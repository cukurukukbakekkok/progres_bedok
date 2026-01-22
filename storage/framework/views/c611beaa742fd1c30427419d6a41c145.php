<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">📄 PRATINJAU BUKTI PENERIMAAN</h4>
            <a href="<?php echo e(route('admin.calon_siswa.show', $siswa->id)); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white p-3 rounded-circle me-3">
                    <i class="ti ti-info-circle fs-3"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Konfirmasi Pengiriman</h5>
                    <p class="mb-0 text-dark opacity-75">Silakan tinjau data di bawah ini. Jika sudah benar, klik tombol <strong>"KIRIM SEKARANG"</strong> untuk memunculkan bukti penerimaan di dashboard siswa.</p>
                </div>
            </div>
        </div>

        
        <div class="bg-white shadow-lg rounded-4 p-4 mb-4 border position-relative overflow-hidden" 
             style="min-height: 800px; font-family: 'Helvetica', 'Arial', sans-serif; color: #2d3748;">
            
            
            <div class="position-absolute" style="top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-45deg); font-size: 80px; font-weight: bold; color: rgba(0,0,0,0.03); z-index: 0; white-space: nowrap; pointer-events: none;">
                LOLOS SELEKSI
            </div>

            <div class="position-relative" style="z-index: 1;">
                
                <div class="d-flex align-items-center mb-3 pb-2 border-bottom border-2 border-dark">
                    <img src="<?php echo e(asset('assets/images/my/logo-antrek.png')); ?>" alt="Logo" style="width: 70px;" class="me-3">
                    <div class="text-start">
                        <h4 class="fw-bold mb-0 text-dark" style="letter-spacing: 0.5px; text-transform: uppercase;">SMK ANTARTIKA 1 SIDOARJO</h4>
                        <h6 class="mb-1 text-secondary fw-bold">PENERIMAAN PESERTA DIDIK BARU (PPDB)</h6>
                        <p class="mb-0 x-small text-muted" style="font-size: 0.75rem;">Jl. Siwalan Panji, Buduran, Sidoarjo, Jawa Timur | Telp: (031) 8964034</p>
                    </div>
                </div>

                
                <div class="text-center mb-4">
                    <h5 class="fw-bold text-dark mb-1" style="text-decoration: underline; text-underline-offset: 4px; text-transform: uppercase;">SURAT KETERANGAN PENERIMAAN</h5>
                    <p class="small text-muted mb-0">Nomor: <?php echo e($siswa->kode_pendaftaran); ?>/SKP/<?php echo e(date('Y')); ?></p>
                </div>

                <div class="px-2">
                    <p class="mb-3 small">Berdasarkan hasil seleksi administrasi dan verifikasi pembayaran yang telah dilaksanakan, Panitia PPDB <strong>SMK ANTARTIKA 1 SIDOARJO</strong> dengan ini menyatakan bahwa:</p>

                    <table class="table table-sm table-borderless mb-4">
                        <tbody>
                            <tr>
                                <td width="200" class="fw-bold text-muted py-1 small">No. Pendaftaran</td>
                                <td class="py-1 small text-dark fw-bold">: <?php echo e($siswa->kode_pendaftaran); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted py-1 small">Nama Lengkap</td>
                                <td class="py-1 small text-dark fw-bold">: <?php echo e(strtoupper($siswa->nama_lengkap)); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted py-1 small">NISN / NIK</td>
                                <td class="py-1 small text-dark">: <?php echo e($siswa->nisn ?? '-'); ?> / <?php echo e($siswa->nik ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted py-1 small">Asal Sekolah</td>
                                <td class="py-1 small text-dark">: <?php echo e(strtoupper($siswa->asal_sekolah)); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted py-1 small">Kompetensi Keahlian</td>
                                <td class="py-1 small text-dark fw-bold">: <?php echo e($siswa->jurusan); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    
                    <?php
                        $pembayaran = $siswa->pembayaran;
                        $hargaBase = $siswa->harga_jurusan ?? 0;
                        $potonganGelombang = $siswa->gelombang->potongan ?? 0;
                        $potonganPromo = $pembayaran ? $pembayaran->potongan : 0;
                        $nominalBayar = $pembayaran ? $pembayaran->nominal : ($siswa->nominal_pembayaran ?? 0);
                    ?>

                    <div class="bg-light p-3 rounded-3 border mb-4 shadow-sm">
                        <h6 class="fw-bold border-bottom pb-1 mb-2 text-dark small"><i class="ti ti-receipt me-1"></i> RINCIAN PEMBAYARAN</h6>
                        <div class="row g-2 x-small" style="font-size: 0.85rem;">
                            <div class="col-8 text-muted">Biaya Pendidikan (Harga Asli)</div>
                            <div class="col-4 text-end fw-bold text-dark">Rp. <?php echo e(number_format($hargaBase, 0, ',', '.')); ?></div>
                            
                            <div class="col-8 text-muted">Potongan Gelombang</div>
                            <div class="col-4 text-end fw-bold text-danger">- Rp. <?php echo e(number_format($potonganGelombang, 0, ',', '.')); ?></div>
                            
                            <div class="col-8 text-muted">Potongan Promo / Voucher</div>
                            <div class="col-4 text-end fw-bold text-danger">- Rp. <?php echo e(number_format($potonganPromo, 0, ',', '.')); ?></div>
                            
                            <div class="col-12 mt-1 pt-1 border-top">
                                <div class="row align-items-center">
                                    <div class="col-8 fw-bold text-dark">TOTAL PEMBAYARAN</div>
                                    <div class="col-4 text-end fw-bold text-success fs-5">Rp. <?php echo e(number_format($nominalBayar, 0, ',', '.')); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center my-4 py-2 border border-success border-2 rounded-3 bg-success bg-opacity-10">
                        <p class="mb-0 text-success fw-bold small">Dinyatakan:</p>
                        <h3 class="fw-bold text-success mb-0" style="letter-spacing: 2px; text-transform: uppercase;">LOLOS SELEKSI</h3>
                    </div>

                    <p class="mb-2 small">Sebagai Siswa Baru <strong>SMK ANTARTIKA 1 SIDOARJO</strong> Tahun Ajaran <?php echo e(date('Y')); ?>/<?php echo e(date('Y')+1); ?>.</p>
                    <p class="mb-4 x-small text-muted">Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya. Harap melakukan daftar ulang sesuai jadwal yang telah diinformasikan.</p>
                </div>

                
                <div class="row mt-3">
                    <div class="col-7"></div>
                    <div class="col-5 text-center px-4">
                        <p class="mb-0 small text-dark">Sidoarjo, <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y')); ?></p>
                        <p class="mb-4 pb-2 small text-dark">Kepala Panitia PPDB,</p>
                        <div class="mt-3 border-bottom border-dark d-inline-block px-3">
                            <h6 class="fw-bold text-dark mb-0 small">PANITIA PPDB 2026/2027</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-bottom bg-white border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-0">Klik tombol di samping untuk mengirim surat ini ke:</p>
                    <h6 class="fw-bold text-dark mb-0"><?php echo e($siswa->nama_lengkap); ?></h6>
                </div>
                <form action="<?php echo e(route('admin.calon_siswa.kirim_bukti', $siswa->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-lg btn-success rounded-pill px-5 fw-bold shadow">
                        <i class="ti ti-send me-2"></i> KIRIM SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ppdb1\resources\views/admin/calon_siswa/preview_bukti.blade.php ENDPATH**/ ?>