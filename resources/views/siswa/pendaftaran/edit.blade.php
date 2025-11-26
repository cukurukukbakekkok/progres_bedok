@extends('layouts.app')

@section('title', 'Edit Calon Siswa')

@section('content')
<div class="container">
    <h3 class="mb-3">Edit Calon Siswa</h3>

    <form action="{{ route('admin.calon_siswa.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.calon_siswa.form')
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.calon_siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
