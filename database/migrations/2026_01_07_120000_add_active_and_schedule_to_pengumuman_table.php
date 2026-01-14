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
        if (Schema::hasTable('pengumuman')) {
            Schema::table('pengumuman', function (Blueprint $table) {
                if (!Schema::hasColumn('pengumuman', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('tanggal_post');
                }
                if (!Schema::hasColumn('pengumuman', 'starts_at')) {
                    $table->timestamp('starts_at')->nullable()->after('is_active');
                }
                if (!Schema::hasColumn('pengumuman', 'ends_at')) {
                    $table->timestamp('ends_at')->nullable()->after('starts_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pengumuman')) {
            Schema::table('pengumuman', function (Blueprint $table) {
                if (Schema::hasColumn('pengumuman', 'ends_at')) {
                    $table->dropColumn('ends_at');
                }
                if (Schema::hasColumn('pengumuman', 'starts_at')) {
                    $table->dropColumn('starts_at');
                }
                if (Schema::hasColumn('pengumuman', 'is_active')) {
                    $table->dropColumn('is_active');
                }
            });
        }
    }
};
