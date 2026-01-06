<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'PPDB')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f6f9fc; }
        .navbar-brand { font-weight: bold; font-size: 20px; }
        .nav-user { margin-right: 15px; font-weight: 600; }
        .card-custom { border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,.06); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background:#006aff;">
    <div class="container">
        <a class="navbar-brand" href="/">PPDB SMK ANTARTIKA 1 SDA</a>
        <div class="d-flex align-items-center">
            <span class="text-white nav-user">Halo, <?php echo e(Auth::user()->name); ?></span>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-4">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/layouts/app.blade.php ENDPATH**/ ?>