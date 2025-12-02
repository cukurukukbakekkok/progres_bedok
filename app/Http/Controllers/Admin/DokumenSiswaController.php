<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\DokumenPersyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenSiswaController extends Controller
{
    public function index()
    {
        $dokumen = DokumenPersyaratan::with('siswa')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dokumen_siswa.index', compact('dokumen'));
    }

    public function show($id)
    {
        $dokumen = DokumenPersyaratan::with('siswa', 'adminVerifikasi')->findOrFail($id);
        $siswa = $dokumen->siswa;

        return view('admin.dokumen_siswa.show', compact('dokumen', 'siswa'));
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Valid,Tidak Valid',
            'keterangan' => 'nullable|string',
        ]);

        $dokumen = DokumenPersyaratan::findOrFail($id);
        $dokumen->update([
            'status_verifikasi' => $request->status_verifikasi,
            'keterangan' => $request->keterangan,
            'id_admin_verifikasi' => Auth::id(),
            'verified_at' => now(),
        ]);

        // Sync status_berkas di calon_siswas table
        $siswa = $dokumen->siswa;
        if ($siswa) {
            $siswa->status_berkas = $request->status_verifikasi;
            $siswa->save();
        }

        return redirect()->route('admin.dokumen_siswa.show', $id)
            ->with('success', 'Dokumen berhasil divalidasi!');
    }
}
