<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\RubriqueRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Structure;

class RubriqueController extends Controller
{
    protected $rubriqueRepository;
    protected $userRepository;

    public function __construct(RubriqueRepository $rubriqueRepository, UserRepository $userRepository) {
        $this->rubriqueRepository = $rubriqueRepository;
        $this->userRepository = $userRepository;
    }

    public function index() {
        $rubriques = $this->rubriqueRepository->get();
        return view('dashboards.rubriques.index', compact('rubriques'));
    }
    
    public function create() {
        return view('dashboards.rubriques.create');
    }

    public function store(Request $request) {

        $request->validate([
            'libelle' => 'required|max:255',
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('libelle')),
            'admin_systeme_id' => Auth::user()->id,
        ]);
            
        $this->rubriqueRepository->store($request->all());

        return redirect('/dashboard/rubrique/')->withStatus("Nouvelle rubrique vient d'être ajouté");
    
    }

    public function show($slug) {
        $rubrique = $this->rubriqueRepository->getBySlug($slug);
        $user = $this->userRepository->getById($rubrique->admin_systeme_id);
        return view('dashboards.rubriques.show', compact('rubrique', ('user')));
    }
    
    public function edit($slug) {
		$rubrique = $this->rubriqueRepository->getBySlug($slug);
        return view('dashboards.rubriques.edit', compact('rubrique'));
    }
    
    public function update($id, Request $request) {
        $this->rubriqueRepository->update($id, $request->all());
        return redirect('/dashboard/rubrique/')->withStatus("rubrique vient d'être mise à jour");
    }

    public function destroy($id) {
		$this->rubriqueRepository->destroy($id);
        return redirect()->back();
    }
}