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
    Schema::create('calon_siswas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nisn')->unique();
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->string('asal_sekolah');
        $table->string('nama_orang_tua');
        $table->text('alamat');
        $table->string('no_hp');
        $table->string('foto')->nullable();
        $table->string('dokumen')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswas');
    }
};
