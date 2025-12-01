<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EquipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estadi = Estadi::where('nom', 'Camp Nou')->first();
        if ($estadi) {
            $estadi->equips()->create([
                'nom' => 'Barça Femení',
                'titols' => 30,
            ]);
        }
        
        $estadi = Estadi::where('nom', 'Wanda Metropolitano')->first();
        if ($estadi) {
            $estadi->equips()->create([
                'nom' => 'Atlètic de Madrid',
                'titols' => 10,
            ]);
        }
        
        $estadi = Estadi::where('nom', 'Santiago Bernabéu')->first();
        if ($estadi) {
            $estadi->equips()->create([
                'nom' => 'Real Madrid Femení',
                'titols' => 5,
            ]);
        }
        
        // Crear 15 equipos adicionales
        Equip::factory()->count(15)->create();

        // --- CREAR MANAGERS PARA TODOS LOS EQUIPOS ---
        $equips = Equip::all();
        
        foreach ($equips as $equip) {
            // Verifica si ya existe un usuario con ese email para no duplicar
            $email = 'manager_' . $equip->id . '@futbolfemeni.com';
            if (!User::where('email', $email)->exists()) {
                User::factory()->create([
                    'name' => 'Manager ' . $equip->nom,
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'role' => 'manager',
                    'team_id' => $equip->id,
                ]);
            }
        }
    }
}