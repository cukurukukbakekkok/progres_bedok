<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\GelombangPendaftaran;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // List semua promo
    public function index()
    {
        $promo = Promo::with('gelombang')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.promo.index', compact('promo'));
    }

    // Form create promo
    public function create()
    {
        $gelombang = GelombangPendaftaran::all();
        return view('admin.promo.create', compact('gelombang'));
    }

    // Store promo
    public function store(Request $request)
    {
        $request->validate([
            'kode_promo' => 'required|unique:promos,kode_promo|string',
            'diskon_nominal' => 'required|numeric|min:1',
            'id_gelombang' => 'nullable|exists:gelombang_pendaftarans,id',
            'tanggal_mulai' => 'nullable|date|after_or_equal:today',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'max_usage' => 'nullable|numeric|min:0',
        ]);

        Promo::create([
            'kode_promo' => strtoupper($request->kode_promo),
            'diskon_nominal' => $request->diskon_nominal,
            'id_gelombang' => $request->id_gelombang,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'max_usage' => $request->max_usage ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil dibuat');
    }

    // Form edit promo
    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        $gelombang = GelombangPendaftaran::all();
        return view('admin.promo.edit', compact('promo', 'gelombang'));
    }

    // Update promo
    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'kode_promo' => 'required|unique:promos,kode_promo,' . $id . '|string',
            'diskon_nominal' => 'required|numeric|min:1',
            'id_gelombang' => 'nullable|exists:gelombang_pendaftarans,id',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'max_usage' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $promo->update([
            'kode_promo' => strtoupper($request->kode_promo),
            'diskon_nominal' => $request->diskon_nominal,
            'id_gelombang' => $request->id_gelombang,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'max_usage' => $request->max_usage ?? 0,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil diupdate');
    }

    // Delete promo
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil dihapus');
    }

    // Validate promo code (AJAX)
    public function validateCode(Request $request)
    {
        $kode = strtoupper($request->kode);
        $id_gelombang = $request->id_gelombang;

        $promo = Promo::where('kode_promo', $kode)
            ->where('is_active', true)
            ->when($id_gelombang, function ($query) use ($id_gelombang) {
                return $query->where(function ($q) use ($id_gelombang) {
                    $q->where('id_gelombang', $id_gelombang)
                      ->orWhereNull('id_gelombang');
                });
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
