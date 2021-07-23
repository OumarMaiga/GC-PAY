<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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

use App\Models\User;
use App\Models\Structure;
use App\Models\Service;
use App\Models\Requete;
use App\Models\Notification;
use App\Models\Rubrique;
use App\Models\Entreprise;
use App\Models\Paiement;
use App\Models\File;


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
        $structure = structure::where('id', Auth::user()->structure_id)->first();
        $requetes = requete::where('structure_id', Auth::user()->structure_id)->where('etat', '<>', 'Remis')->get()->sortByDesc('id');
        return view('dashboards.requetes.index', compact('requetes', 'structure'));
    }
    public function archives()
    {
        $requetes = requete::where('structure_id', Auth::user()->structure_id)->where('etat', 'Remis')->get()->sortByDesc('id');
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
                $montant = $data['montant_payer'];
                $entreprise_id = $data['entreprise_id'];
            }   
            //Données pour la rubrique automobile
            if($rubrique->slug == "automobile"){
                $this->vignetteRepository->store($data);
                $montant = $service->prix;
                $entreprise_id = Null;
            }   
            //Données pour electricité
            if($service->slug == "energie-du-mali"){
                $this->edmRepository->store($data);
                $montant = $data['montant'];
                $entreprise_id = Null;
            }
            //Données pour eau
            if($service->slug == "somagep"){
                $this->somagepRepository->store($data);
                $montant = $data['montant'];
                $entreprise_id = Null;
            }

            //Données pour le service carte d'identité
            if($service->slug == "carte-national-didentite"){
                $this->carteIdentiteRepository->store($data);
                $montant = $service->prix;
                $entreprise_id = Null;
            }

            //Données pour le service passport
            if($service->slug == "passport"){
                $this->passportRepository->store($data);
                $montant = $service->prix;
                $entreprise_id = Null;
               
            } 
            
            //Deplacer les fichiers du dossier temporaire
            //Fichiers pour passport
            if(array_key_exists('identitePath', $data)){
                $fileIdentite = new File;
                $identiteName = $data['identiteName'];
                $source = $data['identitePath'];
                $destination = "/uploads/documents/identite/".Auth::user()->id."/".$identiteName;
                Storage::disk('public')->move($source, $destination);
                $fileIdentite->libelle = $identiteName;
                $fileIdentite->file_path = '/storage/' . $destination;
                $fileIdentite->type = "identite";
                $fileIdentite->user_id = Auth::user()->id;
                $fileIdentite->requete_id = $requete->id;
                
                $fileIdentite->save();
            }
            if(array_key_exists('photoIdentitePath', $data)){
                $filePhotoIdentite = new File;
                $photoIdentiteName = $data['photoIdentiteName'];
                $source = $data['photoIdentitePath'];
                $destination = "/uploads/documents/photo_identite/".Auth::user()->id."/".$photoIdentiteName;
                Storage::disk('public')->move($source, $destination);
                $filePhotoIdentite->libelle = $photoIdentiteName;
                $filePhotoIdentite->file_path = '/storage/' . $destination;
                $filePhotoIdentite->user_id = Auth::user()->id;
                $filePhotoIdentite->type = "photo-identite";
                $filePhotoIdentite->requete_id = $requete->id;
                
                $filePhotoIdentite->save();
            }
            if(array_key_exists('identiteTuteurPath', $data)){
                $fileIdentiteTuteur = new File;
                $identiteTuteurName = $data['identiteTuteurName'];
                $source = $data['identiteTuteurPath'];
                $destination = "/uploads/documents/identite_tuteur/".Auth::user()->id."/".$identiteTuteurName;
                Storage::disk('public')->move($source, $destination);
                $fileIdentiteTuteur->libelle = $identiteTuteurName;
                $fileIdentiteTuteur->file_path = '/storage/' . $destination;
                $fileIdentiteTuteur->user_id = Auth::user()->id;
                $fileIdentiteTuteur->type = "identite-tuteur";
                $fileIdentiteTuteur->requete_id = $requete->id;
                
                $fileIdentiteTuteur->save();
            }
            if(array_key_exists('autorisationParentalePath', $data)){
                $fileAutorisation = new File;
                $autorisationParentaleName = $data['autorisationParentaleName'];
                $source = $data['autorisationParentalePath'];
                $destination = "/uploads/documents/autorisation_parentale/".Auth::user()->id."/".$autorisationParentaleName;
                Storage::disk('public')->move($source, $destination);
                $fileAutorisation->libelle = $autorisationParentaleName;
                $fileAutorisation->file_path = '/storage/' . $destination;
                $fileAutorisation->user_id = Auth::user()->id;
                $fileAutorisation->type = "autorisation-parentale";
                $fileAutorisation->requete_id = $requete->id;
                
                $fileAutorisation->save();
            }
            if(array_key_exists('patentePath', $data)){
                $filePatente = new File;
                $patenteName = $data['patenteName'];
                $source = $data['patentePath'];
                $destination = "/uploads/documents/photo_identite/".Auth::user()->id."/".$patenteName;
                Storage::disk('public')->move($source, $destination);
                $filePatente->libelle = $patenteName;
                $filePatente->file_path = '/storage/' . $destination;
                $filePatente->user_id = Auth::user()->id;
                $filePatente->type = "patente";
                $filePatente->requete_id = $requete->id;
                
                $filePatente->save();
            }

            //Fichier pour vignette
            if(array_key_exists('justificatifVignettePath', $data)){
                $fileJustificatifVignette = new File;
                $justificatifVignetteName = $data['justificatifVignetteName'];
                $source = $data['justificatifVignettePath'];
                $destination = "/uploads/documents/justificatif_vignette/".Auth::user()->id."/".$justificatifVignetteName;
                Storage::disk('public')->move($source, $destination);
                $fileJustificatifVignette->libelle = $justificatifVignetteName;
                $fileJustificatifVignette->file_path = '/storage/' . $destination;
                $fileJustificatifVignette->user_id = Auth::user()->id;
                $fileJustificatifVignette->type = "justificatif-vignette";
                $fileJustificatifVignette->requete_id = $requete->id;
                
                $fileJustificatifVignette->save();
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
        $slug_paiement = 'paiement_'.Auth::user()->id.'_'.time();
        if ($requete) {
            Notification::create([
                'vue' => false,
                'slug' => $slug_notification,
                'description' => $description,
                'destinateur' => 'structure',
                'requete_id' => $requete->id,
                'structure_id' => $structure->id,
                'user_id' => Auth::user()->id,
            ]);

            Paiement::create([
                'slug' => $slug_paiement,
                'structure_id' => $structure->id,
                'service_id' => $service->id,
                'usager_id' => Auth::user()->id,
                'entreprise_id' => $entreprise_id,
                'requete_id' => $requete->id,
                'montant' => $montant,
            ]);
            
            //Envoie de mail
            $service = $requete->service()->associate($requete->service_id)->service;
            if($service->type == "demande") {
                $description = "Votre demande de $service->libelle a bien été soumis, vous aurez un retour dans $service->duree";
                $subject = "Demande";
            } elseif ($service->type == "paiement") {
                $description = "Votre paiement de $service->libelle a bien été effectuée";
                $subject = "Paiement";
            } else {
                $description = $service->libelle;
                $subject = "";
            }
            $data = [
                'email' => Auth::user()->email,
                'nom' => Auth::user()->nom,
                'prenom' => Auth::user()->prenom,
                'subject' => $subject,
            ];
            Mail::send('emails.demande', ['user' => Auth::user(), 'description' => $description], function ($message) use($data) {
                $message->from('info@gc-pay.com', 'GC PAY');
                $message->sender('info@gc-pay.com', 'GC PAY');
                $message->to($data['email'], $data['nom']." ".$data['prenom']);
                $message->replyTo('info@gc-pay.com', 'GC PAY');
                $message->subject($data['subject']);
            });
        }
        return redirect("usagers/requete/$requete->slug")->withStatus("La nouvelle requête a bien été créée");
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

        //Genere un code unique dans la base de données
        do {
            $code = $this->genereCode(6);
            $codeExit = Requete::where('code', $code)->select('code')->first();
        }while($codeExit != NULL);
         
        if($requete->etat=='En cours') {
            $etat = 'Traitée';
            $code= $code;
            $description = "Le traitement de votre demande de ".$service->libelle." est terminé. Veuillez vous rendre à la structure ".$structure->libelle." avec le code suivant: ".$code;
            $subject = "Traitement";
        } else {
            $etat='Remis';
            $code = $requete->code;
            $description = "Votre ".$service->libelle." vous à été remis par ".$user->prenom." ".$user->nom." (".$user->email.") dans la structure ".$structure->libelle;
            $subject = "Accusé de reception";
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

        //Envoie de mail
        $data = [
            'email' => Auth::user()->email,
            'nom' => Auth::user()->nom,
            'prenom' => Auth::user()->prenom,
            'subject' => $subject,
        ];
        Mail::send('emails.demande', ['user' => Auth::user(), 'description' => $description], function ($message) use($data) {
            $message->from('info@gc-pay.com', 'GC PAY');
            $message->sender('info@gc-pay.com', 'GC PAY');
            $message->to($data['email'], $data['nom']." ".$data['prenom']);
            $message->replyTo('info@gc-pay.com', 'GC PAY');
            $message->subject($data['subject']);
        });
        
        return redirect("/dashboard/requete/$requete->slug")->withStatus("La demande a bien été mise à jour");
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
           return redirect('/dashboard/requete')->withStatus("La requête a bien été supprimé");
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

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        
        $requetes = Requete::query()
            ->where('code', $search)
            ->where('structure_id', Auth::user()->structure_id)->get();
           
        // Return the search view with the resluts compacted
        return view('dashboards.requetes.index', compact('requetes'));
    }

}
