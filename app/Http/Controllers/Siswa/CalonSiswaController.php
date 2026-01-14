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
        if ($existing && $existing->tahap_form >= 3) {
            return redirect()->route('siswa.pendaftaran.detail', $existing->id)
                ->with('info', 'Pendaftaran Anda sudah selesai. Data tidak dapat diubah lagi.');
        }

        // Ambil gelombang yang aktif
        $gelombang = \App\Models\GelombangPendaftaran::where('status', 'aktif')->get();

        // Generate preview kode formulir (akan digunakan sebagai referensi)
        $kodePendaftaranPreview = CalonSiswa::generateKodePendaftaran();

        return view('siswa.pendaftaran.create-multistep', compact('gelombang', 'kodePendaftaranPreview'));
    }

    public function index()
    {
        $calonSiswa = CalonSiswa::where('user_id', Auth::id())->first();
        return view('siswa.pendaftaran.index', compact('calonSiswa'));
    }

    public function store(Request $request)
    {
        $tahap = $request->input('tahap', 1);
        \Log::info('=== FORM SUBMITTED ===');
        \Log::info('Tahap: ' . $tahap);

        try {
            // VALIDATE SEMUA TAHAP DULU SEBELUM APAPUN
            if ($tahap >= 1) {
                $this->validateTahap1($request);
            }
            if ($tahap >= 2) {
                $this->validateTahap2($request);
            }
            if ($tahap >= 3) {
                $this->validateTahap3($request);
            }
            
            \Log::info('All validations passed for tahap ' . $tahap);

            // Ambil existing calon
            $calon = CalonSiswa::where('user_id', Auth::id())->first();
            
            if (!$calon) {
                // CREATE DENGAN DATA LENGKAP TAHAP 1 + TAHAP 2
                $createData = [
                    'user_id' => Auth::id(),
                    'id_gelombang' => $request->id_gelombang,
                    'kode_pendaftaran' => CalonSiswa::generateKodePendaftaran(),
                    // Tahap 1
                    'nama_lengkap' => $request->nama_lengkap,
                    'nisn' => $request->nisn,
                    'nik' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'berat_badan' => $request->berat_badan,
                    'tinggi_badan' => $request->tinggi_badan,
                    'asal_sekolah' => $request->asal_sekolah,
                    'no_hp' => $request->no_hp,
                    'no_wa' => $request->no_wa,
                    'jurusan' => $request->jurusan,
                    // Tahap 2 (alamat)
                    'alamat' => $request->alamat ?? '',
                    'provinsi' => $request->provinsi ?? '',
                    'kabupaten' => $request->kabupaten ?? '',
                    'kecamatan' => $request->kecamatan ?? '',
                    'kelurahan' => $request->kelurahan ?? '',
                    'kode_pos' => $request->kode_pos ?? '',
                    'rt_rw' => $request->rt_rw,
                    // Status
                    'status_keluarga' => $request->status_keluarga ?? 'ayah_ibu',
                    'tahap_form' => 1,
                ];
                
                $calon = CalonSiswa::create($createData);
                \Log::info('Created new calon siswa with ID: ' . $calon->id);
                
                // Set harga
                $hargaJurusan = CalonSiswa::getHargaJurusan($request->jurusan);
                $potongan = $calon->gelombang->potongan ?? 0;
                $nominalAkhir = max($hargaJurusan - $potongan, 0);
                
                $calon->update([
                    'harga_jurusan' => $hargaJurusan,
                    'nominal_pembayaran' => $nominalAkhir,
                ]);
            }

            // UPDATE TAHAP 1
            if ($tahap >= 1) {
                $calon->update([
                    'nama_lengkap' => $request->nama_lengkap,
                    'nisn' => $request->nisn,
                    'nik' => $request->nik,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'berat_badan' => $request->berat_badan,
                    'tinggi_badan' => $request->tinggi_badan,
                    'asal_sekolah' => $request->asal_sekolah,
                    'no_hp' => $request->no_hp,
                    'no_wa' => $request->no_wa,
                    'jurusan' => $request->jurusan,
                    'id_gelombang' => $request->id_gelombang,
                    'tahap_form' => ($tahap >= 2 ? 2 : 1),
                ]);
                \Log::info('Updated tahap 1 data');
                
                // Jika tahap = 1, return JSON untuk AJAX
                if ($tahap == 1) {
                    return response()->json(['success' => true, 'tahap' => 2]);
                }
            }

            // UPDATE TAHAP 2
            if ($tahap >= 2) {
                $calon->update([
                    'alamat' => $request->alamat,
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'kelurahan' => $request->kelurahan,
                    'kode_pos' => $request->kode_pos,
                    'rt_rw' => $request->rt_rw,
                    'tahap_form' => ($tahap >= 3 ? 3 : 2),
                ]);
                \Log::info('Updated tahap 2 data');
                
                // Jika tahap = 2, return JSON untuk AJAX
                if ($tahap == 2) {
                    return response()->json(['success' => true, 'tahap' => 3]);
                }
            }

            // UPDATE TAHAP 3
            if ($tahap >= 3) {
                $statusKeluarga = $request->status_keluarga;
                \Log::info('TAHAP 3 - Status Keluarga: ' . $statusKeluarga);
                \Log::info('TAHAP 3 - All Request Data: ', $request->all());
                
                $updateData = [
                    'status_keluarga' => $statusKeluarga,
                    'tahap_form' => 3,
                ];
                
                // Add parent or wali data based on status
                if ($statusKeluarga == 'ayah_ibu') {
                    \Log::info('TAHAP 3 - Saving PARENT data');
                    $updateData = array_merge($updateData, [
                        'nama_ayah' => $request->nama_ayah,
                        'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                        'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
                        'pendidikan_ayah' => $request->pendidikan_ayah,
                        'pekerjaan_ayah' => $request->pekerjaan_ayah,
                        'penghasilan_ayah' => $request->penghasilan_ayah,
                        'no_hp_ayah' => $request->no_hp_ayah,
                        'nama_ibu' => $request->nama_ibu,
                        'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                        'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
                        'pendidikan_ibu' => $request->pendidikan_ibu,
                        'pekerjaan_ibu' => $request->pekerjaan_ibu,
                        'penghasilan_ibu' => $request->penghasilan_ibu,
                        'no_hp_ibu' => $request->no_hp_ibu,
                        // Clear wali data
                        'nama_wali' => null,
                        'tempat_lahir_wali' => null,
                        'tanggal_lahir_wali' => null,
                        'pendidikan_wali' => null,
                        'pekerjaan_wali' => null,
                        'penghasilan_wali' => null,
                        'no_hp_wali' => null,
                    ]);
                    \Log::info('TAHAP 3 - Update Data for PARENT: ', $updateData);
                } else {
                    \Log::info('TAHAP 3 - Saving WALI data');
                    $updateData = array_merge($updateData, [
                        'nama_wali' => $request->nama_wali,
                        'tempat_lahir_wali' => $request->tempat_lahir_wali,
                        'tanggal_lahir_wali' => $request->tanggal_lahir_wali,
                        'pendidikan_wali' => $request->pendidikan_wali,
                        'pekerjaan_wali' => $request->pekerjaan_wali,
                        'penghasilan_wali' => $request->penghasilan_wali,
                        'no_hp_wali' => $request->no_hp_wali,
                        // Clear orang tua data
                        'nama_ayah' => null,
                        'tempat_lahir_ayah' => null,
                        'tanggal_lahir_ayah' => null,
                        'pendidikan_ayah' => null,
                        'pekerjaan_ayah' => null,
                        'penghasilan_ayah' => null,
                        'no_hp_ayah' => null,
                        'nama_ibu' => null,
                        'tempat_lahir_ibu' => null,
                        'tanggal_lahir_ibu' => null,
                        'pendidikan_ibu' => null,
                        'pekerjaan_ibu' => null,
                        'penghasilan_ibu' => null,
                        'no_hp_ibu' => null,
                    ]);
                }
                
                $calon->update($updateData);
                \Log::info('Updated tahap 3 data - Status keluarga: ' . $statusKeluarga);

                // Assign kelas if not yet assigned
                if (!$calon->kelas_id) {
                    $kelas = \App\Models\Kelas::autoAssignKelas($calon->jurusan);
                    if ($kelas) {
                        $calon->kelas_id = $kelas->id;
                        $calon->save();
                        $kelas->increment('jumlah_siswa');
                        \Log::info('Assigned kelas: ' . $kelas->nama);
                    }
                }

                // Decrement kuota
                if ($calon->gelombang && $calon->gelombang->kuota > 0) {
                    $calon->gelombang->decrement('kuota');
                    \Log::info('Kuota decremented');
                }

                \Log::info('Pendaftaran completed! Redirecting to detail...');
                return redirect()->route('siswa.pendaftaran.detail', $calon->id)
                    ->with('success', 'Selamat! Pendaftaran Anda berhasil disimpan.');
            }

            // If tahap < 3
            \Log::info('Tahap ' . $tahap . ' completed');
            return redirect()->route('siswa.pendaftaran.create')
                ->with('success', 'Data tahap ' . $tahap . ' berhasil disimpan');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    private function validateTahap1(Request $request)
    {
        // Get current user's calon siswa if exists
        $calon = CalonSiswa::where('user_id', Auth::id())->first();
        
        $rules = [
            'id_gelombang' => 'required|exists:gelombang_pendaftarans,id',
            'nama_lengkap' => 'required|string',
            'nisn' => 'required',
            'nik' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date|before_or_equal:today|after:1950-01-01',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'berat_badan' => 'required|numeric|min:20|max:200',
            'tinggi_badan' => 'required|numeric|min:100|max:220',
            'asal_sekolah' => 'required|string',
            'no_hp' => 'required|string',
            'no_wa' => 'required|string',
            'jurusan' => 'required|in:RPL,TPM,TITL,TKR',
        ];
        
        // For new calon, NISN must be unique
        // For existing calon, NISN must be unique except for their own record
        if (!$calon) {
            $rules['nisn'] .= '|unique:calon_siswas,nisn';
        } else {
            $rules['nisn'] .= '|unique:calon_siswas,nisn,' . $calon->id;
        }
        
        $request->validate($rules);
    }

    private function validateTahap2(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'kode_pos' => 'required|string',
            'rt_rw' => 'nullable|string',
        ]);
    }

    private function validateTahap3(Request $request)
    {
        $rules = [
            'status_keluarga' => 'required|in:ayah_ibu,yatim,piatu,yatim_piatu',
        ];

        if ($request->status_keluarga == 'ayah_ibu') {
            $rules = array_merge($rules, [
                'nama_ayah' => 'required|string',
                'tempat_lahir_ayah' => 'required|string',
                'tanggal_lahir_ayah' => 'required|date|before_or_equal:today|after:1930-01-01',
                'pendidikan_ayah' => 'required|string',
                'pekerjaan_ayah' => 'required|string',
                'penghasilan_ayah' => 'required|string',
                'no_hp_ayah' => 'required|string',
                'nama_ibu' => 'required|string',
                'tempat_lahir_ibu' => 'required|string',
                'tanggal_lahir_ibu' => 'required|date|before_or_equal:today|after:1930-01-01',
                'pendidikan_ibu' => 'required|string',
                'pekerjaan_ibu' => 'required|string',
                'penghasilan_ibu' => 'required|string',
                'no_hp_ibu' => 'required|string',
            ]);
        } else {
            // For yatim, piatu, or yatim_piatu - use wali data instead
            $rules = array_merge($rules, [
                'nama_wali' => 'required|string',
                'tempat_lahir_wali' => 'required|string',
                'tanggal_lahir_wali' => 'required|date|before_or_equal:today|after:1930-01-01',
                'pendidikan_wali' => 'required|string',
                'pekerjaan_wali' => 'required|string',
                'penghasilan_wali' => 'required|string',
                'no_hp_wali' => 'required|string',
            ]);
        }

        try {
            $validated = $request->validate($rules);
            \Log::info('Tahap 3 - Validation passed', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Tahap 3 - Validation failed', [
                'errors' => $e->errors(),
                'status_keluarga' => $request->status_keluarga,
                'submitted_data' => $request->all()
            ]);
            throw $e;
        }
    }

    /**
     * Get gelombang data (potongan, dll) via AJAX
     */
    public function getGelombangData($id)
    {
        $gelombang = GelombangPendaftaran::find($id);
        
        if (!$gelombang) {
            return response()->json(['error' => 'Gelombang not found'], 404);
        }

        return response()->json([
            'id' => $gelombang->id,
            'nama' => $gelombang->nama_gelombang ?? $gelombang->nama,
            'potongan' => $gelombang->potongan ?? 0,
            'keterangan_potongan' => $gelombang->keterangan_potongan ?? '',
            'kuota' => $gelombang->kuota,
        ]);
    }

    /**
     * Show biodata detail after successful registration
     */
    public function detailBiodata($id)
    {
        $calon = CalonSiswa::findOrFail($id);

        // Only allow user to view their own biodata
        if ($calon->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('siswa.pendaftaran.detail-biodata', compact('calon'));
    }
}

