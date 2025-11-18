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
        Schema::table('bills', function (Blueprint $table) {
            $table->string('lokasi_invoice', 50)->nullable()->after('total_pembayaran');
            $table->date('tanggal_invoice')->nullable()->after('lokasi_invoice');
        });

        Schema::table('bill_details', function (Blueprint $table) {
            $table->date('tanggal_akhir_sewa')->nullable()->after('tanggal_sewa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('lokasi_invoice');
            $table->dropColumn('tanggal_invoice');
        });

        Schema::table('bill_details', function (Blueprint $table) {
            $table->dropColumn('tanggal_akhir_sewa');
        });
    }
};
