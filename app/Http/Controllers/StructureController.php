<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StructureRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Structure;

class StructureController extends Controller
{
    protected $structureRepository;

    public function __construct(StructureRepository $structureRepository) {
        $this->middleware('admin-systeme-only', ['only' => ['index', 'create', 'store', 'destroy']]);
        $this->structureRepository = $structureRepository;
    }

    public function index() {
        $structures = $this->structureRepository->get();
        return view('dashboards.structures.index', compact('structures'));
    }

    public function create() {
        return view('dashboards.structures.create');
    }

    public function store(Request $request) {

        $request->validate([
            'libelle' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        $nbreLibelle = Structure::where('libelle', $request->libelle)->count();
        
        if ($nbreLibelle != '0') {
            $slug = Str::slug($request->get('libelle'))."-".$nbreLibelle;
        }
        else {
            $slug = Str::slug($request->get('libelle'));
        }
        
        $request->merge([
            'slug' => $slug,
            'user_id' => Auth::user()->id,
        ]);
            
        $structure = $this->structureRepository->store($request->all());

        return redirect('/dashboard/structure/')->withStatus("Nouvelle structure vient d'être ajouté");
    
    }

    public function show($slug) {
        $structure = $this->structureRepository->getBySlug($slug);
        $admin = User::where('structure_id', $structure->id)->select('email', 'nom', 'prenom')->first();
        return view('dashboards.structures.show', compact('structure', 'admin'));
    }
    
    public function edit($slug) {
		$structure = $this->structureRepository->getBySlug($slug);
        return view('dashboards.structures.edit', compact('structure'));
    }
    
    public function update($id, Request $request) {
        $this->structureRepository->update($id, $request->all());
        return redirect('/dashboard/structure/')->withStatus("Structure vient d'être mise à jour");
    }

    public function destroy($id) {
		$this->structureRepository->destroy($id);
        return redirect()->back();
    }
}
