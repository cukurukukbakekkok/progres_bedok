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
    <h2 class="mb-4 fw-bold">📋 Verifikasi Dokumen Siswa</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Jurusan</th>
                    <th>Status Verifikasi</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="text-center align-middle">
                        <td><?php echo e($loop->iteration); ?></td>
                        <td class="text-start"><?php echo e($doc->siswa->nama_lengkap); ?></td>
                        <td><?php echo e($doc->siswa->nisn); ?></td>
                        <td><strong><?php echo e($doc->siswa->jurusan); ?></strong></td>
                        <td>
                            <?php if($doc->status_verifikasi == 'Valid'): ?>
                                <span class="badge bg-success">✓ Valid</span>
                            <?php elseif($doc->status_verifikasi == 'Tidak Valid'): ?>
                                <span class="badge bg-danger">✗ Tidak Valid</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">⏳ Menunggu</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($doc->created_at->format('d M Y H:i')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.dokumen_siswa.show', $doc->id)); ?>" class="btn btn-info btn-sm">
                                🔍 Lihat
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada dokumen 😢
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($dokumen->links()); ?>

    </div>

    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/admin/dokumen_siswa/index.blade.php ENDPATH**/ ?>