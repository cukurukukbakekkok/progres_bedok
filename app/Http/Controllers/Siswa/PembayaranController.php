<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\Pembayaran;
use App\Models\GelombangPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    // Halaman list pembayaran siswa
    public function index()
    {
        $siswa = CalonSiswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->route('siswa.pendaftaran.create')
                ->with('error', 'Silakan isi biodata pendaftaran terlebih dahulu.');
        }

        // Check apakah siswa sudah confirm data
        if (!$siswa->data_confirmed) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Silakan konfirmasi data pendaftaran terlebih dahulu sebelum melakukan pembayaran.');
        }

        // Check if documents are complete
        $docs = $siswa->dokumenPersyaratan;
        $isDocsComplete = $docs && $docs->foto && $docs->akte_kelahiran && $docs->ijazah_smp && $docs->skl_smp && $docs->kartu_keluarga && $docs->ktp_ortu;

        if (!$isDocsComplete) {
            return redirect()->route('siswa.dokumen.index')
                ->with('error', 'Silakan lengkapi semua dokumen persyaratan (termasuk Pas Foto) sebelum melakukan pembayaran.');
        }

        // Fetch all payments
        $pembayarans = $siswa->pembayarans()->orderBy('created_at', 'desc')->get();
        $gelombang = $siswa->gelombang;
        $calon = $siswa;

        // Calculate totals
        $totalTagihan = $siswa->nominal_pembayaran; // This should be the final amount to pay
        $totalDibayar = $pembayarans->where('status', 'lunas')->sum('nominal'); // Only counting verified payments
        $totalMenunggu = $pembayarans->where('status', 'menunggu')->sum('nominal');
        $sisaTagihan = max($totalTagihan - $totalDibayar, 0);

        $isLunas = $sisaTagihan <= 0;

        return view('siswa.pembayaran.index', compact('siswa', 'calon', 'pembayarans', 'gelombang', 'totalTagihan', 'totalDibayar', 'sisaTagihan', 'isLunas', 'totalMenunggu'));
    }

    // Halaman upload bukti pembayaran (Optional if using index)
    public function create()
    {
        return redirect()->route('siswa.pembayaran.index');
    }

    // Store pembayaran baru (Cicilan atau Lunas)
    public function store(Request $request)
    {
        $siswa = CalonSiswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        // Calculate sisa tagihan first
        $totalTagihan = $siswa->nominal_pembayaran;
        $totalDibayar = $siswa->pembayarans()->where('status', 'lunas')->sum('nominal');
        $sisaTagihan = max($totalTagihan - $totalDibayar, 0);

        if ($sisaTagihan <= 0) {
            return redirect()->back()->with('error', 'Tagihan Anda sudah lunas.');
        }

        $request->validate([
            'nominal' => 'required|numeric|min:10000|max:' . $sisaTagihan,
            'metode_bayar' => 'required|in:transfer,e-wallet,VA',
            'bukti_bayar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'nominal.max' => 'Nominal pembayaran tidak boleh melebihi sisa tagihan (Rp ' . number_format($sisaTagihan, 0, ',', '.') . ')',
            'bukti_bayar.max' => 'Ukuran file maksimal 5MB',
            'bukti_bayar.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
        ]);

        $gelombang = $siswa->gelombang;

        if (!$gelombang) {
            return redirect()->back()->with('error', 'Belum ada gelombang pendaftaran aktif.');
        }

        $pembayaran = new Pembayaran();
        $pembayaran->id_siswa = $siswa->id;
        $pembayaran->id_gelombang = $gelombang->id;
        $pembayaran->nominal = $request->nominal;
        $pembayaran->harga_awal = $siswa->nominal_pembayaran; // Just for reference
        $pembayaran->potongan = 0; // Info potongan already in siswa data usually

        // Handle file upload
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = 'bukti_bayar_' . $siswa->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $pembayaran->bukti_bayar = $file->storeAs('pembayaran', $filename, 'public');
        }

        $pembayaran->metode_bayar = $request->metode_bayar;
        $pembayaran->status = 'menunggu';
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran ?? now();
        $pembayaran->save();

        return redirect()->route('siswa.pembayaran.index')
            ->with('success', 'Pembayaran sebesar Rp ' . number_format($pembayaran->nominal, 0, ',', '.') . ' berhasil dikirim. Tunggu verifikasi admin.');
    }

    // Lihat detail pembayaran
    public function show()
    {
        $siswa = CalonSiswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        $pembayaran = Pembayaran::where('id_siswa', $siswa->id)->first();

        if (!$pembayaran) {
            return redirect()->route('siswa.pembayaran.index')
                ->with('error', 'Data pembayaran tidak ditemukan.');
        }

        return view('siswa.pembayaran.show', compact('siswa', 'pembayaran'));
    }

    // Check promo code (Ajax for Siswa)
    public function checkPromo(Request $request)
    {
        $kode = strtoupper($request->kode);
        $id_gelombang = $request->id_gelombang;

        $promo = \App\Models\Promo::where('kode_promo', $kode)
            ->where('is_active', true)
            ->where(function ($query) use ($id_gelombang) {
                // Promo bisa spesifik gelombang atau untuk semua (null)
                $query->where('id_gelombang', $id_gelombang)
                    ->orWhereNull('id_gelombang');
            })
            ->first();

        if (!$promo) {
            return response()->json(['valid' => false, 'message' => 'Kode promo tidak valid']);
        }

        // Check tanggal
        if ($promo->tanggal_mulai && now()->isBefore($promo->tanggal_mulai)) {
            return response()->json(['valid' => false, 'message' => 'Promo belum berlaku']);
        }

        if ($promo->tanggal_selesai && now()->isAfter($promo->tanggal_selesai)) {
            return response()->json(['valid' => false, 'message' => 'Promo sudah berakhir']);
        }

        // Check usage limit
        if ($promo->max_usage > 0 && $promo->used_count >= $promo->max_usage) {
            return response()->json(['valid' => false, 'message' => 'Kuota promo sudah habis']);
        }

        return response()->json([
            'valid' => true,
            'diskon_persen' => $promo->diskon_persen,
            'diskon_nominal' => $promo->diskon_nominal,
            'id' => $promo->id,
        ]);
    }
}
