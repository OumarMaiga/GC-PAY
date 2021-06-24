<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\RequeteRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;

use App\Repositories\ImpotRepository;
use App\Repositories\VignetteRepository;
use App\Repositories\PassportRepository;
use App\Repositories\CarteIdentiteRepository;
use App\Repositories\EdmRepository;
use App\Repositories\SomagepRepository;

use App\Models\Structure;
use App\Models\Service;
use App\Models\Rubrique;
use App\Models\Notification;
use App\Models\Entreprise;

class NotificationController extends Controller
{
    protected $notificationRepository;
    protected $requeteRepository;
    protected $userRepository;
    
    protected $impotRepository;
    protected $vignetteRepository;
    protected $passportRepository;
    protected $carteIdentiteRepository;
    protected $edmRepository;
    protected $somagepRepository;

    public function __construct(UserRepository $userRepository, NotificationRepository $notificationRepository, RequeteRepository $requeteRepository,
    ImpotRepository $impotRepository, VignetteRepository $vignetteRepository, PassportRepository $passportRepository, CarteIdentiteRepository $carteIdentiteRepository, EdmRepository $edmRepository, SomagepRepository $somagepRepository) {
        $this->middleware('admin-structure-and-agent-only', ['only' => ['index', 'show']]);
        $this->notificationRepository = $notificationRepository;
        $this->requeteRepository = $requeteRepository;
        $this->userRepository = $userRepository;
        
        $this->impotRepository = $impotRepository;
        $this->vignetteRepository = $vignetteRepository;
        $this->passportRepository = $passportRepository;
        $this->carteIdentiteRepository = $carteIdentiteRepository;
        $this->edmRepository = $edmRepository;
        $this->somagepRepository = $somagepRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::where('structure_id', Auth::user()->structure_id)->where('destinateur', 'structure')->get();
        return view('dashboards.notification.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $notification = $this->notificationRepository->getBySlug($slug);
        $requete = $notification->requete()->associate($notification->user_id)->requete;
        $user = $this->userRepository->getById($requete->usager_id);
        $structure = Structure::where('id', $requete->structure_id)->first();
        $service = Service::where('id', $requete->service_id)->first();
        $rubrique = Rubrique::where('id', $service->rubrique_id)->first();

        if ($notification->vue == false) {
            Notification::where('id', $notification->id)->update([
                'vue' => true
            ]);
        }
        $entreprise = "";
        // Recuperation des données dans le table du service en question            
        // Données pour la rubrique impot et taxe
        if($rubrique->slug == "impots-et-taxes"){
            $data = $this->impotRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
            $entreprise = Entreprise::where('id', $data['entreprise_id'])->first();
        }   
        // Données pour la rubrique automobile
        if($rubrique->slug == "automobile"){
            $data = $this->vignetteRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }   
        // Données pour electricité
        if($service->slug == "energie-du-mali"){
            $data = $this->edmRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }
        // Données pour eau
        if($service->slug == "somagep"){
            $data = $this->somagepRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }
        // Données pour le service carte d'identité
        if($service->slug == "carte-national-didentite"){
            $data = $this->carteIdentiteRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }
        // Données pour le service passport
        if($service->slug == "passport"){
            $data = $this->passportRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }   

        return view('dashboards.requetes.show', compact('service', 'user','structure','requete', 'rubrique', 'entreprise', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
