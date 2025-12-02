<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'id_gelombang',
        'kode_promo',
        'diskon_persen',
        'diskon_nominal',
        'tanggal_mulai',
        'tanggal_selesai',
        'max_usage',
        'used_count',
    ];

    public function gelombang()
    {
        return $this->belongsTo(GelombangPendaftaran::class, 'id_gelombang');
    }
}
