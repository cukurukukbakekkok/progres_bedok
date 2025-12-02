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
            // Tambah kolom harga jurusan (nominal harga untuk jurusan yang dipilih)
            if (!Schema::hasColumn('calon_siswas', 'harga_jurusan')) {
                $table->bigInteger('harga_jurusan')->default(0)->after('jurusan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->dropColumn('harga_jurusan');
        });
    }
};
