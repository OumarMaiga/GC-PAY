<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;

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

}
