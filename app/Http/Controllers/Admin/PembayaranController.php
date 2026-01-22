<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // List semua pembayaran
    public function index(Request $request)
    {
        $query = Pembayaran::with('siswa', 'gelombang')->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $pembayaran = $query->paginate(15);

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    // Detail pembayaran dengan preview bukti
    public function show($id)
    {
        $pembayaran = Pembayaran::with('siswa', 'gelombang', 'adminVerifikasi')->findOrFail($id);
        $siswa = $pembayaran->siswa;

        return view('admin.pembayaran.show', compact('pembayaran', 'siswa'));
    }

    // Validasi pembayaran
    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status_validasi' => 'required|in:lunas,gagal',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status' => $request->status_validasi,
            'id_admin_verifikasi' => Auth::id(),
            'verified_at' => now(),
            'keterangan' => $request->keterangan,
        ]);

        // Update status_pembayaran di calon_siswas
        $siswa = $pembayaran->siswa;
        if ($siswa) {
            // Recalculate total authorized payments
            $totalDibayar = $siswa->pembayarans()->where('status', 'lunas')->sum('nominal');
            $totalTagihan = $siswa->nominal_pembayaran;
            $sisa = $totalTagihan - $totalDibayar;

            if ($sisa <= 0) {
                $siswa->status_pembayaran = 'Lunas';
                \Log::info('Locking data for siswa ID: ' . $siswa->id);
                $siswa->lockData();
                \Log::info('Data locked - data_locked: ' . $siswa->data_locked . ', data_confirmed: ' . $siswa->data_confirmed);
            } else {
                $siswa->status_pembayaran = 'Belum Lunas';
            }
            $siswa->save();
        }

        return redirect()->route('admin.pembayaran.show', $id)
            ->with('success', 'Pembayaran berhasil divalidasi!');
    }
}
