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
</style>
<div class="admin-wrapper">
<div class="admin-container">

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="fw-bold mb-4">{{ $pengumuman->judul }}</h2>
            <p class="text-muted">Tanggal: {{ $pengumuman->tanggal_post }}</p>
            <hr>
            <p>{{ $pengumuman->isi }}</p>
            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
        </div>
    </div>

</div>
</div>
@endsection
