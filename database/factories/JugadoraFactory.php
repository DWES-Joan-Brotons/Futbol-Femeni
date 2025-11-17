<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugadora>
 */
class JugadoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'equip_id' => Equip::factory(),
            'nom' => $this->faker->name(),
            'data_naixement' => $this->faker->dateTimeBetween(Carbon::now()->subYears(35), Carbon::now()->subYears(16)),
            'dorsal' => $this->faker->numberBetween(1, 99),
        ];
    }
}