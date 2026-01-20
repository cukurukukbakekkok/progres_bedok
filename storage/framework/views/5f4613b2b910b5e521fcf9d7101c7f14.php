

<?php $__env->startSection('content'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --primary-light: #8b9eef;
        --success: #48bb78;
        --danger: #f56565;
        --text-dark: #2d3748;
        --text-light: #718096;
        --border-color: #e2e8f0;
    }

    body {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .registration-wrapper {
        min-height: calc(100vh - 70px);
        padding: 40px 20px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }

    .registration-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Header Section */
    .header-section {
        text-align: center;
        color: white;
        margin-bottom: 50px;
        animation: slideDown 0.8s ease-out;
    }

    .header-section h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .header-section p {
        font-size: 1.1rem;
        opacity: 0.95;
        font-weight: 300;
    }

    /* Step Indicator */
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 50px;
        position: relative;
    }

    .step-indicator::before {
        content: '';
        position: absolute;
        top: 30px;
        left: 0;
        right: 0;
        height: 2px;
        background: rgba(255, 255, 255, 0.3);
        z-index: 0;
    }

    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .step-circle {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        background: rgba(255, 255, 255, 0.2);
        border: 3px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.3rem;
        transition: all 0.3s ease;
    }

    .step-item.active .step-circle {
        background: white;
        color: var(--primary-dark);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        transform: scale(1.1);
    }

    .step-item.completed .step-circle {
        background: var(--success);
        border-color: var(--success);
        color: white;
    }

    .step-label {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .step-item.active .step-label {
        color: white;
        font-weight: 700;
    }

    .step-item.completed .step-label {
        color: white;
    }

    /* Form Container */
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        padding: 50px;
        animation: fadeIn 0.6s ease-out;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
        animation: fadeIn 0.4s ease-out;
    }

    .form-title {
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .form-subtitle {
        color: var(--text-light);
        margin-bottom: 30px;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group.half {
        display: inline-block;
        width: calc(50% - 12px);
        margin-right: 24px;
    }

    .form-group.half:nth-child(2n) {
        margin-right: 0;
    }

    @media (max-width: 768px) {
        .form-group.half {
            display: block;
            width: 100%;
            margin-right: 0;
        }
    }

    label {
        display: block;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    select.form-control {
        cursor: pointer;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    /* Row for layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -12px;
        margin-left: -12px;
    }

    .col-md-6 {
        flex: 0 0 50%;
        padding: 0 12px;
    }

    .col-md-12 {
        flex: 0 0 100%;
        padding: 0 12px;
    }

    @media (max-width: 768px) {
        .col-md-6,
        .col-md-12 {
            flex: 0 0 100%;
        }
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 8px 15px;
        background: #f0f4ff;
        color: var(--primary-dark);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .status-badge.danger {
        background: #fff5f5;
        color: var(--danger);
    }

    /* Buttons */
    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        justify-content: space-between;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        flex: 1;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: var(--border-color);
        color: var(--text-dark);
        flex: 1;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
        transform: translateY(-2px);
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Help text */
    .form-text {
        display: block;
        margin-top: 5px;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    /* Animation */
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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Info Box */
    .info-box {
        background: #f0f4ff;
        border-left: 4px solid var(--primary);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        color: var(--text-dark);
    }

    .info-box i {
        color: var(--primary);
        margin-right: 10px;
    }

    /* Conditional Fields */
    .conditional-group {
        display: none;
    }

    .conditional-group.show {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    /* Loading State */
    .btn-loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .btn-loading::after {
        content: '';
        display: inline-block;
        width: 14px;
        height: 14px;
        margin-left: 8px;
        border: 2px solid white;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .registration-wrapper {
            padding: 20px 10px;
        }

        .form-container {
            padding: 30px 20px;
        }

        .header-section h1 {
            font-size: 2rem;
        }

        .step-indicator {
            margin-bottom: 30px;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }

        .button-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="registration-wrapper">
    <div class="registration-container">
        <!-- Header -->
        <div class="header-section">
            <h1>Formulir Pendaftaran</h1>
            <p>Isi data diri Anda secara lengkap dan akurat</p>
        </div>

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step-item <?php echo e($tahap_form ?? 0 >= 1 ? 'active' : ''); ?> <?php echo e($tahap_form ?? 0 > 1 ? 'completed' : ''); ?>">
                <div class="step-circle">
                    <?php if(($tahap_form ?? 0) > 1): ?>
                        <i class="fas fa-check"></i>
                    <?php else: ?>
                        1
                    <?php endif; ?>
                </div>
                <div class="step-label">Biodata Siswa</div>
            </div>
            <div class="step-item <?php echo e($tahap_form ?? 0 >= 2 ? 'active' : ''); ?> <?php echo e($tahap_form ?? 0 > 2 ? 'completed' : ''); ?>">
                <div class="step-circle">
                    <?php if(($tahap_form ?? 0) > 2): ?>
                        <i class="fas fa-check"></i>
                    <?php else: ?>
                        2
                    <?php endif; ?>
                </div>
                <div class="step-label">Detail Alamat</div>
            </div>
            <div class="step-item <?php echo e($tahap_form ?? 0 >= 3 ? 'active' : ''); ?>">
                <div class="step-circle">3</div>
                <div class="step-label">Data Orang Tua</div>
            </div>
        </div>

        <!-- Form -->
        <form id="multiStepForm" method="POST" action="<?php echo e(route('siswa.pendaftaran.store')); ?>" class="form-container">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="tahap" id="tahapInput" value="1">

            <!-- Display validation errors -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
                    <strong>⚠️ Terjadi Kesalahan!</strong>
                    <ul style="margin-bottom: 0; margin-top: 10px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Tahap 1: Biodata Siswa -->
            <div class="form-section active" id="tahap1">
                <h2 class="form-title">Biodata Siswa</h2>
                <p class="form-subtitle">Lengkapi data diri Anda dengan informasi yang akurat dan jelas</p>

                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <strong>Panduan:</strong> Pastikan semua data sesuai dengan dokumen resmi Anda
                </div>

                <!-- Gelombang Selection (Auto-filled, tidak bisa diubah) -->
                <div class="form-group">
                    <label>Gelombang Pendaftaran *</label>
                    <div style="padding: 12px 15px; background: #f0f7ff; border: 2px solid #667eea; border-radius: 8px; color: #333; font-weight: 500;">
                        <i class="fas fa-graduation-cap" style="color: #667eea;"></i>
                        <?php echo e($gelombang->nama_gelombang ?? 'Gelombang Pendaftaran'); ?>

                        <span style="color: #666; font-size: 12px; margin-left: 10px;">(Kuota: <?php echo e($gelombang->kuota ?? 'N/A'); ?>)</span>
                    </div>
                    <!-- Hidden input untuk submit -->
                    <input type="hidden" id="id_gelombang" name="id_gelombang" value="<?php echo e($gelombang->id); ?>">
                    <small style="color: #666; display: block; margin-top: 8px;">Gelombang sudah ditentukan oleh sistem</small>
                </div>

                <!-- Nama Lengkap & NISN -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('nama_lengkap', $data->nama_lengkap ?? '')); ?>" required>
                            <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NISN *</label>
                            <input type="text" name="nisn" id="nisn" class="form-control <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('nisn', $data->nisn ?? '')); ?>" required>
                            <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- NIK -->
                <div class="form-group">
                    <label for="nik">NIK (Nomor Induk Kependudukan) *</label>
                    <input type="text" name="nik" id="nik" class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('nik', $data->nik ?? '')); ?>" maxlength="16" required>
                    <span class="form-text">16 digit NIK dari KTP atau KK</span>
                    <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Tempat & Tanggal Lahir -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('tempat_lahir', $data->tempat_lahir ?? '')); ?>" required>
                            <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('tanggal_lahir', $data->tanggal_lahir ?? '')); ?>" required>
                            <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Jenis Kelamin & Agama -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin *</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" <?php echo e(old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                                <option value="Perempuan" <?php echo e(old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                            </select>
                            <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama">Agama *</label>
                            <select name="agama" id="agama" class="form-control <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- Pilih --</option>
                                <option value="Islam" <?php echo e(old('agama', $data->agama ?? '') == 'Islam' ? 'selected' : ''); ?>>Islam</option>
                                <option value="Kristen" <?php echo e(old('agama', $data->agama ?? '') == 'Kristen' ? 'selected' : ''); ?>>Kristen</option>
                                <option value="Katolik" <?php echo e(old('agama', $data->agama ?? '') == 'Katolik' ? 'selected' : ''); ?>>Katolik</option>
                                <option value="Hindu" <?php echo e(old('agama', $data->agama ?? '') == 'Hindu' ? 'selected' : ''); ?>>Hindu</option>
                                <option value="Buddha" <?php echo e(old('agama', $data->agama ?? '') == 'Buddha' ? 'selected' : ''); ?>>Buddha</option>
                                <option value="Konghucu" <?php echo e(old('agama', $data->agama ?? '') == 'Konghucu' ? 'selected' : ''); ?>>Konghucu</option>
                            </select>
                            <?php $__errorArgs = ['agama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Berat & Tinggi Badan -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="berat_badan">Berat Badan (kg) *</label>
                            <input type="number" name="berat_badan" id="berat_badan" step="0.01" min="20" max="200" class="form-control <?php $__errorArgs = ['berat_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('berat_badan', $data->berat_badan ?? '')); ?>" required>
                            <?php $__errorArgs = ['berat_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tinggi_badan">Tinggi Badan (cm) *</label>
                            <input type="number" name="tinggi_badan" id="tinggi_badan" step="0.01" min="100" max="220" class="form-control <?php $__errorArgs = ['tinggi_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('tinggi_badan', $data->tinggi_badan ?? '')); ?>" required>
                            <?php $__errorArgs = ['tinggi_badan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Asal Sekolah -->
                <div class="form-group">
                    <label for="asal_sekolah">Asal Sekolah *</label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control <?php $__errorArgs = ['asal_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('asal_sekolah', $data->asal_sekolah ?? '')); ?>" required>
                    <?php $__errorArgs = ['asal_sekolah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- No HP & No WA -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp">No. HP *</label>
                            <input type="tel" name="no_hp" id="no_hp" class="form-control <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('no_hp', $data->no_hp ?? '')); ?>" required>
                            <span class="form-text">Contoh: 08123456789</span>
                            <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_wa">No. WhatsApp *</label>
                            <input type="tel" name="no_wa" id="no_wa" class="form-control <?php $__errorArgs = ['no_wa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('no_wa', $data->no_wa ?? '')); ?>" required>
                            <span class="form-text">Contoh: 08123456789</span>
                            <?php $__errorArgs = ['no_wa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Jurusan -->
                <div class="form-group">
                    <label for="jurusan">Pilih Jurusan *</label>
                    <select name="jurusan" id="jurusan" class="form-control <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required onchange="updateRincianPembayaran()">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="RPL" <?php echo e(old('jurusan', $data->jurusan ?? '') == 'RPL' ? 'selected' : ''); ?>>
                            RPL (Rekayasa Perangkat Lunak)
                        </option>
                        <option value="TPM" <?php echo e(old('jurusan', $data->jurusan ?? '') == 'TPM' ? 'selected' : ''); ?>>
                            TPM (Teknik Pemesinan)
                        </option>
                        <option value="TITL" <?php echo e(old('jurusan', $data->jurusan ?? '') == 'TITL' ? 'selected' : ''); ?>>
                            TITL (Teknik Instalasi Tenaga Listrik)
                        </option>
                        <option value="TKR" <?php echo e(old('jurusan', $data->jurusan ?? '') == 'TKR' ? 'selected' : ''); ?>>
                            TKR (Teknik Kendaraan Ringan)
                        </option>
                    </select>
                    <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Preview Rincian Pembayaran -->
                <div id="rincianPembayaranContainer" style="display: none; margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #f0f7ff 0%, #e8f4f8 100%); border-radius: 12px; border-left: 4px solid #667eea;">
                    <h5 style="margin-bottom: 15px; color: #333; font-weight: 700;">
                        <i class="fas fa-receipt" style="color: #667eea; margin-right: 8px;"></i>Rincian Biaya Pendaftaran
                    </h5>
                    <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                        <span style="color: #666;">Biaya Pendaftaran:</span>
                        <span style="font-weight: 600; color: #333;" id="hargaJurusanDisplay">Rp 0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                        <span style="color: #666;">Diskon/Potongan Gelombang:</span>
                        <span style="font-weight: 600; color: #dc3545;" id="potonganDisplay">- Rp 0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                        <span style="color: #333; font-weight: 700; font-size: 1.05rem;">Total yang Harus Dibayar:</span>
                        <span style="font-weight: 700; color: #667eea; font-size: 1.1rem;" id="totalBayarDisplay">Rp 0</span>
                    </div>
                    <div style="margin-top: 12px; padding: 10px; background: #fffacd; border-radius: 6px; font-size: 0.9rem; color: #666;">
                        <i class="fas fa-info-circle" style="color: #ffc107;"></i>
                        Pembayaran dapat dilakukan setelah pendaftaran selesai
                    </div>
                </div>

                <!-- Navigation -->
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(1)">
                        Lanjutkan <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <!-- Tahap 2: Detail Alamat -->
            <div class="form-section" id="tahap2">
                <h2 class="form-title">Detail Alamat</h2>
                <p class="form-subtitle">Masukkan alamat lengkap Anda saat ini</p>

                <div class="info-box">
                    <i class="fas fa-map-marker-alt"></i>
                    <strong>Alamat Domisili:</strong> Gunakan alamat tempat tinggal Anda saat ini
                </div>

                <!-- Provinsi & Kabupaten -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi *</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('provinsi', $data->provinsi ?? '')); ?>" required>
                            <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten / Kota *</label>
                            <input type="text" name="kabupaten" id="kabupaten" class="form-control <?php $__errorArgs = ['kabupaten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('kabupaten', $data->kabupaten ?? '')); ?>" required>
                            <?php $__errorArgs = ['kabupaten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Kecamatan & Kelurahan -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan *</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('kecamatan', $data->kecamatan ?? '')); ?>" required>
                            <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan / Desa *</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('kelurahan', $data->kelurahan ?? '')); ?>" required>
                            <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Kode Pos & RT/RW -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos *</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control <?php $__errorArgs = ['kode_pos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('kode_pos', $data->kode_pos ?? '')); ?>" maxlength="5" required>
                            <?php $__errorArgs = ['kode_pos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rt_rw">RT / RW</label>
                            <input type="text" name="rt_rw" id="rt_rw" class="form-control <?php $__errorArgs = ['rt_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   value="<?php echo e(old('rt_rw', $data->rt_rw ?? '')); ?>" placeholder="Contoh: 001/002">
                            <span class="form-text">Contoh format: 001/002</span>
                            <?php $__errorArgs = ['rt_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Alamat Lengkap -->
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap *</label>
                    <textarea name="alamat" id="alamat" class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required><?php echo e(old('alamat', $data->alamat ?? '')); ?></textarea>
                    <span class="form-text">Deskripsikan alamat dengan detail dan jelas</span>
                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Navigation -->
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                        Lanjutkan <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            <!-- Tahap 3: Data Orang Tua -->
            <div class="form-section" id="tahap3">
                <h2 class="form-title">Data Orang Tua / Wali</h2>
                <p class="form-subtitle">Lengkapi data orang tua atau wali Anda</p>

                <!-- Status Keluarga Selection -->
                <div class="form-group">
                    <label for="status_keluarga">Status Keluarga *</label>
                    <select name="status_keluarga" id="status_keluarga" class="form-control <?php $__errorArgs = ['status_keluarga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required onchange="toggleFamilyFields()">
                        <option value="">-- Pilih Status --</option>
                        <option value="ayah_ibu" <?php echo e(old('status_keluarga', $data->status_keluarga ?? '') == 'ayah_ibu' ? 'selected' : ''); ?>>
                            Orang Tua Lengkap (Ayah & Ibu)
                        </option>
                        <option value="yatim" <?php echo e(old('status_keluarga', $data->status_keluarga ?? '') == 'yatim' ? 'selected' : ''); ?>>
                            Yatim (Ayah Meninggal) - Ada Wali
                        </option>
                        <option value="piatu" <?php echo e(old('status_keluarga', $data->status_keluarga ?? '') == 'piatu' ? 'selected' : ''); ?>>
                            Piatu (Ibu Meninggal) - Ada Wali
                        </option>
                        <option value="yatim_piatu" <?php echo e(old('status_keluarga', $data->status_keluarga ?? '') == 'yatim_piatu' ? 'selected' : ''); ?>>
                            Yatim Piatu (Kedua Orang Tua Meninggal) - Ada Wali
                        </option>
                    </select>
                    <?php $__errorArgs = ['status_keluarga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Data Orang Tua (for lengkap status) -->
                <div id="orangtuaSection" class="conditional-group show">
                    <div class="info-box">
                        <i class="fas fa-users"></i>
                        <strong>Data Orang Tua:</strong> Isi data ayah dan ibu biologis Anda
                    </div>

                    <!-- Data Ayah -->
                    <div class="form-group">
                        <h4 style="color: var(--primary-dark); margin-top: 20px; margin-bottom: 15px;">
                            <i class="fas fa-user-tie" style="color: var(--primary);"></i> Data Ayah
                        </h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah *</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control <?php $__errorArgs = ['nama_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('nama_ayah', $data->nama_ayah ?? '')); ?>">
                                <?php $__errorArgs = ['nama_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_ayah">Tempat Lahir Ayah *</label>
                                <input type="text" name="tempat_lahir_ayah" id="tempat_lahir_ayah" class="form-control <?php $__errorArgs = ['tempat_lahir_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('tempat_lahir_ayah', $data->tempat_lahir_ayah ?? '')); ?>">
                                <?php $__errorArgs = ['tempat_lahir_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah *</label>
                                <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" class="form-control <?php $__errorArgs = ['tanggal_lahir_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('tanggal_lahir_ayah', $data->tanggal_lahir_ayah ?? '')); ?>">
                                <?php $__errorArgs = ['tanggal_lahir_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_ayah">Pendidikan Ayah *</label>
                                <select name="pendidikan_ayah" id="pendidikan_ayah" class="form-control <?php $__errorArgs = ['pendidikan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih --</option>
                                    <option value="SD" <?php echo e(old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'SD' ? 'selected' : ''); ?>>SD</option>
                                    <option value="SMP" <?php echo e(old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'SMP' ? 'selected' : ''); ?>>SMP</option>
                                    <option value="SMA/SMK" <?php echo e(old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'SMA/SMK' ? 'selected' : ''); ?>>SMA/SMK</option>
                                    <option value="Diploma" <?php echo e(old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'Diploma' ? 'selected' : ''); ?>>Diploma</option>
                                    <option value="Sarjana" <?php echo e(old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'Sarjana' ? 'selected' : ''); ?>>Sarjana</option>
                                    <option value="Pasca Sarjana" <?php echo e(old('pendidikan_ayah', $data->pendidikan_ayah ?? '') == 'Pasca Sarjana' ? 'selected' : ''); ?>>Pasca Sarjana</option>
                                </select>
                                <?php $__errorArgs = ['pendidikan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ayah">Pekerjaan Ayah *</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control <?php $__errorArgs = ['pekerjaan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('pekerjaan_ayah', $data->pekerjaan_ayah ?? '')); ?>">
                                <?php $__errorArgs = ['pekerjaan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penghasilan_ayah">Penghasilan Ayah per Bulan *</label>
                                <select name="penghasilan_ayah" id="penghasilan_ayah" class="form-control <?php $__errorArgs = ['penghasilan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih Rentang Penghasilan --</option>
                                    <option value="Kurang dari Rp 1.000.000" <?php echo e(old('penghasilan_ayah', $data->penghasilan_ayah ?? '') == 'Kurang dari Rp 1.000.000' ? 'selected' : ''); ?>>Kurang dari Rp 1.000.000</option>
                                    <option value="Rp 1.000.000 - Rp 2.500.000" <?php echo e(old('penghasilan_ayah', $data->penghasilan_ayah ?? '') == 'Rp 1.000.000 - Rp 2.500.000' ? 'selected' : ''); ?>>Rp 1.000.000 - Rp 2.500.000</option>
                                    <option value="Rp 2.500.000 - Rp 5.000.000" <?php echo e(old('penghasilan_ayah', $data->penghasilan_ayah ?? '') == 'Rp 2.500.000 - Rp 5.000.000' ? 'selected' : ''); ?>>Rp 2.500.000 - Rp 5.000.000</option>
                                    <option value="Rp 5.000.000 - Rp 10.000.000" <?php echo e(old('penghasilan_ayah', $data->penghasilan_ayah ?? '') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : ''); ?>>Rp 5.000.000 - Rp 10.000.000</option>
                                    <option value="Lebih dari Rp 10.000.000" <?php echo e(old('penghasilan_ayah', $data->penghasilan_ayah ?? '') == 'Lebih dari Rp 10.000.000' ? 'selected' : ''); ?>>Lebih dari Rp 10.000.000</option>
                                </select>
                                <?php $__errorArgs = ['penghasilan_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="no_hp_ayah">No. HP Ayah *</label>
                                <input type="tel" name="no_hp_ayah" id="no_hp_ayah" class="form-control <?php $__errorArgs = ['no_hp_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('no_hp_ayah', $data->no_hp_ayah ?? '')); ?>">
                                <?php $__errorArgs = ['no_hp_ayah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="form-group">
                        <h4 style="color: var(--primary-dark); margin-top: 30px; margin-bottom: 15px;">
                            <i class="fas fa-user-tie" style="color: var(--primary);"></i> Data Ibu
                        </h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu *</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control <?php $__errorArgs = ['nama_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('nama_ibu', $data->nama_ibu ?? '')); ?>">
                                <?php $__errorArgs = ['nama_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_ibu">Tempat Lahir Ibu *</label>
                                <input type="text" name="tempat_lahir_ibu" id="tempat_lahir_ibu" class="form-control <?php $__errorArgs = ['tempat_lahir_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('tempat_lahir_ibu', $data->tempat_lahir_ibu ?? '')); ?>">
                                <?php $__errorArgs = ['tempat_lahir_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu *</label>
                                <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" class="form-control <?php $__errorArgs = ['tanggal_lahir_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('tanggal_lahir_ibu', $data->tanggal_lahir_ibu ?? '')); ?>">
                                <?php $__errorArgs = ['tanggal_lahir_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_ibu">Pendidikan Ibu *</label>
                                <select name="pendidikan_ibu" id="pendidikan_ibu" class="form-control <?php $__errorArgs = ['pendidikan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih --</option>
                                    <option value="SD" <?php echo e(old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'SD' ? 'selected' : ''); ?>>SD</option>
                                    <option value="SMP" <?php echo e(old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'SMP' ? 'selected' : ''); ?>>SMP</option>
                                    <option value="SMA/SMK" <?php echo e(old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'SMA/SMK' ? 'selected' : ''); ?>>SMA/SMK</option>
                                    <option value="Diploma" <?php echo e(old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'Diploma' ? 'selected' : ''); ?>>Diploma</option>
                                    <option value="Sarjana" <?php echo e(old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'Sarjana' ? 'selected' : ''); ?>>Sarjana</option>
                                    <option value="Pasca Sarjana" <?php echo e(old('pendidikan_ibu', $data->pendidikan_ibu ?? '') == 'Pasca Sarjana' ? 'selected' : ''); ?>>Pasca Sarjana</option>
                                </select>
                                <?php $__errorArgs = ['pendidikan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_ibu">Pekerjaan Ibu *</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control <?php $__errorArgs = ['pekerjaan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('pekerjaan_ibu', $data->pekerjaan_ibu ?? '')); ?>">
                                <?php $__errorArgs = ['pekerjaan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penghasilan_ibu">Penghasilan Ibu per Bulan *</label>
                                <select name="penghasilan_ibu" id="penghasilan_ibu" class="form-control <?php $__errorArgs = ['penghasilan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih Rentang Penghasilan --</option>
                                    <option value="Kurang dari Rp 1.000.000" <?php echo e(old('penghasilan_ibu', $data->penghasilan_ibu ?? '') == 'Kurang dari Rp 1.000.000' ? 'selected' : ''); ?>>Kurang dari Rp 1.000.000</option>
                                    <option value="Rp 1.000.000 - Rp 2.500.000" <?php echo e(old('penghasilan_ibu', $data->penghasilan_ibu ?? '') == 'Rp 1.000.000 - Rp 2.500.000' ? 'selected' : ''); ?>>Rp 1.000.000 - Rp 2.500.000</option>
                                    <option value="Rp 2.500.000 - Rp 5.000.000" <?php echo e(old('penghasilan_ibu', $data->penghasilan_ibu ?? '') == 'Rp 2.500.000 - Rp 5.000.000' ? 'selected' : ''); ?>>Rp 2.500.000 - Rp 5.000.000</option>
                                    <option value="Rp 5.000.000 - Rp 10.000.000" <?php echo e(old('penghasilan_ibu', $data->penghasilan_ibu ?? '') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : ''); ?>>Rp 5.000.000 - Rp 10.000.000</option>
                                    <option value="Lebih dari Rp 10.000.000" <?php echo e(old('penghasilan_ibu', $data->penghasilan_ibu ?? '') == 'Lebih dari Rp 10.000.000' ? 'selected' : ''); ?>>Lebih dari Rp 10.000.000</option>
                                </select>
                                <?php $__errorArgs = ['penghasilan_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="no_hp_ibu">No. HP Ibu *</label>
                                <input type="tel" name="no_hp_ibu" id="no_hp_ibu" class="form-control <?php $__errorArgs = ['no_hp_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('no_hp_ibu', $data->no_hp_ibu ?? '')); ?>">
                                <?php $__errorArgs = ['no_hp_ibu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Wali (for yatim/piatu status) -->
                <div id="waliSection" class="conditional-group">
                    <div class="info-box danger" style="background: #fff5f5; border-color: var(--danger);">
                        <i class="fas fa-user-shield" style="color: var(--danger);"></i>
                        <strong>Data Wali:</strong> Masukkan data wali atau penjaga Anda
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_wali">Nama Wali *</label>
                                <input type="text" name="nama_wali" id="nama_wali" class="form-control <?php $__errorArgs = ['nama_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('nama_wali', $data->nama_wali ?? '')); ?>">
                                <?php $__errorArgs = ['nama_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_wali">Tempat Lahir Wali *</label>
                                <input type="text" name="tempat_lahir_wali" id="tempat_lahir_wali" class="form-control <?php $__errorArgs = ['tempat_lahir_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('tempat_lahir_wali', $data->tempat_lahir_wali ?? '')); ?>">
                                <?php $__errorArgs = ['tempat_lahir_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_wali">Tanggal Lahir Wali *</label>
                                <input type="date" name="tanggal_lahir_wali" id="tanggal_lahir_wali" class="form-control <?php $__errorArgs = ['tanggal_lahir_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('tanggal_lahir_wali', $data->tanggal_lahir_wali ?? '')); ?>">
                                <?php $__errorArgs = ['tanggal_lahir_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_wali">Pendidikan Terakhir Wali *</label>
                                <select name="pendidikan_wali" id="pendidikan_wali" class="form-control <?php $__errorArgs = ['pendidikan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                    <option value="Tidak Sekolah" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'Tidak Sekolah' ? 'selected' : ''); ?>>Tidak Sekolah</option>
                                    <option value="SD" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'SD' ? 'selected' : ''); ?>>SD</option>
                                    <option value="SMP" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'SMP' ? 'selected' : ''); ?>>SMP</option>
                                    <option value="SMA/SMK" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'SMA/SMK' ? 'selected' : ''); ?>>SMA/SMK</option>
                                    <option value="Diploma" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'Diploma' ? 'selected' : ''); ?>>Diploma</option>
                                    <option value="Sarjana" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'Sarjana' ? 'selected' : ''); ?>>Sarjana</option>
                                    <option value="Magister" <?php echo e(old('pendidikan_wali', $data->pendidikan_wali ?? '') == 'Magister' ? 'selected' : ''); ?>>Magister</option>
                                </select>
                                <?php $__errorArgs = ['pendidikan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan_wali">Pekerjaan Wali *</label>
                                <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control <?php $__errorArgs = ['pekerjaan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       value="<?php echo e(old('pekerjaan_wali', $data->pekerjaan_wali ?? '')); ?>">
                                <?php $__errorArgs = ['pekerjaan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penghasilan_wali">Penghasilan Wali per Bulan *</label>
                                <select name="penghasilan_wali" id="penghasilan_wali" class="form-control <?php $__errorArgs = ['penghasilan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih Rentang Penghasilan --</option>
                                    <option value="Kurang dari Rp 1.000.000" <?php echo e(old('penghasilan_wali', $data->penghasilan_wali ?? '') == 'Kurang dari Rp 1.000.000' ? 'selected' : ''); ?>>Kurang dari Rp 1.000.000</option>
                                    <option value="Rp 1.000.000 - Rp 2.500.000" <?php echo e(old('penghasilan_wali', $data->penghasilan_wali ?? '') == 'Rp 1.000.000 - Rp 2.500.000' ? 'selected' : ''); ?>>Rp 1.000.000 - Rp 2.500.000</option>
                                    <option value="Rp 2.500.000 - Rp 5.000.000" <?php echo e(old('penghasilan_wali', $data->penghasilan_wali ?? '') == 'Rp 2.500.000 - Rp 5.000.000' ? 'selected' : ''); ?>>Rp 2.500.000 - Rp 5.000.000</option>
                                    <option value="Rp 5.000.000 - Rp 10.000.000" <?php echo e(old('penghasilan_wali', $data->penghasilan_wali ?? '') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : ''); ?>>Rp 5.000.000 - Rp 10.000.000</option>
                                    <option value="Lebih dari Rp 10.000.000" <?php echo e(old('penghasilan_wali', $data->penghasilan_wali ?? '') == 'Lebih dari Rp 10.000.000' ? 'selected' : ''); ?>>Lebih dari Rp 10.000.000</option>
                                </select>
                                <?php $__errorArgs = ['penghasilan_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_hp_wali">No. HP Wali *</label>
                        <input type="tel" name="no_hp_wali" id="no_hp_wali" class="form-control <?php $__errorArgs = ['no_hp_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('no_hp_wali', $data->no_hp_wali ?? '')); ?>">
                        <?php $__errorArgs = ['no_hp_wali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="button-group" style="margin-top: 50px;">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(3)">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn" onclick="submitForm(event)">
                        <i class="fas fa-check"></i> Selesaikan Pendaftaran
                    </button>
                    <div id="submitStatus" style="margin-top: 10px; font-weight: bold;"></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
let currentStep = 1;

// Harga jurusan
// Harga jurusan dari Controller
const hargaJurusan = <?php echo json_encode($hargaJurusan, 15, 512) ?>;

// Format Rupiah
function formatRupiah(angka) {
    return 'Rp ' + angka.toLocaleString('id-ID');
}

// Submit form handler - visible to onclick
function submitForm(e) {
    e.preventDefault();
    const statusDiv = document.getElementById('submitStatus');
    const formElement = document.getElementById('multiStepForm');
    const submitBtn = document.getElementById('submitBtn');
    const status = document.getElementById('status_keluarga').value;
    
    if (!statusDiv) {
        console.error('submitStatus div not found');
        return;
    }

    // Clear fields yang tidak digunakan sebelum submit
    if (status === 'ayah_ibu') {
        // Clear wali fields
        document.querySelectorAll('#waliSection input, #waliSection select, #waliSection textarea').forEach(el => {
            el.value = '';
        });
    } else {
        // Clear orang tua fields
        document.querySelectorAll('#orangtuaSection input, #orangtuaSection select, #orangtuaSection textarea').forEach(el => {
            el.value = '';
        });
    }
    
    statusDiv.innerHTML = '<span style="color: #667eea;">⏳ Mengirim data...</span>';
    submitBtn.disabled = true;
    
    // Set tahap to 3
    document.getElementById('tahapInput').value = 3;
    
    // Give browser a moment then submit
    setTimeout(() => {
        if (formElement) {
            console.log('Submitting form...');
            formElement.submit();
        } else {
            statusDiv.innerHTML = '<span style="color: red;">❌ Error: Form tidak ditemukan</span>';
        }
    }, 300);
}

function showStep(step) {
    // Hide all sections
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show current section
    document.getElementById(`tahap${step}`).classList.add('active');

    // Update tahap input
    document.getElementById('tahapInput').value = step;

    // Update step indicator
    updateStepIndicator(step);

    // Scroll to top
    document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function updateStepIndicator(step) {
    document.querySelectorAll('.step-item').forEach((item, index) => {
        item.classList.remove('active', 'completed');
        if (index + 1 < step) {
            item.classList.add('completed');
        } else if (index + 1 === step) {
            item.classList.add('active');
        }
    });
}

function updateRincianPembayaran() {
    const jurusan = document.getElementById('jurusan').value;
    const gelombang = document.getElementById('id_gelombang').value;
    const container = document.getElementById('rincianPembayaranContainer');
    
    if (!jurusan) {
        container.style.display = 'none';
        return;
    }

    const harga = hargaJurusan[jurusan] || 0;
    let potongan = 0;

    // Fetch potongan dari gelombang jika dipilih
    if (gelombang) {
        const url = `/siswa/pendaftaran/gelombang/${gelombang}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                potongan = data.potongan || 0;
                const totalBayar = Math.max(harga - potongan, 0);

                document.getElementById('hargaJurusanDisplay').textContent = formatRupiah(harga);
                document.getElementById('potonganDisplay').textContent = potongan > 0 ? '- ' + formatRupiah(potongan) : '- Rp 0';
                document.getElementById('totalBayarDisplay').textContent = formatRupiah(totalBayar);

                container.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching gelombang data:', error);
                // Fallback jika error
                const totalBayar = Math.max(harga - potongan, 0);
                document.getElementById('hargaJurusanDisplay').textContent = formatRupiah(harga);
                document.getElementById('potonganDisplay').textContent = potongan > 0 ? '- ' + formatRupiah(potongan) : '- Rp 0';
                document.getElementById('totalBayarDisplay').textContent = formatRupiah(totalBayar);
                container.style.display = 'block';
            });
    } else {
        // Jika gelombang belum dipilih, tampilkan tanpa potongan
        const totalBayar = Math.max(harga - potongan, 0);
        document.getElementById('hargaJurusanDisplay').textContent = formatRupiah(harga);
        document.getElementById('potonganDisplay').textContent = '- Rp 0';
        document.getElementById('totalBayarDisplay').textContent = formatRupiah(totalBayar);
        container.style.display = 'block';
    }
}

function nextStep(step) {
    // Validate current step before moving next
    const form = document.getElementById('multiStepForm');
    
    // Collect form data for validation
    if (step === 1) {
        if (!validateTahap1()) {
            alert('Silakan lengkapi semua field yang wajib diisi');
            return;
        }
        currentStep = 2;
    } else if (step === 2) {
        if (!validateTahap2()) {
            alert('Silakan lengkapi semua field yang wajib diisi');
            return;
        }
        currentStep = 3;
    }

    showStep(currentStep);
}

function prevStep(step) {
    currentStep = Math.max(1, step - 1);
    showStep(currentStep);
}

function toggleFamilyFields() {
    const status = document.getElementById('status_keluarga').value;
    const orangtuaSection = document.getElementById('orangtuaSection');
    const waliSection = document.getElementById('waliSection');

    if (status === 'ayah_ibu') {
        // Show orang tua, hide wali
        orangtuaSection.classList.add('show');
        waliSection.classList.remove('show');
    } else {
        // Hide orang tua, show wali
        orangtuaSection.classList.remove('show');
        waliSection.classList.add('show');
    }
}

function validateTahap1() {
    const fields = [
        'id_gelombang', 'nama_lengkap', 'nisn', 'nik', 'tempat_lahir',
        'tanggal_lahir', 'jenis_kelamin', 'agama', 'berat_badan', 'tinggi_badan',
        'asal_sekolah', 'no_hp', 'no_wa', 'jurusan'
    ];

    for (let field of fields) {
        const element = document.getElementById(field);
        if (!element.value.trim()) {
            element.focus();
            return false;
        }
    }

    // Validate NISN format (should be 10 digits)
    if (!/^\d{10}$/.test(document.getElementById('nisn').value)) {
        alert('NISN harus berisi 10 digit angka');
        return false;
    }

    // Validate NIK format (should be 16 digits)
    if (!/^\d{16}$/.test(document.getElementById('nik').value)) {
        alert('NIK harus berisi 16 digit angka');
        return false;
    }

    return true;
}

function validateTahap2() {
    const fields = ['alamat', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'kode_pos'];

    for (let field of fields) {
        const element = document.getElementById(field);
        if (!element.value.trim()) {
            element.focus();
            return false;
        }
    }

    // Validate kode pos format (5 digits)
    if (!/^\d{5}$/.test(document.getElementById('kode_pos').value)) {
        alert('Kode pos harus berisi 5 digit angka');
        return false;
    }

    return true;
}

function validateTahap3() {
    const status = document.getElementById('status_keluarga').value;
    
    console.log('Validating Tahap 3 - Status:', status);
    
    if (!status) {
        alert('Pilih status keluarga terlebih dahulu');
        return false;
    }

    if (status === 'lengkap') {
        // Validate orang tua fields
        const fields = ['nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'pendidikan_ayah', 
                       'pekerjaan_ayah', 'penghasilan_ayah', 'no_hp_ayah',
                       'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'pendidikan_ibu', 
                       'pekerjaan_ibu', 'penghasilan_ibu', 'no_hp_ibu'];
        
        for (let field of fields) {
            const element = document.getElementById(field);
            if (!element) {
                console.error('Element not found:', field);
                alert('Field tidak ditemukan: ' + field);
                return false;
            }
            if (!element.value || element.value.trim() === '') {
                console.warn('Field empty:', field);
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                element.focus();
                alert('Silakan isi: ' + field.replace(/_/g, ' '));
                return false;
            }
        }
    } else {
        // Validate wali fields
        const fields = ['nama_wali', 'tempat_lahir_wali', 'tanggal_lahir_wali', 
                       'pekerjaan_wali', 'penghasilan_wali', 'no_hp_wali'];
        
        for (let field of fields) {
            const element = document.getElementById(field);
            if (!element) {
                console.error('Element not found:', field);
                alert('Field tidak ditemukan: ' + field);
                return false;
            }
            if (!element.value || element.value.trim() === '') {
                console.warn('Field empty:', field);
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                element.focus();
                alert('Silakan isi: ' + field.replace(/_/g, ' '));
                return false;
            }
        }
    }

    console.log('Tahap 3 validation passed!');
    return true;
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    showStep(1);
    toggleFamilyFields();

    // Add event listeners untuk gelombang dan jurusan
    const gelombangSelect = document.getElementById('id_gelombang');
    const jurusanSelect = document.getElementById('jurusan');
    
    if (gelombangSelect) {
        gelombangSelect.addEventListener('change', updateRincianPembayaran);
    }
    if (jurusanSelect) {
        jurusanSelect.addEventListener('change', updateRincianPembayaran);
    }

    // Form submit handler - SET TAHAP TO 3 AND SUBMIT (already handled by submitForm() function above)
    const formElement = document.getElementById('multiStepForm');
    const submitBtn = document.getElementById('submitBtn');
    
    console.log('Form loaded - form element:', formElement !== null, 'submit button:', submitBtn !== null);
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\UKK_BEDOK_PPDB2\resources\views/siswa/pendaftaran/create-multistep.blade.php ENDPATH**/ ?>