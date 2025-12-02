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
        Schema::create('pemberitahuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gelombang')->constrained('gelombang_pendaftarans')->onDelete('cascade');
            $table->string('judul');
            $table->longText('konten');
            $table->dateTime('tanggal_publikasi');
            $table->enum('status', ['publish', 'draft'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemberitahuans');
    }
};
