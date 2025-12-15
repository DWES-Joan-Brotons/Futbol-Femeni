<?php

namespace App\Policies;

use App\Models\Jugadora;
use App\Models\User;

class JugadoraPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Jugadora $jugadora): bool { return true; }

    public function create(User $user): bool
    {
        // Admin o Manager con equipo asignado
        return $user->role === 'admin' || ($user->role === 'manager' && $user->team_id);
    }

    public function update(User $user, Jugadora $jugadora): bool
    {
        // Admin o Manager del MISMO equipo
        return $user->role === 'admin' || 
               ($user->role === 'manager' && $user->team_id === $jugadora->equip_id);
    }

    public function delete(User $user, Jugadora $jugadora): bool
    {
        return $user->role === 'admin' || 
               ($user->role === 'manager' && $user->team_id === $jugadora->equip_id);
    }
}