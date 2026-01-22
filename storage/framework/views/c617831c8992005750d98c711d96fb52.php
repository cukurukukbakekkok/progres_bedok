<?php $__env->startSection('content'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
        .payment-wrapper {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
            margin: 0 !important;
            width: 100vw !important;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw !important;
            margin-right: -50vw !important;
        }

        .payment-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .payment-header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            animation: slideDown 0.6s ease-out;
        }

        .payment-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* Alert Messages */
        .alert-box {
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
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

        /* Summary Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .summary-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 0 0 0 100%;
        }

        .card-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .card-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
        }

        .card-value.tagihan {
            color: #667eea;
        }

        .card-value.dibayar {
            color: #28a745;
        }

        .card-value.sisa {
            color: #dc3545;
        }

        /* Payment Form Card */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 30px;
            animation: slideUp 0.6s ease-out 0.2s backwards;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* History Table */
        .history-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            animation: slideUp 0.6s ease-out 0.3s backwards;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #667eea;
            border-bottom: 2px solid #e9ecef;
        }

        .history-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            color: #333;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-lunas {
            background: #d4edda;
            color: #155724;
        }

        .badge-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .badge-gagal {
            background: #f8d7da;
            color: #721c24;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
        }

        .view-btn {
            padding: 6px 12px;
            background: #667eea;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="payment-wrapper">
        <div class="payment-container">
            <!-- Header -->
            <div class="payment-header animate__animated animate__fadeIn">
                <div class="d-flex justify-content-center mb-3">
                    <a href="<?php echo e(route('siswa.dashboard')); ?>"
                        class="btn btn-sm btn-outline-light px-3 py-2 rounded-pill fw-600 shadow-sm"
                        style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
                <h1>💳 Informasi Pembayaran</h1>
                <p>Kelola pembayaran sekolah Anda dengan mudah</p>
            </div>

            <!-- Alerts -->
            <?php if(session('success')): ?>
                <div class="alert-box alert-success">
                    <strong>✅ Sukses!</strong> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert-box alert-error">
                    <strong>❌ Error!</strong> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if($gelombang): ?>
                <!-- Summary Cards -->
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="card-label">Total Tagihan</div>
                        <div class="card-value tagihan">Rp <?php echo e(number_format($totalTagihan, 0, ',', '.')); ?></div>
                    </div>
                    <div class="summary-card">
                        <div class="card-label">Total Terbayar (Verified)</div>
                        <div class="card-value dibayar">Rp <?php echo e(number_format($totalDibayar, 0, ',', '.')); ?></div>
                        <?php if($totalMenunggu > 0): ?>
                            <div style="font-size: 0.8rem; color: #ffc107; margin-top: 5px;">
                                + Rp <?php echo e(number_format($totalMenunggu, 0, ',', '.')); ?> (Menunggu Verifikasi)
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="summary-card">
                        <div class="card-label">Sisa Tagihan</div>
                        <div class="card-value sisa">Rp <?php echo e(number_format($sisaTagihan, 0, ',', '.')); ?></div>
                    </div>
                </div>

                <?php if(!$isLunas): ?>
                    <!-- Payment Form -->
                    <div class="form-card">
                        <div class="section-title">
                            <span>📝</span> Form Pembayaran Baru
                        </div>

                        <div class="alert-box alert-success"
                            style="background: #e3f2fd; border-left-color: #2196f3; color: #0d47a1;">
                            ℹ️ Anda dapat melakukan pembayaran secara mencicil (angsuran) atau pelunasan langsung.
                            Transfer ke Rekening <strong>BRI 1234-5678-9000</strong> a.n SMK ANTARTIKA 1.
                        </div>

                        <form action="<?php echo e(route('siswa.pembayaran.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label class="form-label">Nominal Pembayaran (Rp)</label>
                                <input type="number" name="nominal" class="form-control" placeholder="Contoh: 500000" min="10000"
                                    max="<?php echo e($sisaTagihan); ?>" required>
                                <small style="color: #666;">Maksimal pembayaran: Rp
                                    <?php echo e(number_format($sisaTagihan, 0, ',', '.')); ?></small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="metode_bayar" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="e-wallet">E-Wallet (OVO/Dana/GoPay)</option>
                                    <option value="VA">Virtual Account</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload Bukti Transfer</label>
                                <div style="position: relative; display: inline-block; width: 100%;">
                                    <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control"
                                        accept=".jpg,.jpeg,.png,.pdf" required style="padding-top: 10px;">
                                </div>
                                <small style="color: #666;">Format: JPG, PNG, PDF. Maks 5MB.</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" name="tanggal_pembayaran" class="form-control" value="<?php echo e(date('Y-m-d')); ?>"
                                    required>
                            </div>

                            <button type="submit" class="btn-submit">
                                ✅ Kirim Pembayaran
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="status-card"
                        style="text-align: center; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); padding: 40px; border-radius: 16px; margin-bottom: 30px;">
                        <div style="font-size: 3rem; margin-bottom: 15px;">🎉</div>
                        <h2 style="color: #155724; font-weight: 800;">LUNAS</h2>
                        <p style="color: #155724;">Pembayaran Anda Telah Lunas. Terima kasih!</p>
                    </div>
                <?php endif; ?>

                <!-- History Table -->
                <div class="history-card">
                    <div class="section-title">
                        <span>📜</span> Riwayat Pembayaran
                    </div>

                    <?php if($pembayarans->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Metode</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Bukti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pembayarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(\Carbon\Carbon::parse($p->tanggal_pembayaran)->format('d M Y')); ?></td>
                                            <td><?php echo e(ucfirst($p->metode_bayar)); ?></td>
                                            <td>Rp <?php echo e(number_format($p->nominal, 0, ',', '.')); ?></td>
                                            <td>
                                                <?php if($p->status == 'lunas'): ?>
                                                    <span class="badge badge-lunas">Diterima</span>
                                                <?php elseif($p->status == 'menunggu'): ?>
                                                    <span class="badge badge-menunggu">Menunggu</span>
                                                <?php else: ?>
                                                    <span class="badge badge-gagal">Ditolak</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($p->bukti_bayar): ?>
                                                    <a href="<?php echo e(asset('storage/' . $p->bukti_bayar)); ?>" target="_blank"
                                                        class="view-btn">Lihat</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php if($p->status == 'gagal' && $p->keterangan): ?>
                                            <tr>
                                                <td colspan="5" style="background: #fff5f5; color: #dc3545; font-size: 0.9rem;">
                                                    <strong>Alasan Penolakan:</strong> <?php echo e($p->keterangan); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state" style="text-align: center; color: #999; padding: 20px;">
                            Belum ada riwayat pembayaran.
                        </div>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <!-- No Active Wave -->
                <div class="status-card" style="background: white; padding: 30px; border-radius: 16px; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 15px;">🚫</div>
                    <h3>Gelombang Pendaftaran Tidak Aktif</h3>
                    <p>Silakan tunggu pembukaan gelombang pendaftaran berikutnya.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
    // Handle metode pembayaran change - Update informasi pembayaran
    const metodeRadios = document.querySelectorAll('input[name="metode_bayar"]');
    const metodeDisplay = document.getElementById('metode-display');
    const bankTransferInfo = document.getElementById('bank-transfer-info');
    const vaInfo = document.getElementById('va-info');
    const ewalletInfo = document.getElementById('ewallet-info');

    function updatePaymentInfo() {
    const selectedMetode = document.querySelector('input[name="metode_bayar"]:checked');

    // Hide all info sections
    bankTransferInfo.style.display = 'none';
    vaInfo.style.display = 'none';
    ewalletInfo.style.display = 'none';

    if (selectedMetode) {
    const metode = selectedMetode.value;

    if (metode === 'transfer') {
    metodeDisplay.textContent = '🏦 Transfer Bank';
    bankTransferInfo.style.display = 'block';
    } else if (metode === 'VA') {
    metodeDisplay.textContent = '🏢 Virtual Account (VA)';
    vaInfo.style.display = 'block';
    } else if (metode === 'e-wallet') {
    metodeDisplay.textContent = '📱 E-Wallet';
    ewalletInfo.style.display = 'block';
    }
    }
    }

    // Add event listeners to all metode radio buttons
    metodeRadios.forEach(radio => {
    radio.addEventListener('change', updatePaymentInfo);
    });

    // Call on page load to set initial state
    updatePaymentInfo();

    // Handle file input display - Form Upload Baru
    const fileInput = document.getElementById('bukti_bayar_input');
    const fileNameDisplay = document.getElementById('file_name_display');

    if (fileInput) {
    fileInput.addEventListener('change', function(e) {
    if (this.files && this.files.length > 0) {
    const fileName = this.files[0].name;
    fileNameDisplay.textContent = '✓ File dipilih: ' + fileName;
    fileNameDisplay.style.display = 'block';
    }
    });
    }

    // Handle file input display - Form Ganti Bukti
    const fileInputGanti = document.getElementById('bukti_bayar_ganti_input');
    const fileNameGantiDisplay = document.getElementById('file_name_ganti_display');

    if (fileInputGanti) {
    fileInputGanti.addEventListener('change', function(e) {
    if (this.files && this.files.length > 0) {
    const fileName = this.files[0].name;
    fileNameGantiDisplay.textContent = '✓ File dipilih: ' + fileName;
    fileNameGantiDisplay.style.display = 'block';
    }
    });
    }

    // Promo Code Validation AJAX
    const applyPromoBtn = document.getElementById('apply_promo');
    const kodPromoInput = document.getElementById('kode_promo');
    const promoMessage = document.getElementById('promo_message');
    const promoInfo = document.getElementById('promo_info');
    const diskonAmount = document.getElementById('diskon_amount');
    const totalAfterDiskon = document.getElementById('total_after_diskon');
    const promoIdInput = document.getElementById('promo_id');
    const promoDiskonInput = document.getElementById('promo_diskon');

    const nominalPembayaran = <?php echo e($siswa->nominal_pembayaran ?? 0); ?>;

    applyPromoBtn.addEventListener('click', async function() {
    const kode = kodPromoInput.value.trim();

    if (!kode) {
    showPromoMessage('Masukkan kode promo terlebih dahulu', 'error');
    return;
    }

    try {
    const response = await fetch('<?php echo e(route("siswa.pembayaran.check-promo")); ?>', {
    method: 'POST',
    headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
    },
    body: JSON.stringify({
    kode: kode,
    id_gelombang: <?php echo e($siswa->id_gelombang ?? 'null'); ?>

    })
    });

    const data = await response.json();

    if (!data.valid) {
    showPromoMessage(data.message, 'error');
    promoInfo.style.display = 'none';
    promoIdInput.value = '';
    promoDiskonInput.value = '';
    return;
    }

    // Calculate diskon
    let diskonTotal = 0;
    if (data.diskon_nominal) {
    diskonTotal = data.diskon_nominal;
    }

    const totalSetelahDiskon = nominalPembayaran - diskonTotal;

    // Update display
    showPromoMessage('✓ Kode promo valid!', 'success');
    const formatter = new Intl.NumberFormat('id-ID');
    diskonAmount.textContent = 'Rp ' + formatter.format(diskonTotal);
    totalAfterDiskon.textContent = 'Rp ' + formatter.format(totalSetelahDiskon);

    // Update Main Nominal Display in Purple Card
    const nominalDisplayMain = document.getElementById('nominal-display-main');
    if (nominalDisplayMain) {
    nominalDisplayMain.textContent = 'Rp ' + formatter.format(totalSetelahDiskon);
    // Add highlight effect
    nominalDisplayMain.style.color = '#ffeb3b'; // Yellow for attention
    setTimeout(() => {
    nominalDisplayMain.style.color = ''; // Reset after 1s
    }, 1000);
    }

    promoInfo.style.display = 'block';
    promoIdInput.value = data.id;
    promoDiskonInput.value = diskonTotal;

    } catch (error) {
    console.error('Error:', error);
    showPromoMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');
    }
    });

    function showPromoMessage(message, type) {
    promoMessage.textContent = message;
    promoMessage.style.display = 'block';
    promoMessage.style.backgroundColor = type === 'success' ? '#d4edda' : '#f8d7da';
    promoMessage.style.color = type === 'success' ? '#155724' : '#721c24';
    promoMessage.style.borderLeft = type === 'success' ? '3px solid #28a745' : '3px solid #dc3545';
    }

    // Allow enter key to validate promo
    kodPromoInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
    applyPromoBtn.click();
    }
    });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ujian_ppdb1\resources\views/siswa/pembayaran/index.blade.php ENDPATH**/ ?>