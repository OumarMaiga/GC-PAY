<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
//use App\Repositories\UserRepository;

class SettingController extends Controller
{
/*   protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
*/ 
    public function edit_password() {
        return view('parametres.password');
    }

    public function update_password(Request $request) {
        
        //The passwords matches
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        
            return redirect()->back()->with("error", "Le mot de passe actuel que vous avez fournie n'est pas correct. Veuillez réssayer s'il vous plait.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
            return redirect()->back()->with("error","Le mot de passe actuel doit être different de l'ancien mot de passe. Saisissez un mot de passe différent s'il vous plait.");
        }

        $validatedData = $request->validate([
        'current-password' => 'required',
        'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("status", "Mot de passe changé avec succès !");
    }

}
