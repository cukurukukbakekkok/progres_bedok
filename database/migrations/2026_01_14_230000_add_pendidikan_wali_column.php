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
            // Add pendidikan_wali if it doesn't exist
            if (!Schema::hasColumn('calon_siswas', 'pendidikan_wali')) {
                $table->string('pendidikan_wali')->nullable()->after('tanggal_lahir_wali');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            if (Schema::hasColumn('calon_siswas', 'pendidikan_wali')) {
                $table->dropColumn('pendidikan_wali');
            }
        });
    }
};
