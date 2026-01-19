<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Usuari ADMIN (Accés total)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@futfem.com',
            'password' => Hash::make('password'), // password per defecte
            'role' => 'admin',
            'team_id' => null,
        ]);

        // 2. Usuari DIRECTIVA (Gestió del club)
        User::create([
            'name' => 'Directiva User',
            'email' => 'directiva@futfem.com',
            'password' => Hash::make('password'),
            'role' => 'directiva',
            'team_id' => null,
        ]);

        // 3. Usuari ENTRENADOR (Gestió d'equip)
        // Assignem team_id = 1 (Assegura't que existeix l'equip 1 o posa null)
        User::create([
            'name' => 'Entrenador User',
            'email' => 'entrenador@futfem.com',
            'password' => Hash::make('password'),
            'role' => 'entrenador',
            'team_id' => 1, 
        ]);

        // 4. Usuari JUGADORA (Visualització pròpia)
        User::create([
            'name' => 'Jugadora User',
            'email' => 'jugadora@futfem.com',
            'password' => Hash::make('password'),
            'role' => 'jugadora',
            'team_id' => 1,
        ]);
        
        // (Opcional) Crear 10 usuaris random extra
        User::factory(10)->create();
    }
}