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
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'berat_badan',
        'tinggi_badan',
        'asal_sekolah',
        'no_hp',
        'no_wa',
        'nama_orang_tua',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'rt_rw',
        'nama_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'no_hp_ayah',
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'no_hp_ibu',
        'status_keluarga',
        'nama_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'no_hp_wali',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'penghasilan_wali',
        'jurusan',
        'kelas_id',
        'harga_jurusan',
        'nominal_pembayaran',
        'foto',
        'dokumen',
        'id_gelombang',
        'status_berkas',
        'status_kelulusan',
        'alasan_penolakan',
        'status_pembayaran',
        'data_confirmed',
        'data_locked',
        'confirmed_at',
        'tahap_form',
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

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_siswa');
    }

    /**
     * Check apakah data bisa diedit
     * Data hanya locked setelah pembayaran verified (data_locked = true)
     * Setelah confirm tapi belum bayar: tidak bisa edit tapi tidak locked
     */
    public function isDataEditable()
    {
        // Jika data_locked = true, berarti sudah verified dan truly locked
        return !$this->data_locked;
    }

    /**
     * Check apakah data dalam status confirmed (tidak bisa edit)
     */
    public function isDataConfirmed()
    {
        return $this->data_confirmed;
    }

    /**
     * Lock data ketika pembayaran verified
     */
    public function lockData()
    {
        $this->update([
            'data_locked' => true,
            'data_confirmed' => true,
        ]);
    }
}


