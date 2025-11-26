@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4 text-primary">📌 Detail Calon Siswa</h3>

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
                <tr><th>No HP</th><td>{{ $siswa->no_hp }}</td></tr>
                <tr><th>Alamat</th><td>{{ $siswa->alamat }}</td></tr>
                <tr><th>Status Pembayaran</th>
                    <td>
                        @if($siswa->status_pembayaran == 'lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @endif
                    </td>
                </tr>
                <tr><th>Status Berkas</th>
                    <td>
                        @if($siswa->status_berkas == 'valid')
                            <span class="badge bg-success">Valid</span>
                        @else
                            <span class="badge bg-secondary">Belum Valid</span>
                        @endif
                    </td>
                </tr>
                <tr><th>Status Akhir</th>
                    <td>
                        @if($siswa->status_akhir == 'Lolos')
                            <span class="badge bg-primary">Lolos</span>
                        @elseif($siswa->status_akhir == 'Tidak Lolos')
                            <span class="badge bg-danger">Tidak Lolos</span>
                        @else
                            <span class="badge bg-secondary">Menunggu Keputusan</span>
                        @endif
                    </td>
                </tr>
            </table>

            <hr>

            <h5 class="fw-bold mb-3">🛠 Aksi</h5>
            <div class="d-flex flex-wrap gap-2">

                <form action="{{ route('admin.calon_siswa.verifikasi', $siswa->id) }}" method="POST">@csrf
                    <button class="btn btn-success btn-sm">✔ Verifikasi Pembayaran</button>
                </form>

                <form action="{{ route('admin.calon_siswa.validasi', $siswa->id) }}" method="POST">@csrf
                    <button class="btn btn-info btn-sm">📁 Validasi Berkas</button>
                </form>

                <form action="{{ route('admin.calon_siswa.setujui', $siswa->id) }}" method="POST">@csrf
                    <button class="btn btn-primary btn-sm">🏆 Setujui / Lolos</button>
                </form>

                <form action="{{ route('admin.calon_siswa.tolak', $siswa->id) }}" method="POST">@csrf
                    <button class="btn btn-danger btn-sm">❌ Tolak</button>
                </form>

            </div>
             <a href="{{ route('admin.calon_siswa.index') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>

</div>

{{-- Animasi --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
