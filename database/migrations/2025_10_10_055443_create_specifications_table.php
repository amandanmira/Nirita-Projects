<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id('id_spesifikasi');
            $table->foreignId('id_mobil')->constrained('cars', 'id_mobil')->onDelete('cascade');
            $table->string('jenis_transmisi');
            $table->integer('kapasitas');
            $table->enum('kategori', ['MPV', 'SUV', 'Large SUV', 'MPV Luxury', 'MiniBus', 'Luxury Minibus']);
            $table->text('fasilitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
