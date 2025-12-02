@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">👥 Daftar Siswa - {{ $gelombang->nama }}</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.gelombang.siswa', $gelombang->id) }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari kode pendaftaran, nama, atau NISN..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">🔍 Cari</button>
                <a href="{{ route('admin.gelombang.siswa', $gelombang->id) }}" class="btn btn-secondary">Bersihkan</a>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-2">📋 Info Gelombang</h6>
            <ul class="small list-unstyled">
                <li><strong>Tanggal:</strong> {{ is_string($gelombang->tanggal_mulai) ? $gelombang->tanggal_mulai : $gelombang->tanggal_mulai->format('d M Y') }} s/d {{ is_string($gelombang->tanggal_selesai) ? $gelombang->tanggal_selesai : $gelombang->tanggal_selesai->format('d M Y') }}</li>
                <li><strong>Kuota:</strong> {{ $gelombang->kuota }} siswa</li>
                <li><strong>Potongan:</strong> Rp {{ number_format($gelombang->potongan ?? 0, 0, ',', '.') }}</li>
                <li><strong>Terdaftar:</strong> <span class="badge bg-info">{{ $calonSiswa->total() }}</span></li>
            </ul>
        </div>
    </div>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Jurusan</th>
                <th>Nominal Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Status Berkas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($calonSiswa as $s)
                <tr class="text-center">
                    <td>{{ ($calonSiswa->currentPage() - 1) * $calonSiswa->perPage() + $loop->iteration }}</td>
                    <td><strong class="text-primary">{{ $s->kode_pendaftaran ?? '-' }}</strong></td>
                    <td>{{ $s->nama_lengkap }}</td>
                    <td>{{ $s->nisn }}</td>
                    <td><strong>{{ $s->jurusan }}</strong></td>
                    <td>Rp {{ number_format($s->nominal_pembayaran, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if(strtolower($s->status_pembayaran) == 'lunas') bg-success
                            @elseif(strtolower($s->status_pembayaran) == 'menunggu') bg-warning
                            @else bg-secondary
                            @endif
                        ">
                            {{ $s->status_pembayaran ?? 'Belum' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($s->status_berkas == 'Valid') bg-success
                            @elseif($s->status_berkas == 'Tidak Valid') bg-danger
                            @else bg-secondary
                            @endif
                        ">
                            {{ $s->status_berkas ?? 'Belum' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.calon_siswa.show', $s->id) }}" class="btn btn-info btn-sm">
                            🔍 Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        Belum ada siswa mendaftar 😢
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $calonSiswa->links() }}
    </div>

    <a href="{{ route('admin.gelombang.show', $gelombang->id) }}" class="btn btn-secondary mt-3">⬅ Kembali</a>
</div>
@endsection
