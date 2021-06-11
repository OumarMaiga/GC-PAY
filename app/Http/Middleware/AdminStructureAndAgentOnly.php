<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStructureAndAgentOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->type != 'admin-structure' && Auth::user()->type != 'agent') {
            return redirect()->back()->withDenied('Accès Interdit');
        }
        return $next($request);
    }
}
