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
            return redirect()->route('siswa.pendaftaran.create')
                ->with('error', 'Silakan isi biodata pendaftaran terlebih dahulu.');
        }

        // Check apakah data sudah dikunci (hanya blokir jika data_locked = true)
        if ($siswa->data_locked) {
            return redirect()->route('siswa.pendaftaran.confirmation', $siswa->id)
                ->with('info', 'Data pendaftaran sudah dikunci. Anda tidak dapat mengubah dokumen lagi.');
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

        // Jangan izinkan update jika sudah Valid
        if ($dokumen->status_verifikasi === 'Valid') {
            return redirect()->back()->with('error', 'Dokumen Anda sudah diverifikasi dan valid, tidak dapat diubah lagi.');
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
            // Check if user already has uploaded documents
            $hasDocuments = $dokumen->akte_kelahiran || $dokumen->ijazah_smp || $dokumen->skl_smp || $dokumen->kartu_keluarga || $dokumen->ktp_ortu;
            
            if ($hasDocuments) {
                 return redirect()->route('siswa.dashboard')->with('success', 'Dokumen sudah tersimpan.');
            }

            return back()->with('error', 'Silakan pilih minimal satu file dokumen untuk diupload.');
        }

        // Reset status verifikasi menjadi "Belum" jika ada perubahan dokumen dan status sebelumnya bukan Valid
        if ($dokumen->status_verifikasi !== 'Valid') {
            $data['status_verifikasi'] = 'Belum';
        }
        
        $dokumen->update($data);

        return redirect()->route('siswa.dashboard')->with('success', 'Dokumen berhasil diunggah!');
    }
}

