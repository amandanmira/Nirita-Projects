<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Admin::factory(5)->create();
        \App\Models\Faq::factory(5)->create();
        \App\Models\MessageTemplate::factory(5)->create();
        \App\Models\Testimonial::factory(5)->create();
        Car::factory(10)->create();

        $carIds = Car::orderBy('id_mobil')->pluck('id_mobil')->take(10)->toArray();

        foreach ($carIds as $id) {
            \App\Models\Bill::factory()->create(['id_mobil' => $id]);
            \App\Models\RentalPrice::factory()->create(['id_mobil' => $id]);
            \App\Models\Specification::factory()->create(['id_mobil' => $id]);
        }
    }
}
