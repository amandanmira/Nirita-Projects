<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        Admin::factory()->create([
            'nama_lengkap' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        \App\Models\Faq::factory(5)->create();
        \App\Models\Tnc::factory(5)->create();
        \App\Models\MessageTemplate::factory(5)->create();
        \App\Models\Testimonial::factory(5)->create(['url_gambar' => '../placeholder_image/placeholder_testimoni.jpg']);
        Car::factory(10)->create(['url_foto_mobil' => '../placeholder_image/placeholder_mobil.png']);
        \App\Models\Bill::factory(10)->create();

        $carIds = Car::orderBy('id_mobil')->pluck('id_mobil')->take(10)->toArray();

        foreach ($carIds as $id) {
            \App\Models\BillDetail::factory()->create(['id_mobil' => $id, 'id_nota' => $id]);
            \App\Models\RentalPrice::factory()->create(['id_mobil' => $id]);
            \App\Models\Specification::factory()->create(['id_mobil' => $id]);
        }
    }
}
