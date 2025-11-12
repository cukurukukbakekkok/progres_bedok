<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id('id_siswa'); // primary key
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->string('status_pembayaran')->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calon_siswa');
    }
};
