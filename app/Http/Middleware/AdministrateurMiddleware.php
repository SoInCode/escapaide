<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrateurMiddleware
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

        if (Auth::check() && Auth::user() instanceof \App\Models\Utilisateur && Auth::user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès non autorisé');
    }
}
