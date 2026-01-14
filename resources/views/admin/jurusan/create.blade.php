@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Jurusan</h3>
    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <label>Nama Jurusan</label>
        <input type="text" name="nama" class="form-control mb-3" required>

        <label>Keterangan (opsional)</label>
        <textarea name="keterangan" class="form-control mb-3"></textarea>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
