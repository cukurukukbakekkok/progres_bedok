@extends('layouts.app')

@section('content')
<h2>{{ $pengumuman->judul }}</h2>
<p>{{ $pengumuman->isi }}</p>
<p>Tanggal: {{ $pengumuman->tanggal_post }}</p>

<a href="{{ route('pengumuman.index') }}">⬅ Kembali</a>
@endsection
