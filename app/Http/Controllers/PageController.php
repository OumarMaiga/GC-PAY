<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rubrique;
use App\Repositories\RubriqueRepository;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use App\Models\Entreprise;
use App\Repositories\EntrepriseRepository;

class PageController extends Controller
{
    protected $rubriqueRepository;
    protected $serviceRepository;
    protected $entrepriseRepository;
   
    public function __construct(RubriqueRepository $rubriqueRepository,ServiceRepository $serviceRepository,EntrepriseRepository $entrepriseRepository){
        $this->rubriqueRepository = $rubriqueRepository;
        $this->serviceRepository = $serviceRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        
    }
    public function dashboard() {
        return view('dashboards.index');
    }

    public function accueil() {
        $rubriques = $this->rubriqueRepository->get();
        return view('pages.accueil', compact('rubriques'));
    }

    public function detail($slug) {
        $service = $this->serviceRepository->getBySlug($slug);
        $structures = $service->structures()->get();
        $rubrique=$this->rubriqueRepository->getById($service->rubrique_id);
        
        if(Auth::check())
           {$entreprises= $this->entrepriseRepository->getByForeignId('user_id', Auth::user()->id);
        }
        else{
            $entreprises=NULL;
        }
       
       return view('pages.detail', compact('service','rubrique','entreprises', 'structures'));
    }

