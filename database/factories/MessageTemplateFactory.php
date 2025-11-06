<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageTemplate>
 */
class MessageTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_template' => $this->faker->word(),
            'no_telp_tujuan' => $this->faker->phoneNumber(),
            'isi' => $this->faker->sentence(12),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
