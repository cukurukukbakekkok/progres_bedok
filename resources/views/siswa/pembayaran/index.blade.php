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

    /* Payment Methods */
    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .method-card {
        background: rgba(255,255,255,0.15);
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        color: white;
        user-select: none;
        position: relative;
    }

    .method-card:hover {
        background: rgba(255,255,255,0.25);
        border-color: rgba(255,255,255,0.8);
        transform: translateY(-5px);
    }

    .method-card.active {
        background: rgba(255,255,255,0.4);
        border-color: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3), inset 0 0 20px rgba(255,255,255,0.2);
        transform: scale(1.05);
    }

    .method-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .method-name {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .method-info {
        font-size: 0.85rem;
        opacity: 0.9;
    }

    .method-checkmark {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 2rem;
        color: white;
        text-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .method-card.active .method-checkmark {
        display: block;
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
            <h1>💳 Informasi Pembayaran</h1>
            <p>Kelola pembayaran pendaftaran Anda</p>
        </div>

        <!-- Payment Methods -->
        <div class="payment-methods animate__animated animate__slideInDown" style="animation-delay: 0.1s;">
            <div class="method-card active" data-method="transfer-bank" onclick="selectMethod(this)">
                <div class="method-checkmark">✓</div>
                <div class="method-icon">🏦</div>
                <div class="method-name">Transfer Bank</div>
                <div class="method-info">BRI, BCA, Mandiri</div>
            </div>
            <div class="method-card" data-method="e-wallet" onclick="selectMethod(this)">
                <div class="method-checkmark">✓</div>
                <div class="method-icon">📱</div>
                <div class="method-name">E-Wallet</div>
                <div class="method-info">OVO, GoPay, Dana</div>
            </div>
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
                    @elseif($pembayaran->bukti_pembayaran)
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
                            <div class="info-value">{{ $pembayaran->bukti_pembayaran ? '✓ Tersedia' : '✗ Belum' }}</div>
                        </div>
                    </div>
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
                <div class="bank-details">
                    <div class="bank-row">
                        <span class="bank-label">Metode Pembayaran</span>
                        <span class="bank-value">Transfer Bank / E-Wallet</span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-label">Nama Bank</span>
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
                    <div class="bank-row">
                        <span class="bank-label">Nominal</span>
                        <span class="bank-value">Rp {{ number_format($siswa->nominal_pembayaran ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Upload Bukti -->
            <div class="upload-card animate__animated animate__slideInUp" style="animation-delay: 0.3s;">
                <h3>📤 Upload Bukti Pembayaran</h3>
                
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
    function selectMethod(element) {
        // Hapus active dari semua kartu
        document.querySelectorAll('.method-card').forEach(card => {
            card.classList.remove('active');
        });
        
        // Tambahkan active ke kartu yang diklik
        element.classList.add('active');
        
        // Simpan metode pembayaran yang dipilih
        const method = element.getAttribute('data-method');
        console.log('Metode pembayaran dipilih:', method);
    }

    // Handle file input display
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
</script>

@endsection
