@extends('layouts.main')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        overflow-x: hidden !important;
    }

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

    .payment-header p {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Alert Messages */
    .alert-box {
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
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

    /* Status Cards */
    .status-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        animation: slideUp 0.6s ease-out 0.2s backwards;
        margin-bottom: 30px;
        position: relative;
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px 16px 0 0;
    }

    .status-card h3 {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 20px;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .status-badge.lunas {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .status-badge.gagal {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }

    .status-badge.menunggu {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: white;
    }

    .status-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .info-item {
        padding: 15px;
        background: #f9f9f9;
        border-radius: 10px;
        border-left: 3px solid #667eea;
    }

    .info-label {
        font-size: 0.9rem;
        color: #999;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
    }

    .info-value.amount {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Bank Info */
    .bank-info-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        animation: slideUp 0.6s ease-out 0.3s backwards;
    }

    .bank-header {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bank-details {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 20px;
        backdrop-filter: blur(10px);
    }

    .bank-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .bank-row:last-child {
        border-bottom: none;
    }

    .bank-label {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .bank-value {
        font-weight: 700;
        font-size: 1.1rem;
        font-family: 'Courier New', monospace;
    }

    /* Upload Section */
    .upload-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        animation: slideUp 0.6s ease-out 0.4s backwards;
        margin-bottom: 30px;
    }

    .upload-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .upload-instructions {
        background: #f0f7ff;
        border-left: 4px solid #667eea;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .upload-instructions ul {
        margin: 10px 0 0 20px;
        padding: 0;
    }

    .upload-instructions li {
        margin-bottom: 8px;
        color: #333;
    }

    .upload-btn {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        margin-top: 15px;
    }

    .upload-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
    }

    /* Timeline */
    .timeline {
        position: relative;
        padding-left: 40px;
        margin: 30px 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
    }

    .timeline-item {
        margin-bottom: 25px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -48px;
        top: 0;
        width: 16px;
        height: 16px;
        background: white;
        border: 3px solid #667eea;
        border-radius: 50%;
    }

    .timeline-title {
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }

    .timeline-desc {
        font-size: 0.9rem;
        color: #999;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .empty-state h3 {
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .payment-wrapper {
            padding: 20px 15px;
        }

        .payment-header h1 {
            font-size: 2rem;
        }

        .payment-methods {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .method-card {
            padding: 15px;
        }

        .method-icon {
            font-size: 2rem;
        }

        .status-info {
            grid-template-columns: 1fr;
        }

        .bank-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .bank-value {
            margin-top: 8px;
        }
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
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-sm btn-outline-light px-3 py-2 rounded-pill fw-600 shadow-sm" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;">
                    <i class="ti ti-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>
            <h1>💳 Informasi Pembayaran</h1>
            <p>Kelola pembayaran pendaftaran Anda</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert-box alert-success animate__animated animate__slideInDown">
                <strong>✅ Sukses!</strong> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-box alert-error animate__animated animate__slideInDown">
                <strong>❌ Error!</strong> {{ session('error') }}
            </div>
        @endif

        @if($gelombang)
            <!-- Status Pembayaran -->
            <div class="status-card animate__animated animate__slideInUp" style="animation-delay: 0.1s;">
                <h3>📊 Status Pembayaran Anda</h3>

                @if($pembayaran)
                    @if($pembayaran->status == 'lunas')
                        <span class="status-badge lunas">✓ Pembayaran Lunas</span>
                        <div class="alert-box alert-success" style="margin: 15px 0 0 0; border: none; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                            🎉 Pembayaran Anda telah dikonfirmasi oleh admin. Terima kasih!
                        </div>
                    @elseif($pembayaran->status == 'gagal')
                        <span class="status-badge gagal">✗ Pembayaran Ditolak</span>
                        @if($pembayaran->keterangan)
                            <div class="alert-box alert-error" style="margin: 15px 0 0 0; border: none;">
                                <strong>Catatan Admin:</strong> {{ $pembayaran->keterangan }}
                            </div>
                        @endif
                    @elseif($pembayaran->status == 'menunggu' && $pembayaran->bukti_bayar)
                        <span class="status-badge menunggu">⏳ Menunggu Verifikasi</span>
                        <div class="alert-box alert-success" style="margin: 15px 0 0 0; border: none; background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
                            📝 Bukti pembayaran Anda sedang diproses oleh admin. Harap tunggu...
                        </div>
                    @endif

                    <div class="status-info" style="margin-top: 25px;">
                        <div class="info-item">
                            <div class="info-label">Nominal Pembayaran</div>
                            <div class="info-value amount">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tanggal Pembayaran</div>
                            <div class="info-value">{{ $pembayaran->tanggal_pembayaran ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') : '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Bukti Pembayaran</div>
                            <div class="info-value">{{ $pembayaran->bukti_bayar ? '✓ Sudah Diupload' : '✗ Belum' }}</div>
                        </div>
                    </div>

                    @if($pembayaran->harga_awal || $pembayaran->potongan)
                    <div style="margin-top: 25px; padding: 20px; background: linear-gradient(135deg, #f0f7ff 0%, #e8f4f8 100%); border-radius: 12px; border-left: 4px solid #667eea;">
                        <h5 style="margin-bottom: 15px; color: #333; font-weight: 700;">📋 Rincian Pembayaran</h5>
                        <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                            <span style="color: #666;">Harga Awal:</span>
                            <span style="font-weight: 600; color: #333;">Rp {{ number_format($pembayaran->harga_awal ?? 0, 0, ',', '.') }}</span>
                        </div>
                        @if($pembayaran->potongan > 0)
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                                <span style="color: #666;">
                                    Potongan{{ $pembayaran->keterangan_potongan ? ' (' . $pembayaran->keterangan_potongan . ')' : '' }}:
                                </span>
                                <span style="font-weight: 600; color: #dc3545;">- Rp {{ number_format($pembayaran->potongan, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div style="display: flex; justify-content: space-between; padding: 12px 0;">
                            <span style="color: #333; font-weight: 700; font-size: 1.05rem;">Total Pembayaran:</span>
                            <span style="font-weight: 700; color: #667eea; font-size: 1.1rem;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">💭</div>
                        <h3>Belum Ada Data Pembayaran</h3>
                        <p>Anda belum melakukan pembayaran. Silakan lakukan pembayaran ke rekening di bawah ini.</p>
                    </div>
                @endif
            </div>

            <!-- Bank Information -->
            <div class="bank-info-card animate__animated animate__slideInUp" style="animation-delay: 0.2s;">
                <div class="bank-header">
                    🏦 Informasi Pembayaran
                </div>
                <div class="bank-details" id="bank-details">
                    <div class="bank-row">
                        <span class="bank-label">Metode Pembayaran</span>
                        <span class="bank-value" id="metode-display">Pilih metode pembayaran di form</span>
                    </div>

                    <!-- Bank Transfer Info -->
                    <div id="bank-transfer-info" style="display: none;">
                        <div class="bank-row">
                            <span class="bank-label">Pilih Bank</span>
                            <span class="bank-value">BRI • BCA • Mandiri</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label">Nomor Rekening BRI</span>
                            <span class="bank-value">1234567890</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label">Atas Nama</span>
                            <span class="bank-value">SMK ANTARTIKA 1 SDA</span>
                        </div>
                    </div>

                    <!-- Virtual Account Info -->
                    <div id="va-info" style="display: none;">
                        <div class="bank-row">
                            <span class="bank-label">Pilih Bank</span>
                            <span class="bank-value">BRI • BCA • Mandiri</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label">Virtual Account</span>
                            <span class="bank-value">Akan dikirim via email setelah upload bukti</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label">Atas Nama</span>
                            <span class="bank-value">SMK ANTARTIKA 1 SDA</span>
                        </div>
                    </div>

                    <!-- E-Wallet Info -->
                    <div id="ewallet-info" style="display: none;">
                        <div class="bank-row">
                            <span class="bank-label">E-Wallet Tersedia</span>
                            <span class="bank-value">OVO • GoPay • Dana</span>
                        </div>
                        <div class="bank-row">
                            <span class="bank-label">Nomor Tujuan</span>
                            <span class="bank-value">Hubungi admin untuk nomor e-wallet</span>
                        </div>
                    </div>

                    <div class="bank-row">
                        <span class="bank-label">Nominal</span>
                        <span class="bank-value" id="nominal-display-main">Rp {{ number_format($siswa->nominal_pembayaran ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Upload Bukti -->
            <div class="upload-card animate__animated animate__slideInUp" style="animation-delay: 0.3s;">
                <h3>📤 Upload Bukti Pembayaran</h3>
                
                @if(!$pembayaran || !$pembayaran->bukti_bayar)
                    <!-- Form Upload (Belum Ada File) -->
                    <div class="upload-instructions">
                        <strong>Petunjuk Upload:</strong>
                        <ul>
                            <li>Format: JPG, PNG, atau PDF</li>
                            <li>Ukuran maksimal: 5MB</li>
                            <li>Foto/scan jelas dan dapat dibaca</li>
                            <li>Pastikan nomor referensi terlihat</li>
                        </ul>
                    </div>

                    <form action="{{ route('siswa.pembayaran.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                        @csrf
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #333;">Pilih Metode Pembayaran:</label>
                            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="radio" name="metode_bayar" value="transfer" required>
                                    <span>Transfer Bank</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="radio" name="metode_bayar" value="e-wallet" required>
                                    <span>E-Wallet</span>
                                </label>
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="radio" name="metode_bayar" value="VA" required>
                                    <span>Virtual Account</span>
                                </label>
                            </div>
                        </div>

                        <!-- Promo Code Field -->
                        <div style="margin-bottom: 20px; padding: 15px; background: #f0f7ff; border-radius: 12px; border-left: 4px solid #667eea;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #333;">
                                🎟️ Kode Promo <span style="color: #999; font-weight: 400;">(Opsional)</span>
                            </label>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" id="kode_promo" placeholder="Masukkan kode promo dari pengumuman" 
                                       style="flex: 1; padding: 10px 15px; border: 2px solid #667eea; border-radius: 8px; font-size: 0.95rem;">
                                <button type="button" id="apply_promo" style="padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; white-space: nowrap;">
                                    Cek Promo
                                </button>
                            </div>
                            <div id="promo_message" style="margin-top: 10px; display: none; padding: 10px; border-radius: 8px; font-weight: 500;"></div>
                            <div id="promo_info" style="margin-top: 10px; display: none; padding: 10px; background: white; border-radius: 8px; border-left: 3px solid #28a745;">
                                <div style="color: #666; font-size: 0.9rem;">Diskon: <span id="diskon_amount" style="font-weight: 700; color: #28a745;"></span></div>
                                <div style="color: #666; font-size: 0.9rem;">Total setelah diskon: <span id="total_after_diskon" style="font-weight: 700; color: #667eea;"></span></div>
                            </div>
                            <input type="hidden" id="promo_id" name="promo_id">
                            <input type="hidden" id="promo_diskon" name="promo_diskon">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #333;">Upload Bukti Pembayaran:</label>
                            <div style="position: relative; display: inline-block; width: 100%;">
                                <input type="file" name="bukti_bayar" accept=".pdf,.jpg,.jpeg,.png" required style="display: none;" id="bukti_bayar_input">
                                <label for="bukti_bayar_input" style="display: block; padding: 30px; border: 2px dashed #667eea; border-radius: 12px; text-align: center; cursor: pointer; background: #f9f9f9; transition: all 0.3s ease;">
                                    <div style="font-size: 2rem; margin-bottom: 10px;">📎</div>
                                    <div style="font-weight: 600; color: #667eea;">Klik untuk memilih file</div>
                                    <div style="font-size: 0.9rem; color: #999; margin-top: 5px;">atau drag & drop file di sini</div>
                                </label>
                                <div id="file_name_display" style="margin-top: 10px; color: #28a745; font-weight: 600; display: none;"></div>
                            </div>
                            @error('bukti_bayar')
                                <div style="color: #dc3545; font-size: 0.9rem; margin-top: 8px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" style="width: 100%; padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s ease;">
                            ✅ Upload & Kirim Verifikasi
                        </button>
                    </form>
                @else
                    <!-- Tampil Foto Bukti Pembayaran -->
                    <div style="background: #f9f9f9; padding: 20px; border-radius: 12px;">
                        <h5 style="margin-bottom: 15px; color: #333;">📸 Bukti Pembayaran yang Diupload:</h5>
                        
                        @php
                            $ext = pathinfo($pembayaran->bukti_bayar, PATHINFO_EXTENSION);
                            $isPDF = strtolower($ext) === 'pdf';
                        @endphp
                        
                        @if($isPDF)
                            <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd; text-align: center; margin-bottom: 15px;">
                                <div style="font-size: 3rem; margin-bottom: 10px;">📄</div>
                                <div style="color: #666;">File PDF: {{ basename($pembayaran->bukti_bayar) }}</div>
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" alt="Bukti Pembayaran" style="max-width: 100%; max-height: 400px; border-radius: 8px; border: 2px solid #667eea; margin-bottom: 15px;">
                        @endif
                        
                        <div style="display: flex; gap: 10px;">
                            @if(!$isPDF)
                                <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" target="_blank" style="flex: 1; padding: 12px; background: #667eea; color: white; text-decoration: none; border-radius: 8px; text-align: center; font-weight: 600;">
                                    👁️ Lihat Foto Penuh
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" download style="flex: 1; padding: 12px; background: #667eea; color: white; text-decoration: none; border-radius: 8px; text-align: center; font-weight: 600;">
                                    ⬇️ Download PDF
                                </a>
                            @endif
                            
                            <button type="button" onclick="document.getElementById('ganti_bukti_form').style.display='block'; document.getElementById('bukti_display').style.display='none';" style="flex: 1; padding: 12px; background: #ff6b6b; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                                🔄 Ganti Bukti
                            </button>
                        </div>
                    </div>

                    <!-- Form Ganti Bukti (Hidden by default) -->
                    <div id="ganti_bukti_form" style="display: none; background: #fff3cd; padding: 20px; border-radius: 12px; margin-top: 15px; border: 2px solid #ffc107;">
                        <h5 style="margin-bottom: 15px; color: #333;">📝 Upload Bukti Pembayaran Baru:</h5>
                        
                        <form action="{{ route('siswa.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #333;">Pilih Metode Pembayaran:</label>
                                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="metode_bayar" value="transfer" {{ $pembayaran && $pembayaran->metode_bayar === 'transfer' ? 'checked' : '' }}>
                                        <span>Transfer Bank</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="metode_bayar" value="e-wallet" {{ $pembayaran && $pembayaran->metode_bayar === 'e-wallet' ? 'checked' : '' }}>
                                        <span>E-Wallet</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="metode_bayar" value="VA" {{ $pembayaran && $pembayaran->metode_bayar === 'VA' ? 'checked' : '' }}>
                                        <span>Virtual Account</span>
                                    </label>
                                </div>
                            </div>

                            <div style="margin-bottom: 20px;">
                                <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #333;">Upload Bukti Pembayaran Baru:</label>
                                <div style="position: relative; display: inline-block; width: 100%;">
                                    <input type="file" name="bukti_bayar" accept=".pdf,.jpg,.jpeg,.png" required style="display: none;" id="bukti_bayar_ganti_input">
                                    <label for="bukti_bayar_ganti_input" style="display: block; padding: 30px; border: 2px dashed #ff6b6b; border-radius: 12px; text-align: center; cursor: pointer; background: white; transition: all 0.3s ease;">
                                        <div style="font-size: 2rem; margin-bottom: 10px;">📎</div>
                                        <div style="font-weight: 600; color: #ff6b6b;">Klik untuk memilih file baru</div>
                                        <div style="font-size: 0.9rem; color: #999; margin-top: 5px;">atau drag & drop file di sini</div>
                                    </label>
                                    <div id="file_name_ganti_display" style="margin-top: 10px; color: #28a745; font-weight: 600; display: none;"></div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 10px;">
                                <button type="submit" style="flex: 1; padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-size: 1rem; font-weight: 700; cursor: pointer;">
                                    ✅ Upload Bukti Baru
                                </button>
                                <button type="button" onclick="document.getElementById('ganti_bukti_form').style.display='none'; document.getElementById('bukti_display').style.display='block';" style="padding: 15px 20px; background: #6c757d; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer;">
                                    ❌ Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="bukti_display"></div>
                @endif
            </div>

            <!-- Payment Timeline -->
            <div class="status-card animate__animated animate__slideInUp" style="animation-delay: 0.4s;">
                <h3>📅 Tahapan Pembayaran</h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-title">1. Pembayaran ke Rekening</div>
                        <div class="timeline-desc">Lakukan pembayaran sesuai nominal ke rekening BRI di atas</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">2. Simpan Bukti Pembayaran</div>
                        <div class="timeline-desc">Ambil foto/screenshot bukti pembayaran Anda</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">3. Upload Bukti</div>
                        <div class="timeline-desc">Upload bukti pembayaran melalui menu Dokumen</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">4. Tunggu Verifikasi</div>
                        <div class="timeline-desc">Admin akan memverifikasi dalam waktu 1-2 hari kerja</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">5. Konfirmasi</div>
                        <div class="timeline-desc">Status akan berubah menjadi "Lunas" setelah diverifikasi</div>
                    </div>
                </div>
            </div>

        @else
            <!-- Empty State -->
            <div class="status-card" style="animation-delay: 0.1s;">
                <div class="empty-state">
                    <div class="empty-state-icon">📋</div>
                    <h3>Belum Ada Gelombang Aktif</h3>
                    <p>Silakan lakukan pendaftaran terlebih dahulu untuk melihat informasi pembayaran.</p>
                </div>
            </div>
        @endif

        <!-- Help Section -->
        <div class="status-card animate__animated animate__slideInUp" style="animation-delay: 0.5s; background: linear-gradient(135deg, #f0f7ff 0%, #e8f4f8 100%); border-left: 4px solid #667eea;">
            <h4 style="color: #667eea; margin-bottom: 15px;">❓ Bantuan Pembayaran</h4>
            <p style="color: #333; margin-bottom: 10px;">
                Jika mengalami kesulitan dalam pembayaran, hubungi admin melalui:
            </p>
            <ul style="margin-left: 20px; color: #333;">
                <li>WhatsApp: 081234567890</li>
                <li>Email: admin@smkantartika.sch.id</li>
                <li>Telepon: 0274-XXX-XXXX</li>
            </ul>
        </div>
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
    
    const nominalPembayaran = {{ $siswa->nominal_pembayaran ?? 0 }};

    applyPromoBtn.addEventListener('click', async function() {
        const kode = kodPromoInput.value.trim();
        
        if (!kode) {
            showPromoMessage('Masukkan kode promo terlebih dahulu', 'error');
            return;
        }

        try {
            const response = await fetch('{{ route("siswa.pembayaran.check-promo") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({
                    kode: kode,
                    id_gelombang: {{ $siswa->id_gelombang ?? 'null' }}
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

@endsection
