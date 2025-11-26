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
        $table->enum('status_pembayaran', ['Lunas', 'Menunggu'])->default('Menunggu')->after('no_hp');
    });
}

public function down()
{
    Schema::table('calon_siswas', function (Blueprint $table) {
        $table->dropColumn('status_pembayaran');
    });
}
};
