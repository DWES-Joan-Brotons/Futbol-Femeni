<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estadis')->insert([
            ['nom' => 'Camp Nou', 'capacitat' => 99000],
            ['nom' => 'Wanda Metropolitano', 'capacitat' => 68000],
            ['nom' => 'Santiago Bernabéu', 'capacitat' => 81000],
        ]);
    }
}