<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">✏️ Edit Gelombang Pendaftaran</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?php echo e(route('admin.gelombang.update', $gelombang->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label class="form-label"><strong>Nama Gelombang</strong></label>
                    <input type="text" name="nama" class="form-control" value="<?php echo e($gelombang->nama); ?>" required>
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Tanggal Mulai</strong></label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo e(is_string($gelombang->tanggal_mulai) ? $gelombang->tanggal_mulai : $gelombang->tanggal_mulai->format('Y-m-d')); ?>" required>
                            <small class="text-muted">Tanggal mulai tidak boleh mundur dari hari ini</small>
                            <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Tanggal Selesai</strong></label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?php echo e(is_string($gelombang->tanggal_selesai) ? $gelombang->tanggal_selesai : $gelombang->tanggal_selesai->format('Y-m-d')); ?>" required>
                            <small class="text-muted">Tanggal selesai harus setelah tanggal mulai</small>
                            <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Kuota Siswa</strong></label>
                    <input type="number" name="kuota" class="form-control" value="<?php echo e($gelombang->kuota); ?>" min="1" required>
                    <?php $__errorArgs = ['kuota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>💰 Potongan Harga (Rp)</strong></label>
                    <input type="number" name="potongan" class="form-control" value="<?php echo e($gelombang->potongan ?? 0); ?>" min="0">
                    <small class="text-muted">Contoh: Gelombang 1 = 1000000, Gelombang 2 = 750000, dst</small>
                    <?php $__errorArgs = ['potongan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Keterangan Potongan (Opsional)</strong></label>
                    <textarea name="keterangan_potongan" class="form-control" rows="2"><?php echo e($gelombang->keterangan_potongan); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Deskripsi</strong></label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?php echo e($gelombang->deskripsi); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Status</strong></label>
                    <select name="status" class="form-control" required>
                        <option value="aktif" <?php echo e($gelombang->status == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="nonaktif" <?php echo e($gelombang->status == 'nonaktif' ? 'selected' : ''); ?>>Nonaktif</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn btn-primary">💾 Update Gelombang</button>
                <a href="<?php echo e(route('admin.gelombang.show', $gelombang->id)); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_content'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    // Get today's date in YYYY-MM-DD format
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];
    
    // Set minimum tanggal mulai = hari ini
    tanggalMulai.min = todayStr;

    // Fungsi untuk update minimum tanggal selesai
    function updateMinTanggalSelesai() {
        if (tanggalMulai.value) {
            // Set minimum tanggal selesai = tanggal mulai + 1 hari
            const minDate = new Date(tanggalMulai.value);
            minDate.setDate(minDate.getDate() + 1);
            tanggalSelesai.min = minDate.toISOString().split('T')[0];
            
            // Jika tanggal selesai kurang dari minimum, reset
            if (tanggalSelesai.value && tanggalSelesai.value <= tanggalMulai.value) {
                tanggalSelesai.value = minDate.toISOString().split('T')[0];
            }
        }
    }

    // Update saat halaman dimuat
    updateMinTanggalSelesai();

    // Event listener untuk perubahan tanggal mulai
    tanggalMulai.addEventListener('change', function() {
        // Validasi tanggal mulai tidak boleh mundur dari hari ini
        if (tanggalMulai.value < todayStr) {
            alert('Tanggal mulai tidak boleh mundur dari hari ini!');
            tanggalMulai.value = todayStr;
        }
        updateMinTanggalSelesai();
    });

    // Validasi saat tanggal selesai diubah
    tanggalSelesai.addEventListener('change', function() {
        if (tanggalSelesai.value <= tanggalMulai.value) {
            alert('Tanggal selesai harus setelah tanggal mulai!');
            const minDate = new Date(tanggalMulai.value);
            minDate.setDate(minDate.getDate() + 1);
            tanggalSelesai.value = minDate.toISOString().split('T')[0];
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/admin/gelombang/edit.blade.php ENDPATH**/ ?>