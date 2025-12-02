<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CalonSiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $calonSiswa = CalonSiswa::where('user_id', $user->id)->first();

        return view('siswa.dashboard', compact('user', 'calonSiswa'));
    }

    // 🔥 Tambahkan method biodata
    public function biodata()
    {
        $user = Auth::user();
        $siswa = CalonSiswa::where('user_id', $user->id)->first();

        return view('siswa.biodata', compact('user', 'siswa'));
    }
}
