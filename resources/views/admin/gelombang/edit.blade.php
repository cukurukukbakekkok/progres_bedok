@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">✏️ Edit Gelombang Pendaftaran</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.gelombang.update', $gelombang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label"><strong>Nama Gelombang</strong></label>
                    <input type="text" name="nama" class="form-control" value="{{ $gelombang->nama }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Tanggal Mulai</strong></label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="{{ is_string($gelombang->tanggal_mulai) ? $gelombang->tanggal_mulai : $gelombang->tanggal_mulai->format('Y-m-d') }}" required>
                            @error('tanggal_mulai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Tanggal Selesai</strong></label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ is_string($gelombang->tanggal_selesai) ? $gelombang->tanggal_selesai : $gelombang->tanggal_selesai->format('Y-m-d') }}" required>
                            @error('tanggal_selesai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Kuota Siswa</strong></label>
                    <input type="number" name="kuota" class="form-control" value="{{ $gelombang->kuota }}" min="1" required>
                    @error('kuota')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>💰 Potongan Harga (Rp)</strong></label>
                    <input type="number" name="potongan" class="form-control" value="{{ $gelombang->potongan ?? 0 }}" min="0">
                    <small class="text-muted">Contoh: Gelombang 1 = 1000000, Gelombang 2 = 750000, dst</small>
                    @error('potongan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Keterangan Potongan (Opsional)</strong></label>
                    <textarea name="keterangan_potongan" class="form-control" rows="2">{{ $gelombang->keterangan_potongan }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Deskripsi</strong></label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ $gelombang->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Status</strong></label>
                    <select name="status" class="form-control" required>
                        <option value="aktif" {{ $gelombang->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $gelombang->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">💾 Update Gelombang</button>
                <a href="{{ route('admin.gelombang.show', $gelombang->id) }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
