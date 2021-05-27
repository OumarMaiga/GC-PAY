<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StructureRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StructureController extends Controller
{
    protected $structureRepository;

    public function __construct(StructureRepository $structureRepository) {
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

        $request->merge([
            'slug' => Str::slug($request->get('libelle')),
            'user_id' => Auth::user()->id,
        ]);
            
        $structure = $this->structureRepository->store($request->all());

        return redirect('/dashboard/structure/')->withStatus("Nouvelle structure vient d'être ajouté");
    
    }

    public function destroy($id) {
		$this->structureRepository->destroy($id);
        return redirect()->back();
    }
}
