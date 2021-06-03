<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use App\Repositories\UserRepository;

use App\Repositories\EntrepriseRepository;
use Illuminate\Support\Str;

use App\Models\Entreprise;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $userRepository;

    public function __construct(EntrepriseRepository $entrepriseRepository, UserRepository $userRepository) {
        $this->middleware('admin-systeme-only', ['only' => ['index', 'create', 'store', 'destroy']]);
        $this->entrepriseRepository = $entrepriseRepository;
        $this->userRepository = $userRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('dashboards.entreprise.create');
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
        //
        $request->validate([
            'nom' => 'required|max:255',
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('nom')),
            'utilisateur_id' => Auth::user()->id,
        ]);
            
        $entreprise = $this->entrepriseRepository->store($request->all());

        return redirect('/dashboard/entreprise/')->withStatus("Une nouvelle entreprise vient d'être ajouté");
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
        
        $user = user::where('id', $entreprise->utilisateur_id)->select('nom', 'prenom')->first();
        // show the view and pass the user to it
        return view('dashboards.entreprise.show',compact('user','entreprise'));
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
        return view('dashboards.entreprise.edit',compact('entreprise'));
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
}
