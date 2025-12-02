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
    <h2 class="mb-4 fw-bold">📋 Verifikasi Dokumen Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Jurusan</th>
                    <th>Status Verifikasi</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumen as $doc)
                    <tr class="text-center align-middle">
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $doc->siswa->nama_lengkap }}</td>
                        <td>{{ $doc->siswa->nisn }}</td>
                        <td><strong>{{ $doc->siswa->jurusan }}</strong></td>
                        <td>
                            @if($doc->status_verifikasi == 'Valid')
                                <span class="badge bg-success">✓ Valid</span>
                            @elseif($doc->status_verifikasi == 'Tidak Valid')
                                <span class="badge bg-danger">✗ Tidak Valid</span>
                            @else
                                <span class="badge bg-warning text-dark">⏳ Menunggu</span>
                            @endif
                        </td>
                        <td>{{ $doc->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.dokumen_siswa.show', $doc->id) }}" class="btn btn-info btn-sm">
                                🔍 Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada dokumen 😢
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $dokumen->links() }}
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>
@endsection
