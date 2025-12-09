<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Comprova si hi ha un idioma a la sessió i si és vàlid
        if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'es', 'ca'])) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}