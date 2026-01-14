<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            // Make nama_orang_tua nullable since it's not collected in form
            $table->string('nama_orang_tua')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->string('nama_orang_tua')->nullable(false)->change();
        });
    }
};
