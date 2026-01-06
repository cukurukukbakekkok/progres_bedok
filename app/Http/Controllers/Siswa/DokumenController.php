<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\CalonSiswa;
use App\Models\DokumenPersyaratan;

class DokumenController extends Controller
{
    public function index()
    {
        $siswa = CalonSiswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->route('siswa.pendaftaran')
                ->with('error', 'Silakan isi biodata pendaftaran terlebih dahulu.');
        }

        $dokumen = DokumenPersyaratan::where('id_siswa', $siswa->id)->first();
        if (!$dokumen) {
            $dokumen = DokumenPersyaratan::create(['id_siswa' => $siswa->id]);
        }

        return view('siswa.dokumen.index', compact('siswa', 'dokumen'));
    }

    public function store(Request $request)
    {
        $siswa = CalonSiswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Silakan lengkapi biodata pendaftaran terlebih dahulu sebelum mengunggah dokumen.');
        }

        $request->validate([
            'akte_kelahiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah_smp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'skl_smp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ktp_ortu' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'akte_kelahiran.max' => 'Ukuran file akte kelahiran maksimal 2MB',
            'ijazah_smp.max' => 'Ukuran file ijazah SMP maksimal 2MB',
            'skl_smp.max' => 'Ukuran file SKL maksimal 2MB',
            'kartu_keluarga.max' => 'Ukuran file kartu keluarga maksimal 2MB',
            'ktp_ortu.max' => 'Ukuran file KTP orang tua maksimal 2MB',
        ]);

        $dokumen = DokumenPersyaratan::where('id_siswa', $siswa->id)->first();
        if (!$dokumen) {
            $dokumen = DokumenPersyaratan::create(['id_siswa' => $siswa->id]);
        }

        $data = [];

        if ($request->hasFile('akte_kelahiran')) {
            if ($dokumen->akte_kelahiran && file_exists(storage_path('app/public/' . $dokumen->akte_kelahiran))) {
                unlink(storage_path('app/public/' . $dokumen->akte_kelahiran));
            }
            $data['akte_kelahiran'] = $request->file('akte_kelahiran')->store('dokumen', 'public');
        }

        if ($request->hasFile('ijazah_smp')) {
            if ($dokumen->ijazah_smp && file_exists(storage_path('app/public/' . $dokumen->ijazah_smp))) {
                unlink(storage_path('app/public/' . $dokumen->ijazah_smp));
            }
            $data['ijazah_smp'] = $request->file('ijazah_smp')->store('dokumen', 'public');
        }

        if ($request->hasFile('skl_smp')) {
            if ($dokumen->skl_smp && file_exists(storage_path('app/public/' . $dokumen->skl_smp))) {
                unlink(storage_path('app/public/' . $dokumen->skl_smp));
            }
            $data['skl_smp'] = $request->file('skl_smp')->store('dokumen', 'public');
        }

        if ($request->hasFile('kartu_keluarga')) {
            if ($dokumen->kartu_keluarga && file_exists(storage_path('app/public/' . $dokumen->kartu_keluarga))) {
                unlink(storage_path('app/public/' . $dokumen->kartu_keluarga));
            }
            $data['kartu_keluarga'] = $request->file('kartu_keluarga')->store('dokumen', 'public');
        }

        if ($request->hasFile('ktp_ortu')) {
            if ($dokumen->ktp_ortu && file_exists(storage_path('app/public/' . $dokumen->ktp_ortu))) {
                unlink(storage_path('app/public/' . $dokumen->ktp_ortu));
            }
            $data['ktp_ortu'] = $request->file('ktp_ortu')->store('dokumen', 'public');
        }

        if (empty($data)) {
            return back()->with('error', 'Silakan pilih file dokumen sebelum menyimpan.');
        }

        // Reset status verifikasi menjadi "Belum" jika ada perubahan dokumen
        // Tapi jangan hapus keterangan admin agar siswa tahu apa yang perlu diperbaiki
        $data['status_verifikasi'] = 'Belum';
        $dokumen->update($data);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah! Menunggu verifikasi admin.');
    }
}

