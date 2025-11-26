@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Kelola Pengumuman</h3>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary mb-3">+ Tambah Pengumuman</a>

    <table class="table table-bordered table-hover bg-white shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengumuman as $p)
            <tr>
                <td>{{ $p->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_post)->format('d M Y') }}</td>
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
