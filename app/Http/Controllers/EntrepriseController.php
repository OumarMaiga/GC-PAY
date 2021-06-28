<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Repositories\UserRepository;
use App\Repositories\EntrepriseRepository;

use App\Models\User;
use App\Models\Entreprise;

use App\Repositories\RequeteRepository;
use App\Models\Requete;


use App\Repositories\ImpotRepository;
use App\Models\Impot;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $userRepository;
    protected $requeteRepository;
    protected $impotRepository;

    public function __construct(EntrepriseRepository $entrepriseRepository, RequeteRepository $requeteRepository,UserRepository $userRepository,ImpotRepository $impotRepository) {
        
        $this->entrepriseRepository = $entrepriseRepository;
        $this->userRepository = $userRepository;
        $this->requeteRepository = $requeteRepository;
        $this->impotRepository = $impotRepository;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises = $this->entrepriseRepository->get();
        return view('dashboards.entreprise.index', compact('entreprises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = $this->userRepository->get();
        return view('dashboards.entreprise.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'nif' => 'required|unique:entreprises|alpha_num|size:10',
        ]);

        $nbreLibelle = Entreprise::where('nom', $request->nom)->count();
        
        if ($nbreLibelle != '0') {
            $slug = Str::slug($request->get('nom'))."-".$nbreLibelle;
        }
        else {
            $slug = Str::slug($request->get('nom'));
        }
        
        $request->merge([
            'slug' => $slug,
            'user_id' => Auth::user()->id,
        ]);
            
        $entreprise = $this->entrepriseRepository->store($request->all());
        if(Auth::user()->type == "usager"){
            return redirect('/usagers/entreprise/')->withStatus("Une nouvelle entreprise vient d'être ajouté");
        } else {
            return redirect('/dashboard/entreprise/')->withStatus("Une nouvelle entreprise vient d'être ajouté");
        }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $entreprise = $this->entrepriseRepository->getBySlug($slug);
        
        $user = User::where('id', $entreprise->user_id)->select('nom', 'prenom', 'email', 'type')->first();
        
        $impots=Impot::where('entreprise_id',$entreprise->id)->get();

        return view('dashboards.entreprise.show',compact('user','entreprise','impots'));
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
        $entreprise= $this->entrepriseRepository->getBySlug($slug);
        // show the view and pass the service to it
        $users = $this->userRepository->get();
        $impots=Impot::where('entreprise_id',$entreprise->id)->get();
        return view('dashboards.entreprise.edit',compact('entreprise','users','impots'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id,Request $request)
    {
        //
        $this->entrepriseRepository->update($id, $request->all());
        
        return redirect('/dashboard/entreprise/')->withStatus("L'entreprise vient d'être mise à jour");
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
        $entreprise = entreprise::find($id);
        $entreprise->delete();

        // redirect
        return redirect('/dashboard/entreprise/')->withStatus("L'entreprise a bien été supprimé");
    }
    
    public function list()
    {
        $entreprises = Entreprise::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboards.entreprise.entreprise_usager', compact('entreprises'));
    }
}
