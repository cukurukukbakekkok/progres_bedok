<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    public function index()
    {
        $calonSiswa = CalonSiswa::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.calon_siswa.index', compact('calonSiswa'));
    }

    public function show($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('admin.calon_siswa.show', compact('siswa'));
    }

    // ✔ Verifikasi pembayaran
    public function verifikasi($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_pembayaran = 'Lunas';
        $siswa->save();

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    // ✔ Validasi berkas
    public function validasi($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        $siswa->status_berkas = 'Valid';
        $siswa->save();

        return back()->with('success', 'Berkas berhasil divalidasi.');
    }

    // ✔ Tolak kelulusan
    public function tolak($id)
{
    $siswa = CalonSiswa::findOrFail($id);
    $siswa->status_kelulusan = 'Tidak Lolos';
    $siswa->save();

    return redirect()->route('admin.calon_siswa.show', $id)
        ->with('success', 'Siswa telah dinyatakan TIDAK LOLOS.');
}

    // ✔ Setujui kelulusan
    public function setujui($id)
{
    $siswa = CalonSiswa::findOrFail($id);
    $siswa->status_kelulusan = 'Lolos';
    $siswa->save();

    return redirect()->route('admin.calon_siswa.show', $id)
        ->with('success', 'Siswa telah dinyatakan LOLOS.');
}


    // ✔ Hapus data calon siswa
    public function destroy($id)
    {
        $data = CalonSiswa::findOrFail($id);

        if ($data->foto && file_exists(public_path('uploads/foto/' . $data->foto))) {
            unlink(public_path('uploads/foto/' . $data->foto));
        }
        if ($data->dokumen && file_exists(public_path('uploads/dokumen/' . $data->dokumen))) {
            unlink(public_path('uploads/dokumen/' . $data->dokumen));
        }

        $data->delete();

        return redirect()->route('admin.calon_siswa.index')
            ->with('success', 'Data calon siswa berhasil dihapus.');
    }
}
