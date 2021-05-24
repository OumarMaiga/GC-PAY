<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilRequest;
use Illuminate\Http\Requests;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Image;



class ProfilController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function propos($email) {
        $user = Auth::user();
        return view('pages.propos', compact('user'));
    }
    public function profil($email) {
        $user = Auth::user();
        return view('pages.profil', compact('user'));
    }
    
    public function update($email, UpdateProfilRequest $request)
    {
        $user = $this->userRepository->getByEmail($email);
        
        $this->userRepository->update($user->id, $request->all());

        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('upload/avatars/'.$filename));
            $user=Auth::user();
            $user->avatar=$filename;
            $user->save();
        }

            return redirect('/{email}')->withStatus("Votre profil a bien été mis à jour");

    }
}
