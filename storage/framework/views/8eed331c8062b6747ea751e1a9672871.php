<?php $__env->startSection('content'); ?>
<div class="container py-4">

    <h3 class="fw-bold mb-4 text-primary">📌 Detail Calon Siswa</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success shadow-sm"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-body">

            <h4 class="fw-bold"><?php echo e($siswa->nama_lengkap); ?></h4>
            <p class="text-muted mb-4"><?php echo e($siswa->nisn); ?> • <?php echo e($siswa->asal_sekolah); ?></p>

            <table class="table table-striped">
                <tr><th>Kode Pendaftaran</th><td><strong class="text-primary text-lg"><?php echo e($siswa->kode_pendaftaran ?? '-'); ?></strong></td></tr>
                <tr><th>Nama Lengkap</th><td><?php echo e($siswa->nama_lengkap); ?></td></tr>
                <tr><th>NISN</th><td><?php echo e($siswa->nisn); ?></td></tr>
                <tr><th>Asal Sekolah</th><td><?php echo e($siswa->asal_sekolah); ?></td></tr>
                <tr><th>Jurusan</th><td><strong><?php echo e($siswa->jurusan); ?></strong></td></tr>
                <tr><th>No HP</th><td><?php echo e($siswa->no_hp); ?></td></tr>
                <tr><th>Alamat</th><td><?php echo e($siswa->alamat); ?></td></tr>
                <tr><th>Status Pembayaran</th>
                    <td>
                        <?php if($siswa->status_pembayaran == 'lunas'): ?>
                            <span class="badge bg-success">Lunas</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><th>Status Berkas</th>
                    <td>
                        <?php if($siswa->status_berkas == 'valid'): ?>
                            <span class="badge bg-success">Valid</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Belum Valid</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><th>Status Akhir</th>
                    <td>
                        <?php if($siswa->status_akhir == 'Lolos'): ?>
                            <span class="badge bg-primary">Lolos</span>
                        <?php elseif($siswa->status_akhir == 'Tidak Lolos'): ?>
                            <span class="badge bg-danger">Tidak Lolos</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Menunggu Keputusan</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <hr>

            <h5 class="fw-bold mb-3">🛠 Aksi</h5>
            <div class="d-flex flex-wrap gap-2">

                <a href="<?php echo e(route('admin.dokumen_siswa.show', $siswa->dokumenPersyaratan->id ?? '#')); ?>" class="btn btn-warning btn-sm">
                    📸 Lihat Dokumen
                </a>

                <form action="<?php echo e(route('admin.calon_siswa.verifikasi', $siswa->id)); ?>" method="POST"><?php echo csrf_field(); ?>
                    <button class="btn btn-success btn-sm">✔ Verifikasi Pembayaran</button>
                </form>

                <form action="<?php echo e(route('admin.calon_siswa.validasi', $siswa->id)); ?>" method="POST"><?php echo csrf_field(); ?>
                    <button class="btn btn-info btn-sm">📁 Validasi Berkas</button>
                </form>

                <form action="<?php echo e(route('admin.calon_siswa.setujui', $siswa->id)); ?>" method="POST"><?php echo csrf_field(); ?>
                    <button class="btn btn-primary btn-sm">🏆 Setujui / Lolos</button>
                </form>

                <form action="<?php echo e(route('admin.calon_siswa.tolak', $siswa->id)); ?>" method="POST"><?php echo csrf_field(); ?>
                    <button class="btn btn-danger btn-sm">❌ Tolak</button>
                </form>

            </div>
             <a href="<?php echo e(route('admin.calon_siswa.index')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>

</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/admin/calon_siswa/show.blade.php ENDPATH**/ ?>