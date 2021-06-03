<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
   
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        
        $this->userRepository = $userRepository;
    }
    
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        
        $request->authenticate();
        $user = $this->userRepository->getByEmail($request->login);
        //si la personne se connecte avec son numéro de téléphone
        if($user==NULL)
        {
            $user=user::where('telephone',$request->login)->select('etat')->first();

        }
        if($user->etat==true)
        {
           if($user->type=='admin-systeme')
           {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
           }
           else{
            $request->session()->regenerate();

            return redirect("/$user->email");
           }

            
        }
        else
        {
            return redirect('/login')->withError("Utilisateur bloqué");
        }

        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
