<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equip;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuari Administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@futbolfemeni.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Àrbitre Principal (El que tenies)
        User::create([
            'name' => 'Àrbitre Principal',
            'email' => 'arbitre@futbolfemeni.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);

        // 3. NOUS ÀRBITRES (Per fer proves d'assignació)
        User::create([
            'name' => 'Marta Huerta',
            'email' => 'marta@arbitre.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);

        User::create([
            'name' => 'Guadalupe Porras',
            'email' => 'guadalupe@arbitre.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);

        // 4. Usuari Manager (Assignat al primer equip que trobi)
        $equip = Equip::first();
        if ($equip) {
            User::create([
                'name' => 'Manager ' . $equip->nom,
                'email' => 'manager@futbolfemeni.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'team_id' => $equip->id,
            ]);
        }
    }
}