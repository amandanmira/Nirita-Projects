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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mobil')->constrained('cars', 'id_mobil')->onDelete('cascade');
            $table->foreignId('id_nota')->constrained('bills', 'id_nota')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_akhir_sewa')->nullable();
            $table->enum('lokasi_sewa', ['solo', 'solo_raya', 'luar_kota']);
            $table->text('deskripsi_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
