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
        $request->validate([
            'structure_id' => ['required', 'numeric'],
        ]);
        $service = $this->serviceRepository->getBySlug($slug);
        $request->merge([
            'service_id' => $service->id
        ]);
        $request->session()->put('data', $request->all());
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
            
            $rubrique = $this->rubriqueRepository->getById($services->first()->rubrique_id);
        }
    
        // Return the search view with the resluts compacted
        return view('pages.recherche', compact('services','search', 'rubrique'));
    }
}
