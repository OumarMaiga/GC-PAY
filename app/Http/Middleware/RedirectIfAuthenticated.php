<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {  
        $guards = empty($guards) ? [null] : $guards;
        $user = $request->user();
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()  && $user->etat === true) {
                return redirect(RouteServiceProvider::HOME);
            }
            else{
                if(Auth::guard($guard)->check() && $user->etat === false)
                return view('auth.login');
            }
        }

        return $next($request);
    }
}
