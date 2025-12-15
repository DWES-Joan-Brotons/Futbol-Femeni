<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\JugadoraService;
use App\Repositories\JugadoraRepository;
use Mockery;
use App\Models\Jugadora;

class JugadoraServiceTest extends TestCase
{
    public function test_guardar_crea_jugadora_amb_repository()
    {
        // Mock del repositorio
        $repoMock = Mockery::mock(JugadoraRepository::class);
        $dades = ['nom' => 'Alexia', 'dorsal' => 11, 'equip_id' => 1];

        // Expectativa: llamar a create 1 vez
        $repoMock->shouldReceive('create')
            ->once()
            ->with($dades)
            ->andReturn(new Jugadora($dades));

        // Inyección
        $service = new JugadoraService($repoMock);
        
        // Ejecución
        $resultat = $service->guardar($dades);

        // Aserción
        $this->assertEquals('Alexia', $resultat->nom);
    }
}