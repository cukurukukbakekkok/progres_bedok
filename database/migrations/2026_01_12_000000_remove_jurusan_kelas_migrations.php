<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus entri migrations untuk migration create jurusans/kelas jika ada
        DB::table('migrations')->whereIn('migration', [
            '2026_01_07_120500_create_jurusans_table',
            '2026_01_07_120501_create_kelas_table',
        ])->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada aksi rollback — jika perlu, bisa ditambahkan manual
    }
};
