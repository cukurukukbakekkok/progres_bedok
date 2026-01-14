<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .dashboard-wrapper {
            padding: 30px 0;
            min-height: 100vh;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            position: relative;
            z-index: 1;
        }
        
        .navbar { 
            border-bottom: 4px solid rgba(255,255,255,.25); 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.10);
            transition: 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.18);
        }

        .btn-modern {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            color: #fff;
            transition: 0.3s;
            border: none;
        }
        .btn-modern:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 22px rgba(0,0,0,0.25);
        }

        .btn-calon { background: linear-gradient(135deg, #007bff, #00c6ff); }
        .btn-pengumuman { background: linear-gradient(135deg, #28a745, #7dff88); }
        
        .list-group-item {
            border-radius: 10px;
            margin-bottom: 8px;
            transition: 0.25s;
        }
        .list-group-item:hover {
            background: #f1f8ff;
            transform: translateX(6px);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">PPDB SMK ANTARTIKA 1 SDA</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white nav-user fw-bold">👋 Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light px-3 fw-semibold logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="dashboard-wrapper">
    <div class="dashboard-container">

        <h2 class="mb-4 fw-bold text-white">📊 Dashboard Utama</h2>

        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="card bg-info text-white p-4 text-center">
                    <h5>Total Pendaftar</h5>
                    <h1 class="fw-bold display-5">{{ $totalPendaftar ?? 0 }}</h1>
                    <small>Data pendaftar aktif</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white p-4 text-center">
                    <h5>Pendaftar Lunas</h5>
                    <h1 class="fw-bold display-5">{{ $lunas ?? 0 }}</h1>
                    <small>Pembayaran sudah dikonfirmasi</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-white p-4 text-center">
                    <h5>Pendaftar Menunggu</h5>
                    <h1 class="fw-bold display-5">{{ $menunggu ?? 0 }}</h1>
                    <small>Pembayaran belum lengkap</small>
                </div>
            </div>

        </div>

        <!-- Buttons -->
        <div class="mb-5 d-flex gap-3">
            <a href="{{ route('admin.calon_siswa.index') }}" class="btn btn-modern btn-calon">
                📋 List Calon Siswa
            </a>
            <a href="{{ route('admin.gelombang.index') }}" class="btn btn-modern" style="background: linear-gradient(135deg, #ff7a00, #ffc857); color: #fff;">
                📆 Gelombang
            </a>
            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-modern" style="background: linear-gradient(135deg, #6f42c1, #9f7aea); color: #fff;">
                🏫 Jurusan & Kelas
            </a>
            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-modern btn-pengumuman">
                📢 Kelola Pengumuman
            </a>
        </div>

        <!-- Pengumuman Terbaru -->
        @if(isset($pengumuman) && count($pengumuman) > 0)
        <div class="mt-4">
            <h3 class="mb-3 fw-bold text-secondary">📌 Pengumuman Terbaru</h3>
            <div class="list-group shadow-sm">
                @foreach($pengumuman as $p)
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="fw-bold">{{ $p->judul }}</h5>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($p->tanggal_post)->format('d M Y') }}</small>
                        <p class="mt-2 mb-0">{{ \Illuminate\Support\Str::limit($p->isi, 120, '...') }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
