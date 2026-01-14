<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('calon_siswas')) {
            Schema::table('calon_siswas', function (Blueprint $table) {
                if (!Schema::hasColumn('calon_siswas', 'kelas_id')) {
                    $table->foreignId('kelas_id')->nullable()->after('jurusan')->constrained('kelas')->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('calon_siswas')) {
            Schema::table('calon_siswas', function (Blueprint $table) {
                if (Schema::hasColumn('calon_siswas', 'kelas_id')) {
                    $table->dropConstrainedForeignId('kelas_id');
                }
            });
        }
    }
};
