<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Auth;

class CalonSiswaController extends Controller
    {
        public function create()
        {
            return view('siswa.pendaftaran.create');
        }

        public function index()
{
    $calonSiswa = \App\Models\CalonSiswa::orderBy('created_at', 'desc')->get();
    return view('admin.calon_siswa.index', compact('calonSiswa'));
}


    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => 'required|unique:calon_siswas,nisn',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'asal_sekolah' => 'required',
            'nama_orang_tua' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        CalonSiswa::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal_sekolah' => $request->asal_sekolah,
            'nama_orang_tua' => $request->nama_orang_tua,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}
