<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun default (Admin & Siswa Demo)
     */
    public function run(): void
    {
        // Hapus user lama kalau pakai email ini (biar gak dobel)
        User::whereIn('email', ['admin@ppdb.com', 'siswa@ppdb.com'])->delete();

        // Tambah akun Admin
        User::create([
            'name' => 'Admin PPDB',
            'email' => 'admin@ppdb.com',
            'password' => Hash::make('admin123'), // password: admin123
            'role' => 'Admin',
            'email_verified_at' => now(),
        ]);

        // Tambah akun Siswa contoh
        User::create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@ppdb.com',
            'password' => Hash::make('siswa123'), // password: siswa123
            'role' => 'Siswa',
            'email_verified_at' => now(),
        ]);
    }
}
