<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $data = [
            ['nama' => 'RPL', 'slug' => 'rpl', 'keterangan' => 'Rekayasa Perangkat Lunak', 'created_at'=>$now,'updated_at'=>$now],
            ['nama' => 'TPM', 'slug' => 'tpm', 'keterangan' => 'Teknik Pemesinan', 'created_at'=>$now,'updated_at'=>$now],
            ['nama' => 'TITL', 'slug' => 'titl', 'keterangan' => 'Teknik Instalasi Tenaga Listrik', 'created_at'=>$now,'updated_at'=>$now],
            ['nama' => 'TKR', 'slug' => 'tkr', 'keterangan' => 'Teknik Kendaraan Ringan', 'created_at'=>$now,'updated_at'=>$now],
        ];
        DB::table('jurusans')->insert($data);
    }
}
