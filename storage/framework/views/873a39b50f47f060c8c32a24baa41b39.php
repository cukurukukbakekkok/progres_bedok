<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">👥 Daftar Siswa - <?php echo e($gelombang->nama); ?></h2>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.gelombang.siswa', $gelombang->id)); ?>" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari kode pendaftaran, nama, atau NISN..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-primary">🔍 Cari</button>
                <a href="<?php echo e(route('admin.gelombang.siswa', $gelombang->id)); ?>" class="btn btn-secondary">Bersihkan</a>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-2">📋 Info Gelombang</h6>
            <ul class="small list-unstyled">
                <li><strong>Tanggal:</strong> <?php echo e(is_string($gelombang->tanggal_mulai) ? $gelombang->tanggal_mulai : $gelombang->tanggal_mulai->format('d M Y')); ?> s/d <?php echo e(is_string($gelombang->tanggal_selesai) ? $gelombang->tanggal_selesai : $gelombang->tanggal_selesai->format('d M Y')); ?></li>
                <li><strong>Kuota:</strong> <?php echo e($gelombang->kuota); ?> siswa</li>
                <li><strong>Potongan:</strong> Rp <?php echo e(number_format($gelombang->potongan ?? 0, 0, ',', '.')); ?></li>
                <li><strong>Terdaftar:</strong> <span class="badge bg-info"><?php echo e($calonSiswa->total()); ?></span></li>
            </ul>
        </div>
    </div>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Jurusan</th>
                <th>Nominal Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Status Berkas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $calonSiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="text-center">
                    <td><?php echo e(($calonSiswa->currentPage() - 1) * $calonSiswa->perPage() + $loop->iteration); ?></td>
                    <td><strong class="text-primary"><?php echo e($s->kode_pendaftaran ?? '-'); ?></strong></td>
                    <td><?php echo e($s->nama_lengkap); ?></td>
                    <td><?php echo e($s->nisn); ?></td>
                    <td><strong><?php echo e($s->jurusan); ?></strong></td>
                    <td>Rp <?php echo e(number_format($s->nominal_pembayaran, 0, ',', '.')); ?></td>
                    <td>
                        <span class="badge 
                            <?php if(strtolower($s->status_pembayaran) == 'lunas'): ?> bg-success
                            <?php elseif(strtolower($s->status_pembayaran) == 'menunggu'): ?> bg-warning
                            <?php else: ?> bg-secondary
                            <?php endif; ?>
                        ">
                            <?php echo e($s->status_pembayaran ?? 'Belum'); ?>

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
                        <a href="<?php echo e(route('admin.calon_siswa.show', $s->id)); ?>" class="btn btn-info btn-sm">
                            🔍 Detail
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        Belum ada siswa mendaftar 😢
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        <?php echo e($calonSiswa->links()); ?>

    </div>

    <a href="<?php echo e(route('admin.gelombang.show', $gelombang->id)); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/admin/gelombang/siswa.blade.php ENDPATH**/ ?>