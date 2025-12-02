@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f3f6ff;
    }
    .animate-card {
        opacity: 0;
        transform: scale(0.92);
        animation: fadeZoom 0.6s forwards;
    }
    @keyframes fadeZoom {
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .hero-box {
        background: linear-gradient(120deg, #0066ff, #00c3ff);
        border-radius: 18px;
        padding: 35px;
        color: white;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.18);
    }
    .menu-card {
        border-radius: 18px;
        transition: 0.35s;
        border: none;
        padding: 25px;
        height: 165px;
        color: #222;
    }
    .menu-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.18);
        cursor: pointer;
    }
    .bg-blue { background: #e3f2ff; }
    .bg-orange { background: #ffe8cc; }
    .bg-green { background: #e7ffee; }
    h1, h2, h3, h4, h5 { margin: 0; }
</style>

<div class="container py-4">

    {{-- Header Card --}}
    <div class="hero-box mb-4 animate-card" style="animation-delay: .05s">
        <h2>Halo, 👋 {{ Auth::user()->nama ?? 'Siswa' }}</h2>
        <p class="mt-2 fs-5">Selamat datang di portal <b>Pendaftaran Siswa Baru</b> SMK ANTARTIKA 1 SDA</p>
    </div>

    {{-- Menu --}}
    <div class="row g-4">
        <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: .15s">
            <a href="{{ url('/siswa/pendaftaran') }}" style="text-decoration: none;">
                <div class="menu-card bg-blue">
                    <h5 class="fw-bold mb-2">📝 Pendaftaran</h5>
                    <p>Isi formulir biodata lengkap untuk menjadi calon siswa.</p>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: .28s">
            <a href="{{ url('/siswa/dokumen') }}" style="text-decoration: none;">
                <div class="menu-card bg-orange">
                    <h5 class="fw-bold mb-2">📄 Dokumen Persyaratan</h5>
                    <p>Upload berkas wajib seperti KK, Ijazah, Akte.</p>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: .42s">
            <a href="{{ url('/siswa/pembayaran') }}" style="text-decoration: none;">
                <div class="menu-card bg-green">
                    <h5 class="fw-bold mb-2">💰 Pembayaran</h5>
                    <p>Lakukan pembayaran biaya pendaftaran & cetak bukti.</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Ambil data calon siswa --}}
    @php
        $calon = \App\Models\CalonSiswa::where('user_id', Auth::id())->first();
    @endphp


    {{-- STATUS PENDAFTARAN --}}
    @if($calon)
        <div class="alert alert-info mt-4 animate-card" style="animation-delay: .50s; border-radius:14px;">
            <b>Status Pendaftaran:</b>
            @if($calon->status_kelulusan == 'Lolos')
                🟢 <span class="text-success fw-bold">LOLOS Seleksi</span>
            @elseif($calon->status_kelulusan == 'Tidak Lolos')
                🔴 <span class="text-danger fw-bold">TIDAK LOLOS Seleksi</span>
            @else
                ⚪ <span class="text-secondary fw-bold">Belum Diputuskan</span>
            @endif
        </div>

        {{-- STATUS PEMBAYARAN --}}
        <div class="alert alert-secondary mt-2 animate-card" style="animation-delay: .55s; border-radius:14px;">
            <b>Status Pembayaran:</b>
            @if(strtolower($calon->status_pembayaran) == 'belum')
                🔴 <span class="text-danger fw-bold">Belum Membayar</span>
            @elseif(strtolower($calon->status_pembayaran) == 'menunggu')
                ⏳ <span class="text-warning fw-bold">Menunggu Validasi Admin</span>
            @elseif(strtolower($calon->status_pembayaran) == 'lunas')
                🟢 <span class="text-success fw-bold">Lunas</span>
            @endif
        </div>

        {{-- STATUS VERIFIKASI BERKAS --}}
        <div class="alert alert-primary mt-2 animate-card" style="animation-delay: .58s; border-radius:14px;">
            <b>Status Berkas:</b>
            @if($calon->status_berkas == 'Belum')
                🔴 <span class="text-danger fw-bold">Berkas Belum Divalidasi</span>
            @elseif($calon->status_berkas == 'Valid')
                🟢 <span class="text-success fw-bold">Berkas Sudah Valid ✓</span>
            @elseif($calon->status_berkas == 'Tidak Valid')
                ⚠️ <span class="text-warning fw-bold">Berkas Ditolak — Silakan Perbaiki</span>
            @endif
        </div>

        {{-- DETAIL BIODATA (menggantikan Status Kelulusan) --}}
        <div class="alert alert-warning mt-2 animate-card" style="animation-delay: .61s; border-radius:14px;">
            <b>📋 Detail Biodata:</b>
            <a href="{{ route('siswa.biodata') }}" class="btn btn-warning btn-sm">Lihat Detail Biodata</a>
        </div>
    @endif


    {{-- BIODATA SISWA --}}
    <div class="mt-4">
        @if($calon)
        <div class="card shadow p-4 animate-card" style="animation-delay: .65s">
            <h4 class="mb-3"><b>📌 Biodata Siswa</b></h4>

            <table class="table table-bordered">
                <tr><th>Nama Lengkap</th><td>{{ $calon->nama_lengkap }}</td></tr>
                <tr><th>NISN</th><td>{{ $calon->nisn }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ $calon->jenis_kelamin }}</td></tr>
                <tr><th>TTL</th><td>{{ $calon->tempat_lahir }}, {{ $calon->tanggal_lahir }}</td></tr>
                <tr><th>Asal Sekolah</th><td>{{ $calon->asal_sekolah }}</td></tr>
                <tr><th>Jurusan</th><td><strong>{{ $calon->jurusan }}</strong></td></tr>
                <tr><th>Gelombang</th><td><strong>{{ $calon->gelombang?->nama ?? '-' }}</strong></td></tr>
                <tr><th>Alamat</th><td>{{ $calon->alamat }}</td></tr>
                <tr><th>Nama Orang Tua</th><td>{{ $calon->nama_ortu }}</td></tr>
                <tr><th>No HP</th><td>{{ $calon->no_hp }}</td></tr>
            </table>

            <a href="{{ route('siswa.biodata') }}" class="btn btn-info btn-sm mt-3">📄 Lihat Detail Biodata</a>
        </div>
        @else
        <div class="alert alert-warning mt-4 animate-card" style="animation-delay: .55s">
            ⚠️ Biodata belum tersedia — silakan isi pendaftaran terlebih dahulu.
        </div>
        @endif
    </div>

</div>
@endsection
