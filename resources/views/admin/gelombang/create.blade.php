@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold">➕ Tambah Gelombang Pendaftaran</h2>

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
                <form action="{{ route('admin.gelombang.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Gelombang</strong></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Gelombang 1" required
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><strong>Tanggal Mulai</strong></label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required
                                    value="{{ old('tanggal_mulai') }}" min="{{ date('Y-m-d') }}">
                                @error('tanggal_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><strong>Tanggal Selesai</strong></label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required
                                    value="{{ old('tanggal_selesai') }}" min="{{ date('Y-m-d') }}">
                                @error('tanggal_selesai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Kuota Siswa</strong></label>
                        <input type="number" name="kuota" class="form-control" placeholder="100" min="1" required
                            value="{{ old('kuota') }}">
                        @error('kuota')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>💰 Potongan Harga (Rp)</strong></label>
                        <input type="number" name="potongan" class="form-control"
                            placeholder="Contoh: 1000000 untuk potongan 1 juta" min="0" value="{{ old('potongan') ?? 0 }}">
                        <small class="text-muted">Contoh: Gelombang 1 = 1000000, Gelombang 2 = 750000, dst</small>
                        @error('potongan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Keterangan Potongan (Opsional)</strong></label>
                        <textarea name="keterangan_potongan" class="form-control"
                            placeholder="Contoh: Potongan 1 juta untuk pendaftar awal"
                            rows="2">{{ old('keterangan_potongan') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Deskripsi</strong></label>
                        <textarea name="deskripsi" class="form-control"
                            placeholder="Informasi tambahan tentang gelombang ini..."
                            rows="3">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <select name="status" class="form-control" required>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">✅ Simpan Gelombang</button>
                    <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts_content')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');

            // Get today's date in YYYY-MM-DD format (Local Time)
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const todayStr = `${year}-${month}-${day}`;

            // Set minimum tanggal mulai = hari ini (Fallback if PHP fails)
            if (!tanggalMulai.getAttribute('min')) {
                tanggalMulai.min = todayStr;
            }

            // Fungsi untuk update minimum tanggal selesai
            function updateMinTanggalSelesai() {
                if (tanggalMulai.value) {
                    // Set minimum tanggal selesai = tanggal mulai + 1 hari
                    const minDate = new Date(tanggalMulai.value);
                    minDate.setDate(minDate.getDate() + 1);
                    tanggalSelesai.min = minDate.toISOString().split('T')[0];

                    // Jika tanggal selesai kurang dari minimum, reset
                    if (tanggalSelesai.value && tanggalSelesai.value <= tanggalMulai.value) {
                        tanggalSelesai.value = minDate.toISOString().split('T')[0];
                    }
                }
            }

            // Update saat halaman dimuat
            updateMinTanggalSelesai();

            // Event listener untuk perubahan tanggal mulai
            tanggalMulai.addEventListener('change', function () {
                // Validasi tanggal mulai tidak boleh mundur dari hari ini
                if (tanggalMulai.value < todayStr) {
                    alert('Tanggal mulai tidak boleh mundur dari hari ini!');
                    tanggalMulai.value = todayStr;
                }
                updateMinTanggalSelesai();
            });

            // Validasi saat tanggal selesai diubah
            tanggalSelesai.addEventListener('change', function () {
                if (tanggalSelesai.value <= tanggalMulai.value) {
                    alert('Tanggal selesai harus setelah tanggal mulai!');
                    const minDate = new Date(tanggalMulai.value);
                    minDate.setDate(minDate.getDate() + 1);
                    tanggalSelesai.value = minDate.toISOString().split('T')[0];
                }
            });
        });
    </script>
@endsection