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
        Schema::table('calon_siswas', function (Blueprint $table) {
            // Tambah kolom nominal pembayaran yang auto-fill berdasarkan jurusan
            if (!Schema::hasColumn('calon_siswas', 'nominal_pembayaran')) {
                $table->bigInteger('nominal_pembayaran')->nullable()->after('jurusan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->dropColumn('nominal_pembayaran');
        });
    }
};
