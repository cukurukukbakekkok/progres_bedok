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
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->integer('harga_awal')->nullable()->after('nominal')->comment('Harga awal sebelum potongan');
            $table->integer('potongan')->nullable()->default(0)->after('harga_awal')->comment('Jumlah potongan/diskon');
            $table->string('keterangan_potongan')->nullable()->after('potongan')->comment('Alasan potongan (misalnya: Diskon Beasiswa, dll)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn(['harga_awal', 'potongan', 'keterangan_potongan']);
        });
    }
};
