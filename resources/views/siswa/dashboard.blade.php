@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f3f6ff;
    }

    /* Fade + Zoom animation when page loaded */
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

</div>
@endsection
