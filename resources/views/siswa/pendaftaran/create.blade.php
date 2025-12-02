@extends('layouts.main')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .registration-wrapper {
        min-height: 100vh;
        padding: 40px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .registration-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Header Section */
    .header-section {
        text-align: center;
        color: white;
        margin-bottom: 50px;
        animation: slideDown 0.8s ease-out;
    }

    .header-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 12px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        letter-spacing: -1px;
    }

    .header-section p {
        font-size: 1.1rem;
        font-weight: 300;
        opacity: 0.95;
        margin-bottom: 30px;
    }

    /* Main Form Card */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: slideUp 0.8s ease-out;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    /* Code Card */
    .code-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 35px;
        color: white;
        position: relative;
        overflow: hidden;
        animation: fadeIn 1s ease-out 0.3s both;
    }

    .code-card::before {
        content: '✨';
        position: absolute;
        font-size: 100px;
        opacity: 0.1;
        right: -30px;
        top: -30px;
    }

    .code-card-content {
        position: relative;
        z-index: 1;
    }

    .code-label {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .code-display {
        font-size: 2.2rem;
        font-weight: 800;
        font-family: 'Courier New', monospace;
        letter-spacing: 4px;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .code-hint {
        font-size: 0.85rem;
        opacity: 0.85;
        margin-top: 12px;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 25px;
        animation: fadeIn 0.6s ease-out backwards;
    }

    .form-group:nth-child(1) { animation-delay: 0.4s; }
    .form-group:nth-child(2) { animation-delay: 0.5s; }
    .form-group:nth-child(3) { animation-delay: 0.6s; }
    .form-group:nth-child(4) { animation-delay: 0.7s; }
    .form-group:nth-child(5) { animation-delay: 0.8s; }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    .form-group label:hover {
        color: #667eea;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
        background: #f9f9f9;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-hint {
        font-size: 0.85rem;
        color: #999;
        margin-top: 6px;
    }

    /* Grid Layout */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    /* Alert Messages */
    .alert {
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        animation: slideDown 0.5s ease-out;
    }

    .alert.success {
        background: #d4edda;
        border: 2px solid #28a745;
        color: #155724;
    }

    .alert.error {
        background: #f8d7da;
        border: 2px solid #dc3545;
        color: #721c24;
    }

    .alert.warning {
        background: #fff3cd;
        border: 2px solid #ffc107;
        color: #856404;
    }

    .alert ul {
        margin-left: 20px;
        margin-top: 10px;
    }

    .alert li {
        margin-top: 5px;
    }

    /* Info Card Gelombang */
    .gelombang-info {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-left: 5px solid #667eea;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        animation: slideDown 0.5s ease-out;
    }

    .gelombang-info h4 {
        color: #667eea;
        margin-bottom: 20px;
        font-size: 1.1rem;
        font-weight: 700;
    }

    .gelombang-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-item {
        background: white;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .stat-label {
        font-size: 0.8rem;
        color: #999;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #667eea;
    }

    .progress-container {
        margin-top: 20px;
    }

    .progress-label {
        font-size: 0.9rem;
        color: #666;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .progress-bar {
        width: 100%;
        height: 12px;
        background: #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    }

    .progress-fill {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.75rem;
        transition: all 0.4s ease;
    }

    /* Pricing Card */
    .pricing-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        animation: slideUp 0.5s ease-out;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .pricing-card h4 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pricing-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        font-size: 1rem;
    }

    .pricing-row:last-child {
        border-bottom: none;
    }

    .pricing-label {
        flex: 1;
    }

    .pricing-sublabel {
        font-size: 0.85rem;
        opacity: 0.8;
        margin-top: 4px;
    }

    .pricing-amount {
        font-size: 1.2rem;
        font-weight: 700;
        min-width: 150px;
        text-align: right;
    }

    .pricing-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        margin-top: 15px;
        padding-top: 20px;
        border-top: 2px solid rgba(255,255,255,0.3);
        font-size: 1.2rem;
    }

    .pricing-total-label {
        font-weight: 700;
    }

    .pricing-total-amount {
        font-size: 2rem;
        font-weight: 800;
    }

    /* Button */
    .submit-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header-section h1 {
            font-size: 2.5rem;
        }

        .form-card {
            padding: 30px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .gelombang-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .registration-wrapper {
            padding: 20px 15px;
        }
    }

    .hidden {
        display: none !important;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
        background: #f9f9f9;
    }

    .form-control:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }
</style>

<div class="registration-wrapper">
    <div class="registration-container">
        <!-- Header -->
        <div class="header-section animate__animated animate__slideInDown">
            <h1>📝 Pendaftaran Siswa Baru</h1>
            <p>Bergabunglah dengan ribuan siswa teladan di sekolah kami</p>
        </div>

        <!-- Form Card -->
        <div class="form-card" style="position: relative;">
            <!-- Status Messages -->
            @if(session('success'))
                <div class="alert success animate__animated animate__slideInDown">
                    <strong>✅ Sukses!</strong> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert error animate__animated animate__slideInDown">
                    <strong>❌ Error!</strong> {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert warning animate__animated animate__slideInDown">
                    <strong>⚠️ Ada kesalahan pada form:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Kode Formulir -->
            <div class="code-card animate__animated animate__fadeInUp">
                <div class="code-card-content">
                    <div class="code-label">🎫 Kode Formulir Pendaftaran Anda</div>
                    <div class="code-display">{{ $kodePendaftaranPreview }}</div>
                    <div class="code-hint">💾 Simpan kode ini untuk referensi dan tracking pendaftaran Anda</div>
                </div>
            </div>

            <!-- Main Form -->
            <form action="{{ route('siswa.pendaftaran.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Gelombang Selection -->
                <div class="form-group animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <label for="gelombang">📋 Pilih Gelombang Pendaftaran <span style="color: #dc3545;">*</span></label>
                    <select id="gelombang" name="id_gelombang" class="form-control" required onchange="updateGelombangInfo()">
                        <option value="">-- Pilih Gelombang --</option>
                        @foreach($gelombang as $g)
                            @if($g->status == 'aktif')
                                @php
                                    $mulai = is_string($g->tanggal_mulai) ? $g->tanggal_mulai : $g->tanggal_mulai->format('d M Y');
                                    $selesai = is_string($g->tanggal_selesai) ? $g->tanggal_selesai : $g->tanggal_selesai->format('d M Y');
                                    $jumlahSiswa = $g->calonSiswa()->count();
                                    $sisaKuota = max(0, ($g->kuota ?? 0) - $jumlahSiswa);
                                @endphp
                                <option value="{{ $g->id }}" 
                                        data-kuota="{{ $g->kuota }}" 
                                        data-terdaftar="{{ $jumlahSiswa }}"
                                        data-sisa="{{ $sisaKuota }}"
                                        data-potongan="{{ $g->potongan ?? 0 }}"
                                        data-keterangan-potongan="{{ $g->keterangan_potongan ?? '' }}"
                                        data-deskripsi="{{ $g->deskripsi ?? '' }}">
                                    {{ $g->nama }} ({{ $mulai }} - {{ $selesai }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_gelombang')
                        <div class="form-hint" style="color: #dc3545;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gelombang Info -->
                <div id="gelombangInfo" class="gelombang-info hidden animate__animated animate__slideInDown">
                    <h4>📊 Informasi Gelombang Pendaftaran</h4>
                    <div class="gelombang-stats">
                        <div class="stat-item">
                            <div class="stat-label">Kuota Total</div>
                            <div class="stat-value"><span id="kuotaTotal">0</span></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Terdaftar</div>
                            <div class="stat-value" style="color: #ffc107;"><span id="terdaftar">0</span></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Sisa Kuota</div>
                            <div class="stat-value" style="color: #28a745;"><span id="sisaKuota">0</span></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Status</div>
                            <div id="ketersediaan" style="font-size: 1rem; margin-top: 8px;">✅</div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-label">Persentase Terisi Kuota</div>
                        <div class="progress-bar">
                            <div id="progressBar" class="progress-fill" style="width: 0%; background: linear-gradient(90deg, #28a745, #20c997);">
                                <span id="progressText">0%</span>
                            </div>
                        </div>
                    </div>

                    <div id="deskripsiDiv" class="hidden" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(0,0,0,0.1);">
                        <p style="font-size: 0.9rem; color: #666;"><strong>Keterangan:</strong></p>
                        <p id="deskripsi" style="font-size: 0.9rem; color: #666; margin-top: 8px;"></p>
                    </div>
                </div>

                <!-- Personal Info -->
                <h5 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 30px 0 20px 0; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                    ℹ️ Data Pribadi Anda
                </h5>

                <div class="form-row animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="form-group">
                        <label>Nama Lengkap <span style="color: #dc3545;">*</span></label>
                        <input type="text" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>NISN <span style="color: #dc3545;">*</span></label>
                        <input type="text" name="nisn" required>
                    </div>
                </div>

                <div class="form-row animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="form-group">
                        <label>Tempat Lahir <span style="color: #dc3545;">*</span></label>
                        <input type="text" name="tempat_lahir" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir <span style="color: #dc3545;">*</span></label>
                        <input type="date" name="tanggal_lahir" required min="1950-01-01" max="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="form-row animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                    <div class="form-group">
                        <label>Jenis Kelamin <span style="color: #dc3545;">*</span></label>
                        <select name="jenis_kelamin" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">🧑 Laki-laki</option>
                            <option value="Perempuan">👩 Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asal Sekolah <span style="color: #dc3545;">*</span></label>
                        <input type="text" name="asal_sekolah" required>
                    </div>
                </div>

                <!-- Program Selection -->
                <h5 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 30px 0 20px 0; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                    🎓 Pilihan Program
                </h5>

                <div class="form-group animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                    <label>Pilih Jurusan <span style="color: #dc3545;">*</span></label>
                    <select name="jurusan" required onchange="calculateTotal()">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="RPL" data-harga="3500000">🖥️ RPL (Rekayasa Perangkat Lunak)</option>
                        <option value="TPM" data-harga="4000000">⚙️ TPM (Teknik Pemesinan)</option>
                        <option value="TITL" data-harga="3750000">⚡ TITL (Teknik Instalasi Tenaga Listrik)</option>
                        <option value="TKR" data-harga="4200000">🚗 TKR (Teknik Kendaraan Ringan)</option>
                    </select>
                </div>

                <!-- Contact Info -->
                <h5 style="font-size: 1.1rem; font-weight: 700; color: #333; margin: 30px 0 20px 0; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                    📞 Informasi Kontak
                </h5>

                <div class="form-row animate__animated animate__fadeInUp" style="animation-delay: 0.7s;">
                    <div class="form-group">
                        <label>Nama Orang Tua <span style="color: #dc3545;">*</span></label>
                        <input type="text" name="nama_orang_tua" required>
                    </div>
                    <div class="form-group">
                        <label>No HP <span style="color: #dc3545;">*</span></label>
                        <input type="text" name="no_hp" required>
                    </div>
                </div>

                <div class="form-group animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
                    <label>Alamat <span style="color: #dc3545;">*</span></label>
                    <textarea name="alamat" required placeholder="Masukkan alamat lengkap Anda..."></textarea>
                </div>

                <!-- Pricing Summary -->
                <div id="pricingCard" class="pricing-card hidden animate__animated animate__slideInUp" style="animation-delay: 0.9s;">
                    <h4>💰 Rincian Biaya Pendaftaran</h4>
                    
                    <div class="pricing-row">
                        <div class="pricing-label">
                            Biaya Pendaftaran<span id="jurusanText"></span>
                            <div class="pricing-sublabel">Harga standar jurusan pilihan</div>
                        </div>
                        <div class="pricing-amount" id="hargaJurusanDisplay">Rp 0</div>
                    </div>

                    <div class="pricing-row">
                        <div class="pricing-label">
                            Potongan Harga <span id="gelombangNameText"></span>
                            <div class="pricing-sublabel" id="potonganKeteranganText"></div>
                        </div>
                        <div class="pricing-amount" style="color: #a8d5ff;" id="potonganDisplay">-</div>
                    </div>

                    <div class="pricing-total">
                        <span class="pricing-total-label">Total Pembayaran</span>
                        <span class="pricing-total-amount" id="totalDisplay">Rp 0</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn animate__animated animate__fadeInUp" style="animation-delay: 1s;">
                    ✉️ Kirim Formulir Pendaftaran
                </button>

                <p style="text-align: center; color: #999; margin-top: 20px; font-size: 0.9rem;">
                    📌 Pastikan semua data sudah benar sebelum mengirim. Anda tidak bisa mengubahnya setelah submit.
                </p>
            </form>
        </div>
    </div>
</div>

<script>
// Harga jurusan lookup
const hargaJurusan = {
    'RPL': 3500000,
    'TPM': 4000000,
    'TITL': 3750000,
    'TKR': 4200000,
};

// Format rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
}

// Calculate and show total pricing
function calculateTotal() {
    const jurusanSelect = document.querySelector('select[name="jurusan"]');
    const gelombangSelect = document.querySelector('select[name="id_gelombang"]');
    const pricingCard = document.getElementById('pricingCard');

    const selectedJurusan = jurusanSelect.value;
    const selectedGelombang = gelombangSelect.options[gelombangSelect.selectedIndex];

    // Show/hide pricing card
    if (!selectedJurusan || !gelombangSelect.value) {
        pricingCard.classList.add('hidden');
        return;
    }

    pricingCard.classList.remove('hidden');

    // Get values
    const harga = hargaJurusan[selectedJurusan] || 0;
    const potongan = parseInt(selectedGelombang.dataset.potongan) || 0;
    const total = Math.max(0, harga - potongan);

    // Update display
    document.getElementById('jurusanText').textContent = selectedJurusan;
    document.getElementById('gelombangNameText').textContent = selectedGelombang.textContent.split('(')[0].trim();
    document.getElementById('hargaJurusanDisplay').textContent = formatRupiah(harga);
    
    if (potongan > 0) {
        document.getElementById('potonganDisplay').textContent = '- ' + formatRupiah(potongan);
        const keterangan = selectedGelombang.dataset.keteranganPotongan;
        if (keterangan) {
            document.getElementById('potonganKeteranganText').textContent = keterangan;
        } else {
            document.getElementById('potonganKeteranganText').textContent = 'Diskon gelombang ini';
        }
    } else {
        document.getElementById('potonganDisplay').textContent = '✓ Gratis';
        document.getElementById('potonganKeteranganText').textContent = 'Tidak ada potongan untuk gelombang ini';
    }

    document.getElementById('totalDisplay').textContent = formatRupiah(total);
}

function updateGelombangInfo() {
    const select = document.querySelector('select[name="id_gelombang"]');
    const selectedOption = select.options[select.selectedIndex];
    const infoDiv = document.getElementById('gelombangInfo');

    if (selectedOption.value === '') {
        infoDiv.classList.add('hidden');
        calculateTotal(); // Reset pricing card
        return;
    }

    infoDiv.classList.remove('hidden');

    const kuota = selectedOption.dataset.kuota;
    const terdaftar = selectedOption.dataset.terdaftar;
    const sisa = selectedOption.dataset.sisa;
    const deskripsi = selectedOption.dataset.deskripsi;

    // Update data
    document.getElementById('kuotaTotal').textContent = kuota;
    document.getElementById('sisaKuota').textContent = sisa;
    document.getElementById('terdaftar').textContent = terdaftar;

    // Update progress bar
    const kuotaNum = parseFloat(kuota) || 0;
    const terdaftarNum = parseFloat(terdaftar) || 0;
    const persentase = kuotaNum > 0 ? (terdaftarNum / kuotaNum) * 100 : 0;
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    
    let barColor = 'linear-gradient(90deg, #28a745, #20c997)'; // Hijau < 30%
    if (persentase > 80) barColor = 'linear-gradient(90deg, #dc3545, #c82333)'; // Merah >= 80%
    else if (persentase > 60) barColor = 'linear-gradient(90deg, #fd7e14, #e8590c)'; // Orange 60-80%
    else if (persentase > 30) barColor = 'linear-gradient(90deg, #ffc107, #e0a800)'; // Kuning 30-60%

    progressBar.style.background = barColor;
    progressBar.style.width = Math.min(persentase, 100) + '%';
    progressText.textContent = Math.round(persentase) + '%';

    // Update ketersediaan
    const ketersediaanDiv = document.getElementById('ketersediaan');
    if (sisa <= 0) {
        ketersediaanDiv.innerHTML = '❌ Habis';
        ketersediaanDiv.style.color = '#dc3545';
    } else if (sisa <= 10) {
        ketersediaanDiv.innerHTML = '⚠️ Sedikit';
        ketersediaanDiv.style.color = '#fd7e14';
    } else {
        ketersediaanDiv.innerHTML = '✅ Terbuka';
        ketersediaanDiv.style.color = '#28a745';
    }

    // Update deskripsi
    if (deskripsi) {
        document.getElementById('deskripsi').textContent = deskripsi;
        document.getElementById('deskripsiDiv').classList.remove('hidden');
    } else {
        document.getElementById('deskripsiDiv').classList.add('hidden');
    }

    // Recalculate total setelah gelombang berubah
    calculateTotal();
}
</script>
@endsection
