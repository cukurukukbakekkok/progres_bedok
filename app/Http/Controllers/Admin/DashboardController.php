<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = CalonSiswa::where('data_confirmed', true)->count();
        $lunas = CalonSiswa::where('data_confirmed', true)->where('status_pembayaran', 'Lunas')->count();
        $menunggu = CalonSiswa::where('data_confirmed', true)->where('status_pembayaran', 'Menunggu')->count();

        // Statistik Jurusan
        $jurusanStats = CalonSiswa::where('data_confirmed', true)
            ->selectRaw('jurusan, count(*) as count')
            ->groupBy('jurusan')
            ->pluck('count', 'jurusan')
            ->toArray();

        // Ensure keys exist for chart labels even if empty
        $jurusanLabels = array_keys($jurusanStats);
        $jurusanValues = array_values($jurusanStats);

        return view('admin.dashboard', compact('totalPendaftar', 'lunas', 'menunggu', 'jurusanLabels', 'jurusanValues'));
    }
}
