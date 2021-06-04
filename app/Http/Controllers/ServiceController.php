<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\StructureRepository;
use App\Repositories\UserRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\RubriqueRepository;
use Illuminate\Support\Str;
use App\Models\Structure;
use App\Models\Service;
use App\Models\Rubrique;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $serviceRepository;
    protected $structureRepository;
    protected $userRepository;
    protected $rubriqueRepository;

    public function __construct(ServiceRepository $serviceRepository,StructureRepository $structureRepository, UserRepository $userRepository,RubriqueRepository $rubriqueRepository) {
        $this->middleware('admin-systeme-only', ['only' => ['index', 'create', 'store', 'destroy']]);
        $this->serviceRepository = $serviceRepository;
        $this->structureRepository = $structureRepository;
        $this->userRepository = $userRepository;
        $this->rubriqueRepository = $rubriqueRepository;
    }

    public function index()
    {
        //
        $services = $this->serviceRepository->get();
        return view('dashboards.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $structures = $this->structureRepository->get();
        $rubriques = $this->rubriqueRepository->get();
        return view('dashboards.services.create',compact('structures','rubriques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'libelle' => 'required|max:255',
        ]);

        $nbreLibelle = Service::where('libelle', $request->libelle)->count();
        
        if ($nbreLibelle != '0') {
            $slug = Str::slug($request->get('libelle'))."-".$nbreLibelle;
        }
        else {
            $slug = Str::slug($request->get('libelle'));
        }

        $request->merge([
            'slug' => $slug,
            'admin_systeme_id' => Auth::user()->id,
        ]);
            
        $service = $this->serviceRepository->store($request->all());

        return redirect('/dashboard/service/')->withStatus("Un nouveau service vient d'être ajouté");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $service = $this->serviceRepository->getBySlug($slug);
        $user = $this->userRepository->getById($service->admin_systeme_id);
        $structure = structure::where('id', $service->structure_id)->select('slug', 'libelle')->first();
        $rubrique = Rubrique::where('id', $service->rubrique_id)->select('slug', 'libelle')->first();
        return view('dashboards.services.show', compact('service', ('user'),('structure'),('rubrique')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $service= $this->serviceRepository->getBySlug($slug);
        $structures = $this->structureRepository->get();
        $rubriques = $this->rubriqueRepository->get();
        // show the view and pass the service to it
        return view('dashboards.services.edit',compact('service','structures','rubriques'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id, Request $request)
    {
        $this->serviceRepository->update($id, $request->all());
        
        return redirect('/dashboard/service/')->withStatus("Le service vient d'être mise à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // delete
        $service = Service::find($id);
        $service->delete();

        // redirect
        return redirect('/dashboard/service/')->withStatus("Le service a bien été supprimé");
    }
}
