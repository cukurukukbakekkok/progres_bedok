@extends('layouts.app')

@section('title', 'Data Calon Siswa')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Calon Siswa</h3>
    <a href="{{ route('admin.calon_siswa.create') }}" class="btn btn-primary mb-3">+ Tambah Siswa</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nama_lengkap }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->asal_sekolah }}</td>
                    <td>{{ $siswa->no_hp }}</td>
                    <td>
                        <a href="{{ route('admin.calon_siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.calon_siswa.destroy', $siswa->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <a href="{{ route('admin.calon_siswa.show', $siswa->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
