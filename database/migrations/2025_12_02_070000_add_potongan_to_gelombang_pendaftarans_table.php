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
        Schema::table('gelombang_pendaftarans', function (Blueprint $table) {
            // Tambah kolom potongan (nominal potongan harga)
            if (!Schema::hasColumn('gelombang_pendaftarans', 'potongan')) {
                $table->bigInteger('potongan')->default(0)->after('kuota');
                $table->text('keterangan_potongan')->nullable()->after('potongan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gelombang_pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['potongan', 'keterangan_potongan']);
        });
    }
};
