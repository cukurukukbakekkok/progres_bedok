<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            if (!Schema::hasColumn('calon_siswas', 'confirmed_at')) {
                $table->timestamp('confirmed_at')->nullable()->after('data_locked')
                    ->comment('Waktu siswa mengkonfirmasi data');
            }
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            if (Schema::hasColumn('calon_siswas', 'confirmed_at')) {
                $table->dropColumn('confirmed_at');
            }
        });
    }
};
