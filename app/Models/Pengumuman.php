<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans'; // nama tabel di database
    protected $fillable = ['judul', 'isi', 'tanggal_post']; // kolom-kolom yang bisa diisi
}
