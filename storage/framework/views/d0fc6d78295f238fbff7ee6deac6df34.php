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
    <h2 class="mb-4 fw-bold text-secondary">💰 Daftar Pembayaran</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Filter Status -->
    <div class="mb-3">
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select w-auto">
                <option value="">Semua Status</option>
                <option value="menunggu" <?php echo e(request('status') == 'menunggu' ? 'selected' : ''); ?>>Menunggu Verifikasi</option>
                <option value="lunas" <?php echo e(request('status') == 'lunas' ? 'selected' : ''); ?>>Lunas</option>
                <option value="gagal" <?php echo e(request('status') == 'gagal' ? 'selected' : ''); ?>>Ditolak</option>
            </select>
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
            <?php if(request('status')): ?>
                <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="btn btn-secondary">Reset</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="text-center">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($p->siswa->nama_lengkap); ?></td>
                    <td><?php echo e($p->siswa->nisn); ?></td>
                    <td>Rp <?php echo e(number_format($p->nominal, 0, ',', '.')); ?></td>
                    <td><?php echo e(ucfirst($p->metode_bayar)); ?></td>
                    <td>
                        <?php if($p->status == 'lunas'): ?>
                            <span class="badge bg-success">✓ Lunas</span>
                        <?php elseif($p->status == 'gagal'): ?>
                            <span class="badge bg-danger">✗ Ditolak</span>
                        <?php else: ?>
                            <span class="badge bg-warning">⏳ Menunggu</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($p->created_at->format('d M Y')); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.pembayaran.show', $p->id)); ?>" class="btn btn-info btn-sm">
                            🔍 Lihat
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        Belum ada pembayaran 😢
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($pembayaran->links()); ?>

    </div>

    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/admin/pembayaran/index.blade.php ENDPATH**/ ?>