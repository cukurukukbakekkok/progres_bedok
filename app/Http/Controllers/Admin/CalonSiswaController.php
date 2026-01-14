<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    public function index(Request $request)
    {
        // eager-load kelas to avoid N+1 when views access $siswa->kelas
        $query = CalonSiswa::with('kelas');
        
        // Search by kode_pendaftaran or nama_lengkap
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('kode_pendaftaran', 'like', '%' . $search . '%')
                  ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%');
        }
        
        $calonSiswa = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.calon_siswa.index', compact('calonSiswa'));
    }

    public function show($id)
    {
        // include kelas relationship for detail view
        $siswa = CalonSiswa::with('kelas')->findOrFail($id);
        return view('admin.calon_siswa.show', compact('siswa'));
    }

    // ✔ Verifikasi pembayaran
    public function verifikasi($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_pembayaran = 'Lunas';
        $siswa->save();

        return back()->with('success', '✔ Pembayaran berhasil diverifikasi.');
    }

    // ✔ Validasi berkas
    public function validasi($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        
        // Update status berkas di calon_siswas
        $siswa->status_berkas = 'Valid';
        $siswa->save();

        return back()->with('success', '✔ Berkas berhasil divalidasi.');
    }

    // ✔ Tolak kelulusan
    public function tolak($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_kelulusan = 'Tidak Lolos';
        $siswa->save();

        return back()->with('success', '❌ Siswa telah dinyatakan TIDAK LOLOS.');
    }

    // ✔ Setujui kelulusan
    public function setujui($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_kelulusan = 'Lolos';
        $siswa->save();

        return back()->with('success', '🏆 Siswa telah dinyatakan LOLOS.');
    }


    // ✔ Hapus data calon siswa
    public function destroy($id)
    {
        $data = CalonSiswa::with('kelas')->findOrFail($id);

        // Decrease kelas count (restore kelas capacity)
        if ($data->kelas_id) {
            \App\Models\Kelas::where('id', $data->kelas_id)->decrement('jumlah_siswa');
            \Log::info('Kelas count decremented for kelas_id: ' . $data->kelas_id);
        }

        // Delete files
        if ($data->foto && file_exists(public_path('uploads/foto/' . $data->foto))) {
            unlink(public_path('uploads/foto/' . $data->foto));
        }
        if ($data->dokumen && file_exists(public_path('uploads/dokumen/' . $data->dokumen))) {
            unlink(public_path('uploads/dokumen/' . $data->dokumen));
        }

        $data->delete();
        \Log::info('Siswa deleted: ' . $data->nama_lengkap);

        return redirect()->route('admin.calon_siswa.index')
            ->with('success', 'Data calon siswa berhasil dihapus.');
    }
}
