<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rubrique;
use App\Repositories\RubriqueRepository;

class PageController extends Controller
{
    protected $rubriqueRepository;
   
    public function __construct(RubriqueRepository $rubriqueRepository){
        $this->rubriqueRepository = $rubriqueRepository;
        
    }
    public function dashboard() {
        return view('dashboards.index');
    }

    public function acceuil() {
        $rubriques = $this->rubriqueRepository->get();
        return view('pages.acceuil',compact('rubriques'));
    }
}
