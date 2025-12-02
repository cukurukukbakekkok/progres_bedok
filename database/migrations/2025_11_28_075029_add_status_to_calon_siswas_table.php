<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('calon_siswas', function (Blueprint $table) {
        // Tambahkan hanya kolom yang belum ada saja
        if (!Schema::hasColumn('calon_siswas', 'status_kelulusan')) {
            $table->enum('status_kelulusan', ['belum', 'lulus', 'tidak_lulus'])->default('belum');
        }

        if (!Schema::hasColumn('calon_siswas', 'bukti_pembayaran')) {
            $table->string('bukti_pembayaran')->nullable();
        }

        if (!Schema::hasColumn('calon_siswas', 'dokumen_persyaratan')) {
            $table->string('dokumen_persyaratan')->nullable();
        }
    });
}



    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('calon_siswas', function (Blueprint $table) {
        if (Schema::hasColumn('calon_siswas', 'status_kelulusan')) {
            $table->dropColumn('status_kelulusan');
        }
        if (Schema::hasColumn('calon_siswas', 'bukti_pembayaran')) {
            $table->dropColumn('bukti_pembayaran');
        }
        if (Schema::hasColumn('calon_siswas', 'dokumen_persyaratan')) {
            $table->dropColumn('dokumen_persyaratan');
        }
    });
}

};
