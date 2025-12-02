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
        <h2 class="fw-bold text-secondary">📋 Gelombang Pendaftaran</h2>
        <a href="{{ route('admin.gelombang.create') }}" class="btn btn-primary">
            ➕ Tambah Gelombang
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Gelombang</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Kuota / Sisa</th>
                <th>Jumlah Siswa</th>
                <th>Potongan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gelombang as $g)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $g->nama }}</td>
                    <td>{{ is_string($g->tanggal_mulai) ? $g->tanggal_mulai : $g->tanggal_mulai->format('d M Y') }}</td>
                    <td>{{ is_string($g->tanggal_selesai) ? $g->tanggal_selesai : $g->tanggal_selesai->format('d M Y') }}</td>
                    <td>
                        @php
                            $jumlahSiswa = $g->calonSiswa()->count();
                            $sisaKuota = max(0, ($g->kuota ?? 0) - $jumlahSiswa);
                            $persentase = ($g->kuota ?? 0) > 0 ? (($jumlahSiswa / $g->kuota) * 100) : 100;
                        @endphp
                        <div class="small mb-1"><strong>{{ $g->kuota }} / {{ $sisaKuota }} sisa</strong></div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar @if($sisaKuota <= 0) bg-danger @elseif($sisaKuota <= 10) bg-warning @else bg-success @endif" 
                                 role="progressbar" 
                                 style="width: {{ $persentase }}%;" 
                                 aria-valuenow="{{ $persentase }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ round($persentase, 1) }}%
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-info">{{ $jumlahSiswa }}</span></td>
                    <td>Rp {{ number_format($g->potongan ?? 0, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge @if($g->status == 'aktif') bg-success @elseif($g->status == 'nonaktif' && $sisaKuota <= 0) bg-danger @else bg-secondary @endif">
                            {{ ucfirst($g->status) }}
                            @if($g->status == 'nonaktif' && $sisaKuota <= 0)
                                <br><small>(kuota habis)</small>
                            @endif
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.gelombang.show', $g->id) }}" class="btn btn-info btn-sm">
                            🔍 Detail
                        </a>
                        <a href="{{ route('admin.gelombang.edit', $g->id) }}" class="btn btn-warning btn-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.gelombang.destroy', $g->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">
                                🗑 Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-3">
                        Belum ada gelombang pendaftaran 😢
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $gelombang->links() }}
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
</div>
@endsection
