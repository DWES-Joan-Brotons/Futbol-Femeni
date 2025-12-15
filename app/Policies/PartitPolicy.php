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
        // Solo admin puede crear partidos manualmente
        return $user->role === 'admin';
    }

    public function update(User $user, Partit $partit): bool
    {
        if ($user->role === 'admin') return true;

        // Árbitro solo si está asignado al partido
        if ($user->role === 'arbitre') {
            return $user->id === $partit->arbitre_id;
        }

        return false;
    }

    public function delete(User $user, Partit $partit): bool
    {
        return $user->role === 'admin';
    }
}