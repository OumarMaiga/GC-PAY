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
use Illuminate\Support\Str;
use App\Models\Structure;
use App\Models\Services;

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

    public function __construct(ServiceRepository $serviceRepository,StructureRepository $structureRepository, UserRepository $userRepository) {
        $this->serviceRepository = $serviceRepository;
        $this->structureRepository = $structureRepository;
        $this->userRepository = $userRepository;
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
        return view('dashboards.services.create',compact('structures'));
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

        $request->merge([
            'slug' => Str::slug($request->get('libelle')),
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
    public function show($lug)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $service = services::find($id);
        $service->delete();

        // redirect
        return redirect('/dashboard/service/')->withStatus("Le service a bien été supprimé");
    }
}
