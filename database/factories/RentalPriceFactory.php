<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalPrice>
 */
class RentalPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_mobil' => Car::factory(),
            'harga_solo' => $this->faker->numberBetween(200000, 400000),
            'harga_solo_raya' => $this->faker->numberBetween(300000, 500000),
            'harga_luar_kota' => $this->faker->numberBetween(400000, 700000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
