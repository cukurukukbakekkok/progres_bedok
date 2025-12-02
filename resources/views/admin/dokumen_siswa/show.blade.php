@extends('layouts.main')

@section('content')
<style>
    .detail-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .document-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .document-item {
        border-bottom: 1px solid #e9ecef;
        padding: 20px 0;
        margin-bottom: 20px;
    }

    .document-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .document-item img {
        max-width: 100%;
        height: auto;
        margin: 10px 0;
        border-radius: 8px;
    }

    .document-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 12px 12px 0 0;
        font-weight: 600;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }
</style>
<div class="detail-wrapper mt-5">
    <h2 class="mb-4 fw-bold">📄 Detail Dokumen Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Info Siswa -->
        <div class="col-md-4">
            <div class="info-card">
                <div class="document-header">
                    👤 Info Siswa
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{ $siswa->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>{{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jurusan</strong></td>
                            <td><strong>{{ $siswa->jurusan }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Asal Sekolah</strong></td>
                            <td>{{ $siswa->asal_sekolah }}</td>
                        </tr>
                        <tr>
                            <td><strong>No HP</strong></td>
                            <td>{{ $siswa->no_hp }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Dokumen -->
        <div class="col-md-8">
            <div class="document-section">
                <div class="document-header">
                    📋 Dokumen Persyaratan
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>Status Verifikasi:
                            @if($dokumen->status_verifikasi == 'Valid')
                                <span class="badge bg-success">✓ Valid</span>
                            @elseif($dokumen->status_verifikasi == 'Tidak Valid')
                                <span class="badge bg-danger">✗ Tidak Valid</span>
                            @else
                                <span class="badge bg-warning text-dark">⏳ Menunggu</span>
                            @endif
                        </h6>
                        @if($dokumen->keterangan)
                            <div class="alert alert-info mt-2">
                                <strong>Catatan:</strong> {{ $dokumen->keterangan }}
                            </div>
                        @endif
                    </div>

                    <!-- Akte Kelahiran -->
                    <div class="document-item">
                        <strong>📋 Akte Kelahiran</strong>
                        @if($dokumen->akte_kelahiran)
                            <br>
                            @if(in_array(pathinfo($dokumen->akte_kelahiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $dokumen->akte_kelahiran) }}" class="img-thumbnail" style="max-width: 400px; max-height: 300px; margin-top: 10px;">
                                <br>
                            @endif
                            <a href="{{ asset('storage/' . $dokumen->akte_kelahiran) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                📥 Download / Lihat File
                            </a>
                        @else
                            <p class="text-muted">Belum diunggah</p>
                        @endif
                    </div>

                    <!-- Ijazah SMP -->
                    <div class="document-item">
                        <strong>📋 Ijazah SMP/MTS</strong>
                        @if($dokumen->ijazah_smp)
                            <br>
                            @if(in_array(pathinfo($dokumen->ijazah_smp, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $dokumen->ijazah_smp) }}" class="img-thumbnail" style="max-width: 400px; max-height: 300px; margin-top: 10px;">
                                <br>
                            @endif
                            <a href="{{ asset('storage/' . $dokumen->ijazah_smp) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                📥 Download / Lihat File
                            </a>
                        @else
                            <p class="text-muted">Belum diunggah</p>
                        @endif
                    </div>

                    <!-- SKL -->
                    <div class="document-item">
                        <strong>📋 SKL (Surat Keterangan Lulus)</strong>
                        @if($dokumen->skl_smp)
                            <br>
                            @if(in_array(pathinfo($dokumen->skl_smp, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $dokumen->skl_smp) }}" class="img-thumbnail" style="max-width: 400px; max-height: 300px; margin-top: 10px;">
                                <br>
                            @endif
                            <a href="{{ asset('storage/' . $dokumen->skl_smp) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                📥 Download / Lihat File
                            </a>
                        @else
                            <p class="text-muted">Belum diunggah</p>
                        @endif
                    </div>

                    <!-- Kartu Keluarga -->
                    <div class="document-item">
                        <strong>📋 Kartu Keluarga (KK)</strong>
                        @if($dokumen->kartu_keluarga)
                            <br>
                            @if(in_array(pathinfo($dokumen->kartu_keluarga, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $dokumen->kartu_keluarga) }}" class="img-thumbnail" style="max-width: 400px; max-height: 300px; margin-top: 10px;">
                                <br>
                            @endif
                            <a href="{{ asset('storage/' . $dokumen->kartu_keluarga) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                📥 Download / Lihat File
                            </a>
                        @else
                            <p class="text-muted">Belum diunggah</p>
                        @endif
                    </div>

                    <!-- KTP Orang Tua -->
                    <div class="document-item">
                        <strong>📋 KTP Orang Tua</strong>
                        @if($dokumen->ktp_ortu)
                            <br>
                            @if(in_array(pathinfo($dokumen->ktp_ortu, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $dokumen->ktp_ortu) }}" class="img-thumbnail" style="max-width: 400px; max-height: 300px; margin-top: 10px;">
                                <br>
                            @endif
                            <a href="{{ asset('storage/' . $dokumen->ktp_ortu) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                📥 Download / Lihat File
                            </a>
                        @else
                            <p class="text-muted">Belum diunggah</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form Validasi -->
            @if($dokumen->status_verifikasi == 'Belum')
                <div class="document-section mt-4">
                    <div class="document-header">
                        ✅ Validasi Dokumen
                    </div>
                    <div style="padding: 25px;">
                        <form action="{{ route('admin.dokumen_siswa.validasi', $dokumen->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label"><strong>Status Verifikasi</strong></label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_verifikasi" value="Valid" id="valid" required>
                                        <label class="form-check-label" for="valid">
                                            ✓ Valid - Semua dokumen lengkap dan jelas
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_verifikasi" value="Tidak Valid" id="invalid" required>
                                        <label class="form-check-label" for="invalid">
                                            ✗ Tidak Valid - Ada dokumen yang bermasalah
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Catatan (Opsional)</strong></label>
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Ijazah tidak jelas, mohon upload ulang..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100">
                                ✅ Simpan Validasi
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.dokumen_siswa.index') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
@endsection
