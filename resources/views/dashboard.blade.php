@extends('layouts.main')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
    .dashboard-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 30px 20px;
    }

    .dashboard-header {
        color: white;
        margin-bottom: 40px;
        animation: slideDown 0.6s ease-out;
    }

    .dashboard-header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 8px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .dashboard-header p {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        animation: slideUp 0.6s ease-out backwards;
        border-top: 5px solid;
        position: relative;
        overflow: hidden;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; border-top-color: #667eea; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; border-top-color: #28a745; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; border-top-color: #ffc107; }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(102,126,234,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .stat-card-content {
        position: relative;
        z-index: 1;
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: inline-block;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #999;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-description {
        font-size: 0.85rem;
        color: #999;
    }

    /* Section Title */
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideDown 0.6s ease-out 0.4s backwards;
    }

    .section-title-bar {
        width: 5px;
        height: 30px;
        background: white;
        border-radius: 3px;
    }

    /* Action Buttons */
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
        animation: slideUp 0.6s ease-out 0.5s backwards;
    }

    .action-btn {
        background: white;
        border: none;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .action-btn .icon {
        font-size: 2rem;
    }

    .action-btn:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .action-btn:active {
        transform: translateY(-3px);
    }

    /* Pengumuman Card */
    .announcement-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        animation: slideUp 0.6s ease-out 0.6s backwards;
    }

    .announcement-item {
        padding: 20px;
        border-left: 4px solid #667eea;
        background: #f9f9f9;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .announcement-item:last-child {
        margin-bottom: 0;
    }

    .announcement-item:hover {
        background: #f0f0f0;
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .announcement-title {
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
        font-size: 1.05rem;
    }

    .announcement-date {
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 8px;
    }

    .announcement-content {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.5;
    }

    .announcement-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 10px;
        text-transform: uppercase;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 15px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 2rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }

        .dashboard-wrapper {
            padding: 20px 15px;
        }
    }

    .container-lg {
        max-width: 1200px;
        margin: 0 auto;
    }
</style>

<div class="dashboard-wrapper">
    <div class="container-lg">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>👋 Selamat datang, {{ Auth::user()->username ?? 'User' }}!</h1>
            <p>Kelola pendaftaran dan dokumen Anda di sini</p>
        </div>

        <!-- Stat Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-icon">📋</div>
                        <div class="stat-label">Total Pendaftar</div>
                        <div class="stat-value">{{ $totalPendaftar ?? 0 }}</div>
                        <div class="stat-description">Calon siswa terdaftar</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-icon">✅</div>
                        <div class="stat-label">Pembayaran Lunas</div>
                        <div class="stat-value">{{ $lunas ?? 0 }}</div>
                        <div class="stat-description">Sudah dikonfirmasi admin</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-label">Menunggu Konfirmasi</div>
                        <div class="stat-value">{{ $menunggu ?? 0 }}</div>
                        <div class="stat-description">Belum dikonfirmasi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="section-title">
            <div class="section-title-bar"></div>
            🚀 Aksi Cepat
        </div>

        <div class="action-buttons">
            <a href="{{ route('siswa.pendaftaran') }}" class="action-btn" title="Isi formulir pendaftaran">
                <div class="icon">📝</div>
                <div>Daftar Sekarang</div>
            </a>
            <a href="{{ route('siswa.biodata') }}" class="action-btn" title="Lihat data pribadi">
                <div class="icon">👤</div>
                <div>Lihat Biodata</div>
            </a>
            <a href="{{ route('siswa.dokumen.index') }}" class="action-btn" title="Upload dokumen">
                <div class="icon">📄</div>
                <div>Upload Dokumen</div>
            </a>
            <a href="{{ route('siswa.pembayaran') }}" class="action-btn" title="Pembayaran">
                <div class="icon">💳</div>
                <div>Informasi Pembayaran</div>
            </a>
        </div>

        <!-- Pengumuman -->
        @if(isset($pengumuman) && count($pengumuman) > 0)
        <div class="section-title" style="margin-top: 30px;">
            <div class="section-title-bar"></div>
            📢 Pengumuman Terbaru
        </div>

        <div class="announcement-section">
            @foreach($pengumuman as $p)
                <div class="announcement-item">
                    <div class="announcement-title">{{ $p->judul }}</div>
                    <div class="announcement-date">📅 {{ \Carbon\Carbon::parse($p->tanggal_post)->format('d M Y') }}</div>
                    <div class="announcement-content">
                        {{ \Illuminate\Support\Str::limit($p->isi, 150, '...') }}
                    </div>
                    <span class="announcement-badge">Informasi</span>
                </div>
            @endforeach
        </div>
        @else
        <div class="announcement-section">
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <p>Belum ada pengumuman terbaru</p>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
