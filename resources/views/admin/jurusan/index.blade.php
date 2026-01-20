@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Kelola Kelas per Jurusan</h3>

    <div class="card p-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <ul class="list-group">
            @foreach($jurusans as $j)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $j->nama }}</strong>
                        <div class="text-muted small">{{ $j->keterangan }} ({{ $j->pendaftar_count }} Pendaftar)</div>
                    </div>
                    <a href="{{ route('admin.jurusan.show', $j->id) }}" class="btn btn-sm btn-primary">Manage Kelas</a>
                </li>
            @endforeach
        </ul>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
@endsection
