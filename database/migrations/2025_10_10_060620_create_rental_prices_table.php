<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rental_prices', function (Blueprint $table) {
            $table->id('id_harga');
            $table->foreignId('id_mobil')->constrained('cars', 'id_mobil')->onDelete('cascade');
            $table->decimal('harga_solo', 12, 2)->nullable();
            $table->decimal('harga_solo_raya', 12, 2)->nullable();
            $table->decimal('harga_luar_kota', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_prices');
    }
};
