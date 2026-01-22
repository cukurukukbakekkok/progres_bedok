<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GelombangPendaftaran;
use Illuminate\Http\Request;

class GelombangPendaftaranController extends Controller
{
    // List semua gelombang
    public function index()
    {
        $gelombang = GelombangPendaftaran::active()
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        return view('admin.gelombang.index', compact('gelombang'));
    }

    // Form create gelombang
    public function create()
    {
        return view('admin.gelombang.create');
    }

    // Store gelombang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:gelombang_pendaftarans',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'required|integer|min:1',
            'potongan' => 'nullable|integer|min:0',
            'keterangan_potongan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        GelombangPendaftaran::create($request->all());

        return redirect()->route('admin.gelombang.index')
            ->with('success', 'Gelombang pendaftaran berhasil dibuat!');
    }

    // Detail gelombang
    public function show($id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);
        $calonSiswa = $gelombang->calonSiswa()->count();
        $pembayaran = $gelombang->pembayarans()->count();

        return view('admin.gelombang.show', compact('gelombang', 'calonSiswa', 'pembayaran'));
    }

    // Form edit gelombang
    public function edit($id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);
        return view('admin.gelombang.edit', compact('gelombang'));
    }

    // Update gelombang
    public function update(Request $request, $id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|unique:gelombang_pendaftarans,nama,' . $id,
            'tanggal_mulai' => 'required|date', // Allow editing past events start date if needed, but end date must be valid
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kuota' => 'required|integer|min:1',
            'potongan' => 'nullable|integer|min:0',
            'keterangan_potongan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $gelombang->update($request->all());

        return redirect()->route('admin.gelombang.show', $id)
            ->with('success', 'Gelombang pendaftaran berhasil diperbarui!');
    }

    // Delete gelombang
    public function destroy($id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);
        $gelombang->delete();

        return redirect()->route('admin.gelombang.index')
            ->with('success', 'Gelombang pendaftaran berhasil dihapus!');
    }

    // List siswa per gelombang
    public function siswa(Request $request, $id)
    {
        $gelombang = GelombangPendaftaran::findOrFail($id);
        $query = $gelombang->calonSiswa();

        // Search by kode_pendaftaran or nama_lengkap
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('kode_pendaftaran', 'like', '%' . $search . '%')
                ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                ->orWhere('nisn', 'like', '%' . $search . '%');
        }

        $calonSiswa = $query->paginate(15);

        return view('admin.gelombang.siswa', compact('gelombang', 'calonSiswa'));
    }
}
