<?php $__env->startSection('title', 'Selamat Datang di PPDB Online'); ?>


<?php $__env->startSection('content'); ?>
    <!-- [ Header ] start -->
    <header id="home" class="d-flex align-items-center position-relative"
        style="min-height: 100dvh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        
        <!-- Animated Background Elements -->
        <div style="position: absolute; width: 400px; height: 400px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; top: -100px; right: -100px; animation: float 6s ease-in-out infinite; pointer-events: none;"></div>
        <div style="position: absolute; width: 300px; height: 300px; background: rgba(255, 255, 255, 0.08); border-radius: 50%; bottom: -50px; left: -50px; animation: float 8s ease-in-out infinite 1s; pointer-events: none;"></div>

        <div class="container mt-5 pt-5 position-relative" style="z-index: 10;">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-10 col-xl-8 text-center">
                    <div class="wow fadeInUp" data-wow-delay="0.1s" style="animation-duration: 0.8s;">
                        <h1 class="text-white mb-3 f-w-700" style="font-size: clamp(2rem, 8vw, 4rem); line-height: 1.2; letter-spacing: -1px;">
                            Selamat Datang di<br>
                            <span class="bg-gradient-primary text-transparent d-inline-block" style="background: linear-gradient(90deg, #fff 0%, #ffeb3b 100%); -webkit-background-clip: text;">PPDB Online</span>
                        </h1>
                    </div>
                    
                    <div class="wow fadeInUp" data-wow-delay="0.2s" style="animation-duration: 0.8s;">
                        <h3 class="text-white opacity-90 mb-5 fw-500" style="font-size: 1.3rem; letter-spacing: 0.5px;">
                            <span class="badge badge-soft-warning" style="background: rgba(255, 235, 59, 0.2); border: 1px solid rgba(255, 235, 59, 0.5); color: #ffeb3b;">SMK ANTARTIKA 1 SIDOARJO</span>
                        </h3>
                        <p class="text-white opacity-75 lead mb-4" style="max-width: 600px; margin-left: auto; margin-right: auto; font-size: 1.1rem; font-weight: 300;">
                            Wujudkan masa depan gemilang melalui pendidikan berkualitas. Daftar dengan mudah dan cepat melalui sistem pendaftaran siswa baru kami yang modern dan aman.
                        </p>
                    </div>
                    
                    <div class="mt-5 wow fadeInUp" data-wow-delay="0.3s" style="animation-duration: 0.8s; position: relative; z-index: 10;">
                        <a href="<?php echo e(route('register')); ?>"
                            class="btn btn-light btn-lg d-inline-flex align-items-center gap-2 me-3 fw-600 shadow-lg"
                            style="padding: 14px 40px; border-radius: 50px; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.2); cursor: pointer; z-index: 20; position: relative; pointer-events: auto;">
                            <i class="ti ti-user-plus"></i> Daftar Sekarang
                        </a>
                        <a href="#alur" class="btn btn-outline-light btn-lg fw-600"
                            style="padding: 14px 40px; border-radius: 50px; border-width: 2px; transition: all 0.3s ease; cursor: pointer; z-index: 20; position: relative; pointer-events: auto;">
                            <i class="ti ti-arrow-down"></i> Lihat Alur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- [ Header ] End -->

    <!-- [ Pengumuman ] Start -->
    <section class="py-5" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);">
        <div class="container">
            <div class="row justify-content-center text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-md-10 col-xl-6">
                    <span class="badge badge-soft-primary mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 8px 16px; border-radius: 20px;">📢 Pengumuman Terbaru</span>
                    <h2 class="mb-3 fw-700" style="font-size: 2.5rem;">Informasi<br><span class="bg-gradient-primary text-transparent d-inline-block" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text;">dari Sekolah</span></h2>
                    <p class="text-muted lead">Pantau perkembangan terbaru dan pengumuman penting dari sekolah kami.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo e($loop->index * 0.1 + 0.2); ?>s">
                    <div class="card border-0 h-100" 
                        style="border-radius: 15px; background: white; overflow: hidden; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1); cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(102, 126, 234, 0.1)'">
                        <div style="height: 8px; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);"></div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge badge-soft-primary" style="background: rgba(102, 126, 234, 0.15); color: #667eea; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;"><?php echo e($item->tanggal_post->format('d M Y')); ?></span>
                            </div>
                            <h5 class="fw-600 mb-2 text-dark" style="min-height: 50px; line-height: 1.4;"><?php echo e($item->judul); ?></h5>
                            <p class="text-muted small mb-4" style="min-height: 60px; line-height: 1.5;"><?php echo e(Str::limit($item->isi, 100, '...')); ?></p>
                            <a href="<?php echo e(route('pengumuman.public.show', $item->id)); ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px; padding: 8px 16px; text-decoration: none; transition: all 0.3s ease; display: inline-block;">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-muted fs-5" style="padding: 40px 0;">📭 Belum ada pengumuman untuk ditampilkan saat ini</p>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if($pengumuman->count() > 0): ?>
            <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.5s">
                <a href="<?php echo e(route('pengumuman.public.index')); ?>" class="btn btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50px; padding: 14px 40px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: inline-block;">
                    Lihat Semua Pengumuman →
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- [ Pengumuman ] End -->

    <!-- [ Promo ] Start -->
    <?php if($promo->count() > 0): ?>
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-md-10 col-xl-6">
                    <span class="badge badge-soft-warning mb-3" style="background: #fff3cd; color: #856404; padding: 8px 16px; border-radius: 20px;">🔥 Penawaran Spesial</span>
                    <h2 class="mb-3 fw-700" style="font-size: 2.5rem;">Promo<br><span class="bg-gradient-primary text-transparent d-inline-block" style="background: linear-gradient(90deg, #ffc107 0%, #ff9800 100%); -webkit-background-clip: text;">Pendaftaran</span></h2>
                    <p class="text-muted lead">Gunakan kode promo di bawah ini untuk mendapatkan potongan biaya pendaftaran!</p>
                </div>
            </div>
            
            <div class="row g-4 justify-content-center">
                <?php $__currentLoopData = $promo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo e($loop->index * 0.1 + 0.2); ?>s">
                    <div class="card border-0 h-100 position-relative overflow-hidden" 
                        style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                        
                        <!-- Background decoration -->
                        <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border-radius: 50%; opacity: 0.1;"></div>
                        <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; opacity: 0.05;"></div>

                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold text-muted mb-2">Kode Promo:</h5>
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <div class="bg-light px-4 py-2 rounded-3 border border-2 border-warning border-dashed d-inline-block position-relative">
                                    <h3 class="mb-0 fw-800 text-dark tracking-wide"><?php echo e($item->kode_promo); ?></h3>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="display-6 fw-bold text-primary mb-1">
                                    Diskon Rp <?php echo e(number_format($item->diskon_nominal/1000, 0)); ?>rb
                                </div>
                                <small class="text-muted">Potongan langsung biaya pendaftaran</small>
                            </div>

                            <ul class="list-unstyled text-start bg-light p-3 rounded-3 mb-0 small">
                                <li class="mb-2 d-flex align-items-center text-muted">
                                    <i class="ti ti-calendar me-2 text-warning"></i>
                                    Berlaku s/d <?php echo e($item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') : 'Seterusnya'); ?>

                                </li>
                                <?php if($item->max_usage > 0): ?>
                                <li class="d-flex align-items-center text-muted">
                                    <i class="ti ti-ticket me-2 text-warning"></i>
                                    Sisa Kuota: <?php echo e(max($item->max_usage - $item->used_count, 0)); ?> pendaftar
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!-- [ Promo ] End -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-md-10 col-xl-6">
                    <span class="badge badge-soft-primary mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 8px 16px; border-radius: 20px;">Keunggulan Kami</span>
                    <h2 class="mb-3 fw-700" style="font-size: 2.5rem;">Mengapa Memilih<br><span class="bg-gradient-primary text-transparent d-inline-block" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text;">Sekolah Kami?</span></h2>
                    <p class="text-muted lead">Kami berkomitmen untuk menyediakan lingkungan belajar yang inspiratif dengan kurikulum terbaik untuk masa depan cerah putra-putri Anda.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 h-100 wow fadeInUp" data-wow-delay="0.2s"
                        style="border-radius: 15px; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); overflow: hidden; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1); cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(102, 126, 234, 0.1)'">
                        <div class="card-body text-center">
                            <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="ti ti-building-community f-36 text-white"></i>
                            </div>
                            <h5 class="mb-2 fw-600">Fasilitas Modern</h5>
                            <p class="mb-0 text-muted small">Lingkungan belajar nyaman dengan fasilitas terkini, dari lab, perpustakaan, hingga sarana olahraga lengkap.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 h-100 wow fadeInUp" data-wow-delay="0.3s"
                        style="border-radius: 15px; background: linear-gradient(135deg, #f64ba815 0%, #f64ba815 100%); overflow: hidden; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(246, 75, 168, 0.1); cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(246, 75, 168, 0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(246, 75, 168, 0.1)'">
                        <div class="card-body text-center">
                            <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: linear-gradient(135deg, #f64ba8 0%, #f64ba8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="ti ti-book f-36 text-white"></i>
                            </div>
                            <h5 class="mb-2 fw-600">Kurikulum Unggulan</h5>
                            <p class="mb-0 text-muted small">Kurikulum dirancang untuk mengembangkan potensi akademik dan non-akademik siswa secara seimbang.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 h-100 wow fadeInUp" data-wow-delay="0.4s"
                        style="border-radius: 15px; background: linear-gradient(135deg, #ffa50015 0%, #ffa50015 100%); overflow: hidden; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(255, 165, 0, 0.1); cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(255, 165, 0, 0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(255, 165, 0, 0.1)'">
                        <div class="card-body text-center">
                            <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: linear-gradient(135deg, #ffa500 0%, #ffa500 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="ti ti-users f-36 text-white"></i>
                            </div>
                            <h5 class="mb-2 fw-600">Pendidik Profesional</h5>
                            <p class="mb-0 text-muted small">Didukung oleh guru berpengalaman dan berdedikasi dalam membimbing siswa menjadi pribadi cerdas dan berkarakter.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Keunggulan Kami ] End -->

    <!-- [ Alur Pendaftaran ] start -->
    <section class="py-5 bg-light" id="alur">
        <div class="container">
            <div class="row justify-content-center text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-md-10 col-xl-6">
                    <span class="badge badge-soft-primary mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 8px 16px; border-radius: 20px;">Proses Cepat</span>
                    <h2 class="mb-3 fw-700" style="font-size: 2.5rem;">Alur<br><span class="bg-gradient-primary text-transparent d-inline-block" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text;">Pendaftaran</span></h2>
                    <p class="text-muted lead">Ikuti 4 langkah mudah untuk menjadi bagian dari keluarga besar SMK ANTARTIKA 1 SIDOARJO.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-sm-6 col-lg-3">
                    <div class="position-relative wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card border-0 h-100"
                            style="border-radius: 15px; background: white; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.08); overflow: hidden;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.15)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                            <div class="card-body text-center p-4">
                                <div style="width: 60px; height: 60px; margin: 0 auto 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
                                    1
                                </div>
                                <h5 class="mb-2 fw-600">Buat Akun</h5>
                                <p class="mb-0 text-muted small">Daftarkan diri Anda dengan mengisi email dan password untuk membuat akun.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="col-sm-6 col-lg-3">
                    <div class="position-relative wow fadeInUp" data-wow-delay="0.3s">
                        <div class="card border-0 h-100"
                            style="border-radius: 15px; background: white; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.08); overflow: hidden;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.15)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                            <div class="card-body text-center p-4">
                                <div style="width: 60px; height: 60px; margin: 0 auto 20px; background: linear-gradient(135deg, #f64ba8 0%, #f64ba8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
                                    2
                                </div>
                                <h5 class="mb-2 fw-600">Lengkapi Data</h5>
                                <p class="mb-0 text-muted small">Login dan lengkapi formulir biodata serta unggah dokumen yang diperlukan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="col-sm-6 col-lg-3">
                    <div class="position-relative wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card border-0 h-100"
                            style="border-radius: 15px; background: white; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.08); overflow: hidden;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.15)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                            <div class="card-body text-center p-4">
                                <div style="width: 60px; height: 60px; margin: 0 auto 20px; background: linear-gradient(135deg, #ffa500 0%, #ffa500 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
                                    3
                                </div>
                                <h5 class="mb-2 fw-600">Proses Seleksi</h5>
                                <p class="mb-0 text-muted small">Tim kami akan melakukan verifikasi dan seleksi terhadap berkas pendaftaran Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="col-sm-6 col-lg-3">
                    <div class="position-relative wow fadeInUp" data-wow-delay="0.5s">
                        <div class="card border-0 h-100"
                            style="border-radius: 15px; background: white; transition: all 0.4s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.08); overflow: hidden;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(102, 126, 234, 0.15)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                            <div class="card-body text-center p-4">
                                <div style="width: 60px; height: 60px; margin: 0 auto 20px; background: linear-gradient(135deg, #00d4ff 0%, #0099ff 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
                                    4
                                </div>
                                <h5 class="mb-2 fw-600">Pengumuman</h5>
                                <p class="mb-0 text-muted small">Hasil seleksi akan diumumkan secara online melalui akun Anda masing-masing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Alur Pendaftaran ] End -->

    <!-- [ CTA ] start -->
    <section class="py-5 position-relative overflow-hidden"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        
        <!-- Animated shapes -->
        <div style="position: absolute; width: 300px; height: 300px; background: rgba(255, 255, 255, 0.08); border-radius: 50%; top: -100px; right: -100px;"></div>
        <div style="position: absolute; width: 200px; height: 200px; background: rgba(255, 255, 255, 0.06); border-radius: 50%; bottom: -50px; left: -50px;"></div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <h2 class="text-white mb-4 fw-700" style="font-size: 2.5rem;">
                        Siap Bergabung dengan<br>
                        <span style="background: linear-gradient(90deg, #fff 0%, #ffeb3b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">SMK ANTARTIKA 1 SIDOARJO?</span>
                    </h2>
                    <p class="text-white opacity-85 mb-5 lead" style="font-size: 1.1rem;">
                        Pendaftaran akan segera ditutup. Jangan lewatkan kesempatan untuk menjadi siswa berprestasi di sekolah kami. Klik tombol di bawah untuk memulai proses pendaftaran sekarang juga.
                    </p>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-light btn-lg fw-600 px-5 py-3 shadow-lg"
                        style="border-radius: 50px; transition: all 0.3s ease;">
                        <i class="ti ti-rocket"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- [ CTA ] End -->

    <!-- [ Statistik ] start -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 h-100 wow fadeInUp" data-wow-delay="0.2s"
                        style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden; box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <h2 class="m-0 text-white fw-700"><?php echo e($totalPendaftar); ?></h2>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <h5 class="mb-2 text-white fw-600">Total Pendaftar</h5>
                                    <p class="mb-0 text-white opacity-75 small">Siswa yang sudah terdaftar dan dikonfirmasi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 h-100 wow fadeInUp" data-wow-delay="0.3s"
                        style="border-radius: 15px; background: linear-gradient(135deg, #f64ba8 0%, #f64ba8 100%); overflow: hidden; box-shadow: 0 8px 25px rgba(246, 75, 168, 0.2);">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <h2 class="m-0 text-white fw-700"><?php echo e($kursiTersedia); ?></h2>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <h5 class="mb-2 text-white fw-600">Kursi Tersedia</h5>
                                    <p class="mb-0 text-white opacity-75 small">Kuota pendaftaran gelombang aktif saat ini.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card border-0 h-100 wow fadeInUp" data-wow-delay="0.4s"
                        style="border-radius: 15px; background: linear-gradient(135deg, #ffa500 0%, #ffa500 100%); overflow: hidden; box-shadow: 0 8px 25px rgba(255, 165, 0, 0.2);">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <h2 class="m-0 text-white fw-700"><?php echo e($jurusanCount); ?></h2>
                                </div>
                                <div class="flex-grow-1 ms-4">
                                    <h5 class="mb-2 text-white fw-600">Jurusan Unggulan</h5>
                                    <p class="mb-0 text-white opacity-75 small">Pilihan jurusan yang tersedia untuk pendaftaran.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Statistik ] End -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\UKK_BEDOK_PPDB2\resources\views/welcome.blade.php ENDPATH**/ ?>