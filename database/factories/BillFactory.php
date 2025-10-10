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
            'id_mobil' => Car::factory(),
            'nama_penyewa' => $this->faker->name(),
            'no_hp_penyewa' => $this->faker->phoneNumber(),
            'tanggal_sewa' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'driver' => $this->faker->boolean() ? $this->faker->name() : null,
            'deskripsi_kegiatan' => $this->faker->sentence(10),
            'total_pembayaran' => $this->faker->numberBetween(500000, 2000000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
