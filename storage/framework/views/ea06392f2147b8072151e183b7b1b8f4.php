<?php $__env->startSection('content'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
    .upload-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 40px 20px;
    }

    .upload-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .upload-header {
        text-align: center;
        color: white;
        margin-bottom: 40px;
        animation: slideDown 0.6s ease-out;
    }

    .upload-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    /* Alert Messages */
    .alert-box {
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        animation: slideDown 0.5s ease-out;
        border-left: 5px solid;
    }

    .alert-success {
        background: #d4edda;
        border-left-color: #28a745;
        color: #155724;
    }

    .alert-error {
        background: #f8d7da;
        border-left-color: #dc3545;
        color: #721c24;
    }

    /* Status Card */
    .status-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        animation: slideUp 0.6s ease-out 0.1s backwards;
        margin-bottom: 30px;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .status-badge.valid {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .status-badge.tidak-valid {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .status-badge.menunggu {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: white;
    }

    .status-card h4 {
        margin-bottom: 15px;
        color: #333;
        font-weight: 700;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        animation: slideUp 0.6s ease-out 0.2s backwards;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px 16px 0 0;
    }

    .form-card {
        position: relative;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #667eea;
    }

    .section-title h4 {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 700;
        color: #333;
    }

    /* Document Item */
    .document-item {
        background: #f9f9f9;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .document-item:hover {
        border-color: #667eea;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
    }

    .document-item h5 {
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .document-item p {
        font-size: 0.9rem;
        color: #999;
        margin-bottom: 15px;
    }

    .file-input-label {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        font-size: 0.95rem;
    }

    .file-input-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .file-input-label input[type="file"] {
        display: none;
    }

    .file-info {
        margin-top: 12px;
        padding: 12px;
        background: white;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .file-name {
        color: #667eea;
        font-weight: 600;
        word-break: break-word;
    }

    .view-btn {
        display: inline-block;
        background: #667eea;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .view-btn:hover {
        background: #764ba2;
        color: white;
    }

    /* Error Message */
    .error-message {
        color: #dc3545;
        font-size: 0.9rem;
        margin-top: 8px;
        padding: 10px;
        background: #f8d7da;
        border-radius: 6px;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 25px;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    /* Instructions */
    .instructions {
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f4f8 100%);
        border-left: 4px solid #667eea;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .instructions h5 {
        color: #667eea;
        margin-bottom: 12px;
        font-weight: 700;
    }

    .instructions ul {
        margin: 0;
        padding-left: 20px;
    }

    .instructions li {
        color: #333;
        margin-bottom: 8px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .empty-state h3 {
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .upload-wrapper {
            padding: 20px 15px;
        }

        .upload-header h1 {
            font-size: 2rem;
        }

        .upload-container {
            max-width: 100%;
        }
    }
</style>

<div class="upload-wrapper">
    <div class="upload-container">
        <!-- Header -->
        <div class="upload-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-center mb-3">
                <a href="<?php echo e(route('siswa.dashboard')); ?>" class="btn btn-sm btn-outline-light px-3 py-2 rounded-pill fw-600 shadow-sm" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>
            <h1>📄 Upload Dokumen Persyaratan</h1>
            <p>Lengkapi dokumen yang diperlukan untuk proses seleksi</p>
        </div>

        <!-- Alerts -->
        <?php if(session('success')): ?>
            <div class="alert-box alert-success animate__animated animate__slideInDown">
                <strong>✅ Sukses!</strong> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert-box alert-error animate__animated animate__slideInDown">
                <strong>❌ Error!</strong> <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php
            $siswa = \App\Models\CalonSiswa::where('user_id', Auth::id())->first();
            $dokumen = $siswa ? \App\Models\DokumenPersyaratan::where('id_siswa', $siswa->id)->first() : null;
            
            // Check if there are any uploaded documents
            $hasUploadedDocuments = $dokumen && (
                $dokumen->akte_kelahiran || 
                $dokumen->ijazah_smp || 
                $dokumen->skl_smp || 
                $dokumen->kartu_keluarga ||
                $dokumen->ktp_ortu
            );
        ?>

        <?php if($dokumen): ?>
            <!-- Status Card -->
            <div class="status-card animate__animated animate__slideInUp" style="animation-delay: 0.1s;">
                <h4>📊 Status Verifikasi Dokumen</h4>
                
                <?php if($dokumen->status_verifikasi == 'Valid'): ?>
                    <span class="status-badge valid">✓ Valid - Dokumen Diterima</span>
                    <div class="alert-box alert-success" style="margin: 15px 0 0 0; border: none; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                        🎉 Semua dokumen Anda telah diverifikasi dan diterima!
                    </div>
                <?php elseif($dokumen->status_verifikasi == 'Tidak Valid'): ?>
                    <span class="status-badge tidak-valid">✗ Tidak Valid - Dokumen Ditolak</span>
                    <?php if($dokumen->keterangan): ?>
                        <div class="alert-box alert-error" style="margin: 15px 0 0 0; border: none;">
                            <strong>📝 Catatan Admin:</strong><br><?php echo e($dokumen->keterangan); ?>

                        </div>
                    <?php endif; ?>
                <?php elseif($hasUploadedDocuments): ?>
                    <span class="status-badge menunggu">⏳ Menunggu Verifikasi</span>
                    <div class="alert-box alert-success" style="margin: 15px 0 0 0; border: none; background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
                        📝 Dokumen Anda sedang diproses oleh admin. Harap tunggu...
                    </div>
                    
                    <?php if($dokumen->keterangan): ?>
                        <div class="alert-box alert-error" style="margin: 15px 0 0 0; border: none;">
                            <strong>📝 Catatan Admin untuk Perbaikan:</strong><br><?php echo e($dokumen->keterangan); ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Instructions -->
            <div class="instructions animate__animated animate__slideInUp" style="animation-delay: 0.2s;">
                <h5>📋 Petunjuk Upload</h5>
                <ul>
                    <li>Format file: PDF, JPG, atau PNG</li>
                    <li>Ukuran maksimal file: 2MB per dokumen</li>
                    <li>Pastikan dokumen jelas dan dapat dibaca</li>
                    <li>Upload minimal satu dokumen untuk memulai</li>
                    <li>Anda dapat mengupdate dokumen kapan saja</li>
                </ul>
            </div>

            <!-- Form Card -->
            <div class="form-card animate__animated animate__slideInUp" style="animation-delay: 0.3s;">
                <form id="dokumen-form" action="<?php echo e(route('siswa.dokumen.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <!-- Akte Kelahiran -->
                    <div class="document-item">
                        <h5>
                            <span>🎫</span>
                            Akte Kelahiran
                            <?php if($dokumen->akte_kelahiran): ?>
                                <span style="margin-left: auto; background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700;">✓ SUDAH DIUPLOAD</span>
                            <?php endif; ?>
                        </h5>
                        <p>Fotokopi akte kelahiran resmi dari Disdukcapil</p>
                        
                        <div id="akte_kelahiran_upload" style="display: <?php echo e($dokumen->akte_kelahiran ? 'none !important' : 'block'); ?>;">
                            <label class="file-input-label">
                                📁 Pilih File
                                <input type="file" name="akte_kelahiran" accept=".pdf,.jpg,.jpeg,.png">
                            </label>
                        </div>

                        <?php if($dokumen->akte_kelahiran): ?>
                            <div class="file-info" style="display: block;">
                                <span class="file-name">✓ <?php echo e(basename($dokumen->akte_kelahiran)); ?></span>
                                <div>
                                    <a href="<?php echo e(asset('storage/' . $dokumen->akte_kelahiran)); ?>" target="_blank" class="view-btn">
                                        👁️ Lihat
                                    </a>
                                    <?php if($dokumen->status_verifikasi !== 'Valid'): ?>
                                    <button type="button" class="view-btn" style="background: #ff6b6b; cursor: pointer;" onclick="document.getElementById('akte_kelahiran_upload').style.display='block'; this.parentElement.parentElement.style.display='none';">
                                        🔄 Ganti
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="file-info" style="display: none;"></div>
                        <?php endif; ?>

                        <?php $__errorArgs = ['akte_kelahiran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Ijazah SMP -->
                    <div class="document-item">
                        <h5>
                            <span>📜</span>
                            Ijazah SMP/MTS
                            <?php if($dokumen->ijazah_smp): ?>
                                <span style="margin-left: auto; background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700;">✓ SUDAH DIUPLOAD</span>
                            <?php endif; ?>
                        </h5>
                        <p>Fotokopi ijazah SMP atau MTS asli</p>
                        
                        <div id="ijazah_smp_upload" style="display: <?php echo e($dokumen->ijazah_smp ? 'none !important' : 'block'); ?>;">
                            <label class="file-input-label">
                                📁 Pilih File
                                <input type="file" name="ijazah_smp" accept=".pdf,.jpg,.jpeg,.png">
                            </label>
                        </div>

                        <?php if($dokumen->ijazah_smp): ?>
                            <div class="file-info" style="display: block;">
                                <span class="file-name">✓ <?php echo e(basename($dokumen->ijazah_smp)); ?></span>
                                <div>
                                    <a href="<?php echo e(asset('storage/' . $dokumen->ijazah_smp)); ?>" target="_blank" class="view-btn">
                                        👁️ Lihat
                                    </a>
                                    <?php if($dokumen->status_verifikasi !== 'Valid'): ?>
                                    <button type="button" class="view-btn" style="background: #ff6b6b; cursor: pointer;" onclick="document.getElementById('ijazah_smp_upload').style.display='block'; this.parentElement.parentElement.style.display='none';">
                                        🔄 Ganti
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="file-info" style="display: none;"></div>
                        <?php endif; ?>

                        <?php $__errorArgs = ['ijazah_smp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- SKL -->
                    <div class="document-item">
                        <h5>
                            <span>✅</span>
                            SKL (Surat Keterangan Lulus)
                            <?php if($dokumen->skl_smp): ?>
                                <span style="margin-left: auto; background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700;">✓ SUDAH DIUPLOAD</span>
                            <?php endif; ?>
                        </h5>
                        <p>Surat keterangan lulus dari sekolah asal</p>
                        
                        <div id="skl_smp_upload" style="display: <?php echo e($dokumen->skl_smp ? 'none !important' : 'block'); ?>;">
                            <label class="file-input-label">
                                📁 Pilih File
                                <input type="file" name="skl_smp" accept=".pdf,.jpg,.jpeg,.png">
                            </label>
                        </div>

                        <?php if($dokumen->skl_smp): ?>
                            <div class="file-info" style="display: block;">
                                <span class="file-name">✓ <?php echo e(basename($dokumen->skl_smp)); ?></span>
                                <div>
                                    <a href="<?php echo e(asset('storage/' . $dokumen->skl_smp)); ?>" target="_blank" class="view-btn">
                                        👁️ Lihat
                                    </a>
                                    <?php if($dokumen->status_verifikasi !== 'Valid'): ?>
                                    <button type="button" class="view-btn" style="background: #ff6b6b; cursor: pointer;" onclick="document.getElementById('skl_smp_upload').style.display='block'; this.parentElement.parentElement.style.display='none';">
                                        🔄 Ganti
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="file-info" style="display: none;"></div>
                        <?php endif; ?>

                        <?php $__errorArgs = ['skl_smp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Kartu Keluarga -->
                    <div class="document-item">
                        <h5>
                            <span>👨‍👩‍👧‍👦</span>
                            Kartu Keluarga
                            <?php if($dokumen->kartu_keluarga): ?>
                                <span style="margin-left: auto; background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700;">✓ SUDAH DIUPLOAD</span>
                            <?php endif; ?>
                        </h5>
                        <p>Fotokopi kartu keluarga dari kantor kelurahan/desa</p>
                        
                        <div id="kartu_keluarga_upload" style="display: <?php echo e($dokumen->kartu_keluarga ? 'none !important' : 'block'); ?>;">
                            <label class="file-input-label">
                                📁 Pilih File
                                <input type="file" name="kartu_keluarga" accept=".pdf,.jpg,.jpeg,.png">
                            </label>
                        </div>

                        <?php if($dokumen->kartu_keluarga): ?>
                            <div class="file-info" style="display: block;">
                                <span class="file-name">✓ <?php echo e(basename($dokumen->kartu_keluarga)); ?></span>
                                <div>
                                    <a href="<?php echo e(asset('storage/' . $dokumen->kartu_keluarga)); ?>" target="_blank" class="view-btn">
                                        👁️ Lihat
                                    </a>
                                    <?php if($dokumen->status_verifikasi !== 'Valid'): ?>
                                    <button type="button" class="view-btn" style="background: #ff6b6b; cursor: pointer;" onclick="document.getElementById('kartu_keluarga_upload').style.display='block'; this.parentElement.parentElement.style.display='none';">
                                        🔄 Ganti
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="file-info" style="display: none;"></div>
                        <?php endif; ?>

                        <?php $__errorArgs = ['kartu_keluarga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- KTP Orang Tua -->
                    <div class="document-item">
                        <h5>
                            <span>🆔</span>
                            KTP Orang Tua
                            <?php if($dokumen->ktp_ortu): ?>
                                <span style="margin-left: auto; background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700;">✓ SUDAH DIUPLOAD</span>
                            <?php endif; ?>
                        </h5>
                        <p>Fotokopi KTP salah satu orang tua</p>
                        
                        <div id="ktp_ortu_upload" style="display: <?php echo e($dokumen->ktp_ortu ? 'none !important' : 'block'); ?>;">
                            <label class="file-input-label">
                                📁 Pilih File
                                <input type="file" name="ktp_ortu" accept=".pdf,.jpg,.jpeg,.png">
                            </label>
                        </div>

                        <?php if($dokumen->ktp_ortu): ?>
                            <div class="file-info" style="display: block;">
                                <span class="file-name">✓ <?php echo e(basename($dokumen->ktp_ortu)); ?></span>
                                <div>
                                    <a href="<?php echo e(asset('storage/' . $dokumen->ktp_ortu)); ?>" target="_blank" class="view-btn">
                                        👁️ Lihat
                                    </a>
                                    <?php if($dokumen->status_verifikasi !== 'Valid'): ?>
                                    <button type="button" class="view-btn" style="background: #ff6b6b; cursor: pointer;" onclick="document.getElementById('ktp_ortu_upload').style.display='block'; this.parentElement.parentElement.style.display='none';">
                                        🔄 Ganti
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="file-info" style="display: none;"></div>
                        <?php endif; ?>

                        <?php $__errorArgs = ['ktp_ortu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="error-message"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Submit Button -->
                    <?php if($dokumen->status_verifikasi !== 'Valid'): ?>
                    <button type="submit" class="submit-btn">
                        💾 Simpan & Upload Dokumen
                    </button>
                    <?php endif; ?>
                </form>
            </div>

        <?php else: ?>
            <!-- Empty State -->
            <div class="status-card">
                <div class="empty-state">
                    <div class="empty-state-icon">📋</div>
                    <h3>Belum Ada Data Pendaftaran</h3>
                    <p>Anda harus melakukan pendaftaran terlebih dahulu sebelum mengupload dokumen.</p>
                    <a href="<?php echo e(route('siswa.pendaftaran.create')); ?>" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 600; margin-top: 15px;">
                        Lakukan Pendaftaran
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Array of document fields
    const documents = [
        'akte_kelahiran',
        'ijazah_smp',
        'skl_smp',
        'kartu_keluarga',
        'ktp_ortu'
    ];

    // Handle file input changes
    documents.forEach(docName => {
        const fileInput = document.querySelector(`input[name="${docName}"]`);
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files.length > 0) {
                    // Get the file name
                    const fileName = this.files[0].name;
                    
                    // Hide the upload input
                    const uploadDiv = document.getElementById(`${docName}_upload`);
                    if (uploadDiv) {
                        uploadDiv.style.display = 'none';
                        
                        // Find the document-item parent
                        const documentItem = uploadDiv.closest('.document-item');
                        if (documentItem) {
                            // Look for existing file info
                            let fileInfo = documentItem.querySelector('.file-info');
                            if (!fileInfo) {
                                fileInfo = document.createElement('div');
                                fileInfo.className = 'file-info';
                                documentItem.appendChild(fileInfo);
                            }
                            
                            // Update file info with selected file
                            fileInfo.innerHTML = `
                                <span class="file-name">✓ ${fileName}</span>
                                <div>
                                    <button type="button" class="view-btn" style="background: #ff6b6b; cursor: pointer;" onclick="document.getElementById('${docName}_upload').style.display='block'; this.parentElement.parentElement.style.display='none';">
                                        🔄 Ganti
                                    </button>
                                </div>
                            `;
                            fileInfo.style.display = 'block';
                        }
                    }
                }
            });
        }
    });

    // Script auto-reload removed to prevent interference with controller redirects
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\UKK_BEDOK_PPDB2\resources\views/siswa/dokumen/upload.blade.php ENDPATH**/ ?>