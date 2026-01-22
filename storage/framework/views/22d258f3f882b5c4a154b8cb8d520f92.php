<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .admin-wrapper {
        background-color: #f8f9fa;
        padding: 30px 0;
        min-height: 100vh;
    }

    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 30px;
    }

    .table-wrapper {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow-x: auto;
    }

    .table-wrapper table {
        margin-bottom: 0;
    }

    .table-row-hover:hover {
        background-color: #f5f5f5;
        transition: all 0.2s ease;
    }
</style>

<div class="admin-wrapper">
<div class="admin-container">
    <h3 class="mb-4">Kelola Pengumuman</h3>
    <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="btn btn-primary mb-3">+ Tambah Pengumuman</a>

    <div class="table-wrapper">
        <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($p->judul); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($p->tanggal_post)->format('d M Y')); ?></td>
                <td><?php echo $p->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Tidak</span>'; ?></td>
                <td>
                    <a href="<?php echo e(route('admin.pengumuman.edit', $p->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?php echo e(route('admin.pengumuman.destroy', $p->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button onclick="return confirm('Hapus pengumuman?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
     <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
    <?php echo e($pengumuman->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ppdb1\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>