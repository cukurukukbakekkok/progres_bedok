<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        
        $pengumuman = Pengumuman::orderBy('tanggal_post', 'desc')->paginate(5);
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal_post' => 'required',
        ]);
        $data = $request->only(['judul','isi','tanggal_post','starts_at','ends_at']);
        $data['is_active'] = $request->has('is_active');
        Pengumuman::create($data);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal_post' => 'required',
        ]);
        $pengumuman = Pengumuman::findOrFail($id);
        $data = $request->only(['judul','isi','tanggal_post','starts_at','ends_at']);
        $data['is_active'] = $request->has('is_active');
        $pengumuman->update($data);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }

    // Public methods for siswa viewing
    public function publicIndex()
    {
        $pengumuman = Pengumuman::where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                      ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>=', now());
            })
            ->latest('tanggal_post')
            ->paginate(10);
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function publicShow($id)
    {
        $pengumuman = Pengumuman::where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                      ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>=', now());
            })
            ->findOrFail($id);
        return view('pengumuman.show', compact('pengumuman'));
    }
}
