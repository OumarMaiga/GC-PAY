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
            $fileModel = new File;
            $fileName = time().'_'.$request->file('avatar')->getClientOriginalName();
            $filePath = $request->file('avatar')->storeAs("uploads/profil_pictures/$user->id", $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->user_id = $user->id;
            
            $fileModel->save();
            $user->save();
        }

            return redirect('/'.$email)->withStatus("Votre profil a bien été mis à jour");

    }
}
