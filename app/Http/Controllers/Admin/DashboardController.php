<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung data calon siswa
        $totalPendaftar = CalonSiswa::count();
        $lunas = CalonSiswa::where('status_pembayaran', 'Lunas')->count();
        $menunggu = CalonSiswa::where('status_pembayaran', 'Menunggu')->count();

        // Ambil pengumuman terbaru
        $pengumuman = Pengumuman::orderBy('tanggal_post', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalPendaftar', 'lunas', 'menunggu', 'pengumuman'));
    }
}
