<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GelombangPendaftaran extends Model
{
    protected $table = 'gelombang_pendaftarans';

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'kuota',
        'potongan',
        'keterangan_potongan',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Scope a query to only include waves that are currently running.
     * (Today must be between tanggal_mulai and tanggal_selesai)
     */
    public function scopeActive($query)
    {
        $today = now()->toDateString();
        return $query->where('tanggal_mulai', '<=', $today)
            ->where('tanggal_selesai', '>=', $today);
    }

    // Relationships
    public function calonSiswa()
    {
        return $this->hasMany(CalonSiswa::class, 'id_gelombang');
    }

    public function promos()
    {
        return $this->hasMany(Promo::class, 'id_gelombang');
    }

    public function pemberitahuans()
    {
        return $this->hasMany(Pemberitahuan::class, 'id_gelombang');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_gelombang');
    }
}
