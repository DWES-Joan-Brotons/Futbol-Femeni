<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Si el rol del usuario está en la lista permitida
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        abort(403, 'No tienes permisos para acceder a esta página.');
    }
}