@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Pengumuman</h3>
    <form action="{{ route('admin.pengumuman.update',$pengumuman->id) }}" method="POST">
        @csrf @method('PUT')

        <label>Judul</label>
        <input type="text" name="judul" value="{{$pengumuman->judul }}" class="form-control mb-3" required>

        <label>Isi Pengumuman</label>
        <textarea name="isi" class="form-control mb-3" rows="5" required>{{$pengumuman->isi }}</textarea>

        <label>Tanggal Post</label>
        <input type="date" name="tanggal_post" value="{{$pengumuman->tanggal_post }}" class="form-control mb-3" required>

        <button class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
