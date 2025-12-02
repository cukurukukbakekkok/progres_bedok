<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSiswa extends Model
{
    protected $fillable = [
        'user_id', 'kk', 'akte', 'ijazah', 'foto'
    ];
}
