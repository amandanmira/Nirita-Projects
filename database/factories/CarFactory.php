<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_mobil' => $this->faker->company() . ' ' . $this->faker->word(),
            'url_foto_mobil' => $this->faker->imageUrl(640, 480, 'car', true),
            'plat_nomor' => strtoupper($this->faker->bothify('AD####??')),
            'ketersediaan' => $this->faker->randomNumber(2),
            'deskripsi' => $this->faker->sentence(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
