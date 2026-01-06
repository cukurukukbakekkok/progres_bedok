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
        <h2 class="fw-bold text-secondary">📋 Daftar Calon Siswa</h2>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.dokumen_siswa.index')); ?>" class="btn btn-warning">
                📑 Lihat Semua Dokumen Upload
            </a>
            <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="btn btn-primary">
                💳 Lihat Semua Pembayaran
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.calon_siswa.index')); ?>" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari kode pendaftaran, nama, atau NISN..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-primary">🔍 Cari</button>
                <a href="<?php echo e(route('admin.calon_siswa.index')); ?>" class="btn btn-secondary">Bersihkan</a>
            </form>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Status Pembayaran</th>
                <th>Status Berkas</th>
                <th>Status Kelulusan</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $calonSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="text-center table-row-hover">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><strong class="text-primary"><?php echo e($s->kode_pendaftaran ?? '-'); ?></strong></td>
                    <td><?php echo e($s->nama_lengkap); ?></td>
                    <td><?php echo e($s->nisn); ?></td>
                    <td><?php echo e($s->asal_sekolah); ?></td>
                    <td><strong><?php echo e($s->jurusan); ?></strong></td>
                    <td>
                        <span class="badge 
                            <?php if($s->status_pembayaran == 'Lunas'): ?> bg-success
                            <?php elseif($s->status_pembayaran == 'Menunggu'): ?> bg-warning
                            <?php endif; ?>
                        ">
                            <?php echo e($s->status_pembayaran); ?>

                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            <?php if($s->status_berkas == 'Valid'): ?> bg-success
                            <?php elseif($s->status_berkas == 'Tidak Valid'): ?> bg-danger
                            <?php else: ?> bg-secondary
                            <?php endif; ?>
                        ">
                            <?php echo e($s->status_berkas ?? 'Belum'); ?>

                        </span>
                    </td>
                    <td>
                        <?php if($s->status_kelulusan): ?>
                            <span class="badge 
                                <?php if($s->status_kelulusan == 'Lolos'): ?> bg-success
                                <?php elseif($s->status_kelulusan == 'Tidak Lolos'): ?> bg-danger
                                <?php endif; ?>
                            ">
                                <?php echo e($s->status_kelulusan); ?>

                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Belum Diputuskan</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($s->created_at->format('d M Y')); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.calon_siswa.show', $s->id)); ?>" class="btn btn-info btn-sm">
                            🔍 Detail
                        </a>

                        <form action="<?php echo e(route('admin.calon_siswa.destroy', $s->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">
                                🗑 Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="11" class="text-center text-muted py-3">
                        Belum ada pendaftar 😢
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($calonSiswa->links()); ?>

    </div>

    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/admin/calon_siswa/index.blade.php ENDPATH**/ ?>