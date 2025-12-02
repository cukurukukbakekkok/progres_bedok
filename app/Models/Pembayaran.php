<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'id_siswa',
        'id_gelombang',
        'nominal',
        'metode_bayar',
        'status',
        'bukti_bayar',
        'verified_at',
        'id_admin_verifikasi',
        'keterangan',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(CalonSiswa::class, 'id_siswa');
    }

    public function gelombang()
    {
        return $this->belongsTo(GelombangPendaftaran::class, 'id_gelombang');
    }

    public function adminVerifikasi()
    {
        return $this->belongsTo(User::class, 'id_admin_verifikasi');
    }
}
