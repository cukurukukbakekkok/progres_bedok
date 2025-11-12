<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'calon_siswa';

    // Primary key (jika bukan 'id')
    protected $primaryKey = 'id_siswa';

    // Field yang bisa diisi massal
    protected $fillable = [
        'nama_lengkap',
        'nisn',
        'status_pembayaran',
        // tambahkan field lain sesuai tabel
    ];
}
