<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Repositories\StructureRepository;
use App\Repositories\UserRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\RequeteRepository;

use App\Repositories\ImpotRepository;
use App\Repositories\VignetteRepository;
use App\Repositories\PassportRepository;
use App\Repositories\CarteIdentiteRepository;
use App\Repositories\EdmRepository;
use App\Repositories\SomagepRepository;

use App\Models\Structure;
use App\Models\Service;
use App\Models\Requete;
use App\Models\Notification;
use App\Models\Rubrique;
use App\Models\Entreprise;
class RequeteController extends Controller
{
    protected $serviceRepository;
    protected $structureRepository;
    protected $userRepository;
    protected $requeteRepository;

    protected $impotRepository;
    protected $vignetteRepository;
    protected $passportRepository;
    protected $carteIdentiteRepository;
    protected $edmRepository;
    protected $somagepRepository;

    public function __construct(ServiceRepository $serviceRepository,StructureRepository $structureRepository, UserRepository $userRepository,RequeteRepository $requeteRepository,
    ImpotRepository $impotRepository, VignetteRepository $vignetteRepository, PassportRepository $passportRepository, CarteIdentiteRepository $carteIdentiteRepository, EdmRepository $edmRepository, SomagepRepository $somagepRepository) {
        $this->middleware('admin-structure-and-agent-only', ['only' => ['index', 'create', 'show', 'update', 'destroy']]);
        $this->serviceRepository = $serviceRepository;
        $this->structureRepository = $structureRepository;
        $this->userRepository = $userRepository;
        $this->requeteRepository = $requeteRepository;
        
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
        $requetes = requete::where('structure_id', Auth::user()->structure_id)->where('etat', '<>', 'Cloturée')->get();
        return view('dashboards.requetes.index', compact('requetes'));
    }
    public function archives()
    {
        $requetes = requete::where('structure_id', Auth::user()->structure_id)->where('etat', 'Cloturée')->get();
        return view('dashboards.requetes.archives', compact('requetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $structures = $this->structureRepository->get();
        $services = $this->serviceRepository->get();
        return view('dashboards.requetes.create', compact('structures','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Session::get('data');
        $structure = $this->structureRepository->getById($data['structure_id']);
        $service = $this->serviceRepository->getById($data['service_id']);
        $rubrique = $service->rubrique()->associate($service->rubrique_id)->rubrique;
        
        //Verification si le service et la structure ont un lien dans notre base de données
        if($structure && $service){
            $lien = DB::select('select * from service_structure where service_id = ? && structure_id = ?', [$service->id, $structure->id]);
            if ($lien == null) {
                return redirect("/service/$service->slug")->withErrors("La structure ou le service est mal sélectionné");
            }
        }else{
            return redirect("/service/$service->slug")->withErrors("La structure ou le service est mal sélectionné");
        }
        $slug = 'requete_'.Auth::user()->id.'_'.time();
        //$data['montant'] = $request->montant_payer;
        $data['slug'] = $slug;
        $data['usager_id'] = Auth::user()->id;
        $data['service_id'] = $service->id;
        $data['structure_id'] = $structure->id;
        $requete = $this->requeteRepository->store($data);
        $data['requete_id'] = $requete->id;

        // Enregistrement dans le table du service en question            

            //Données pour la rubrique impot et taxe
            if($rubrique->slug == "impots-et-taxes"){
                $data['libelle'] = $service->libelle;
                $this->impotRepository->store($data);
            }   
            //Données pour la rubrique automobile
            if($rubrique->slug == "automobile"){
                $this->vignetteRepository->store($data);
            }   
            //Données pour electricité
            if($service->slug == "energie-du-mali"){
                $this->edmRepository->store($data);
            }
            //Données pour eau
            if($service->slug == "somagep"){
                $this->somagepRepository->store($data);
            }

            //Données pour le service carte d'identité
            if($service->slug == "carte-national-didentite"){
                $this->carteIdentiteRepository->store($data);
            }   

            //Données pour le service passport
            if($service->slug == "passport"){
                $this->passportRepository->store($data);
            }   

        //Generation de notification        
        if($service->type == "demande") {
            $description = Auth::user()->prenom." ".Auth::user()->nom." (".Auth::user()->email.") a fait une demande de ".$service->libelle;
        } elseif ($service->type == "paiement") {
            $description = Auth::user()->prenom." ".Auth::user()->nom." (".Auth::user()->email.") a fait effectué le paiement de ".$service->libelle;
        } else {
            $description = $service->libelle;
        }
        $slug_notification = 'notification_'.Auth::user()->id.'_'.time();
        Notification::create([
            'vue' => false,
            'slug' => $slug_notification,
            'description' => $description,
            'destinateur' => 'structure',
            'requete_id' => $requete->id,
            'structure_id' => $requete->structure_id,
            'user_id' => $requete->usager_id,
        ]);
        return redirect("usagers/requetes/$requete->slug")->withStatus("La nouvelle requête a bien été créée");
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
        $structure = Structure::where('id', $requete->structure_id)->first();
        $service = Service::where('id', $requete->service_id)->first();
        $rubrique = Rubrique::where('id', $service->rubrique_id)->first();

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
    

    public function update( $id,Request $request)
    {
        $requete = Requete::find($id);
        $service = $requete->service()->associate($requete->service_id)->service;
        $structure = $requete->structure()->associate($requete->structure_id)->structure;
        $user = Auth::user();

        //si ce nombre est égale à 0 alors mon code est unique, sinon je génère tant que je n'ai pas un nombre égale à 0
        do {
            $code = $this->genereCode(6);
            $codeExit = Requete::where('code', $code)->select('code')->first();
        }while($codeExit != NULL);
         
        if($requete->etat=='En cours') {
            $etat = 'Terminé';
            $code= $code;
            $description = "Le traitement de votre demande de ".$service->libelle." est terminé. Veuillez vou rendre à la structure ".$structure->libelle." avec le code suivant: ".$code;                     
        } else {
            $etat='Cloturée';
            $code = $requete->code;
            $description = "Votre ".$service->libelle." vous à été remis par ".$user->prenom." ".$user->nom." (".$user->email.") dans la structure ".$structure->libelle;
        }
        $request->merge([
            'etat'=> $etat,
            'code'=>  $code,
        ]);
        $this->requeteRepository->update($id, $request->all());
        
        $slug = 'notification_'.Auth::user()->id.'_'.time();
        
        Notification::create([
            'vue' => false,
            'slug' => $slug,
            'description' => $description,
            'destinateur' => 'usager',
            'requete_id' => $requete->id,
            'structure_id' => $requete->structure_id,
            'user_id' => $requete->usager_id,
        ]);

        return redirect("/dashboard/requetes/$requete->slug")->withStatus("La demande a bien été mise à jour");
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
           $requete = Requete::find($id);
           $requete->delete();
   
           // redirect
           return redirect('/dashboard/requetes')->withStatus("La requête a bien été supprimé");
    }
    
    public function detail($slug)
    {
        $requete = $this->requeteRepository->getBySlug($slug);
        $user = $this->userRepository->getById($requete->usager_id);
        $structure = Structure::where('id', $requete->structure_id)->first();
        $service = Service::where('id', $requete->service_id)->first();
        $rubrique = Rubrique::where('id', $service->rubrique_id)->first();

        $entreprise = "";

        // Enregistrement dans le table du service en question            

        //Données pour la rubrique impot et taxe
        if($rubrique->slug == "impots-et-taxes"){
            $data = $this->impotRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
            $entreprise = Entreprise::where('id', $data['entreprise_id'])->first();
        }   
        //Données pour la rubrique automobile
        if($rubrique->slug == "automobile"){
            $data = $this->vignetteRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }   
        //Données pour electricité
        if($service->slug == "energie-du-mali"){
            $data = $this->edmRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }
        //Données pour eau
        if($service->slug == "somagep"){
            $data = $this->somagepRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }
        //Données pour le service carte d'identité
        if($service->slug == "carte-national-didentite"){
            $data = $this->carteIdentiteRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }
        //Données pour le service passport
        if($service->slug == "passport"){
            $data = $this->passportRepository->getByForeignId('requete_id', $requete->id)->first()->toArray();
        }   
        return view('pages.requetes.detail', compact('service', 'user','structure','requete', 'rubrique', 'entreprise', 'data'));
    }
    
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

}
