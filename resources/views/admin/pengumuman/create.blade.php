@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Pengumuman</h3>
    <form action="{{ route('admin.pengumuman.store') }}" method="POST">
        @csrf
        <label>Judul</label>
        <input type="text" name="judul" class="form-control mb-3" required>

        <label>Isi Pengumuman</label>
        <textarea name="isi" class="form-control mb-3" rows="5" required></textarea>

        <label>Tanggal Post</label>
        <input type="date" name="tanggal_post" class="form-control mb-3" required>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
