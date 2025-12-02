<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\GelombangPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalonSiswaController extends Controller
    {
        public function create()
        {
            // Jika user sudah punya biodata, redirect ke biodata view (read-only)
            $existing = CalonSiswa::where('user_id', Auth::id())->first();
            if ($existing) {
                return redirect()->route('siswa.biodata')
                    ->with('info', 'Anda sudah melakukan pendaftaran. Berikut data diri Anda:');
            }

            // Ambil gelombang yang aktif
            $gelombang = \App\Models\GelombangPendaftaran::where('status', 'aktif')->get();

            // Generate preview kode formulir (akan digunakan sebagai referensi)
            $kodePendaftaranPreview = CalonSiswa::generateKodePendaftaran();

            return view('siswa.pendaftaran.create', compact('gelombang', 'kodePendaftaranPreview'));
        }

    public function index()
    {
    $calonSiswa = CalonSiswa::where('user_id', Auth::id())->first();
    return view('siswa.pendaftaran.index', compact('calonSiswa'));
    }

    public function store(Request $request)
    {
        // Jika user sudah punya pendaftaran, tolak pendaftaran ulang
        $existing = CalonSiswa::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Anda sudah melakukan pendaftaran. Satu akun hanya boleh memiliki satu biodata.');
        }

        $request->validate([
            'id_gelombang' => 'required|exists:gelombang_pendaftarans,id',
            'nama_lengkap' => 'required',
            'nisn' => 'required|unique:calon_siswas,nisn',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today|after:1950-01-01',
            'jenis_kelamin' => 'required',
            'asal_sekolah' => 'required',
            'nama_orang_tua' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jurusan' => 'required|in:RPL,TPM,TITL,TKR',
        ], [
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid. Gunakan format YYYY-MM-DD (contoh: 2008-05-15)',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh di masa depan',
            'tanggal_lahir.after' => 'Tanggal lahir harus setelah tahun 1950',
        ]);

        // Buat pendaftaran baru untuk user ini
        // Set nominal pembayaran berdasarkan jurusan
        $hargaJurusan = CalonSiswa::getHargaJurusan($request->jurusan);

        // Lakukan dalam transaction untuk mencegah race condition
        try {
            DB::transaction(function () use ($request, $hargaJurusan) {
                // ambil gelombang dengan lock
                $gelombang = GelombangPendaftaran::where('id', $request->id_gelombang)->lockForUpdate()->first();

                if (! $gelombang || $gelombang->status !== 'aktif' || ($gelombang->kuota ?? 0) <= 0) {
                    throw new \Exception('Gelombang tidak tersedia atau kuota habis.');
                }

                $potongan = $gelombang->potongan ?? 0;
                $nominalAkhir = max($hargaJurusan - $potongan, 0); // Minimal 0

                CalonSiswa::create([
                    'user_id' => Auth::id(),
                    'kode_pendaftaran' => CalonSiswa::generateKodePendaftaran(),
                    'id_gelombang' => $request->id_gelombang,
                    'nama_lengkap' => $request->nama_lengkap,
                    'nisn' => $request->nisn,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'asal_sekolah' => $request->asal_sekolah,
                    'nama_orang_tua' => $request->nama_orang_tua,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                    'jurusan' => $request->jurusan,
                    'harga_jurusan' => $hargaJurusan,
                    'nominal_pembayaran' => $nominalAkhir, // Nominal setelah potongan
                ]);

                // kurangi kuota
                $gelombang->kuota = max(0, ($gelombang->kuota ?? 0) - 1);
                if ($gelombang->kuota <= 0) {
                    $gelombang->status = 'nonaktif';
                }
                $gelombang->save();
            });

            return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
