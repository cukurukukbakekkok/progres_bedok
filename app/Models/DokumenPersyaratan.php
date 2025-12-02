<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPersyaratan extends Model
{
    protected $table = 'dokumen_persyaratans';

    protected $fillable = [
        'id_siswa',
        'akte_kelahiran',
        'ijazah_smp',
        'skl_smp',
        'kartu_keluarga',
        'ktp_ortu',
        'status_verifikasi',
        'id_admin_verifikasi',
        'verified_at',
        'keterangan',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'id_siswa');
    }

    public function adminVerifikasi()
    {
        return $this->belongsTo(User::class, 'id_admin_verifikasi');
    }
}
