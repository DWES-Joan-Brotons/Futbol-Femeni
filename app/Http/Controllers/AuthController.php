<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Error en l\'autenticació amb Google.']);
        }

        // 1. Busquem si l'usuari ja existeix pel correu electrònic
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // REGLA: La resta d'usuaris (admin, manager, àrbitre) NO poden entrar amb Google.
            if ($existingUser->role !== 'convidat') {
                return redirect()->route('login')->withErrors([
                    'email' => 'Els usuaris amb rol ' . $existingUser->role . ' han d\'iniciar sessió amb contrasenya.'
                ]);
            }

            // Si és convidat, actualitzem el Google ID i l'avatar si cal
            $existingUser->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            Auth::login($existingUser);
        } else {
            // 2. Si no existeix, el creem amb el rol 'convidat'
            // REGLA: Sense password (posem un random inútil) i sense permisos especials.
            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'role' => 'convidat', // Rol obligatori per a nous usuaris de Google
                'password' => bcrypt(str()->random(24)), // Password aleatori inaccessible
            ]);

            Auth::login($newUser);
        }

        return redirect('/dashboard'); // Redirigeix a la pàgina principal
    }
}