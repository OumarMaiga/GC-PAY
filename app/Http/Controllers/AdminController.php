<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users=user::all();
       $users = user::where('type','admin')->get();
        return view('dashboards.admin.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.admin.create');
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
        $user = User::create([
            
            'nom' => $request->nom,
            'email'=>$request->email,
            'prenom'=> $request->prenom,
            'telephone' => $request->telephone,
            'type' => 'admin',
            'adresse' => $request->adresse,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        
        return redirect('/dashboard/admin/')->withStatus("Un nouvel administrateur vient d\'être créé");
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = user::find($id);

        // show the view and pass the user to it
        return view('dashboards.admin.show')->with('user',$user);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = user::find($id);

        // show the view and pass the user to it
        return view('dashboards.admin.edit')->with('user',$user);
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
        $user = user::find($id);
        $user->delete();

        // redirect
        return redirect('/dashboard/admin/')->withStatus("L\'administrateur a bien été supprimé");
    }   
}
