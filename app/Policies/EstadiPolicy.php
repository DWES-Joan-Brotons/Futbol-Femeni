<?php

namespace App\Policies;

use App\Models\Estadi;
use App\Models\User;

class EstadiPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Estadi $estadi): bool { return true; }

    // Solo admin puede gestionar estadios
    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, Estadi $estadi): bool { return $user->role === 'admin'; }
    public function delete(User $user, Estadi $estadi): bool { return $user->role === 'admin'; }
}