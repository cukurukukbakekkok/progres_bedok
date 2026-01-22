<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Public Sans', sans-serif;
            background-color: #f6f9fc;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 6px 18px rgba(102, 126, 234, 0.12);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 18px;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 8px;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .navbar-user {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 500;
            margin-right: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            transition: all 0.3s ease;
            padding: 5px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            transform: translateY(-2px);
        }

        .container {
            margin: 0 auto !important;
            padding: 20px 15px !important;
            max-width: 1200px !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid px-3 px-lg-4">
            <!-- Left: Logo & Text -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="<?php echo e(asset('assets/images/my/logo-antrek.png')); ?>" alt="logo" style="height: 40px;">
                <span class="ms-2 d-none d-sm-inline">PPDB Online</span>
            </a>

            <!-- Center: Main Title -->
            <div class="navbar-nav mx-auto d-none d-md-block">
                <h5 class="mb-0 text-white fw-bold text-uppercase" style="letter-spacing: 1px;">PPDB SMK ANTARTIKA 1 SDA</h5>
            </div>

            <!-- Right: User & Logout -->
            <div class="d-flex align-items-center gap-3">
                <div class="navbar-user">
                    <span>👋</span>
                    <span class="d-none d-md-inline">Halo, <?php echo e(Auth::user()->name ?? 'User'); ?></span>
                </div>
                <a href="<?php echo e(route('logout')); ?>" class="btn btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti ti-logout"></i> <span>Logout</span>
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>
    </nav>

    <?php if(strpos(request()->path(), 'siswa/') !== false): ?>
        <!-- Full width untuk halaman siswa (pendaftaran, biodata, dokumen, pembayaran) -->
        <?php echo $__env->yieldContent('content'); ?>
    <?php else: ?>
        <!-- Container untuk halaman lainnya -->
        <div class="container py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts_content'); ?>
</body>
</html>
<?php /**PATH C:\ujian_ppdb1\resources\views/layouts/main.blade.php ENDPATH**/ ?>