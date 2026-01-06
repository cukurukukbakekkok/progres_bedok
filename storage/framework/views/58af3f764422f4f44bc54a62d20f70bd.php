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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">📋 Gelombang Pendaftaran</h2>
        <a href="<?php echo e(route('admin.gelombang.create')); ?>" class="btn btn-primary">
            ➕ Tambah Gelombang
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Gelombang</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Kuota / Sisa</th>
                <th>Jumlah Siswa</th>
                <th>Potongan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $gelombang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="text-center">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($g->nama); ?></td>
                    <td><?php echo e(is_string($g->tanggal_mulai) ? $g->tanggal_mulai : $g->tanggal_mulai->format('d M Y')); ?></td>
                    <td><?php echo e(is_string($g->tanggal_selesai) ? $g->tanggal_selesai : $g->tanggal_selesai->format('d M Y')); ?></td>
                    <td>
                        <?php
                            $jumlahSiswa = $g->calonSiswa()->count();
                            $sisaKuota = max(0, ($g->kuota ?? 0) - $jumlahSiswa);
                            $persentase = ($g->kuota ?? 0) > 0 ? (($jumlahSiswa / $g->kuota) * 100) : 100;
                        ?>
                        <div class="small mb-1"><strong><?php echo e($g->kuota); ?> / <?php echo e($sisaKuota); ?> sisa</strong></div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar <?php if($sisaKuota <= 0): ?> bg-danger <?php elseif($sisaKuota <= 10): ?> bg-warning <?php else: ?> bg-success <?php endif; ?>" 
                                 role="progressbar" 
                                 style="width: <?php echo e($persentase); ?>%;" 
                                 aria-valuenow="<?php echo e($persentase); ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                <?php echo e(round($persentase, 1)); ?>%
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-info"><?php echo e($jumlahSiswa); ?></span></td>
                    <td>Rp <?php echo e(number_format($g->potongan ?? 0, 0, ',', '.')); ?></td>
                    <td>
                        <span class="badge <?php if($g->status == 'aktif'): ?> bg-success <?php elseif($g->status == 'nonaktif' && $sisaKuota <= 0): ?> bg-danger <?php else: ?> bg-secondary <?php endif; ?>">
                            <?php echo e(ucfirst($g->status)); ?>

                            <?php if($g->status == 'nonaktif' && $sisaKuota <= 0): ?>
                                <br><small>(kuota habis)</small>
                            <?php endif; ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.gelombang.show', $g->id)); ?>" class="btn btn-info btn-sm">
                            🔍 Detail
                        </a>
                        <a href="<?php echo e(route('admin.gelombang.edit', $g->id)); ?>" class="btn btn-warning btn-sm">
                            ✏️ Edit
                        </a>
                        <form action="<?php echo e(route('admin.gelombang.destroy', $g->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">
                                🗑 Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-3">
                        Belum ada gelombang pendaftaran 😢
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($gelombang->links()); ?>

    </div>

    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/admin/gelombang/index.blade.php ENDPATH**/ ?>