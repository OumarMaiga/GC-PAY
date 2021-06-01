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
use Illuminate\Support\Str;
use App\Models\Structure;



class AdminController extends Controller
{
    protected $structureRepository;
    protected $userRepository;

    public function __construct(StructureRepository $structureRepository, UserRepository $userRepository) {
        $this->structureRepository = $structureRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users=user::all();
       $users = user::where('type','admin-structure')->get();
        return view('dashboards.admin.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $structures = $this->structureRepository->get();
        return view('dashboards.admin.create', compact('structures'));
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
            'nom' => 'required|string|string|max:255',
            'telephone' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);
        
        $request->merge([
            'type' => 'admin-structure',
            'password' => Hash::make($request->get('password')),
        ]);

        $user = $this->userRepository->store($request->all());

        event(new Registered($user));
        
        return redirect('/dashboard/admin/')->withStatus("Un nouvel administrateur vient d'être créé");
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $user = $this->userRepository->getByEmail($email);
        
        $structure = structure::where('id', $user->structure_id)->select('slug', 'libelle')->first();
        // show the view and pass the user to it
        return view('dashboards.admin.show',compact('user','structure'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($email)
    {
        $user = $this->userRepository->getByEmail($email);
        $structures = $this->structureRepository->get();
        // show the view and pass the user to it
        return view('dashboards.admin.edit',compact('user','structures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $this->userRepository->update($id, $request->all());
        
        return redirect('/dashboard/admin/')->withStatus("L'Administrateur vient d'être mise à jour");
    }

    /**()
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        // delete
        $user = user::find($id);
        $user->delete();

        // redirect
        return redirect('/dashboard/admin/')->withStatus("L\'administrateur a bien été supprimé");
    }   
}
