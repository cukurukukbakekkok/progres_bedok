<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = CalonSiswa::count();
        $lunas = CalonSiswa::where('status_pembayaran', 'Lunas')->count();
        $menunggu = CalonSiswa::where('status_pembayaran', 'Menunggu')->count();

        $pengumuman = Pengumuman::orderBy('tanggal_post', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('totalPendaftar', 'lunas', 'menunggu', 'pengumuman'));
    }
}
