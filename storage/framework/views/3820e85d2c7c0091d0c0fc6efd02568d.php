<?php $__env->startSection('content'); ?>
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .admin-wrapper {
        background-color: #f8f9fa;
        padding: 30px 0;
        min-height: 100vh;
    }

    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 30px;
    }

    .section-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 18px;
        border-radius: 8px;
        margin-top: 25px;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .detail-table {
        background: #f9f9f9;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .detail-table th {
        background-color: #f0f0f0;
        border-bottom: 2px solid #ddd;
        font-weight: 600;
        width: 30%;
    }

    .detail-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .header-card h4 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .header-card p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    @media (max-width: 768px) {
        .grid-2 {
            grid-template-columns: 1fr;
        }
    }
</style>
<div class="admin-wrapper">
<div class="admin-container">

    <h3 class="fw-bold mb-4 text-primary">📌 Detail Calon Siswa - Informasi Lengkap</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success shadow-sm"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Header Section -->
    <div class="header-card">
        <h4><?php echo e($siswa->nama_lengkap); ?></h4>
        <p><?php echo e($siswa->kode_pendaftaran); ?> • NISN: <?php echo e($siswa->nisn); ?> • <?php echo e($siswa->jurusan); ?></p>
    </div>

    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-body">

            <!-- TAHAP 1: BIODATA SISWA -->
            <div class="section-title">📋 BIODATA SISWA</div>
            <table class="table detail-table">
                <tr><th>Kode Pendaftaran</th><td><strong class="text-primary"><?php echo e($siswa->kode_pendaftaran ?? '-'); ?></strong></td></tr>
                <tr><th>Nama Lengkap</th><td><?php echo e($siswa->nama_lengkap); ?></td></tr>
                <tr><th>NISN</th><td><?php echo e($siswa->nisn); ?></td></tr>
                <tr><th>NIK</th><td><?php echo e($siswa->nik ?? '-'); ?></td></tr>
                <tr><th>Tempat Lahir</th><td><?php echo e($siswa->tempat_lahir); ?></td></tr>
                <tr><th>Tanggal Lahir</th><td><?php echo e($siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') : '-'); ?></td></tr>
                <tr><th>Jenis Kelamin</th><td><?php echo e($siswa->jenis_kelamin); ?></td></tr>
                <tr><th>Agama</th><td><?php echo e($siswa->agama ?? '-'); ?></td></tr>
                <tr><th>Berat Badan</th><td><?php echo e($siswa->berat_badan ?? '-'); ?> kg</td></tr>
                <tr><th>Tinggi Badan</th><td><?php echo e($siswa->tinggi_badan ?? '-'); ?> cm</td></tr>
                <tr><th>Asal Sekolah</th><td><?php echo e($siswa->asal_sekolah); ?></td></tr>
                <tr><th>No. HP</th><td><?php echo e($siswa->no_hp); ?></td></tr>
                <tr><th>No. WhatsApp</th><td><?php echo e($siswa->no_wa ?? '-'); ?></td></tr>
                <tr><th>Jurusan Pilihan</th><td><strong class="text-primary"><?php echo e($siswa->jurusan); ?></strong></td></tr>
            </table>

            <!-- TAHAP 2: DETAIL ALAMAT -->
            <div class="section-title">🏠 DETAIL ALAMAT</div>
            <table class="table detail-table">
                <tr><th>Provinsi</th><td><?php echo e($siswa->provinsi ?? '-'); ?></td></tr>
                <tr><th>Kabupaten/Kota</th><td><?php echo e($siswa->kabupaten ?? '-'); ?></td></tr>
                <tr><th>Kecamatan</th><td><?php echo e($siswa->kecamatan ?? '-'); ?></td></tr>
                <tr><th>Kelurahan/Desa</th><td><?php echo e($siswa->kelurahan ?? '-'); ?></td></tr>
                <tr><th>Kode Pos</th><td><?php echo e($siswa->kode_pos ?? '-'); ?></td></tr>
                <tr><th>RT/RW</th><td><?php echo e($siswa->rt_rw ?? '-'); ?></td></tr>
                <tr><th>Alamat Lengkap</th><td><?php echo e($siswa->alamat); ?></td></tr>
            </table>

            <!-- TAHAP 3: DATA ORANG TUA / WALI -->
            <div class="section-title">👨‍👩‍👧 DATA ORANG TUA / WALI</div>
            
            <!-- Status Keluarga -->
            <div class="alert alert-info mb-3">
                <strong>Status Keluarga:</strong> 
                <?php if($siswa->status_keluarga == 'ayah_ibu'): ?>
                    <span class="status-badge" style="background-color: #48bb78; color: white;">✓ Orang Tua Lengkap</span>
                <?php elseif($siswa->status_keluarga == 'yatim'): ?>
                    <span class="status-badge" style="background-color: #ed8936; color: white;">⚠ Yatim (Ayah Meninggal)</span>
                <?php elseif($siswa->status_keluarga == 'piatu'): ?>
                    <span class="status-badge" style="background-color: #ed8936; color: white;">⚠ Piatu (Ibu Meninggal)</span>
                <?php elseif($siswa->status_keluarga == 'yatim_piatu'): ?>
                    <span class="status-badge" style="background-color: #f56565; color: white;">⚠ Yatim Piatu (Keduanya Meninggal)</span>
                <?php else: ?>
                    <span class="status-badge" style="background-color: #ccc; color: #333;">Belum ditentukan</span>
                <?php endif; ?>
            </div>

            <?php if($siswa->status_keluarga == 'ayah_ibu'): ?>
                <!-- Data Ayah -->
                <div class="mb-3">
                    <h6 style="background: #f0f0f0; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                        <i class="fas fa-user-tie"></i> <strong>DATA AYAH</strong>
                    </h6>
                    <table class="table detail-table">
                        <tr><th>Nama Ayah</th><td><?php echo e($siswa->nama_ayah ?? '-'); ?></td></tr>
                        <tr><th>Tempat Lahir</th><td><?php echo e($siswa->tempat_lahir_ayah ?? '-'); ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td><?php echo e($siswa->tanggal_lahir_ayah ? \Carbon\Carbon::parse($siswa->tanggal_lahir_ayah)->format('d/m/Y') : '-'); ?></td></tr>
                        <tr><th>Pendidikan</th><td><?php echo e($siswa->pendidikan_ayah ?? '-'); ?></td></tr>
                        <tr><th>Pekerjaan</th><td><?php echo e($siswa->pekerjaan_ayah ?? '-'); ?></td></tr>
                        <tr><th>No. HP</th><td><?php echo e($siswa->no_hp_ayah ?? '-'); ?></td></tr>
                    </table>
                </div>

                <!-- Data Ibu -->
                <div class="mb-3">
                    <h6 style="background: #f0f0f0; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                        <i class="fas fa-user-tie"></i> <strong>DATA IBU</strong>
                    </h6>
                    <table class="table detail-table">
                        <tr><th>Nama Ibu</th><td><?php echo e($siswa->nama_ibu ?? '-'); ?></td></tr>
                        <tr><th>Tempat Lahir</th><td><?php echo e($siswa->tempat_lahir_ibu ?? '-'); ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td><?php echo e($siswa->tanggal_lahir_ibu ? \Carbon\Carbon::parse($siswa->tanggal_lahir_ibu)->format('d/m/Y') : '-'); ?></td></tr>
                        <tr><th>Pendidikan</th><td><?php echo e($siswa->pendidikan_ibu ?? '-'); ?></td></tr>
                        <tr><th>Pekerjaan</th><td><?php echo e($siswa->pekerjaan_ibu ?? '-'); ?></td></tr>
                        <tr><th>No. HP</th><td><?php echo e($siswa->no_hp_ibu ?? '-'); ?></td></tr>
                    </table>
                </div>
            <?php else: ?>
                <!-- Data Wali (untuk kasus yatim/piatu/yatim piatu) -->
                <div class="mb-3">
                    <h6 style="background: #fff3cd; padding: 10px; border-radius: 5px; margin-bottom: 10px; border-left: 4px solid #f57c00;">
                        <i class="fas fa-user-shield"></i> <strong>DATA WALI</strong>
                    </h6>
                    <table class="table detail-table">
                        <tr><th>Nama Wali</th><td><?php echo e($siswa->nama_wali ?? '-'); ?></td></tr>
                        <tr><th>Tempat Lahir</th><td><?php echo e($siswa->tempat_lahir_wali ?? '-'); ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td><?php echo e($siswa->tanggal_lahir_wali ? \Carbon\Carbon::parse($siswa->tanggal_lahir_wali)->format('d/m/Y') : '-'); ?></td></tr>
                        <tr><th>Pendidikan Terakhir</th><td><?php echo e($siswa->pendidikan_wali ?? '-'); ?></td></tr>
                        <tr><th>Pekerjaan</th><td><?php echo e($siswa->pekerjaan_wali ?? '-'); ?></td></tr>
                        <tr><th>No. HP</th><td><?php echo e($siswa->no_hp_wali ?? '-'); ?></td></tr>
                    </table>
                </div>
            <?php endif; ?>

            <!-- STATUS & REFERENSI -->
            <div class="section-title">📊 STATUS & REFERENSI</div>
            <table class="table detail-table">
                <tr><th>Kelas</th><td><?php echo e($siswa->kelas->nama_kelas ?? '-'); ?></td></tr>
                <tr><th>Harga Jurusan</th><td>Rp. <?php echo e(number_format($siswa->harga_jurusan ?? 0, 0, ',', '.')); ?></td></tr>
                <tr><th>Nominal Pembayaran</th><td>Rp. <?php echo e(number_format($siswa->nominal_pembayaran ?? 0, 0, ',', '.')); ?></td></tr>
                <tr><th>Status Pembayaran</th>
                    <td>
                        <?php if($siswa->status_pembayaran == 'Lunas'): ?>
                            <span class="badge bg-success">✓ Lunas</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">⏳ Menunggu</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><th>Status Berkas</th>
                    <td>
                        <?php if($siswa->status_berkas == 'Valid'): ?>
                            <span class="badge bg-success">✓ Valid</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">❌ Belum Valid</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><th>Status Kelulusan</th>
                    <td>
                        <?php if($siswa->status_kelulusan == 'Lolos'): ?>
                            <span class="badge bg-primary">🏆 Lolos</span>
                        <?php elseif($siswa->status_kelulusan == 'Tidak Lolos'): ?>
                            <span class="badge bg-danger">❌ Tidak Lolos</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">⏳ Menunggu Keputusan</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><th>Tahap Form</th>
                    <td>
                        <?php if($siswa->tahap_form == 1): ?>
                            <span class="badge bg-warning">Tahap 1: Biodata</span>
                        <?php elseif($siswa->tahap_form == 2): ?>
                            <span class="badge bg-info">Tahap 2: Alamat</span>
                        <?php elseif($siswa->tahap_form == 3): ?>
                            <span class="badge bg-success">Tahap 3: Selesai</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <?php if($siswa->status_kelulusan == 'Lolos' && strtolower($siswa->status_pembayaran) == 'lunas'): ?>
            <div class="section-title" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%)">📜 DOKUMEN KELULUSAN</div>
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center justify-content-between p-4">
                <div>
                    <h5 class="fw-bold mb-1">
                        Bukti Penerimaan / Surat Kelulusan
                        <?php if($siswa->is_bukti_dikirim): ?>
                            <span class="badge bg-success ms-2"><i class="ti ti-check me-1"></i> TERKIRIM</span>
                        <?php endif; ?>
                    </h5>
                    <p class="mb-0 text-dark opacity-75 small">Surat ini dapat pratinjau sebelum dikirim ke siswa atau dicetak untuk arsip.</p>
                </div>
                <a href="<?php echo e(route('admin.calon_siswa.preview_bukti', $siswa->id)); ?>" class="btn btn-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                    <i class="ti ti-mail-forward me-1"></i> <?php echo e($siswa->is_bukti_dikirim ? 'LIHAT / KIRIM ULANG' : 'KIRIM BUKTI PENERIMAAN'); ?>

                </a>
            </div>
            <?php endif; ?>

            <hr class="my-4">

            <h5 class="fw-bold mb-3">🛠️ AKSI ADMIN</h5>
            <div class="d-flex flex-wrap gap-2">

                <!-- Lihat Dokumen -->
                <a href="<?php echo e(route('admin.dokumen_siswa.show', $siswa->dokumenPersyaratan->id ?? '#')); ?>" class="btn btn-warning btn-sm">
                    📸 Lihat Dokumen
                </a>

                <!-- Lolos / Tolak - Selalu bisa digunakan untuk mengubah status -->
                <form action="<?php echo e(route('admin.calon_siswa.setujui', $siswa->id)); ?>" method="POST" style="display:inline;"><?php echo csrf_field(); ?>
                    <button class="btn btn-success btn-sm" type="submit">✅ Lolos</button>
                </form>

                <form action="<?php echo e(route('admin.calon_siswa.tolak', $siswa->id)); ?>" method="POST" style="display:inline;"><?php echo csrf_field(); ?>
                    <button class="btn btn-danger btn-sm" type="submit">❌ Tidak Lolos</button>
                </form>

            </div>
             <a href="<?php echo e(route('admin.calon_siswa.index')); ?>" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>

</div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ukk_ppdb\resources\views/admin/calon_siswa/show.blade.php ENDPATH**/ ?>