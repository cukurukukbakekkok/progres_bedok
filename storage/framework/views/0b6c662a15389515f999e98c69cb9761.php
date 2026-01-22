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
</style>
<div class="admin-wrapper">
<div class="admin-container">

    <h3 class="fw-bold mb-4 text-primary">💳 Detail Pembayaran</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success shadow-sm"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-body">

            <h4 class="fw-bold"><?php echo e($siswa->nama_lengkap); ?></h4>
            <p class="text-muted mb-4"><?php echo e($siswa->nisn); ?> • <?php echo e($siswa->asal_sekolah); ?></p>

            <table class="table table-striped">
                <tr><th>Nama Lengkap</th><td><?php echo e($siswa->nama_lengkap); ?></td></tr>
                <tr><th>NISN</th><td><?php echo e($siswa->nisn); ?></td></tr>
                <tr><th>Asal Sekolah</th><td><?php echo e($siswa->asal_sekolah); ?></td></tr>
                <tr><th>Nominal Bayar</th><td>Rp <?php echo e(number_format($pembayaran->nominal, 0, ',', '.')); ?></td></tr>
                <tr><th>Metode Pembayaran</th><td><?php echo e(ucfirst($pembayaran->metode_bayar)); ?></td></tr>
                <tr><th>Status</th>
                    <td>
                        <?php if($pembayaran->status == 'lunas'): ?>
                            <span class="badge bg-success">✓ Lunas</span>
                        <?php elseif($pembayaran->status == 'gagal'): ?>
                            <span class="badge bg-danger">✗ Ditolak</span>
                        <?php else: ?>
                            <span class="badge bg-warning">⏳ Menunggu Verifikasi</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><th>Tanggal Upload</th><td><?php echo e($pembayaran->created_at->format('d M Y H:i')); ?></td></tr>
                <?php if($pembayaran->verified_at): ?>
                    <tr><th>Tanggal Verifikasi</th><td><?php echo e($pembayaran->verified_at->format('d M Y H:i')); ?></td></tr>
                <?php endif; ?>
            </table>

            <hr>

            <!-- Rincian Pembayaran -->
            <?php if($pembayaran->harga_awal): ?>
                <h5 class="fw-bold mb-3">📋 Rincian Pembayaran</h5>
                <table class="table table-sm mb-4">
                    <tr>
                        <td>Harga Awal:</td>
                        <td class="text-end"><strong>Rp <?php echo e(number_format($pembayaran->harga_awal, 0, ',', '.')); ?></strong></td>
                    </tr>
                    <?php if($pembayaran->potongan > 0): ?>
                        <tr>
                            <td>
                                Potongan
                                <?php if($pembayaran->keterangan_potongan): ?>
                                    (<?php echo e($pembayaran->keterangan_potongan); ?>)
                                <?php endif; ?>
                                :
                            </td>
                            <td class="text-end"><strong class="text-danger">- Rp <?php echo e(number_format($pembayaran->potongan, 0, ',', '.')); ?></strong></td>
                        </tr>
                    <?php endif; ?>
                    <tr style="border-top: 2px solid #667eea;">
                        <td><strong>Total Pembayaran:</strong></td>
                        <td class="text-end"><strong class="text-primary">Rp <?php echo e(number_format($pembayaran->nominal, 0, ',', '.')); ?></strong></td>
                    </tr>
                </table>
            <?php endif; ?>

            <hr>

            <!-- Preview Bukti Pembayaran -->
            <h5 class="fw-bold mb-3">📸 Bukti Pembayaran</h5>
            <?php if($pembayaran->bukti_bayar): ?>
                <div class="mb-4">
                    <?php if(in_array(pathinfo($pembayaran->bukti_bayar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])): ?>
                        <img src="<?php echo e(asset('storage/' . $pembayaran->bukti_bayar)); ?>" class="img-thumbnail" style="max-width: 500px; max-height: 400px;">
                        <br>
                    <?php endif; ?>
                    <a href="<?php echo e(asset('storage/' . $pembayaran->bukti_bayar)); ?>" class="btn btn-sm btn-outline-primary mt-2" target="_blank">
                        📥 Download / Lihat File Lengkap
                    </a>
                </div>
            <?php else: ?>
                <p class="text-muted">Belum ada bukti pembayaran</p>
            <?php endif; ?>

            <hr>

            <!-- Form Validasi -->
            <?php if($pembayaran->status == 'menunggu'): ?>
                <h5 class="fw-bold mb-3">✅ Verifikasi Pembayaran</h5>
                <form action="<?php echo e(route('admin.pembayaran.validasi', $pembayaran->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label"><strong>Status Verifikasi</strong></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_validasi" id="lunas" value="lunas" required>
                                <label class="form-check-label" for="lunas">
                                    ✓ Lunas
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_validasi" id="gagal" value="gagal" required>
                                <label class="form-check-label" for="gagal">
                                    ✗ Ditolak
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Keterangan</strong></label>
                        <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan jika ditolak..." rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">✅ Verifikasi</button>
                </form>
            <?php endif; ?>

            <?php if($pembayaran->status != 'menunggu' && $pembayaran->keterangan): ?>
                <div class="alert alert-info">
                    <strong>Keterangan:</strong> <?php echo e($pembayaran->keterangan); ?>

                </div>
            <?php endif; ?>

            <a href="<?php echo e(route('admin.pembayaran.index')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>

</div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ppdb1\resources\views/admin/pembayaran/show.blade.php ENDPATH**/ ?>