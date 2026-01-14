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
        if (Schema::hasTable('calon_siswas')) {
            Schema::table('calon_siswas', function (Blueprint $table) {
                // Add penghasilan fields if they don't exist
                if (!Schema::hasColumn('calon_siswas', 'penghasilan_ayah')) {
                    $table->string('penghasilan_ayah')->nullable()->comment('Penghasilan Ayah per Bulan');
                }
                if (!Schema::hasColumn('calon_siswas', 'penghasilan_ibu')) {
                    $table->string('penghasilan_ibu')->nullable()->comment('Penghasilan Ibu per Bulan');
                }
                if (!Schema::hasColumn('calon_siswas', 'penghasilan_wali')) {
                    $table->string('penghasilan_wali')->nullable()->comment('Penghasilan Wali per Bulan');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('calon_siswas')) {
            Schema::table('calon_siswas', function (Blueprint $table) {
                if (Schema::hasColumn('calon_siswas', 'penghasilan_ayah')) {
                    $table->dropColumn('penghasilan_ayah');
                }
                if (Schema::hasColumn('calon_siswas', 'penghasilan_ibu')) {
                    $table->dropColumn('penghasilan_ibu');
                }
                if (Schema::hasColumn('calon_siswas', 'penghasilan_wali')) {
                    $table->dropColumn('penghasilan_wali');
                }
            });
        }
    }
};
