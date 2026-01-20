<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    }

    .page-wrapper {
        padding-top: 40px;
        padding-bottom: 60px;
    }

    .breadcrumb {
        background: transparent;
        padding-left: 0;
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

    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 50px 40px; /* Added horizontal padding */
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.2);
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .hero-section::after {
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

    .hero-section h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .meta-info {
        display: flex;
        gap: 30px;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 25px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.2);
        padding: 12px 20px;
        border-radius: 50px;
        backdrop-filter: blur(10px);
    }

    .meta-icon {
        font-size: 1.3rem;
    }

    .meta-text {
        font-weight: 500;
        font-size: 0.95rem;
    }

    .content-card {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.1);
        margin-bottom: 40px;
    }

    .content-card h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-top: 40px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid rgba(102, 126, 234, 0.2);
    }

    .content-card h2:first-child {
        margin-top: 0;
    }

    .content-card h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #667eea;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .content-card p {
        font-size: 1.05rem;
        line-height: 2;
        color: #555;
        margin-bottom: 25px;
        text-align: justify;
        text-indent: 2em;
    }

    .content-card ul, .content-card ol {
        margin: 20px 0 20px 40px;
        line-height: 2;
    }

    .content-card li {
        margin-bottom: 15px;
        color: #555;
        font-size: 1.05rem;
        text-align: justify;
    }

    .content-card strong {
        color: #667eea;
        font-weight: 600;
    }

    .info-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-left: 5px solid #667eea;
        border-radius: 10px;
        padding: 25px;
        margin: 30px 0;
    }

    .info-box-title {
        font-weight: 700;
        color: #667eea;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .info-box-content {
        color: #555;
        line-height: 1.7;
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        flex-wrap: wrap;
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
    }

    .btn-gradient-primary:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-gradient-secondary {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        border-radius: 10px;
        padding: 12px 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-gradient-secondary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-3px);
    }

    .divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent);
        margin: 40px 0;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 1.8rem;
        }
        .content-card {
            padding: 30px;
        }
        .meta-info {
            gap: 15px;
        }
        .button-group {
            flex-direction: column;
        }
        .btn-gradient-primary, .btn-gradient-secondary {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <!-- Breadcrumb removed -->

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h1><?php echo e($pengumuman->judul); ?></h1>
                <div class="meta-info">
                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <span class="meta-text"><?php echo e($pengumuman->tanggal_post->format('d F Y')); ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">⏰</span>
                        <span class="meta-text">Dipublikasikan <?php echo e($pengumuman->created_at->diffForHumans()); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-card">
            <?php echo nl2br(e($pengumuman->isi)); ?>


            <div class="divider"></div>

            <!-- Action Buttons -->
            <div class="button-group">
                <a href="<?php echo e(route('pengumuman.public.index')); ?>" class="btn-gradient-secondary">
                    ← Kembali ke Semua Pengumuman
                </a>
                <a href="<?php echo e(route('welcome')); ?>" class="btn-gradient-primary">
                    Kembali ke Beranda →
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/pengumuman/show.blade.php ENDPATH**/ ?>