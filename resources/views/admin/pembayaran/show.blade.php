@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4 text-primary">💳 Detail Pembayaran</h3>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-body">

            <h4 class="fw-bold">{{ $siswa->nama_lengkap }}</h4>
            <p class="text-muted mb-4">{{ $siswa->nisn }} • {{ $siswa->asal_sekolah }}</p>

            <table class="table table-striped">
                <tr><th>Nama Lengkap</th><td>{{ $siswa->nama_lengkap }}</td></tr>
                <tr><th>NISN</th><td>{{ $siswa->nisn }}</td></tr>
                <tr><th>Asal Sekolah</th><td>{{ $siswa->asal_sekolah }}</td></tr>
                <tr><th>Nominal Bayar</th><td>Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td></tr>
                <tr><th>Metode Pembayaran</th><td>{{ ucfirst($pembayaran->metode_bayar) }}</td></tr>
                <tr><th>Status</th>
                    <td>
                        @if($pembayaran->status == 'lunas')
                            <span class="badge bg-success">✓ Lunas</span>
                        @elseif($pembayaran->status == 'gagal')
                            <span class="badge bg-danger">✗ Ditolak</span>
                        @else
                            <span class="badge bg-warning">⏳ Menunggu Verifikasi</span>
                        @endif
                    </td>
                </tr>
                <tr><th>Tanggal Upload</th><td>{{ $pembayaran->created_at->format('d M Y H:i') }}</td></tr>
                @if($pembayaran->verified_at)
                    <tr><th>Tanggal Verifikasi</th><td>{{ $pembayaran->verified_at->format('d M Y H:i') }}</td></tr>
                @endif
            </table>

            <hr>

            <!-- Preview Bukti Pembayaran -->
            <h5 class="fw-bold mb-3">📸 Bukti Pembayaran</h5>
            @if($pembayaran->bukti_bayar)
                <div class="mb-4">
                    @if(in_array(pathinfo($pembayaran->bukti_bayar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" class="img-thumbnail" style="max-width: 500px; max-height: 400px;">
                        <br>
                    @endif
                    <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" class="btn btn-sm btn-outline-primary mt-2" target="_blank">
                        📥 Download / Lihat File Lengkap
                    </a>
                </div>
            @else
                <p class="text-muted">Belum ada bukti pembayaran</p>
            @endif

            <hr>

            <!-- Form Validasi -->
            @if($pembayaran->status == 'menunggu')
                <h5 class="fw-bold mb-3">✅ Verifikasi Pembayaran</h5>
                <form action="{{ route('admin.pembayaran.validasi', $pembayaran->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label"><strong>Status Verifikasi</strong></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_validasi" id="lunas" value="lunas" required>
                                <label class="form-check-label" for="lunas">
                                    ✓ Lunas
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_validasi" id="gagal" value="gagal" required>
                                <label class="form-check-label" for="gagal">
                                    ✗ Ditolak
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Keterangan</strong></label>
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan jika ditolak..." rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">✅ Verifikasi</button>
                </form>
            @endif

            @if($pembayaran->status != 'menunggu' && $pembayaran->keterangan)
                <div class="alert alert-info">
                    <strong>Keterangan:</strong> {{ $pembayaran->keterangan }}
                </div>
            @endif

            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>

</div>

{{-- Animasi --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
