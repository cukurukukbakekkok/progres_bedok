

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --success: #48bb78;
        --danger: #f56565;
        --text-dark: #2d3748;
        --text-light: #718096;
        --border-color: #e2e8f0;
    }

    body {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        min-height: 100vh;
    }

    .confirmation-wrapper {
        min-height: calc(100vh - 70px);
        padding: 40px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .confirmation-container {
        max-width: 900px;
        width: 100%;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .confirmation-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 40px;
        text-align: center;
    }

    .confirmation-header h1 {
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .confirmation-header p {
        font-size: 16px;
        opacity: 0.9;
        margin: 0;
    }

    .confirmation-icon {
        font-size: 60px;
        margin-bottom: 20px;
    }

    .confirmation-content {
        padding: 40px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--primary);
    }

    .data-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .data-item {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }

    .data-label {
        font-size: 12px;
        color: var(--text-light);
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .data-value {
        font-size: 16px;
        color: var(--text-dark);
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-edit {
        background: #f0f0f0;
        color: var(--text-dark);
        border: 2px solid var(--border-color);
    }

    .btn-edit:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }

    .btn-confirm {
        background: linear-gradient(135deg, var(--success) 0%, #36a94f 100%);
        color: white;
    }

    .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(72, 187, 120, 0.3);
    }

    .confirmation-note {
        background: #e6f7ff;
        border-left: 4px solid var(--primary);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 30px;
        font-size: 14px;
        color: #0f4c81;
    }

    .confirmation-note i {
        margin-right: 10px;
        color: var(--primary);
    }

    .link-dokumen {
        color: var(--primary);
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 6px;
        background: rgba(102, 126, 234, 0.1);
    }

    .link-dokumen:hover {
        color: var(--primary-dark);
        background: rgba(102, 126, 234, 0.2);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .confirmation-header {
            padding: 30px 20px;
        }

        .confirmation-content {
            padding: 20px;
        }

        .confirmation-header h1 {
            font-size: 24px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="confirmation-wrapper">
    <div class="confirmation-container">
        <div class="confirmation-header">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Verifikasi Data Pendaftaran</h1>
            <p>Pastikan semua data yang Anda masukkan sudah benar sebelum melanjutkan</p>
        </div>

        <div class="confirmation-content">
            <div class="confirmation-note">
                <i class="fas fa-info-circle"></i>
                <strong>Catatan Penting:</strong> Setelah Anda melakukan pembayaran, data pendaftaran Anda tidak dapat diubah lagi. 
                Pastikan semua data sudah benar sebelum melanjutkan ke tahap pembayaran.
            </div>

            <!-- TAHAP 1: BIODATA -->
            <div class="section-title">
                <i class="fas fa-user-circle"></i> Data Diri Siswa
            </div>
            <div class="data-grid">
                <div class="data-item">
                    <div class="data-label">Nama Lengkap</div>
                    <div class="data-value"><?php echo e($calon->nama_lengkap); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">NISN</div>
                    <div class="data-value"><?php echo e($calon->nisn); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">NIK</div>
                    <div class="data-value"><?php echo e($calon->nik); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Jenis Kelamin</div>
                    <div class="data-value"><?php echo e($calon->jenis_kelamin); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Tempat Lahir</div>
                    <div class="data-value"><?php echo e($calon->tempat_lahir); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Tanggal Lahir</div>
                    <div class="data-value"><?php echo e(\Carbon\Carbon::parse($calon->tanggal_lahir)->format('d/m/Y')); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Agama</div>
                    <div class="data-value"><?php echo e($calon->agama); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Asal Sekolah</div>
                    <div class="data-value"><?php echo e($calon->asal_sekolah); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Jurusan Pilihan</div>
                    <div class="data-value"><?php echo e($calon->jurusan); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Berat Badan</div>
                    <div class="data-value"><?php echo e($calon->berat_badan); ?> kg</div>
                </div>
                <div class="data-item">
                    <div class="data-label">Tinggi Badan</div>
                    <div class="data-value"><?php echo e($calon->tinggi_badan); ?> cm</div>
                </div>
                <div class="data-item">
                    <div class="data-label">No. HP</div>
                    <div class="data-value"><?php echo e($calon->no_hp); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">No. WhatsApp</div>
                    <div class="data-value"><?php echo e($calon->no_wa); ?></div>
                </div>
            </div>

            <!-- TAHAP 2: ALAMAT -->
            <div class="section-title">
                <i class="fas fa-map-marker-alt"></i> Alamat Tempat Tinggal
            </div>
            <div class="data-grid">
                <div class="data-item" style="grid-column: 1/-1;">
                    <div class="data-label">Alamat</div>
                    <div class="data-value"><?php echo e($calon->alamat); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Provinsi</div>
                    <div class="data-value"><?php echo e($calon->provinsi); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Kabupaten</div>
                    <div class="data-value"><?php echo e($calon->kabupaten); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Kecamatan</div>
                    <div class="data-value"><?php echo e($calon->kecamatan); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Kelurahan</div>
                    <div class="data-value"><?php echo e($calon->kelurahan); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">Kode Pos</div>
                    <div class="data-value"><?php echo e($calon->kode_pos); ?></div>
                </div>
                <div class="data-item">
                    <div class="data-label">RT/RW</div>
                    <div class="data-value"><?php echo e($calon->rt_rw ?? '-'); ?></div>
                </div>
            </div>

            <!-- TAHAP 3: ORANG TUA / WALI -->
            <div class="section-title">
                <i class="fas fa-users"></i> Data Orang Tua / Wali
            </div>

            <?php if($calon->status_keluarga == 'ayah_ibu'): ?>
                <div style="margin-bottom: 30px;">
                    <h4 style="color: var(--primary); margin-bottom: 15px;">Data Ayah</h4>
                    <div class="data-grid">
                        <div class="data-item">
                            <div class="data-label">Nama Ayah</div>
                            <div class="data-value"><?php echo e($calon->nama_ayah ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Tempat Lahir</div>
                            <div class="data-value"><?php echo e($calon->tempat_lahir_ayah ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Tanggal Lahir</div>
                            <div class="data-value"><?php echo e($calon->tanggal_lahir_ayah ? \Carbon\Carbon::parse($calon->tanggal_lahir_ayah)->format('d/m/Y') : '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Pendidikan</div>
                            <div class="data-value"><?php echo e($calon->pendidikan_ayah ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Pekerjaan</div>
                            <div class="data-value"><?php echo e($calon->pekerjaan_ayah ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Penghasilan</div>
                            <div class="data-value"><?php echo e($calon->penghasilan_ayah ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">No. HP</div>
                            <div class="data-value"><?php echo e($calon->no_hp_ayah ?? '-'); ?></div>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 30px;">
                    <h4 style="color: var(--primary); margin-bottom: 15px;">Data Ibu</h4>
                    <div class="data-grid">
                        <div class="data-item">
                            <div class="data-label">Nama Ibu</div>
                            <div class="data-value"><?php echo e($calon->nama_ibu ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Tempat Lahir</div>
                            <div class="data-value"><?php echo e($calon->tempat_lahir_ibu ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Tanggal Lahir</div>
                            <div class="data-value"><?php echo e($calon->tanggal_lahir_ibu ? \Carbon\Carbon::parse($calon->tanggal_lahir_ibu)->format('d/m/Y') : '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Pendidikan</div>
                            <div class="data-value"><?php echo e($calon->pendidikan_ibu ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Pekerjaan</div>
                            <div class="data-value"><?php echo e($calon->pekerjaan_ibu ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">Penghasilan</div>
                            <div class="data-value"><?php echo e($calon->penghasilan_ibu ?? '-'); ?></div>
                        </div>
                        <div class="data-item">
                            <div class="data-label">No. HP</div>
                            <div class="data-value"><?php echo e($calon->no_hp_ibu ?? '-'); ?></div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="data-grid">
                    <div class="data-item">
                        <div class="data-label">Nama Wali</div>
                        <div class="data-value"><?php echo e($calon->nama_wali ?? '-'); ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Tempat Lahir</div>
                        <div class="data-value"><?php echo e($calon->tempat_lahir_wali ?? '-'); ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Tanggal Lahir</div>
                        <div class="data-value"><?php echo e($calon->tanggal_lahir_wali ? \Carbon\Carbon::parse($calon->tanggal_lahir_wali)->format('d/m/Y') : '-'); ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Pendidikan</div>
                        <div class="data-value"><?php echo e($calon->pendidikan_wali ?? '-'); ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Pekerjaan</div>
                        <div class="data-value"><?php echo e($calon->pekerjaan_wali ?? '-'); ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Penghasilan</div>
                        <div class="data-value"><?php echo e($calon->penghasilan_wali ?? '-'); ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">No. HP</div>
                        <div class="data-value"><?php echo e($calon->no_hp_wali ?? '-'); ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- DOKUMEN YANG DIUNGGAH -->
            <div class="section-title" style="margin-top: 40px;">
                <i class="fas fa-folder-open"></i> Dokumen yang Diunggah
            </div>
            <?php if($dokumen): ?>
                <div class="data-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <?php $__currentLoopData = ['akte_kelahiran' => 'Akte Kelahiran', 'ijazah_smp' => 'Ijazah SMP', 'skl_smp' => 'SKL SMP', 'kartu_keluarga' => 'Kartu Keluarga', 'ktp_ortu' => 'KTP Orang Tua']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($dokumen->$field): ?>
                            <?php
                                $ext = pathinfo($dokumen->$field, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']);
                            ?>
                            <div class="data-item">
                                <div class="data-label"><?php echo e($label); ?></div>
                                <div class="data-value mt-2">
                                    <?php if($isImage): ?>
                                        <div style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            <img src="<?php echo e(asset('storage/' . $dokumen->$field)); ?>" alt="<?php echo e($label); ?>" style="width: 100%; height: auto; display: block;">
                                        </div>
                                    <?php else: ?>
                                        <div class="p-3 bg-light text-center rounded border">
                                            <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                            <p class="mb-0 small text-muted">Format: <?php echo e(strtoupper($ext)); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo e(asset('storage/' . $dokumen->$field)); ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-3 w-100">
                                        <i class="fas fa-external-link-alt me-1"></i> Lihat Dokumen Asli
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="data-item" style="background: #fff3cd; border-left-color: #ffc107;">
                                <div class="data-label"><i class="fas fa-exclamation-triangle" style="color: #ffc107; margin-right: 5px;"></i> <?php echo e($label); ?></div>
                                <div class="data-value" style="color: #856404;">Belum diunggah</div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div style="padding: 20px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107; color: #856404; text-align: center;">
                    <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                    <strong>Belum ada dokumen yang diunggah</strong><br>
                    <small>Silakan upload dokumen terlebih dahulu sebelum melanjutkan</small>
                </div>
            <?php endif; ?>

            <!-- BIAYA PENDAFTARAN -->
            <div class="section-title" style="margin-top: 40px;">
                <i class="fas fa-credit-card"></i> Biaya Pendaftaran
            </div>
            <div class="data-grid">
                <div class="data-item" style="grid-column: 1/-1; background: #f0f7ff; border-left-color: var(--primary);">
                    <div class="data-label">Jurusan</div>
                    <div class="data-value" style="font-size: 20px;"><?php echo e($calon->jurusan); ?></div>
                </div>
                <div class="data-item" style="grid-column: 1/-1; background: #e8f5e9; border-left-color: var(--success);">
                    <div class="data-label">Total Biaya</div>
                    <div class="data-value" style="font-size: 20px; color: var(--success); font-weight: bold;">
                        Rp <?php echo e(number_format($calon->nominal_pembayaran, 0, ',', '.')); ?>

                    </div>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="action-buttons" style="display: flex; flex-direction: column; gap: 15px; align-items: center; margin-top: 30px;">
                <?php
                    // Data terkunci hanya jika: pembayaran LUNAS DAN sudah disetujui admin (LULUS)
                    $isLocked = ($calon->status_pembayaran === 'Lunas' && $calon->status_kelulusan === 'Lulus') || $calon->data_locked;
                ?>
                
                <?php if(!$isLocked): ?>
                    <?php if(!$calon->data_confirmed): ?>
                        
                        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                            <a href="<?php echo e(route('siswa.pendaftaran.edit', $calon->id)); ?>" class="btn" style="background: #f0f0f0; color: #333; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-user-edit"></i> Ubah Biodata
                            </a>
                            <a href="<?php echo e(route('siswa.dokumen.index')); ?>" class="btn" style="background: #f0f0f0; color: #333; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-file-alt"></i> Ubah Dokumen
                            </a>
                            <form action="<?php echo e(route('siswa.pendaftaran.confirm', $calon->id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 25px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                                    <i class="fas fa-check"></i> Konfirmasi & Lanjut Pembayaran
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        
                        <div class="alert alert-success" style="width: 100%; text-align: center; padding: 15px; border-radius: 8px; background: #d4edda; color: #155724; margin-bottom: 0;">
                            <i class="fas fa-check-circle"></i> Data pendaftaran telah dikonfirmasi. 
                            Silakan lanjutkan ke tahap pembayaran melalui dashboard.
                        </div>
                        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                            <a href="<?php echo e(route('siswa.pendaftaran.edit', $calon->id)); ?>" class="btn" style="background: #f0f0f0; color: #333; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-user-edit"></i> Perbaiki Biodata
                            </a>
                            <a href="<?php echo e(route('siswa.dokumen.index')); ?>" class="btn" style="background: #f0f0f0; color: #333; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-file-image"></i> Ganti Dokumen
                            </a>
                            <a href="<?php echo e(route('siswa.dashboard')); ?>" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-home"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    
                    <div class="alert alert-info" style="width: 100%; text-align: center; padding: 15px; border-radius: 8px; background: #d1ecf1; color: #0c5460;">
                        <i class="fas fa-lock"></i> Data pendaftaran sudah terkunci karena pembayaran sudah lunas dan disetujui admin.
                    </div>
                    <a href="<?php echo e(route('siswa.dashboard')); ?>" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        <i class="fas fa-home"></i> Kembali ke Dashboard
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\UKK_BEDOK_PPDB2\resources\views/siswa/pendaftaran/confirmation.blade.php ENDPATH**/ ?>