    public function verification($slug, Request $request) {
        $service = $this->serviceRepository->getBySlug($slug);
        $rubrique = $service->rubrique()->associate($service->rubrique_id)->rubrique;

        // Validation par type de service
            //Données pour la rubrique impot et taxe
            if($rubrique->slug == "impots-et-taxes"){
                $request->validate([
                    'entreprise_id' => ['required', 'numeric'],
                    'montant_declarer' => ['required', 'numeric'],
                    'montant_payer' => ['required', 'numeric'],
                    'periode' => ['required'],
                    'structure_id' => ['required', 'numeric'],
                ]);
            }   
            //Données pour la rubrique automobile
            if($rubrique->slug == "automobile"){
                $request->validate([
                    'numero_chassis' => ['required', 'alpha_num', 'min:10'],
                    'structure_id' => ['required', 'numeric'],
                ]);
            }   
            //Données pour electricité
            if($service->slug == "energie-du-mali"){
                $request->validate([
                    'numero_facture' => ['required', 'alpha_num'],
                    'montant' => ['required', 'numeric'],
                    'structure_id' => ['required', 'numeric'],
                ]);
            }
            //Données pour eau
            if($service->slug == "somagep"){
                $request->validate([
                    'numero_facture' => ['required', 'alpha_num'],
                    'montant' => ['required', 'numeric'],
                    'structure_id' => ['required', 'numeric'],
                ]);
            }

            //Données pour le service carte d'identité
            if($service->slug == "carte-national-didentite"){
                $today = date('Y-m-d');
                $request->validate([
                    'nom' => ['required'],
                    'prenom' => ['required'],
                    'date_naissance' => ['required', 'date_format:Y-m-d', 'before:'.$today],
                    'lieu_naissance' => ['required'],
                    'prenom_pere' => ['required'],
                    'prenom_nom_mere' => ['required'],
                    'adresse' => ['required'],
                    'profession' => ['required'],
                    'taille' => ['required'],
                    'teint' => ['required'],
                    'cheveux' => ['required'],
                    'structure_id' => ['required', 'numeric'],
                ]);
            }   

            //Données pour le service passport
            if($service->slug == "passport"){
                $today = date('Y-m-d');
                $request->validate([
                    'nom' => ['required'],
                    'prenom' => ['required'],
                    'date_naissance' => ['required', 'date_format:Y-m-d', 'before:'.$today],
                    'lieu_naissance' => ['required'],
                    'numero_nina' => ['required'],
                    'adresse' => ['required'],
                    'structure_id' => ['required', 'numeric'],
                ]);                
            }

            // Mettre les fichiers dans un dossier temporaire
            
            if ($request->has('identite')) {
                $identiteName = time().'_'.$request->file('identite')->getClientOriginalName();
                $identitePath = $request->file('identite')->storeAs("uploads/temps/identite/".Auth::user()->id, $identiteName, 'public');
            }
            if ($request->has('photo-identite')) {
                $photoIdentiteName = time().'_'.$request->file('photo-identite')->getClientOriginalName();
                $photoIdentitePath = $request->file('photo-identite')->storeAs("uploads/temps/photo_identite/".Auth::user()->id, $photoIdentiteName, 'public');
            }
            if ($request->has('identite-tuteur')) {
                $identiteTuteurName = time().'_'.$request->file('identite-tuteur')->getClientOriginalName();
                $identiteTuteurPath = $request->file('identite-tuteur')->storeAs("uploads/temps/identite_tuteur/".Auth::user()->id, $identiteTuteurName, 'public');
            }
            if ($request->has('autorisation-parentale')) {
                $autorisationParentaleName = time().'_'.$request->file('autorisation-parentale')->getClientOriginalName();
                $autorisationParentalePath = $request->file('autorisation-parentale')->storeAs("uploads/temps/autorisation_parentale/".Auth::user()->id, $autorisationParentaleName, 'public');
            }
            if ($request->has('patente')) {
                $patenteName = time().'_'.$request->file('patente')->getClientOriginalName();
                $patentePath = $request->file('patente')->storeAs("uploads/temps/patente/".Auth::user()->id, $patenteName, 'public');
            }
            if ($request->has('justificatif-vignette')) {
                $justificatifVignetteName = time().'_'.$request->file('justificatif-vignette')->getClientOriginalName();
                $justificatifVignettePath = $request->file('justificatif-vignette')->storeAs("uploads/temps/justificatif_vignette/".Auth::user()->id, $justificatifVignetteName, 'public');
            }

        $request->merge([
            'service_id' => $service->id
        ]);

        $inputs = $request->except('identite', 'photo-identite', 'identite-tuteur', 'autorisation-parentale', 'patente', 'justificatif-vignette');

        //Transformer les files en string pour que ça passe par url
        //Passport
        if (isset($identitePath)) {
            $inputs['identitePath'] = $identitePath;
            $inputs['identiteName'] = $identiteName;
        } 
        if (isset($photoIdentitePath)) {
            $inputs['photoIdentitePath'] = $photoIdentitePath;
            $inputs['photoIdentiteName'] = $photoIdentiteName;
        } 
        if (isset($identiteTuteurPath)) {
            $inputs['identiteTuteurPath'] = $identiteTuteurPath;
            $inputs['identiteTuteurName'] = $identiteTuteurName;
        } 
        if (isset($autorisationParentalePath)) {
            $inputs['autorisationParentalePath'] = $autorisationParentalePath;
            $inputs['autorisationParentaleName'] = $autorisationParentaleName;
        }
        if (isset($patentePath)) {
            $inputs['patentePath'] = $patentePath;
            $inputs['patenteName'] = $patenteName;
        }
        //Vignette
        if (isset($justificatifVignettePath)) {
            $inputs['justificatifVignettePath'] = $justificatifVignettePath;
            $inputs['justificatifVignetteName'] = $justificatifVignetteName;
        } 
        
        $request->session()->put('data', $inputs);
        $data = $request->session()->get("data");
        
        $entreprise = "";
        if ($request->has('entreprise_id')) {
            $entreprise = $this->entrepriseRepository->getById($request->entreprise_id);
        }
        return view('pages.resume', compact('service', 'data', 'entreprise'));
    }

    public function paiement($slug) { 
        $data = session()->get("data");
        return view('pages.paiement', compact('data'));
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $rubrique = Rubrique::where('libelle', 'LIKE', "%{$search}%")
           ->first();
    
        // Search in the title and body columns from the posts table
        $services = Service::query()
            ->where('libelle', 'LIKE', "%{$search}%")
            ->get();
            
        if($rubrique == Null)
        {
            $first = Service::query()
            ->where('libelle', 'LIKE', "%{$search}%")
            ->first();
            if($first !=NULL)
            $rubrique = $this->rubriqueRepository->getById($services->first()->rubrique_id);
        }
    
        // Return the search view with the resluts compacted
        return view('pages.recherche', compact('services','search', 'rubrique'));
    }
}
