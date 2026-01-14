<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';
    protected $fillable = ['nama','slug','keterangan'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'jurusan_id');
    }

    public function calonSiswa()
    {
        return $this->hasManyThrough(CalonSiswa::class, Kelas::class, 'jurusan_id', 'kelas_id');
    }

    /**
     * Get total siswa untuk jurusan ini
     */
    public function getTotalSiswa(): int
    {
        // Sum jumlah_siswa dari semua kelas untuk mendapatkan total siswa yang ter-assign
        return (int) $this->kelas()->sum('jumlah_siswa');
    }

    /**
     * Get total kapasitas untuk semua kelas di jurusan ini
     */
    public function getTotalKapasitas(): int
    {
        return $this->kelas()->sum('kapasitas');
    }
}
