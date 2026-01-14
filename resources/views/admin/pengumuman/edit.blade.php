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

    <h3 class="mb-4 fw-bold text-primary">✏️ Edit Pengumuman</h3>
    
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <form action="{{ route('admin.pengumuman.update',$pengumuman->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-600">Judul Pengumuman</label>
                    <input type="text" name="judul" value="{{ $pengumuman->judul }}" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan judul pengumuman" required>
                    @error('judul')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-600">Isi Pengumuman</label>
                    <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="6" placeholder="Masukkan isi pengumuman" required>{{ $pengumuman->isi }}</textarea>
                    @error('isi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-600">Tanggal Post</label>
                    <input type="date" name="tanggal_post" value="{{ $pengumuman->tanggal_post }}" class="form-control @error('tanggal_post') is-invalid @enderror" required>
                    @error('tanggal_post')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-600">📅 Mulai Tayang (Opsional)</label>
                            <input type="datetime-local" name="starts_at" value="{{ optional($pengumuman->starts_at)->format('Y-m-d\TH:i') }}" class="form-control @error('starts_at') is-invalid @enderror" placeholder="Tanggal & jam mulai tayang">
                            <small class="text-muted d-block mt-1">Kosongkan jika ingin tayang langsung</small>
                            @error('starts_at')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-600">⏰ Selesai Tayang (Opsional)</label>
                            <input type="datetime-local" name="ends_at" value="{{ optional($pengumuman->ends_at)->format('Y-m-d\TH:i') }}" class="form-control @error('ends_at') is-invalid @enderror" placeholder="Tanggal & jam selesai tayang">
                            <small class="text-muted d-block mt-1">Kosongkan jika ingin tayang selamanya</small>
                            @error('ends_at')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $pengumuman->is_active ? 'checked' : '' }}>
                    <label class="form-check-label fw-600" for="is_active">✓ Tayangkan pengumuman</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-lg">💾 Simpan Perubahan</button>
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary btn-lg">⬅ Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>
</div>
@endsection
