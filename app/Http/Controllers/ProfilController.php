<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilRequest;
use Illuminate\Http\Requests;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

use App\Http\Controllers\Controller;
use Image;



class ProfilController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function profil($email) {
        $user = Auth::user();
        $file = $user->file()->associate($user->id)->file;
        
        return view('pages.profil', compact('user', 'file'));
    }

    public function edit($email) {
        $user = Auth::user();
        return view('pages.edit', compact('user'));
    }
    
    public function update($email, UpdateProfilRequest $request)
    {
        $user = $this->userRepository->getByEmail($email);
        
        $this->userRepository->update($user->id, $request->all());

        if($request->hasFile('avatar')){
            $avatar = new File;
            $filename='profil_picture_user_'.$user->id.'.'.$request->file('avatar')->getClientOriginalExtension();
            $avatar->libelle=$filename;
            $avatar->file_path='/storage/app/public/profil_pictures/'.$filename;
            $avatar->utilisateur_id = $user->id;
            $request->file('avatar')->storeAs('public/profil_pictures',$filename);
            $avatar->save();
            $user=Auth::user();
            $user->save();
        }

            return redirect('/'.$email)->withStatus("Votre profil a bien été mis à jour");

    }
}
