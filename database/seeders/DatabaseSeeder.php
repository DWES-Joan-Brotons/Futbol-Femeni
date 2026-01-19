<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // L'ordre és important per les claus foranes (team_id)
        $this->call([
            EstadisSeeder::class,   // Primer estadis
            EquipsSeeder::class,    // Segon equips (que usen estadis)
            UserSeeder::class,      // Tercer usuaris (que poden ser d'un equip)
            JugadoresSeeder::class, 
            PartitsSeeder::class,
        ]);
    }
}