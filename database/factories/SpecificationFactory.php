<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specification>
 */
class SpecificationFactory extends Factory
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
            'jenis_transmisi' => $this->faker->randomElement(['Manual', 'Automatic']),
            'kapasitas' => $this->faker->numberBetween(4, 8),
            'kategori' => $this->faker->randomElement(['MPV', 'SUV', 'Large SUV', 'MPV Luxury', 'MiniBus', 'Luxury Minibus']),
            'fasilitas' => '{}',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
