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
        $rubrique=$this->rubriqueRepository->getById($service->rubrique_id);
        $entreprises= $this->entrepriseRepository->get();
        
        return view('pages.detail', compact('service','rubrique','entreprises'));
    }

    public function verification($slug, Request $request) {
        $service = $this->serviceRepository->getBySlug($slug);
        return view('pages.resume', compact('service'));
    }

}
