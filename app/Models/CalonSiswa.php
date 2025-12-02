<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $fillable = [
        'user_id',
        'kode_pendaftaran',
        'nama_lengkap',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'nama_orang_tua',
        'alamat',
        'no_hp',
        'jurusan',
        'harga_jurusan',
        'nominal_pembayaran',
        'foto',
        'dokumen',
        'id_gelombang',
        'status_berkas',
        'status_kelulusan',
        'status_pembayaran',
    ];

    /**
     * Harga jurusan default (dapat disesuaikan sesuai kebijakan)
     */
    public static $hargaJurusan = [
        'RPL' => 3500000,      // Rp 3.5 juta
        'TPM' => 4000000,      // Rp 4 juta
        'TITL' => 3750000,     // Rp 3.75 juta
        'TKR' => 4200000,      // Rp 4.2 juta
    ];

    /**
     * Get harga for specific jurusan
     */
    public static function getHargaJurusan($jurusan)
    {
        return self::$hargaJurusan[$jurusan] ?? 0;
    }

    /**
     * Generate unique registration code format: REG-YYYYMMDD-XXXXX
     */
    public static function generateKodePendaftaran()
    {
        $prefix = 'REG-' . date('Ymd') . '-';
        $random = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        
        // ensure unique
        while (self::where('kode_pendaftaran', $prefix . $random)->exists()) {
            $random = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        }
        
        return $prefix . $random;
    }

    public function dokumenPersyaratan()
    {
        return $this->hasOne(DokumenPersyaratan::class, 'id_siswa');
    }

    public function gelombang()
    {
        return $this->belongsTo(GelombangPendaftaran::class, 'id_gelombang');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_siswa');
    }
}

