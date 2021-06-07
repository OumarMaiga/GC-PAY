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
use App\Repositories\RequeteRepository;
use Illuminate\Support\Str;
use App\Models\Structure;
use App\Models\Service;
use App\Models\Requete;


class RequeteController extends Controller
{
    protected $serviceRepository;
    protected $structureRepository;
    protected $userRepository;
    protected $requeteRepository;

    public function __construct(ServiceRepository $serviceRepository,StructureRepository $structureRepository, UserRepository $userRepository,RequeteRepository $requeteRepository) {
        
        $this->serviceRepository = $serviceRepository;
        $this->structureRepository = $structureRepository;
        $this->userRepository = $userRepository;
        $this->requeteRepository = $requeteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $requetes = requete::where('structure_id',Auth::user()->structure_id)
        ->get();
        return view('pages.requetes.index',compact('requetes'));
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
        $services = $this->serviceRepository->get();
       
        return view('pages.requetes.create',compact('structures','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $slug='Requete_'.Auth::user()->id.'_'.time();
        $request->merge([
            'slug' => $slug,
            'usager_id' => Auth::user()->id,
        ]);
            
        $requete = $this->requeteRepository->store($request->all());

        return redirect('/home')->withStatus("La nouvelle requête a bien été créée");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $requete = $this->requeteRepository->getBySlug($slug);
        $user = $this->userRepository->getById($requete->usager_id);
        $structure = structure::where('id', $requete->structure_id)->select('slug', 'libelle')->first();
        $service = service::where('id', $requete->service_id)->select('slug', 'libelle')->first();
        return view('pages.requetes.show', compact('service', 'user','structure','requete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
           // delete
           $requete =Requete::find($id);
           $requete->delete();
   
           // redirect
           return redirect('/dashboard/requetes')->withStatus("La requête a bien été supprimé");
    }
}
