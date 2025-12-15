<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partit;
use App\Models\Equip;
use Carbon\Carbon;

class PartitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtenim tots els equips
        $equips = Equip::all();
        
        // Si no hi ha prous equips, no fem res
        if ($equips->count() < 2) {
            $this->command->info('No hi ha prous equips per crear partits.');
            return;
        }

        // 2. Definim els IDs dels àrbitres que vols utilitzar
        $idsArbitres = [3, 4, 5];

        // 3. Bucle per crear 22 jornades
        for ($jornada = 1; $jornada <= 22; $jornada++) {
            
            // Barregem els equips a cada jornada per fer emparellaments aleatoris
            $equipsBarrejats = $equips->shuffle();
            
            // Calculem una data: 
            // Jornada 1 = Fa 10 setmanes (Passat)
            // Jornada 11 = Aquesta setmana (Actual)
            // Jornada 22 = D'aquí 11 setmanes (Futur)
            $setmanesDiferencia = $jornada - 11; 
            $dataBase = Carbon::now()->addWeeks($setmanesDiferencia);

            // Creem els partits emparellant equips de 2 en 2
            for ($i = 0; $i < $equipsBarrejats->count() - 1; $i += 2) {
                
                $local = $equipsBarrejats[$i];
                $visitant = $equipsBarrejats[$i+1];

                // Triem un àrbitre aleatori de la llista [3, 4, 5]
                $arbitreId = $idsArbitres[array_rand($idsArbitres)];

                // Si la data és passada, posem resultat. Si és futura, null.
                $esPartitPassat = $dataBase->isPast();
                $golsLocal = $esPartitPassat ? rand(0, 5) : null;
                $golsVisitant = $esPartitPassat ? rand(0, 5) : null;

                Partit::create([
                    'local_id' => $local->id,
                    'visitant_id' => $visitant->id,
                    'estadi_id' => $local->estadi_id, // Juguem a casa del local
                    'arbitre_id' => $arbitreId,       // <--- Aquí assignem el 3, 4 o 5
                    'jornada' => $jornada,
                    'data' => $dataBase->copy()->addDays(rand(0, 1))->setTime(rand(12, 21), 0), // Dissabte o Diumenge
                    'gols_local' => $golsLocal,
                    'gols_visitant' => $golsVisitant,
                ]);
            }
        }
    }
}