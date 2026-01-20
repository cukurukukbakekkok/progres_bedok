<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    }

    .page-wrapper {
        padding: 60px 0;
    }

    .hero-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 0;
        border-radius: 20px;
        margin-bottom: 50px;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(102, 126, 234, 0.25);
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-banner h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .hero-banner p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 0;
    }

    .breadcrumb-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        margin-bottom: 30px;
    }

    .breadcrumb-link:hover {
        color: #764ba2;
        transform: translateX(-5px);
    }

    .pengumuman-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .pengumuman-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }

    .pengumuman-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
    }

    .card-top-border {
        height: 6px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .card-body {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-date {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.1) 100%);
        color: #667eea;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        width: fit-content;
        margin-bottom: 16px;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        line-height: 1.4;
        min-height: 60px;
    }

    .card-excerpt {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
        min-height: 70px;
    }

    .card-footer {
        display: flex;
        align-items: center;
        color: #667eea;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .card-footer::after {
        content: '→';
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .pengumuman-card:hover .card-footer {
        transform: translateX(5px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .empty-state-text {
        font-size: 1.2rem;
        color: #999;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 14px 32px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 40px;
    }

    .btn-gradient-primary:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    @media (max-width: 768px) {
        .hero-banner {
            padding: 50px 20px;
        }
        .hero-banner h1 {
            font-size: 2rem;
        }
        .pengumuman-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <!-- Breadcrumb removed -->

        <!-- Hero Banner -->
        <div class="hero-banner">
            <div class="hero-content">
                <h1>📢 Semua Pengumuman</h1>
                <p>Pantau informasi terbaru dan perkembangan penting dari sekolah kami</p>
            </div>
        </div>

        <!-- Content -->
        <?php if($pengumuman->count() > 0): ?>
            <div class="pengumuman-grid">
                <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('pengumuman.public.show', $item->id)); ?>" class="pengumuman-card">
                    <div class="card-top-border"></div>
                    <div class="card-body">
                        <span class="card-date"><?php echo e($item->tanggal_post->format('d M Y')); ?></span>
                        <h3 class="card-title"><?php echo e($item->judul); ?></h3>
                        <p class="card-excerpt"><?php echo e(Str::limit($item->isi, 150, '...')); ?></p>
                        <div class="card-footer">Baca Selengkapnya</div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <?php if($pengumuman->hasPages()): ?>
            <div class="pagination-wrapper">
                <?php echo e($pengumuman->links('pagination::bootstrap-5')); ?>

            </div>
            <?php endif; ?>

            <div class="text-center" style="margin-top: 40px;">
                <a href="<?php echo e(route('welcome')); ?>" class="btn-gradient-primary">
                    ← Kembali ke Beranda
                </a>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <p class="empty-state-text">Belum ada pengumuman untuk ditampilkan saat ini</p>
                <a href="<?php echo e(route('welcome')); ?>" class="btn-gradient-primary">Kembali ke Beranda</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/pengumuman/index.blade.php ENDPATH**/ ?>