@extends('layouts.app')

@section('title', 'Detail Calon Siswa')

@section('content')
<div class="container">
    <h3 class="mb-3">Detail Calon Siswa</h3>

    <table class="table">
        <tr><th>Nama Lengkap</th><td>{{ $data->nama_lengkap }}</td></tr>
        <tr><th>NISN</th><td>{{ $data->nisn }}</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $data->jenis_kelamin }}</td></tr>
        <tr><th>Asal Sekolah</th><td>{{ $data->asal_sekolah }}</td></tr>
        <tr><th>Nama Orang Tua</th><td>{{ $data->nama_orang_tua }}</td></tr>
        <tr><th>Alamat</th><td>{{ $data->alamat }}</td></tr>
        <tr><th>No HP</th><td>{{ $data->no_hp }}</td></tr>
        <tr>
            <th>Foto</th>
            <td>
                @if ($data->foto)
                    <img src="{{ asset('storage/calon_siswa/' . $data->foto) }}" width="120">
                @else -
                @endif
            </td>
        </tr>
        <tr>
            <th>Dokumen</th>
            <td>
                @if ($data->dokumen)
                    <a href="{{ asset('storage/calon_siswa/' . $data->dokumen) }}" target="_blank">Lihat Dokumen</a>
                @else -
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('admin.calon_siswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
