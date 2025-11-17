<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equip;
use App\Models\Jugadora;

class JugadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equips = Equip::all();

        foreach ($equips as $equip) {
            Jugadora::factory()->count(15)->create([
                'equip_id' => $equip->id,
            ]);
        }
    }
}