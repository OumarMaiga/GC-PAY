<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilRequest;
use Illuminate\Http\Requests;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;

use App\Http\Controllers\Controller;



class ProfilController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }


    public function profil($email) {
        $user = $this->userRepository->getByEmail($email);
        return view('pages.profil', compact('user'));
    }
    
    public function edit($id) {

    }
    public function update($email,UpdateProfilRequest $request)
    {
        $user = $this->userRepository->getByEmail($email);
       
        $user()->update(
            $user()->email,
        [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);
            session()->flash('success','Votre profil a bien été mis à jour');
            return redirect()->back;
    }
}
