<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    .animate-card {
        opacity: 0;
        transform: scale(0.92);
        animation: fadeZoom 0.6s forwards;
    }
    @keyframes fadeZoom {
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .hero-box {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 18px;
        padding: 35px;
        color: white;
        box-shadow: 0 6px 15px rgba(6, 182, 212, 0.2);
    }
    .menu-card {
        border-radius: 18px;
        transition: 0.35s;
        border: none;
        padding: 25px;
        height: 165px;
        color: #222;
    }
    .menu-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.18);
        cursor: pointer;
    }
    .bg-blue { background: #e3f2ff; }
    .bg-orange { background: #ffe8cc; }
    .bg-green { background: #e7ffee; }
    h1, h2, h3, h4, h5 { margin: 0; }
</style>

<div class="container py-4" style="position: relative; z-index: 1;">

    
    <div class="hero-box mb-4 animate-card" style="animation-delay: .05s">
        <h2>Halo, 👋 <?php echo e(Auth::user()->nama ?? 'Siswa'); ?></h2>
        <p class="mt-2 fs-5">Selamat datang di portal <b>Pendaftaran Siswa Baru</b> SMK ANTARTIKA 1 SDA</p>
    </div>

    
    <div class="row g-4">
        <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: .15s">
            <a href="<?php echo e(url('/siswa/pendaftaran')); ?>" style="text-decoration: none;">
                <div class="menu-card bg-blue">
                    <h5 class="fw-bold mb-2">📝 Pendaftaran</h5>
                    <p>Isi formulir biodata lengkap untuk menjadi calon siswa.</p>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: .28s">
            <a href="<?php echo e(url('/siswa/dokumen')); ?>" style="text-decoration: none;">
                <div class="menu-card bg-orange">
                    <h5 class="fw-bold mb-2">📄 Dokumen Persyaratan</h5>
                    <p>Upload berkas wajib seperti KK, Ijazah, Akte.</p>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6 animate-card" style="animation-delay: .42s">
            <a href="<?php echo e(url('/siswa/pembayaran')); ?>" style="text-decoration: none;">
                <div class="menu-card bg-green">
                    <h5 class="fw-bold mb-2">💰 Pembayaran</h5>
                    <p>Lakukan pembayaran biaya pendaftaran & cetak bukti.</p>
                </div>
            </a>
        </div>
    </div>

    
    <?php
        $calon = \App\Models\CalonSiswa::where('user_id', Auth::id())->first();
    ?>


    
    
    <?php if($calon): ?>
    <div class="row mt-4 g-4 animate-card" style="animation-delay: .50s;">
        <!-- Card Kiri: Status -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-header border-0 p-4 pb-0 bg-white">
                    <h5 class="fw-bold mb-0">📊 Status Pendaftaran</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="text-muted small fw-bold mb-1 text-uppercase">Kelulusan</label>
                        <div>
                            <?php if($calon->status_kelulusan == 'Lolos'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-3 fs-6 w-100 d-block text-center">
                                    <i class="ti ti-check me-1"></i> LOLOS SELEKSI
                                </span>
                            <?php elseif($calon->status_kelulusan == 'Tidak Lolos'): ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-3 fs-6 w-100 d-block text-center">
                                    <i class="ti ti-x me-1"></i> TIDAK LOLOS
                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-3 fs-6 w-100 d-block text-center">
                                    <i class="ti ti-clock me-1"></i> MENUNGGU
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-muted small fw-bold mb-1 text-uppercase">Pembayaran</label>
                         <div>
                            <?php if(strtolower($calon->status_pembayaran) == 'lunas'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-3 w-100 d-block text-center">
                                    <i class="ti ti-check me-1"></i> LUNAS
                                </span>
                            <?php elseif(strtolower($calon->status_pembayaran) == 'menunggu'): ?>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-3 w-100 d-block text-center">
                                    <i class="ti ti-clock me-1"></i> VERIFIKASI ADMIN
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-3 w-100 d-block text-center">
                                    <i class="ti ti-alert-circle me-1"></i> BELUM BAYAR
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="text-muted small fw-bold mb-1 text-uppercase">Verifikasi Berkas</label>
                        <div>
                            <?php if($calon->status_berkas == 'Valid'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-3 w-100 d-block text-center">
                                    <i class="ti ti-check me-1"></i> VALID
                                </span>
                            <?php elseif($calon->status_berkas == 'Tidak Valid'): ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-3 w-100 d-block text-center">
                                    <i class="ti ti-ban me-1"></i> DITOLAK
                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-3 w-100 d-block text-center">
                                    <i class="ti ti-clock me-1"></i> BELUM DIVALIDASI
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($calon->status_kelulusan == 'Lolos' && strtolower($calon->status_pembayaran) == 'lunas' && $calon->is_bukti_dikirim): ?>
                    <div class="mt-4 pt-3 border-top">
                        <a href="<?php echo e(route('siswa.pendaftaran.download_bukti', $calon->id)); ?>" class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm">
                            <i class="ti ti-printer me-2 fs-4"></i> CETAK BUKTI PENERIMAAN
                        </a>
                        <p class="text-muted small text-center mt-2 mb-0">Silakan cetak sebagai bukti pendaftaran ulang.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Card Kanan: Biodata Ringkas -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header border-0 p-4 pb-0 bg-white d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">👤 Biodata Siswa</h5>
                    <a href="<?php echo e(route('siswa.pendaftaran.create')); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="ti ti-edit me-1"></i> Lihat Lengkap
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="bg-light p-3 rounded-3 h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Nama Lengkap</label>
                                <div class="fw-bold text-dark fs-6"><?php echo e($calon->nama_lengkap); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light p-3 rounded-3 h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">NISN</label>
                                <div class="fw-bold text-dark fs-6"><?php echo e($calon->nisn); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light p-3 rounded-3 h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Jurusan Pilihan</label>
                                <div class="fw-bold text-primary fs-6"><?php echo e($calon->jurusan); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light p-3 rounded-3 h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Gelombang</label>
                                <div class="fw-bold text-dark fs-6"><?php echo e($calon->gelombang?->nama ?? '-'); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light p-3 rounded-3 h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Sekolah Asal</label>
                                <div class="fw-bold text-dark fs-6"><?php echo e($calon->asal_sekolah); ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light p-3 rounded-3 h-100">
                                <label class="text-muted small text-uppercase fw-bold mb-1">Nomor HP</label>
                                <div class="fw-bold text-dark fs-6"><?php echo e($calon->no_hp); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4 animate-card rounded-4 border-0 shadow-sm p-4" style="animation-delay: .55s">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle fs-1 me-3 text-warning"></i>
                <div>
                    <h5 class="fw-bold text-dark">Belum Mendaftar?</h5>
                    <p class="mb-0">Silakan lengkapi formulir pendaftaran untuk memulai proses Penerimaan Peserta Didik Baru.</p>
                </div>
                <div class="ms-auto">
                    <a href="<?php echo e(route('siswa.pendaftaran.create')); ?>" class="btn btn-warning fw-bold px-4 py-2 rounded-pill">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\UKK_BEDOK_PPDB2\resources\views/siswa/dashboard.blade.php ENDPATH**/ ?>