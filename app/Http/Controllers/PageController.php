<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rubrique;
use App\Repositories\RubriqueRepository;
use App\Models\Service;
use App\Repositories\ServiceRepository;

class PageController extends Controller
{
    protected $rubriqueRepository;
    protected $serviceRepository;
   
    public function __construct(RubriqueRepository $rubriqueRepository,ServiceRepository $serviceRepository){
        $this->rubriqueRepository = $rubriqueRepository;
        $this->serviceRepository = $serviceRepository;
        
    }
    public function dashboard() {
        return view('dashboards.index');
    }

    public function accueil() {
        $rubriques = $this->rubriqueRepository->get();
        return view('pages.accueil',compact('rubriques'));
    }

    public function detail($slug) {
        $service = $this->serviceRepository->getBySlug($slug);
        return view('pages.detail',compact('service'));
    }
    public function store(Request $request) {
       
        return view('pages.detail');
    }
}
