<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Models\User;
//use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{

    /*protected $username;

    public function __construct() {
        $this->username = $this->findUsername();
    }

    public function findUsername() {
        $login = request()->input('login');
        $fieldtype = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';
        request()->merge([$fieldtype => $login]);
        return $fieldtype;
    }

    public function username() {
        return $this->username;
    }*/

    
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

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
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
