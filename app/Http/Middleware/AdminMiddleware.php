<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // On vérifie si l'utilisateur est connecté ET s'il est admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // On laisse passer la requête
        }

        // Sinon, on bloque avec une erreur 403 (Interdit)
        abort(403, "Accès refusé : Réservé aux administrateurs.");
    }
}
