<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            // Tambah field untuk tracking apakah data sudah dikonfirmasi
            if (!Schema::hasColumn('calon_siswas', 'data_confirmed')) {
                $table->boolean('data_confirmed')->default(false)->after('tahap_form')
                    ->comment('Data sudah dikonfirmasi oleh siswa');
            }
            
            // Tambah field untuk tracking apakah data bisa diedit
            if (!Schema::hasColumn('calon_siswas', 'data_locked')) {
                $table->boolean('data_locked')->default(false)->after('data_confirmed')
                    ->comment('Data terkunci setelah pembayaran dilakukan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            if (Schema::hasColumn('calon_siswas', 'data_confirmed')) {
                $table->dropColumn('data_confirmed');
            }
            if (Schema::hasColumn('calon_siswas', 'data_locked')) {
                $table->dropColumn('data_locked');
            }
        });
    }
};
