<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Penerimaan - {{ $calon->nama_lengkap }}</title>
    <style>
        @page {
            margin: 0.5cm 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.2;
            color: #2d3748;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2d3748;
            padding-bottom: 8px;
            margin-bottom: 15px;
            position: relative;
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 65px;
        }
        .header-text {
            padding-left: 70px;
            padding-right: 70px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
            color: #1a202c;
        }
        .header h2 {
            margin: 1px 0;
            font-size: 13px;
            font-weight: bold;
            color: #4a5568;
        }
        .header p {
            margin: 0;
            font-size: 9px;
            color: #718096;
        }
        .title {
            text-align: center;
            margin-bottom: 15px;
        }
        .title h3 {
            font-size: 16px;
            text-transform: uppercase;
            margin-bottom: 2px;
            border-bottom: 1px solid #2d3748;
            display: inline-block;
        }
        .title p {
            margin: 0;
            font-size: 11px;
            color: #4a5568;
        }
        .main-text {
            margin-bottom: 12px;
            font-size: 12px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
            font-size: 12px;
        }
        .info-table td:first-child {
            width: 30%;
            font-weight: bold;
            color: #4a5568;
        }
        .payment-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        .payment-box h4 {
            margin: 0 0 8px 0;
            font-size: 11px;
            text-transform: uppercase;
            color: #4a5568;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 3px;
        }
        .payment-row {
            width: 100%;
            margin-bottom: 3px;
            font-size: 11px;
            clear: both;
        }
        .payment-label {
            float: left;
            color: #718096;
        }
        .payment-value {
            float: right;
            font-weight: bold;
            color: #2d3748;
        }
        .payment-total {
            border-top: 1px solid #e2e8f0;
            margin-top: 5px;
            padding-top: 5px;
            font-size: 13px;
            font-weight: bold;
        }
        .decision-box {
            text-align: center;
            margin: 15px 0;
            padding: 10px;
            border: 2px solid #38a169;
            background-color: #f0fff4;
            border-radius: 8px;
        }
        .decision-box p {
            margin: 0;
            font-size: 12px;
            color: #2f855a;
        }
        .decision-box h2 {
            margin: 0;
            font-size: 24px;
            color: #276749;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 20px;
            width: 100%;
        }
        .signature-container {
            float: right;
            width: 200px;
            text-align: center;
        }
        .signature-line {
            margin-top: 50px;
            border-bottom: 1px solid #2d3748;
            font-weight: bold;
            font-size: 12px;
        }
        .watermark {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            font-weight: bold;
            color: rgba(0,0,0,0.03);
            z-index: -1;
            white-space: nowrap;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="watermark">LOLOS SELEKSI</div>

    <div class="content">
        <div class="header">
            <img src="{{ public_path('assets/images/my/logo-antrek.png') }}" class="logo" alt="Logo">
            <div class="header-text">
                <h1>SMK ANTARTIKA 1 SIDOARJO</h1>
                <h2>PENERIMAAN PESERTA DIDIK BARU (PPDB)</h2>
                <p>Jl. Siwalan Panji, Buduran, Sidoarjo, Jawa Timur | Telp: (031) 8964034</p>
                <p>Website: www.smkantartika1sidoarjo.sch.id | Email: smkantartika1@gmail.com</p>
            </div>
        </div>

        <div class="title">
            <h3>SURAT KETERANGAN PENERIMAAN</h3>
            <p>Nomor: {{ $calon->kode_pendaftaran }}/SKP/{{ date('Y') }}</p>
        </div>

        <div class="main-text">
            Berdasarkan hasil seleksi administrasi dan verifikasi pembayaran yang telah dilaksanakan, Panitia PPDB <strong>SMK ANTARTIKA 1 SIDOARJO</strong> dengan ini menyatakan bahwa:
        </div>

        <table class="info-table">
            <tr>
                <td>No. Pendaftaran</td>
                <td>: {{ $calon->kode_pendaftaran }}</td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>: {{ strtoupper($calon->nama_lengkap) }}</td>
            </tr>
            <tr>
                <td>NISN / NIK</td>
                <td>: {{ $calon->nisn ?? '-' }} / {{ $calon->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>: {{ strtoupper($calon->asal_sekolah) }}</td>
            </tr>
            <tr>
                <td>Kompetensi Keahlian</td>
                <td>: {{ $calon->jurusan }}</td>
            </tr>
        </table>

        @php
            $pembayaran = $calon->pembayaran;
            $hargaBase = $calon->harga_jurusan ?? 0;
            $potonganGelombang = $calon->gelombang->potongan ?? 0;
            $potonganPromo = $pembayaran ? $pembayaran->potongan : 0;
            $nominalBayar = $pembayaran ? $pembayaran->nominal : ($calon->nominal_pembayaran ?? 0);
        @endphp

        <div class="payment-box">
            <h4>Rincian Pembayaran (Kuitansi)</h4>
            <div class="payment-row">
                <span class="payment-label">Biaya Pendidikan (Harga Asli)</span>
                <span class="payment-value">Rp. {{ number_format($hargaBase, 0, ',', '.') }}</span>
            </div>
            <div class="payment-row">
                <span class="payment-label">Potongan Gelombang ({{ $calon->gelombang->nama ?? 'Pendaftaran' }})</span>
                <span class="payment-value" style="color: #e53e3e;">- Rp. {{ number_format($potonganGelombang, 0, ',', '.') }}</span>
            </div>
            <div class="payment-row">
                <span class="payment-label">Potongan Promo / Voucher</span>
                <span class="payment-value" style="color: #e53e3e;">- Rp. {{ number_format($potonganPromo, 0, ',', '.') }}</span>
            </div>
            <div class="payment-row payment-total">
                <span class="payment-label" style="color: #2d3748; font-weight: bold;">TOTAL PEMBAYARAN</span>
                <span class="payment-value" style="color: #38a169;">Rp. {{ number_format($nominalBayar, 0, ',', '.') }}</span>
            </div>
            <div class="payment-row" style="margin-top: 5px; font-size: 10px; color: #718096;">
                <span>Status: <strong>LUNAS (Verified)</strong></span>
                <span style="float: right;">Tgl Verifikasi: {{ $pembayaran && $pembayaran->verified_at ? $pembayaran->verified_at->translatedFormat('d F Y H:i') : ($calon->updated_at->format('d/m/Y')) }}</span>
            </div>
        </div>

        <div class="decision-box">
            <p>Dinyatakan:</p>
            <h2>LOLOS SELEKSI</h2>
        </div>

        <div class="main-text">
            <p style="margin-bottom: 5px;">Sebagai Siswa Baru SMK ANTARTIKA 1 SIDOARJO Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}.</p>
            <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya. Harap melakukan daftar ulang sesuai jadwal yang telah diinformasikan.</p>
        </div>

        <div class="footer clearfix">
            <div class="signature-container">
                <p>Sidoarjo, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Kepala Panitia PPDB,</p>
                <div class="signature-line">
                    PANITIA PPDB 2026/2027
                </div>
                <p style="font-size: 10px; color: #718096; margin-top: 3px;">Dokumen ini diterbitkan secara sistem.</p>
            </div>
        </div>
    </div>
</body>
</html>
