<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'PPDB')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <style>
        :root {
            --primary-color: #006aff;
        }

        body { 
            background-color: #f6f9fc; 
            font-family: 'Public Sans', sans-serif;
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
            padding: 6px 12px;
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

        .card-custom { 
            border-radius: 15px; 
            box-shadow: 0 4px 10px rgba(0,0,0,.06);
            border: none;
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
            <?php if(Auth::check()): ?>
            <div class="navbar-user">
                <span>👋</span>
                <span class="d-none d-md-inline">Halo, <?php echo e(Auth::user()->name); ?></span>
            </div>
            <a href="<?php echo e(route('logout')); ?>" class="btn btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti ti-logout"></i> <span>Logout</span>
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
            <?php else: ?>
            <a href="/login" class="btn btn-logout">
                <i class="ti ti-login"></i> <span>Login</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container py-4">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\ujian_ukk_ppdb\resources\views/layouts/app.blade.php ENDPATH**/ ?>