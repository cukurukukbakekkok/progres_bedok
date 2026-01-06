<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background: #eef2f7; }
        .navbar { border-bottom: 4px solid rgba(255,255,255,.25); }

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">PPDB SMK ANTARTIKA 1 SDA</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white nav-user fw-bold">👋 Halo, <?php echo e(Auth::user()->name); ?></span>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-light px-3 fw-semibold logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">

        <h2 class="mb-4 fw-bold text-secondary">📊 Dashboard Utama</h2>

        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="card bg-info text-white p-4 text-center">
                    <h5>Total Pendaftar</h5>
                    <h1 class="fw-bold display-5"><?php echo e($totalPendaftar ?? 0); ?></h1>
                    <small>Data pendaftar aktif</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white p-4 text-center">
                    <h5>Pendaftar Lunas</h5>
                    <h1 class="fw-bold display-5"><?php echo e($lunas ?? 0); ?></h1>
                    <small>Pembayaran sudah dikonfirmasi</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-white p-4 text-center">
                    <h5>Pendaftar Menunggu</h5>
                    <h1 class="fw-bold display-5"><?php echo e($menunggu ?? 0); ?></h1>
                    <small>Pembayaran belum lengkap</small>
                </div>
            </div>

        </div>

        <!-- Buttons -->
        <div class="mb-5 d-flex gap-3">
            <a href="<?php echo e(route('admin.calon_siswa.index')); ?>" class="btn btn-modern btn-calon">
                📋 List Calon Siswa
            </a>
            <a href="<?php echo e(route('admin.gelombang.index')); ?>" class="btn btn-modern" style="background: linear-gradient(135deg, #ff7a00, #ffc857); color: #fff;">
                📆 Gelombang
            </a>
            <a href="<?php echo e(route('admin.pengumuman.index')); ?>" class="btn btn-modern btn-pengumuman">
                📢 Kelola Pengumuman
            </a>
        </div>

        <!-- Pengumuman Terbaru -->
        <?php if(isset($pengumuman) && count($pengumuman) > 0): ?>
        <div class="mt-4">
            <h3 class="mb-3 fw-bold text-secondary">📌 Pengumuman Terbaru</h3>
            <div class="list-group shadow-sm">
                <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h5 class="fw-bold"><?php echo e($p->judul); ?></h5>
                        <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($p->tanggal_post)->format('d M Y')); ?></small>
                        <p class="mt-2 mb-0"><?php echo e(\Illuminate\Support\Str::limit($p->isi, 120, '...')); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>