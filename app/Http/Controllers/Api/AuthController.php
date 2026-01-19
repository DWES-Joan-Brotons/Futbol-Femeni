<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Retorna l'usuari autenticat i les seves dades.
     */
    public function profile(Request $request): JsonResponse
    {
        // Obtenim l'usuari autenticat (gràcies al middleware auth:sanctum)
        $user = $request->user();

        return response()->json([
            'status' => true,
            'message' => 'Dades del perfil recuperades correctament',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,       // Camp role del model User
                'team_id' => $user->team_id, // Camp team_id del model User
                // Pots afegir més camps si cal
            ]
        ], 200);
    }
}