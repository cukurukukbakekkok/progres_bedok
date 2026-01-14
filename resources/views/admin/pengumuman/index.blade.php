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
    <h3 class="mb-4">Kelola Pengumuman</h3>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary mb-3">+ Tambah Pengumuman</a>

    <div class="table-wrapper">
        <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengumuman as $p)
            <tr>
                <td>{{ $p->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_post)->format('d M Y') }}</td>
                <td>{!! $p->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Tidak</span>' !!}</td>
                <td>
                    <a href="{{ route('admin.pengumuman.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus pengumuman?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
     <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
    {{ $pengumuman->links() }}
</div>
@endsection
