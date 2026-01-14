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
            // Tahap 1 - Biodata Siswa (kolom yang ada, tambah yang kurang)
            if (!Schema::hasColumn('calon_siswas', 'nik')) {
                $table->string('nik')->nullable()->after('nisn');
            }
            if (!Schema::hasColumn('calon_siswas', 'agama')) {
                $table->string('agama')->nullable()->after('jenis_kelamin');
            }
            if (!Schema::hasColumn('calon_siswas', 'berat_badan')) {
                $table->decimal('berat_badan', 5, 2)->nullable()->after('agama');
            }
            if (!Schema::hasColumn('calon_siswas', 'tinggi_badan')) {
                $table->decimal('tinggi_badan', 5, 2)->nullable()->after('berat_badan');
            }
            if (!Schema::hasColumn('calon_siswas', 'no_wa')) {
                $table->string('no_wa')->nullable()->after('no_hp');
            }

            // Tahap 2 - Detail Alamat
            if (!Schema::hasColumn('calon_siswas', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('calon_siswas', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('calon_siswas', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kabupaten');
            }
            if (!Schema::hasColumn('calon_siswas', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('calon_siswas', 'kode_pos')) {
                $table->string('kode_pos')->nullable()->after('kelurahan');
            }
            if (!Schema::hasColumn('calon_siswas', 'rt_rw')) {
                $table->string('rt_rw')->nullable()->after('kode_pos');
            }

            // Tahap 3 - Data Orang Tua (Ayah)
            if (!Schema::hasColumn('calon_siswas', 'nama_ayah')) {
                $table->string('nama_ayah')->nullable()->after('nama_orang_tua');
            }
            if (!Schema::hasColumn('calon_siswas', 'tempat_lahir_ayah')) {
                $table->string('tempat_lahir_ayah')->nullable()->after('nama_ayah');
            }
            if (!Schema::hasColumn('calon_siswas', 'tanggal_lahir_ayah')) {
                $table->date('tanggal_lahir_ayah')->nullable()->after('tempat_lahir_ayah');
            }
            if (!Schema::hasColumn('calon_siswas', 'pendidikan_ayah')) {
                $table->string('pendidikan_ayah')->nullable()->after('tanggal_lahir_ayah');
            }
            if (!Schema::hasColumn('calon_siswas', 'pekerjaan_ayah')) {
                $table->string('pekerjaan_ayah')->nullable()->after('pendidikan_ayah');
            }
            if (!Schema::hasColumn('calon_siswas', 'no_hp_ayah')) {
                $table->string('no_hp_ayah')->nullable()->after('pekerjaan_ayah');
            }

            // Tahap 3 - Data Orang Tua (Ibu)
            if (!Schema::hasColumn('calon_siswas', 'nama_ibu')) {
                $table->string('nama_ibu')->nullable()->after('no_hp_ayah');
            }
            if (!Schema::hasColumn('calon_siswas', 'tempat_lahir_ibu')) {
                $table->string('tempat_lahir_ibu')->nullable()->after('nama_ibu');
            }
            if (!Schema::hasColumn('calon_siswas', 'tanggal_lahir_ibu')) {
                $table->date('tanggal_lahir_ibu')->nullable()->after('tempat_lahir_ibu');
            }
            if (!Schema::hasColumn('calon_siswas', 'pendidikan_ibu')) {
                $table->string('pendidikan_ibu')->nullable()->after('tanggal_lahir_ibu');
            }
            if (!Schema::hasColumn('calon_siswas', 'pekerjaan_ibu')) {
                $table->string('pekerjaan_ibu')->nullable()->after('pendidikan_ibu');
            }
            if (!Schema::hasColumn('calon_siswas', 'no_hp_ibu')) {
                $table->string('no_hp_ibu')->nullable()->after('pekerjaan_ibu');
            }

            // Status Keluarga (untuk kasus yatim/piatu/yatim piatu)
            if (!Schema::hasColumn('calon_siswas', 'status_keluarga')) {
                $table->enum('status_keluarga', ['ayah_ibu', 'yatim', 'piatu', 'yatim_piatu'])->default('ayah_ibu')->after('no_hp_ibu');
            }

            // Data Wali (untuk kasus yatim/piatu/yatim piatu)
            if (!Schema::hasColumn('calon_siswas', 'nama_wali')) {
                $table->string('nama_wali')->nullable()->after('status_keluarga');
            }
            if (!Schema::hasColumn('calon_siswas', 'tempat_lahir_wali')) {
                $table->string('tempat_lahir_wali')->nullable()->after('nama_wali');
            }
            if (!Schema::hasColumn('calon_siswas', 'tanggal_lahir_wali')) {
                $table->date('tanggal_lahir_wali')->nullable()->after('tempat_lahir_wali');
            }
            if (!Schema::hasColumn('calon_siswas', 'pendidikan_wali')) {
                $table->string('pendidikan_wali')->nullable()->after('tanggal_lahir_wali');
            }
            if (!Schema::hasColumn('calon_siswas', 'pekerjaan_wali')) {
                $table->string('pekerjaan_wali')->nullable()->after('pendidikan_wali');
            }
            if (!Schema::hasColumn('calon_siswas', 'no_hp_wali')) {
                $table->string('no_hp_wali')->nullable()->after('pekerjaan_wali');
            }

            // Progress tracking
            if (!Schema::hasColumn('calon_siswas', 'tahap_form')) {
                $table->integer('tahap_form')->default(1)->after('no_hp_wali');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $columns = [
                'nik', 'agama', 'berat_badan', 'tinggi_badan', 'no_wa',
                'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'kode_pos', 'rt_rw',
                'nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'no_hp_ayah',
                'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'no_hp_ibu',
                'status_keluarga',
                'nama_wali', 'tempat_lahir_wali', 'tanggal_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali', 'no_hp_wali',
                'tahap_form'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('calon_siswas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
