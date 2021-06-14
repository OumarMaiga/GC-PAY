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

class AgentController extends Controller
{    
    protected $structureRepository;
    protected $userRepository;

    public function __construct(StructureRepository $structureRepository, UserRepository $userRepository) {
        $this->middleware('admin-structure-only', ['only' => ['create', 'store', 'destroy']]);
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
        $user = Auth::user();
        if ($user->type == "admin-systeme") {
            $agents = $this->userRepository->getByForeignId('type', 'agent');
        } elseif ($user->type == "admin-structure" || $user->type == "agent") {
            $agents = User::where('type', 'agent')->where('structure_id', $user->structure_id)->get();
        } else {
            $agents = [];
        }
        return view('dashboards.agent.index')->with('users', $agents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboards.agent.create');
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
            'structure_id' => Auth::user()->structure_id,
            'type' => 'agent',
            'password' => Hash::make($request->get('password')),
        ]);
        
        $user = $this->userRepository->store($request->all());

        event(new Registered($user));

        return redirect('/dashboard/agent/')->withStatus("Un nouvel agent vient d'être ajouter");
       
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
        
        $structure = $this->structureRepository->getById($user->structure_id)->select('slug', 'libelle')->first();

        return view('dashboards.agent.show',compact('user','structure'));

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

        return view('dashboards.agent.edit', compact('user'));

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
        $this->userRepository->update($id, $request->all());
        
        return redirect('/dashboard/agent/')->withStatus("L'Agent vient d'être mise à jour");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->userRepository->destroy($id);
        return redirect()->back()->withStatus("L'agent a bien été supprimé");
    }
}
