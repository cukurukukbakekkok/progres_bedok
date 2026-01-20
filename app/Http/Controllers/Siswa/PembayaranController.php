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

        $pembayaran = Pembayaran::where('id_siswa', $siswa->id)->first();
        $gelombang = $siswa->gelombang;
        $calon = $siswa; // Alias untuk view

        return view('siswa.pembayaran.index', compact('siswa', 'calon', 'pembayaran', 'gelombang'));
    }

    // Halaman upload bukti pembayaran
    public function create()
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

        $gelombang = $siswa->gelombang;
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id)->first();

        return view('siswa.pembayaran.create', compact('siswa', 'gelombang', 'pembayaran'));
    }

    // Store pembayaran baru atau update
    public function store(Request $request)
    {
        $siswa = CalonSiswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        $request->validate([
            'metode_bayar' => 'required|in:transfer,e-wallet,VA',
            'bukti_bayar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'bukti_bayar.max' => 'Ukuran file maksimal 5MB',
            'bukti_bayar.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
        ]);

        $gelombang = $siswa->gelombang;

        if (!$gelombang) {
            return redirect()->back()->with('error', 'Belum ada gelombang pendaftaran aktif.');
        }

        // Cek atau buat pembayaran record
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id)->first();

        if (!$pembayaran) {
            $pembayaran = new Pembayaran();
            $pembayaran->id_siswa = $siswa->id;
            $pembayaran->id_gelombang = $gelombang->id;
            $pembayaran->nominal = $siswa->nominal_pembayaran ?? 0;
            $pembayaran->harga_awal = $siswa->nominal_pembayaran ?? 0; // Set harga awal
        }

        // Handle file upload
        if ($request->hasFile('bukti_bayar')) {
            // Hapus file lama jika ada
            if ($pembayaran->bukti_bayar && Storage::exists('public/' . $pembayaran->bukti_bayar)) {
                Storage::delete('public/' . $pembayaran->bukti_bayar);
            }

            $file = $request->file('bukti_bayar');
            $filename = 'bukti_bayar_' . $siswa->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $pembayaran->bukti_bayar = $file->storeAs('pembayaran', $filename, 'public');
        }

        // Validasi Promo jika ada (Server-side validation)
        $idPromo = $request->input('promo_id');
        $potonganPromo = 0;
        
        if ($idPromo) {
            $promo = \App\Models\Promo::find($idPromo);
            if ($promo && $promo->is_active) {
                // Double check validity
                $isValid = true;
                if ($promo->tanggal_mulai && now()->isBefore($promo->tanggal_mulai)) $isValid = false;
                if ($promo->tanggal_selesai && now()->isAfter($promo->tanggal_selesai)) $isValid = false;
                if ($promo->max_usage > 0 && $promo->used_count >= $promo->max_usage) $isValid = false;
                
                if ($isValid) {
                   $potonganPromo = $promo->diskon_nominal;
                   $pembayaran->id_promo = $promo->id;
                   
                   // Increment usage count
                   $promo->increment('used_count');
                }
            }
        }

        $pembayaran->metode_bayar = $request->metode_bayar;
        $totalBayar = max(($pembayaran->harga_awal ?? $siswa->nominal_pembayaran) - $potonganPromo, 0); // Pastikan tidak negatif
        
        $pembayaran->nominal = $totalBayar;
        $pembayaran->potongan = $potonganPromo;
        $pembayaran->status = 'menunggu'; // Reset status ke menunggu ketika upload baru
        $pembayaran->tanggal_pembayaran = now(); // Set tanggal pembayaran otomatis
        $pembayaran->verified_at = null;
        $pembayaran->id_admin_verifikasi = null;
        $pembayaran->save();

        return redirect()->route('siswa.pembayaran.index')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Tunggu verifikasi admin.');
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
