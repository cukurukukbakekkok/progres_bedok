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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3><?php echo e($jurusan->nama); ?> - Manajemen Kelas</h3>
            <small class="text-muted"><?php echo e($jurusan->keterangan); ?></small>
        </div>
        <a href="<?php echo e(route('admin.jurusan.index')); ?>" class="btn btn-secondary">⬅ Kembali</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Form Tambah Kelas -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">➕ Tambah Kelas Baru</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.jurusan.kelas.store', $jurusan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" name="nama" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="misal: <?php echo e($jurusan->nama); ?> 1" required>
                            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kapasitas Siswa</label>
                            <input type="number" name="kapasitas" class="form-control <?php $__errorArgs = ['kapasitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="25" min="1" required>
                            <?php $__errorArgs = ['kapasitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Buat Kelas
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List Kelas -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">📚 Daftar Kelas (<?php echo e($kelas->count()); ?>)</h5>
                </div>
                <div class="card-body">
                    <?php if($kelas->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 30%">Nama Kelas</th>
                                        <th style="width: 20%">Kapasitas</th>
                                        <th style="width: 15%">Siswa</th>
                                        <th style="width: 15%">Sisa</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><strong><?php echo e($k->nama); ?></strong></td>
                                        <td><span class="badge bg-secondary"><?php echo e($k->kapasitas); ?></span></td>
                                        <td>
                                            <span class="badge bg-warning text-dark"><?php echo e($k->calon_siswa_count); ?></span>
                                        </td>
                                        <td>
                                            <?php
                                                $sisa = $k->kapasitas - $k->calon_siswa_count;
                                                $color = $sisa > 10 ? 'success' : ($sisa > 0 ? 'warning' : 'danger');
                                            ?>
                                            <span class="badge bg-<?php echo e($color); ?>"><?php echo e($sisa); ?></span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                                    data-bs-target="#editKelas<?php echo e($k->id); ?>" title="Edit kapasitas">
                                                ✏️
                                            </button>
                                            <?php if($k->calon_siswa_count == 0): ?>
                                                <form action="<?php echo e(route('admin.jurusan.kelas.destroy', [$jurusan->id, $k->id])); ?>" 
                                                      method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="if(confirm('Hapus kelas ini?')) this.parentForm.submit()" 
                                                            title="Hapus kelas">
                                                        🗑️
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-muted" title="Tidak bisa hapus, ada siswa">🔒</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> Belum ada kelas. Buat kelas baru di form samping.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kelas -->
<?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editKelas<?php echo e($k->id); ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit <?php echo e($k->nama); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="<?php echo e(route('admin.jurusan.kelas.update', [$jurusan->id, $k->id])); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="modal-body">
          <label class="form-label">Kapasitas</label>
          <input type="number" name="kapasitas" class="form-control" value="<?php echo e($k->kapasitas); ?>" min="<?php echo e($k->calon_siswa_count); ?>" required>
          <small class="text-muted">Minimum: <?php echo e($k->calon_siswa_count); ?> (jumlah siswa saat ini)</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ppdb1\resources\views/admin/jurusan/show.blade.php ENDPATH**/ ?>