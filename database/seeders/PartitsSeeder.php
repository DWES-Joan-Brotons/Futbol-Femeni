<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;

class PartitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equips = Equip::all();
        $iniciTemporada = Carbon::now()->subMonths(3);
        $jornada = 1;

        if ($equips->count() < 2) {
            return;
        }

        // Anada
        foreach ($equips as $local) {
            foreach ($equips as $visitant) {
                if ($local->id !== $visitant->id) {
                    $dataPartit = $iniciTemporada->copy()->addWeeks($jornada - 1)->addDays(rand(0, 6));
                    
                    Partit::factory()->create([
                        'local_id' => $local->id,
                        'visitant_id' => $visitant->id,
                        'estadi_id' => $local->estadi_id,
                        'jornada' => $jornada,
                        'data' => $dataPartit,
                        'gols_local' => $dataPartit->isPast() ? rand(0, 4) : null,
                        'gols_visitant' => $dataPartit->isPast() ? rand(0, 4) : null,
                    ]);
                }
            }
            $jornada++;
        }

        // Tornada
        foreach ($equips as $local) {
            foreach ($equips as $visitant) {
                if ($local->id !== $visitant->id) {
                    $dataPartit = $iniciTemporada->copy()->addWeeks($jornada - 1)->addDays(rand(0, 6));

                    Partit::factory()->create([
                        'local_id' => $visitant->id,
                        'visitant_id' => $local->id,
                        'estadi_id' => $visitant->estadi_id,
                        'jornada' => $jornada,
                        'data' => $dataPartit,
                        'gols_local' => $dataPartit->isPast() ? rand(0, 4) : null,
                        'gols_visitant' => $dataPartit->isPast() ? rand(0, 4) : null,
                    ]);
                }
            }
            $jornada++;
        }
    }
}