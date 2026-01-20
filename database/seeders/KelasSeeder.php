<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Ambil semua jurusan
        $jurusans = Jurusan::all();

        $kelasData = [];

        foreach ($jurusans as $jurusan) {
            // Buat 3 kelas untuk setiap jurusan (X, XI, XII)
            for ($tingkat = 10; $tingkat <= 12; $tingkat++) {
                $kelasData[] = [
                    'jurusan_id' => $jurusan->id,
                    'nama' => $jurusan->nama . ' ' . $tingkat,
                    'kapasitas' => 30,
                    'jumlah_siswa' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('kelas')->insert($kelasData);
    }
}