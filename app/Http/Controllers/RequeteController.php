<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\StructureRepository;
use App\Repositories\UserRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\RequeteRepository;
use Illuminate\Support\Str;
use App\Models\Structure;
use App\Models\Service;
use App\Models\Requete;
use App\Models\Notification;


class RequeteController extends Controller
{
    protected $serviceRepository;
    protected $structureRepository;
    protected $userRepository;
    protected $requeteRepository;

    public function __construct(ServiceRepository $serviceRepository,StructureRepository $structureRepository, UserRepository $userRepository,RequeteRepository $requeteRepository) {
        
        $this->serviceRepository = $serviceRepository;
        $this->structureRepository = $structureRepository;
        $this->userRepository = $userRepository;
        $this->requeteRepository = $requeteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requetes = requete::where('structure_id',Auth::user()->structure_id)
        ->get();
        return view('pages.requetes.index',compact('requetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $structures = $this->structureRepository->get();
        $services = $this->serviceRepository->get();
       
        return view('pages.requetes.create',compact('structures','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $slug='requete_'.Auth::user()->id.'_'.time();
        $request->merge([
            'slug' => $slug,
            'usager_id' => Auth::user()->id,
        ]);
            
        $requete = $this->requeteRepository->store($request->all());
        //Generation de notification
        $service = $requete->service()->associate($requete->service_id)->service;
        $user = $requete->user()->associate($requete->usager_id)->user;
        
        if($service->type == "demande") {
            $description = $user->prenom." ".$user->nom." (".$user->email.") a fait une demande de ".$service->libelle." le ".$requete->created_at;
        }elseif ($service->type == "paiement") {
            $description = $user->prenom." ".$user->nom." (".$user->email.") a fait effectué le paiement de ".$service->libelle." le ".$requete->created_at;
        }else{
            $description = $service->libelle;
        }
        $slug2 = 'notification_'.Auth::user()->id.'_'.time();
        Notification::create([
            'vue' => false,
            'slug' => $slug2,
            'description' => $description,
            'requete_id' => $requete->id,
            'structure_id' => $requete->structure_id,
            'user_id' => $requete->usager_id,
        ]);
        return redirect('/home')->withStatus("La nouvelle requête a bien été créée");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $requete = $this->requeteRepository->getBySlug($slug);
        $user = $this->userRepository->getById($requete->usager_id);
        $structure = structure::where('id', $requete->structure_id)->select('slug', 'libelle')->first();
        $service = service::where('id', $requete->service_id)->select('slug', 'libelle')->first();
        return view('pages.requetes.show', compact('service', 'user','structure','requete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    
    public function genereCode($longueur)
    {
        $listeCar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chaine = '';
        $max = mb_strlen($listeCar, '8bit') - 1;
        for ($i = 0; $i < $longueur; ++$i) {
            $chaine .= $listeCar[random_int(0, $max)];
        }
        return $chaine;
    }

    public function update( $id,Request $request)
    {
        $request->merge([
            'etat' => 'Terminé',
            'code'=>  $this->genereCode(6),
        ]);
        $this->requeteRepository->update($id, $request->all());
        
        return redirect('/dashboard/requetes/')->withStatus("La demande a bien été cloturée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           // delete
           $requete =Requete::find($id);
           $requete->delete();
   
           // redirect
           return redirect('/dashboard/requetes')->withStatus("La requête a bien été supprimé");
    }
}
