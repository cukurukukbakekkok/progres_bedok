<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['jurusan_id','nama','kapasitas','jumlah_siswa'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function calonSiswa()
    {
        return $this->hasMany(CalonSiswa::class, 'kelas_id');
    }

    /**
     * Check apakah kelas masih memiliki kapasitas
     */
    public function isFull(): bool
    {
        return $this->jumlah_siswa >= $this->kapasitas;
    }

    /**
     * Get sisa kapasitas kelas
     */
    public function getSisaKapasitas(): int
    {
        return $this->kapasitas - $this->jumlah_siswa;
    }

    /**
     * Safely decrement jumlah_siswa (tidak akan mengurangi di bawah 0)
     */
    public function safeDecrement(): void
    {
        if ($this->jumlah_siswa > 0) {
            $this->decrement('jumlah_siswa');
        }
    }

    /**
     * AUTO-ASSIGN KELAS - Siswa otomatis masuk kelas yang tersedia
     * Jika semua penuh, buat kelas baru otomatis
     * 
     * @param string $jurusanNama - Nama jurusan (RPL, TPM, TITL, TKR)
     * @return Kelas|null
     */
    public static function autoAssignKelas(string $jurusanNama): ?Kelas
    {
        $jurusan = Jurusan::where('nama', $jurusanNama)->first();
        
        if (!$jurusan) {
            return null;
        }

        // Cari kelas yang masih ada tempat
        $kelasAvailable = self::where('jurusan_id', $jurusan->id)
            ->whereRaw('jumlah_siswa < kapasitas')
            ->orderBy('nama')
            ->first();

        if ($kelasAvailable) {
            return $kelasAvailable;
        }

        // Jika semua penuh, buat kelas baru
        $jumlahKelasAda = self::where('jurusan_id', $jurusan->id)->count();
        $nomorKelas = $jumlahKelasAda + 1;
        $namaKelas = "{$jurusan->nama} {$nomorKelas}";

        return self::create([
            'jurusan_id' => $jurusan->id,
            'nama' => $namaKelas,
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);
    }
}
