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
        Schema::create('dokumen_persyaratans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->string('akte_kelahiran')->nullable();
            $table->string('ijazah_smp')->nullable();
            $table->string('skl_smp')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('ktp_ortu')->nullable();
            $table->enum('status_verifikasi', ['Belum', 'Valid', 'Tidak Valid'])->default('Belum');
            $table->unsignedBigInteger('id_admin_verifikasi')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('calon_siswas')->onDelete('cascade');
            $table->foreign('id_admin_verifikasi')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_persyaratans');
    }
};
