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
    <h2 class="mb-4 fw-bold text-secondary">💰 Daftar Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Status -->
    <div class="mb-3">
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select w-auto">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
            @if(request('status'))
                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayaran as $p)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->siswa->nama_lengkap }}</td>
                    <td>{{ $p->siswa->nisn }}</td>
                    <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($p->metode_bayar) }}</td>
                    <td>
                        @if($p->status == 'lunas')
                            <span class="badge bg-success">✓ Lunas</span>
                        @elseif($p->status == 'gagal')
                            <span class="badge bg-danger">✗ Ditolak</span>
                        @else
                            <span class="badge bg-warning">⏳ Menunggu</span>
                        @endif
                    </td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.pembayaran.show', $p->id) }}" class="btn btn-info btn-sm">
                            🔍 Lihat
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        Belum ada pembayaran 😢
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $pembayaran->links() }}
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>
@endsection
