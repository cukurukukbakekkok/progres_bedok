<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin - PPDB SMK ANTARTIKA 1 SDA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background: #f8f9fa; }
        .card { border-radius: 12px; box-shadow: 0 8px 20px rgb(0 0 0 / 0.1); }
        .logout-btn, .btn-action { transition: transform 0.2s ease; }
        .logout-btn:hover, .btn-action:hover { transform: scale(1.05); }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">PPDB SMK ANTARTIKA 1 SDA</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    Halo, {{ Auth::user()->name ?? Auth::user()->username ?? 'Admin' }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="mb-4 text-secondary">Dashboard Admin</h2>

        <div class="row g-4 mb-4">
            <!-- Card Total Pendaftar -->
            <div class="col-md-4">
                <div class="card p-4 text-center text-white bg-info">
                    <h5>Total Pendaftar</h5>
                    <h2 class="fw-bold">{{ $totalPendaftar ?? 0 }}</h2>
                    <small>Data pendaftar aktif</small>
                </div>
            </div>

            <!-- Card Pendaftar Lunas -->
            <div class="col-md-4">
                <div class="card p-4 text-center text-white bg-success">
                    <h5>Pendaftar Lunas</h5>
                    <h2 class="fw-bold">{{ $lunas ?? 0 }}</h2>
                    <small>Pembayaran sudah dikonfirmasi</small>
                </div>
            </div>

            <!-- Card Pendaftar Menunggu -->
            <div class="col-md-4">
                <div class="card p-4 text-center text-white bg-warning">
                    <h5>Pendaftar Menunggu</h5>
                    <h2 class="fw-bold">{{ $menunggu ?? 0 }}</h2>
                    <small>Pembayaran belum lengkap</small>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <div class="mb-4">
            <a href="{{ route('calon_siswa.create') }}" class="btn btn-primary btn-action">Tambah Calon Siswa</a>
            <a href="{{ route('calon_siswa.index') }}" class="btn btn-secondary btn-action">List Calon Siswa</a>
        </div>

        <!-- Pengumuman Terbaru -->
        @if(isset($pengumuman) && count($pengumuman) > 0)
            <div class="mt-4">
                <h3 class="mb-3">Pengumuman Terbaru</h3>
                <div class="list-group shadow-sm">
                    @foreach($pengumuman as $p)
                        <a href="#" class="list-group-item list-group-item-action">
                            <h5 class="mb-1">{{ $p->judul }}</h5>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($p->tanggal_post)->format('d M Y') }}
                            </small>
                            <p class="mb-1 mt-2">
                                {{ \Illuminate\Support\Str::limit($p->isi, 120, '...') }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4">
                Belum ada pengumuman terbaru.
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
