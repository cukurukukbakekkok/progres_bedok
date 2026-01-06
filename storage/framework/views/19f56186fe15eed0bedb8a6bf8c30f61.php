<?php $__env->startSection('content'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
    .biodata-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 40px 20px;
    }

    .biodata-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .biodata-header {
        text-align: center;
        color: white;
        margin-bottom: 40px;
        animation: slideDown 0.6s ease-out;
    }

    .biodata-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    /* Status Alert */
    .status-alert {
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        animation: slideDown 0.6s ease-out 0.2s backwards;
    }

    .status-alert.lolos {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-left: 5px solid #155724;
        color: white;
    }

    .status-alert.tidak-lolos {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-left: 5px solid #721c24;
        color: white;
    }

    .status-alert.menunggu {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        border-left: 5px solid #856404;
        color: white;
    }

    .status-alert h3 {
        margin-bottom: 10px;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .status-alert p {
        margin: 0;
        opacity: 0.95;
    }

    /* Biodata Card */
    .biodata-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        animation: slideUp 0.6s ease-out 0.3s backwards;
    }

    .biodata-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px 16px 0 0;
    }

    .biodata-card {
        position: relative;
    }

    .biodata-section {
        margin-bottom: 35px;
    }

    .biodata-section:last-child {
        margin-bottom: 0;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #667eea;
    }

    .section-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .biodata-row {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 20px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
        align-items: start;
    }

    .biodata-row:last-child {
        border-bottom: none;
    }

    .biodata-label {
        font-weight: 600;
        color: #667eea;
        font-size: 0.95rem;
    }

    .biodata-value {
        color: #333;
        font-size: 1rem;
        line-height: 1.5;
        word-break: break-word;
    }

    /* Special badges */
    .badge-code {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
        margin: 5px 0;
    }

    .badge-jurusan {
        display: inline-block;
        background: #f0f0f0;
        color: #667eea;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        border: 2px solid #667eea;
    }

    .badge-gelombang {
        display: inline-block;
        background: #e8f4f8;
        color: #0c5460;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        border: 2px solid #0c5460;
    }

    /* Action Buttons */
    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }

    .btn-action {
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .btn-primary-action {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-secondary-action {
        background: #f0f0f0;
        color: #333;
    }

    .btn-secondary-action:hover {
        background: #e0e0e0;
        text-decoration: none;
        transform: translateY(-3px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #333;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .empty-state p {
        color: #999;
        margin-bottom: 25px;
    }

    .empty-state .btn-action {
        display: inline-block;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .biodata-wrapper {
            padding: 20px 15px;
        }

        .biodata-header h1 {
            font-size: 2rem;
        }

        .biodata-card {
            padding: 25px;
        }

        .biodata-row {
            grid-template-columns: 1fr;
            gap: 5px;
        }

        .biodata-label {
            font-size: 0.9rem;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="biodata-wrapper">
    <div class="biodata-container">
        <!-- Header -->
        <div class="biodata-header animate__animated animate__fadeIn">
            <h1>📄 Data Pribadi Anda</h1>
            <p>Informasi pendaftaran calon siswa</p>
        </div>

        <?php if($siswa): ?>
            <!-- Status Alert -->
            <div class="status-alert <?php echo e(strtolower(str_replace(' ', '-', $siswa->status_kelulusan ?? 'menunggu'))); ?> animate__animated animate__slideInDown" style="animation-delay: 0.2s;">
                <h3>
                    <?php if($siswa->status_kelulusan == 'Lolos'): ?>
                        🎉 SELAMAT!
                    <?php elseif($siswa->status_kelulusan == 'Tidak Lolos'): ?>
                        😔 MOHON MAAF
                    <?php else: ?>
                        ⏳ MENUNGGU
                    <?php endif; ?>
                </h3>
                <p>
                    <?php if($siswa->status_kelulusan == 'Lolos'): ?>
                        Anda dinyatakan <strong>LOLOS</strong> seleksi pendaftaran!
                    <?php elseif($siswa->status_kelulusan == 'Tidak Lolos'): ?>
                        Anda dinyatakan <strong>TIDAK LOLOS</strong> seleksi pendaftaran.
                    <?php else: ?>
                        Status Anda masih <strong>MENUNGGU</strong> keputusan dari admin.
                    <?php endif; ?>
                </p>
            </div>

            <!-- Biodata Card -->
            <div class="biodata-card animate__animated animate__slideInUp" style="animation-delay: 0.3s;">
                <!-- Kode & Gelombang -->
                <div class="biodata-section">
                    <div class="section-header">
                        <span>🎫</span>
                        <h3>Informasi Pendaftaran</h3>
                    </div>
                    
                    <div class="biodata-row">
                        <div class="biodata-label">Kode Formulir</div>
                        <div class="biodata-value">
                            <span class="badge-code"><?php echo e($siswa->kode_pendaftaran ?? '-'); ?></span>
                        </div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Gelombang</div>
                        <div class="biodata-value">
                            <span class="badge-gelombang"><?php echo e($siswa->gelombang->nama ?? '-'); ?></span>
                        </div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Jurusan</div>
                        <div class="biodata-value">
                            <span class="badge-jurusan"><?php echo e($siswa->jurusan ?? '-'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="biodata-section">
                    <div class="section-header">
                        <span>👤</span>
                        <h3>Data Pribadi</h3>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Nama Lengkap</div>
                        <div class="biodata-value"><?php echo e($siswa->nama_lengkap); ?></div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">NISN</div>
                        <div class="biodata-value"><?php echo e($siswa->nisn); ?></div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Tempat Lahir</div>
                        <div class="biodata-value"><?php echo e($siswa->tempat_lahir); ?></div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Tanggal Lahir</div>
                        <div class="biodata-value">
                            <?php echo e(\Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y')); ?>

                        </div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Jenis Kelamin</div>
                        <div class="biodata-value">
                            <?php echo e($siswa->jenis_kelamin == 'Laki-laki' ? '🧑 Laki-laki' : '👩 Perempuan'); ?>

                        </div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Asal Sekolah</div>
                        <div class="biodata-value"><?php echo e($siswa->asal_sekolah); ?></div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="biodata-section">
                    <div class="section-header">
                        <span>📞</span>
                        <h3>Informasi Kontak</h3>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Orang Tua</div>
                        <div class="biodata-value"><?php echo e($siswa->nama_orang_tua); ?></div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Nomor HP</div>
                        <div class="biodata-value">
                            <a href="tel:<?php echo e($siswa->no_hp); ?>" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                <?php echo e($siswa->no_hp); ?>

                            </a>
                        </div>
                    </div>

                    <div class="biodata-row">
                        <div class="biodata-label">Alamat</div>
                        <div class="biodata-value" style="white-space: pre-wrap;"><?php echo e($siswa->alamat); ?></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="<?php echo e(route('siswa.dashboard')); ?>" class="btn-action btn-secondary-action">
                        ← Kembali ke Dashboard
                    </a>
                    <a href="<?php echo e(route('siswa.dokumen.index')); ?>" class="btn-action btn-primary-action">
                        Lihat Dokumen →
                    </a>
                </div>
            </div>

            <p style="text-align: center; color: rgba(255,255,255,0.8); margin-top: 25px; font-size: 0.9rem;">
                📌 Data Anda bersifat read-only. Untuk perubahan, hubungi admin.
            </p>

        <?php else: ?>
            <!-- Empty State -->
            <div class="biodata-card animate__animated animate__slideInUp" style="animation-delay: 0.3s;">
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>Belum Ada Data Pendaftaran</h3>
                    <p>Anda belum mengisi formulir pendaftaran. Silakan isi terlebih dahulu untuk melanjutkan.</p>
                    <a href="<?php echo e(route('siswa.pendaftaran')); ?>" class="btn-action btn-primary-action">
                        Mulai Pendaftaran
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\BEDOK_UKK_PPDB2\resources\views/siswa/biodata.blade.php ENDPATH**/ ?>