@extends('layouts.main')

@section('content')
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

    .table-wrapper {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow-x: auto;
    }

    .table-wrapper table {
        margin-bottom: 0;
    }

    .table-row-hover:hover {
        background-color: #f5f5f5;
        transition: all 0.2s ease;
    }
</style>

<div class="admin-wrapper">
<div class="admin-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">📋 Daftar Calon Siswa</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dokumen_siswa.index') }}" class="btn btn-warning">
                📑 Lihat Semua Dokumen Upload
            </a>
            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-primary">
                💳 Lihat Semua Pembayaran
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.calon_siswa.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari kode pendaftaran, nama, atau NISN..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">🔍 Cari</button>
                <a href="{{ route('admin.calon_siswa.index') }}" class="btn btn-secondary">Bersihkan</a>
            </form>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Status Pembayaran</th>
                <th>Status Berkas</th>
                <th>Status Kelulusan</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($calonSiswa as $s)
                <tr class="text-center table-row-hover">
                    <td>{{ $loop->iteration }}</td>
                    <td><strong class="text-primary">{{ $s->kode_pendaftaran ?? '-' }}</strong></td>
                    <td>{{ $s->nama_lengkap }}</td>
                    <td>{{ $s->nisn }}</td>
                    <td>{{ $s->asal_sekolah }}</td>
                    <td><strong>{{ $s->jurusan }}</strong></td>
                    <td>
                        <span class="badge 
                            @if($s->status_pembayaran == 'Lunas') bg-success
                            @elseif($s->status_pembayaran == 'Menunggu') bg-warning
                            @endif
                        ">
                            {{ $s->status_pembayaran }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($s->status_berkas == 'Valid') bg-success
                            @elseif($s->status_berkas == 'Tidak Valid') bg-danger
                            @else bg-secondary
                            @endif
                        ">
                            {{ $s->status_berkas ?? 'Belum' }}
                        </span>
                    </td>
                    <td>
                        @if($s->status_kelulusan)
                            <span class="badge 
                                @if($s->status_kelulusan == 'Lolos') bg-success
                                @elseif($s->status_kelulusan == 'Tidak Lolos') bg-danger
                                @endif
                            ">
                                {{ $s->status_kelulusan }}
                            </span>
                        @else
                            <span class="badge bg-secondary">Belum Diputuskan</span>
                        @endif
                    </td>
                    <td>{{ $s->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.calon_siswa.show', $s->id) }}" class="btn btn-info btn-sm">
                            🔍 Detail
                        </a>

                        <form action="{{ route('admin.calon_siswa.destroy', $s->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">
                                🗑 Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center text-muted py-3">
                        Belum ada pendaftar 😢
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $calonSiswa->links() }}
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>

@endsection
