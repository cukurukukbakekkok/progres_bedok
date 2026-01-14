@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --success: #48bb78;
        --text-dark: #2d3748;
        --text-light: #718096;
        --border-color: #e2e8f0;
    }

    body {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .detail-container {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
    }

    .header .subtitle {
        font-size: 14px;
        opacity: 0.9;
        margin-top: 5px;
    }

    .success-badge {
        display: inline-block;
        background: var(--success);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        margin-top: 10px;
        font-weight: bold;
    }

    .content {
        padding: 40px;
    }

    .section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary);
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-item {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid var(--primary);
    }

    .info-label {
        font-size: 12px;
        color: var(--text-light);
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 16px;
        color: var(--text-dark);
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid var(--border-color);
    }

    .btn-action {
        flex: 1;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        color: white;
    }

    .btn-secondary-custom {
        background: #e2e8f0;
        color: var(--text-dark);
    }

    .btn-secondary-custom:hover {
        background: #cbd5e0;
        text-decoration: none;
        color: var(--text-dark);
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .content {
            padding: 20px;
        }

        .header {
            padding: 20px;
        }
    }

    .print-notice {
        background: #fef5e7;
        border-left: 4px solid #f39c12;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        color: #7d6608;
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="header">
        <h1><i class="fas fa-check-circle"></i> Pendaftaran Berhasil!</h1>
        <div class="subtitle">Data Anda telah terdaftar dalam sistem</div>
        <div class="success-badge">✓ TERDAFTAR</div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Notice -->
        <div class="print-notice">
            <i class="fas fa-info-circle"></i> 
            <strong>Penting:</strong> Data pendaftaran Anda tidak dapat diubah lagi. Jika ada kesalahan, silakan hubungi bagian administrasi.
        </div>

        <!-- BIODATA SISWA -->
        <div class="section">
            <div class="section-title">📋 Data Biodata Siswa</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Kode Pendaftaran</div>
                    <div class="info-value">{{ $calon->kode_pendaftaran ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $calon->nama_lengkap }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">NISN</div>
                    <div class="info-value">{{ $calon->nisn }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">NIK</div>
                    <div class="info-value">{{ $calon->nik }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tempat Lahir</div>
                    <div class="info-value">{{ $calon->tempat_lahir }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Lahir</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($calon->tanggal_lahir)->format('d-m-Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-value">{{ $calon->jenis_kelamin }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Agama</div>
                    <div class="info-value">{{ $calon->agama }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Berat Badan</div>
                    <div class="info-value">{{ $calon->berat_badan }} kg</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tinggi Badan</div>
                    <div class="info-value">{{ $calon->tinggi_badan }} cm</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Asal Sekolah</div>
                    <div class="info-value">{{ $calon->asal_sekolah }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">No. HP</div>
                    <div class="info-value">{{ $calon->no_hp }}</div>
                </div>
            </div>
        </div>

        <!-- ALAMAT -->
        <div class="section">
            <div class="section-title">🏠 Alamat</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">{{ $calon->alamat }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">RT/RW</div>
                    <div class="info-value">{{ $calon->rt_rw }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kelurahan</div>
                    <div class="info-value">{{ $calon->kelurahan }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kecamatan</div>
                    <div class="info-value">{{ $calon->kecamatan }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kabupaten</div>
                    <div class="info-value">{{ $calon->kabupaten }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Provinsi</div>
                    <div class="info-value">{{ $calon->provinsi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kode Pos</div>
                    <div class="info-value">{{ $calon->kode_pos }}</div>
                </div>
            </div>
        </div>

        <!-- PILIHAN JURUSAN & KELAS -->
        <div class="section">
            <div class="section-title">🎓 Pilihan Jurusan & Kelas</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Jurusan</div>
                    <div class="info-value">{{ $calon->jurusan }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kelas Tujuan</div>
                    <div class="info-value">{{ $calon->kelas->nama ?? 'Belum Ditentukan' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Harga Pendaftaran</div>
                    <div class="info-value">Rp {{ number_format($calon->harga_jurusan, 0, ',', '.') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Nominal Pembayaran</div>
                    <div class="info-value" style="color: var(--success); font-weight: bold;">Rp {{ number_format($calon->nominal_pembayaran, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- ORANG TUA / WALI -->
        <div class="section">
            <div class="section-title">👨‍👩‍👧 Data Orang Tua / Wali</div>
            
            @if ($calon->status_keluarga == 'ayah_ibu')
                <!-- Ayah -->
                <div style="margin-bottom: 30px;">
                    <h5 style="color: var(--primary); margin-bottom: 15px; font-weight: bold;">👨 Data Ayah</h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nama Ayah</div>
                            <div class="info-value">{{ $calon->nama_ayah }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tempat Lahir</div>
                            <div class="info-value">{{ $calon->tempat_lahir_ayah }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tanggal Lahir</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($calon->tanggal_lahir_ayah)->format('d-m-Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Pendidikan</div>
                            <div class="info-value">{{ $calon->pendidikan_ayah }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Pekerjaan</div>
                            <div class="info-value">{{ $calon->pekerjaan_ayah }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Penghasilan/Bulan</div>
                            <div class="info-value">{{ $calon->penghasilan_ayah }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">No. HP</div>
                            <div class="info-value">{{ $calon->no_hp_ayah }}</div>
                        </div>
                    </div>
                </div>

                <!-- Ibu -->
                <div>
                    <h5 style="color: var(--primary); margin-bottom: 15px; font-weight: bold;">👩 Data Ibu</h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nama Ibu</div>
                            <div class="info-value">{{ $calon->nama_ibu }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tempat Lahir</div>
                            <div class="info-value">{{ $calon->tempat_lahir_ibu }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tanggal Lahir</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($calon->tanggal_lahir_ibu)->format('d-m-Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Pendidikan</div>
                            <div class="info-value">{{ $calon->pendidikan_ibu }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Pekerjaan</div>
                            <div class="info-value">{{ $calon->pekerjaan_ibu }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Penghasilan/Bulan</div>
                            <div class="info-value">{{ $calon->penghasilan_ibu }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">No. HP</div>
                            <div class="info-value">{{ $calon->no_hp_ibu }}</div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Wali -->
                <div>
                    <h5 style="color: var(--primary); margin-bottom: 15px; font-weight: bold;">🧑 Data Wali</h5>
                    <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                        <strong>Status Keluarga:</strong> 
                        @if ($calon->status_keluarga == 'yatim')
                            Yatim (Ayah Tidak Ada)
                        @elseif ($calon->status_keluarga == 'piatu')
                            Piatu (Ibu Tidak Ada)
                        @else
                            Yatim Piatu (Kedua Orang Tua Tidak Ada)
                        @endif
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nama Wali</div>
                            <div class="info-value">{{ $calon->nama_wali }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tempat Lahir</div>
                            <div class="info-value">{{ $calon->tempat_lahir_wali }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tanggal Lahir</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($calon->tanggal_lahir_wali)->format('d-m-Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Pekerjaan</div>
                            <div class="info-value">{{ $calon->pekerjaan_wali }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Penghasilan/Bulan</div>
                            <div class="info-value">{{ $calon->penghasilan_wali }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">No. HP</div>
                            <div class="info-value">{{ $calon->no_hp_wali }}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- ACTION BUTTONS -->
        <div class="action-buttons">
            <a href="{{ route('siswa.dashboard') }}" class="btn-action btn-primary-custom">
                <i class="fas fa-arrow-right"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

@endsection
