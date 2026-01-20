<?php $__env->startSection('title', 'Dashboard PPDB'); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .dashboard-wrapper {
            padding: 30px 0;
            min-height: 100vh;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            position: relative;
            z-index: 1;
        }
        
        .admin-navbar-v2 { 
            border-bottom: 4px solid rgba(255,255,255,.25); 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.10);
            transition: 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.18);
        }

        .btn-modern {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            color: #fff;
            transition: 0.3s;
            border: none;
        }
        .btn-modern:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 22px rgba(0,0,0,0.25);
        }

        .btn-calon { background: linear-gradient(135deg, #007bff, #00c6ff); }
        .btn-pengumuman { background: linear-gradient(135deg, #28a745, #7dff88); }
        
        .list-group-item {
            border-radius: 10px;
            margin-bottom: 8px;
            transition: 0.25s;
        }
        .list-group-item:hover {
            background: #f1f8ff;
            transform: translateX(6px);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="dashboard-wrapper">
    <div class="dashboard-container">

        <h2 class="mb-4 fw-bold text-white">📊 Dashboard Utama</h2>

        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="card bg-info text-white p-4 text-center">
                    <h5>Total Pendaftar</h5>
                    <h1 class="fw-bold display-5"><?php echo e($totalPendaftar ?? 0); ?></h1>
                    <small>Data pendaftar aktif</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white p-4 text-center">
                    <h5>Pendaftar Lunas</h5>
                    <h1 class="fw-bold display-5"><?php echo e($lunas ?? 0); ?></h1>
                    <small>Pembayaran sudah dikonfirmasi</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-white p-4 text-center">
                    <h5>Pendaftar Menunggu</h5>
                    <h1 class="fw-bold display-5"><?php echo e($menunggu ?? 0); ?></h1>
                    <small>Pembayaran belum lengkap</small>
                </div>
            </div>

        </div>

        <!-- Buttons -->
        <div class="mb-5 d-flex gap-3">
            <a href="<?php echo e(route('admin.calon_siswa.index')); ?>" class="btn btn-modern btn-calon">
                📋 List Calon Siswa
            </a>
            <a href="<?php echo e(route('admin.gelombang.index')); ?>" class="btn btn-modern" style="background: linear-gradient(135deg, #ff7a00, #ffc857); color: #fff;">
                📆 Gelombang
            </a>
            <a href="<?php echo e(route('admin.jurusan.index')); ?>" class="btn btn-modern" style="background: linear-gradient(135deg, #6f42c1, #9f7aea); color: #fff;">
                🏫 Jurusan & Kelas
            </a>
            <a href="<?php echo e(route('admin.pengumuman.index')); ?>" class="btn btn-modern btn-pengumuman">
                📢 Kelola Pengumuman
            </a>
            <a href="<?php echo e(route('admin.promo.index')); ?>" class="btn btn-modern" style="background: linear-gradient(135deg, #e91e63, #f06292); color: #fff;">
                🏷️ Kelola Promo
            </a>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 chart-section animate__animated animate__fadeInUp">
            <!-- Jurusan Chart -->
            <div class="col-lg-8">
                <div class="card p-4 h-100 border-0 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-dark mb-0">📊 Statistik Pendaftar per Jurusan</h4>
                    </div>
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="jurusanChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Status Chart -->
            <div class="col-lg-4">
                <div class="card p-4 h-100 border-0 shadow-sm">
                    <h4 class="fw-bold text-dark mb-4">🍩 Pembayaran</h4>
                    <div style="position: relative; height: 300px; width: 100%; display: flex; justify-content: center;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <?php if(empty($jurusanLabels)): ?>
        <div class="alert alert-info mt-4">
            <i class="ti ti-info-circle me-2"></i> Belum ada data pendaftar yang dikonfirmasi. Grafik akan muncul setelah ada data masuk.
        </div>
        <?php endif; ?>

    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts_content'); ?>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Jurusan Chart
            const ctxJurusan = document.getElementById('jurusanChart').getContext('2d');
            new Chart(ctxJurusan, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($jurusanLabels, 15, 512) ?>,
                    datasets: [{
                        label: 'Jumlah Pendaftar',
                        data: <?php echo json_encode($jurusanValues, 15, 512) ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // Data for Status Chart
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            const total = <?php echo e($totalPendaftar ?? 0); ?>;
            const lunas = <?php echo e($lunas ?? 0); ?>;
            const menunggu = <?php echo e($menunggu ?? 0); ?>;
            const belum = total - lunas - menunggu; // Rough estimate or 0 if negative

            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Lunas', 'Menunggu Verifikasi', 'Belum Bayar'],
                    datasets: [{
                        data: [lunas, menunggu, (belum > 0 ? belum : 0)],
                        backgroundColor: [
                            '#198754', // Success Green
                            '#ffc107', // Warning Yellow
                            '#dc3545'  // Danger Red
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { usePointStyle: true, boxWidth: 10 }
                        }
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>