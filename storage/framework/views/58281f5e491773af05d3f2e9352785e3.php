<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">📌 Detail Gelombang Pendaftaran</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="fw-bold"><?php echo e($gelombang->nama); ?></h4>

            <table class="table table-striped mt-3">
                <tr>
                    <th>Tanggal Mulai</th>
                    <td><?php echo e(is_string($gelombang->tanggal_mulai) ? $gelombang->tanggal_mulai : $gelombang->tanggal_mulai->format('d M Y')); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td><?php echo e(is_string($gelombang->tanggal_selesai) ? $gelombang->tanggal_selesai : $gelombang->tanggal_selesai->format('d M Y')); ?></td>
                </tr>
                <tr>
                    <th>Kuota</th>
                    <td>
                        <?php
                            $sisaKuota = max(0, ($gelombang->kuota ?? 0) - $calonSiswa);
                            $persentase = ($gelombang->kuota ?? 0) > 0 ? (($calonSiswa / $gelombang->kuota) * 100) : 100;
                        ?>
                        <div class="mb-2"><strong><?php echo e($gelombang->kuota); ?> Siswa</strong> (<?php echo e($calonSiswa); ?> terdaftar, <?php echo e($sisaKuota); ?> sisa)</div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar <?php if($sisaKuota <= 0): ?> bg-danger <?php elseif($sisaKuota <= 10): ?> bg-warning <?php else: ?> bg-success <?php endif; ?>" 
                                 role="progressbar" 
                                 style="width: <?php echo e($persentase); ?>%;" 
                                 aria-valuenow="<?php echo e($persentase); ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                <?php echo e(round($persentase, 1)); ?>%
                            </div>
                        </div>
                        <?php if($sisaKuota <= 0): ?>
                            <small class="text-danger"><strong>⚠️ Kuota telah HABIS - Gelombang akan/sudah dinonaktifkan</strong></small>
                        <?php elseif($sisaKuota <= 10): ?>
                            <small class="text-warning"><strong>⚠️ Kuota tinggal sedikit!</strong></small>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Potongan Harga</th>
                    <td>
                        <strong>Rp <?php echo e(number_format($gelombang->potongan ?? 0, 0, ',', '.')); ?></strong>
                        <?php if($gelombang->keterangan_potongan): ?>
                            <br><small class="text-muted"><?php echo e($gelombang->keterangan_potongan); ?></small>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge <?php if($gelombang->status == 'aktif'): ?> bg-success <?php else: ?> bg-secondary <?php endif; ?>">
                            <?php echo e(ucfirst($gelombang->status)); ?>

                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><?php echo e($gelombang->deskripsi ?? '-'); ?></td>
                </tr>
                <tr>
                    <th>Calon Siswa</th>
                    <td><span class="badge bg-info"><strong><?php echo e($calonSiswa); ?></strong></span> pendaftar</td>
                </tr>
                <tr>
                    <th>Pembayaran</th>
                    <td><span class="badge bg-warning"><strong><?php echo e($pembayaran); ?></strong></span> pembayaran</td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="<?php echo e(route('admin.gelombang.siswa', $gelombang->id)); ?>" class="btn btn-info">
                    👥 Lihat Daftar Siswa
                </a>
                <a href="<?php echo e(route('admin.gelombang.edit', $gelombang->id)); ?>" class="btn btn-warning">
                    ✏️ Edit
                </a>
                <form action="<?php echo e(route('admin.gelombang.destroy', $gelombang->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button onclick="return confirm('Yakin ingin menghapus gelombang ini?')" class="btn btn-danger">
                        🗑 Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <a href="<?php echo e(route('admin.gelombang.index')); ?>" class="btn btn-secondary">⬅ Kembali</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/admin/gelombang/show.blade.php ENDPATH**/ ?>