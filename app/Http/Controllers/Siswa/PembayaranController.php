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
            return redirect()->route('siswa.pendaftaran')
                ->with('error', 'Silakan isi biodata pendaftaran terlebih dahulu.');
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
            return redirect()->route('siswa.pendaftaran')
                ->with('error', 'Silakan isi biodata pendaftaran terlebih dahulu.');
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

        $pembayaran->metode_bayar = $request->metode_bayar;
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
}
