<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;
use App\Models\Bill;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_mobil' => $this->faker->numberBetween(1, 10),
            'id_nota' => Bill::factory(),
            'tanggal_sewa' => $this->faker->dateTimeBetween('-15 days', 'now'),
            'tanggal_akhir_sewa' => $this->faker->dateTimeBetween('+1 days', '+15 days'),
            'lokasi_sewa' => $this->faker->randomElement(['solo', 'solo_raya', 'luar_kota']),
            'deskripsi_kegiatan' => $this->faker->sentence(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
