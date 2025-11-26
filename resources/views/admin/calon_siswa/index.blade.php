@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-secondary">📋 Daftar Calon Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($calonSiswa as $s)
                <tr class="text-center table-row-hover">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama_lengkap }}</td>
                    <td>{{ $s->nisn }}</td>
                    <td>{{ $s->asal_sekolah }}</td>
                    <td>
                        <span class="badge 
                            @if($s->status_pembayaran == 'Lunas') bg-success
                            @elseif($s->status_pembayaran == 'Menunggu') bg-warning
                            @endif
                        ">
                            {{ $s->status_pembayaran }}
                        </span>
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
                    <td colspan="7" class="text-center text-muted py-3">
                        Belum ada pendaftar 😢
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $calonSiswa->links() }}
    </div>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>

{{-- 🌟 Animasi hover --}}
<style>
    .table-row-hover:hover {
        background-color: #f3faff !important;
        transition: .2s;
        transform: scale(1.01);
    }
</style>
@endsection
