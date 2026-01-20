<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Kelas;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::withCount(['kelas', 'pendaftar'])->get();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function show($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $kelas = $jurusan->kelas()->withCount('calonSiswa')->orderBy('nama')->get();
        return view('admin.jurusan.show', compact('jurusan', 'kelas'));
    }

    public function kelasStore(Request $request, $jurusanId)
    {
        $request->validate(['nama' => 'required', 'kapasitas' => 'required|integer|min:1']);
        $jurusan = Jurusan::findOrFail($jurusanId);
        Kelas::create([
            'jurusan_id' => $jurusan->id,
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'jumlah_siswa' => 0,
        ]);
        return redirect()->route('admin.jurusan.show', $jurusan->id)->with('success', 'Kelas berhasil dibuat');
    }

    public function kelasUpdate(Request $request, $jurusanId, $kelasId)
    {
        $request->validate(['kapasitas' => 'required|integer|min:1']);
        $kelas = Kelas::findOrFail($kelasId);
        $kelas->update(['kapasitas' => $request->kapasitas]);
        return redirect()->route('admin.jurusan.show', $jurusanId)->with('success', 'Kelas berhasil diupdate');
    }

    public function kelasDestroy($jurusanId, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        if ($kelas->calonSiswa()->count() > 0) {
            return back()->with('error', 'Tidak bisa hapus kelas yang ada siswa');
        }
        $kelas->delete();
        return redirect()->route('admin.jurusan.show', $jurusanId)->with('success', 'Kelas berhasil dihapus');
    }
}
