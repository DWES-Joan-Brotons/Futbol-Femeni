<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartitAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_arbitre_no_pot_modificar_partit_no_assignat()
    {
        // 1. Crear entorno
        $estadi = Estadi::factory()->create();
        $local = Equip::factory()->create(['estadi_id' => $estadi->id]);
        $visitant = Equip::factory()->create(['estadi_id' => $estadi->id]);
        
        $arbitre = User::factory()->create(['role' => 'arbitre']);
        
        // Crear partido sin árbitro (o asignado a otro)
        $partit = Partit::create([
            'local_id' => $local->id,
            'visitant_id' => $visitant->id,
            'estadi_id' => $estadi->id,
            'data' => now()->addDay(),
            'jornada' => 1,
            'arbitre_id' => null // Nadie asignado
        ]);

        // 2. Actuar como árbitro e intentar editar
        $response = $this->actingAs($arbitre)
                         ->put(route('partits.update', $partit), [
                             'gols_local' => 1,
                             'gols_visitant' => 0
                         ]);

        // 3. Verificar prohibición (403)
        $response->assertForbidden();
    }
}