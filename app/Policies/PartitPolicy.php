<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;

class PartitPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Partit $partit): bool { return true; }

    public function create(User $user): bool
    {
        // "No es permet crear partits manualment" -> Solo admin por mantenimiento
        return $user->role === 'admin';
    }

    public function update(User $user, Partit $partit): bool
    {
        if ($user->role === 'admin') return true;
        
        // Árbitros: "poden modificar el resultat... només si són l’àrbitre assignat"
        return $user->role === 'arbitre' && $user->id === $partit->arbitre_id;
    }

    public function delete(User $user, Partit $partit): bool
    {
        return $user->role === 'admin';
    }
}