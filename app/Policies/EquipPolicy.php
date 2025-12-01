<?php

namespace App\Policies;

use App\Models\Equip;
use App\Models\User;

class EquipPolicy
{
    /**
     * Determina si l'usuari pot veure el model.
     */
    public function view(User $user, Equip $equip): bool
    {
        return true; // Tothom pot veure
    }

    /**
     * Determina si l'usuari pot crear models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determina si l'usuari pot actualitzar el model.
     */
    public function update(User $user, Equip $equip): bool
    {
        // L'admin pot editar qualsevol equip
        if ($user->role === 'admin') {
            return true;
        }

        // El manager només pot editar si el seu team_id coincideix amb l'equip
        return $user->role === 'manager' && $user->team_id === $equip->id;
    }

    /**
     * Determina si l'usuari pot eliminar el model.
     */
    public function delete(User $user, Equip $equip): bool
    {
        return $user->role === 'admin';
    }
}