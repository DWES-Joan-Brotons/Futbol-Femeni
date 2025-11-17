<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;
use App\Models\Estadi;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partit>
 */
class PartitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = $this->faker->dateTimeBetween(Carbon::now()->subMonths(6), Carbon::now()->addMonths(6));
        $haJugat = $data < Carbon::now();

        return [
            'local_id' => Equip::factory(),
            'visitant_id' => Equip::factory(),
            'estadi_id' => Estadi::factory(),
            'data' => $data,
            'jornada' => $this->faker->numberBetween(1, 38),
            'gols_local' => $haJugat ? $this->faker->numberBetween(0, 5) : null,
            'gols_visitant' => $haJugat ? $this->faker->numberBetween(0, 5) : null,
        ];
    }
}