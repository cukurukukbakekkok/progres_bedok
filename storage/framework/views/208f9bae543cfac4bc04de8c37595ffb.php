<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4">Kelola Kelas per Jurusan</h3>

    <div class="card p-3">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <ul class="list-group">
            <?php $__currentLoopData = $jurusans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?php echo e($j->nama); ?></strong>
                        <div class="text-muted small"><?php echo e($j->keterangan); ?> (<?php echo e($j->pendaftar_count); ?> Pendaftar)</div>
                    </div>
                    <a href="<?php echo e(route('admin.jurusan.show', $j->id)); ?>" class="btn btn-sm btn-primary">Manage Kelas</a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ppdb1\resources\views/admin/jurusan/index.blade.php ENDPATH**/ ?>