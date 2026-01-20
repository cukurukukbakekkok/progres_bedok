@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-white">Edit Promo</h2>
                <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="kode_promo" class="form-label fw-bold">Kode Promo</label>
                            <input type="text" name="kode_promo" id="kode_promo" class="form-control form-control-lg text-uppercase font-monospace @error('kode_promo') is-invalid @enderror" value="{{ old('kode_promo', $promo->kode_promo) }}" required>
                            @error('kode_promo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="diskon_nominal" class="form-label fw-bold">Nominal Diskon (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="diskon_nominal" id="diskon_nominal" class="form-control form-control-lg @error('diskon_nominal') is-invalid @enderror" value="{{ old('diskon_nominal', $promo->diskon_nominal) }}" required>
                            </div>
                            @error('diskon_nominal')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="id_gelombang" class="form-label fw-bold">Berlaku Untuk Gelombang (Opsional)</label>
                            <select name="id_gelombang" id="id_gelombang" class="form-select @error('id_gelombang') is-invalid @enderror">
                                <option value="">-- Semua Gelombang --</option>
                                @foreach($gelombang as $g)
                                    <option value="{{ $g->id }}" {{ old('id_gelombang', $promo->id_gelombang) == $g->id ? 'selected' : '' }}>
                                        {{ $g->nama_gelombang }} ({{ $g->status }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_gelombang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" min="{{ date('Y-m-d') }}" value="{{ old('tanggal_mulai', $promo->tanggal_mulai ? $promo->tanggal_mulai->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tanggal_selesai" class="form-label fw-bold">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" min="{{ date('Y-m-d') }}" value="{{ old('tanggal_selesai', $promo->tanggal_selesai ? $promo->tanggal_selesai->format('Y-m-d') : '') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="max_usage" class="form-label fw-bold">Batas Penggunaan (Kuota)</label>
                            <input type="number" name="max_usage" id="max_usage" class="form-control @error('max_usage') is-invalid @enderror" value="{{ old('max_usage', $promo->max_usage) }}">
                            <div class="form-text">Isi 0 jika tidak ada batasan kuota.</div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $promo->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">Status Aktif</label>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold text-white">Update Promo</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('tanggal_mulai');
        const endDateInput = document.getElementById('tanggal_selesai');
        
        // Initial setup based on current values
        if (startDateInput.value) {
            endDateInput.min = startDateInput.value;
        }

        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
        });
    });
</script>
@endsection
