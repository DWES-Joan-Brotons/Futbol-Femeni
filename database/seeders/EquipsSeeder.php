<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        
        Equip::factory()->count(15)->create();
    }
}