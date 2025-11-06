<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_penyewa' => $this->faker->name(),
            'no_hp_penyewa' => $this->faker->phoneNumber(),
            'driver' => $this->faker->name(),
            'total_pembayaran' => $this->faker->numberBetween(500000, 2000000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
