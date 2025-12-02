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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('calon_siswas')->onDelete('cascade');
            $table->foreignId('id_gelombang')->constrained('gelombang_pendaftarans')->onDelete('cascade');
            $table->integer('nominal');
            $table->enum('metode_bayar', ['transfer', 'e-wallet', 'VA'])->default('transfer');
            $table->enum('status', ['menunggu', 'lunas', 'gagal'])->default('menunggu');
            $table->string('bukti_bayar')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->foreignId('id_admin_verifikasi')->nullable()->constrained('users')->onDelete('set null');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
