<?php
    $calon = \App\Models\CalonSiswa::where('user_id', Auth::id())->first();
?>

<?php if($calon): ?>
    <?php
        $dokumen = $calon->dokumenPersyaratan;
    ?>
    <?php echo $__env->make('siswa.dokumen.upload', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php else: ?>
    <div class="container mt-5">
        <div class="alert alert-warning" role="alert">
            <h4>⚠️ Biodata Belum Diisi</h4>
            <p>Silakan isi pendaftaran biodata terlebih dahulu sebelum upload dokumen.</p>
            <a href="<?php echo e(route('siswa.pendaftaran.create')); ?>" class="btn btn-primary">Isi Pendaftaran</a>
        </div>
    </div>
<?php endif; ?>

<?php /**PATH C:\ujian_ppdb1\resources\views/siswa/dokumen/index.blade.php ENDPATH**/ ?>