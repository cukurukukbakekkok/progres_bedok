@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">📌 Detail Gelombang Pendaftaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="fw-bold">{{ $gelombang->nama }}</h4>

            <table class="table table-striped mt-3">
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>{{ is_string($gelombang->tanggal_mulai) ? $gelombang->tanggal_mulai : $gelombang->tanggal_mulai->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td>{{ is_string($gelombang->tanggal_selesai) ? $gelombang->tanggal_selesai : $gelombang->tanggal_selesai->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Kuota</th>
                    <td>
                        @php
                            $sisaKuota = max(0, ($gelombang->kuota ?? 0) - $calonSiswa);
                            $persentase = ($gelombang->kuota ?? 0) > 0 ? (($calonSiswa / $gelombang->kuota) * 100) : 100;
                        @endphp
                        <div class="mb-2"><strong>{{ $gelombang->kuota }} Siswa</strong> ({{ $calonSiswa }} terdaftar, {{ $sisaKuota }} sisa)</div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar @if($sisaKuota <= 0) bg-danger @elseif($sisaKuota <= 10) bg-warning @else bg-success @endif" 
                                 role="progressbar" 
                                 style="width: {{ $persentase }}%;" 
                                 aria-valuenow="{{ $persentase }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ round($persentase, 1) }}%
                            </div>
                        </div>
                        @if($sisaKuota <= 0)
                            <small class="text-danger"><strong>⚠️ Kuota telah HABIS - Gelombang akan/sudah dinonaktifkan</strong></small>
                        @elseif($sisaKuota <= 10)
                            <small class="text-warning"><strong>⚠️ Kuota tinggal sedikit!</strong></small>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Potongan Harga</th>
                    <td>
                        <strong>Rp {{ number_format($gelombang->potongan ?? 0, 0, ',', '.') }}</strong>
                        @if($gelombang->keterangan_potongan)
                            <br><small class="text-muted">{{ $gelombang->keterangan_potongan }}</small>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge @if($gelombang->status == 'aktif') bg-success @else bg-secondary @endif">
                            {{ ucfirst($gelombang->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $gelombang->deskripsi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Calon Siswa</th>
                    <td><span class="badge bg-info"><strong>{{ $calonSiswa }}</strong></span> pendaftar</td>
                </tr>
                <tr>
                    <th>Pembayaran</th>
                    <td><span class="badge bg-warning"><strong>{{ $pembayaran }}</strong></span> pembayaran</td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('admin.gelombang.siswa', $gelombang->id) }}" class="btn btn-info">
                    👥 Lihat Daftar Siswa
                </a>
                <a href="{{ route('admin.gelombang.edit', $gelombang->id) }}" class="btn btn-warning">
                    ✏️ Edit
                </a>
                <form action="{{ route('admin.gelombang.destroy', $gelombang->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus gelombang ini?')" class="btn btn-danger">
                        🗑 Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">⬅ Kembali</a>
</div>
@endsection
