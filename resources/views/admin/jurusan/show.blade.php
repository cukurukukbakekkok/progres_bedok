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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>{{ $jurusan->nama }} - Manajemen Kelas</h3>
            <small class="text-muted">{{ $jurusan->keterangan }}</small>
        </div>
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">⬅ Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Form Tambah Kelas -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">➕ Tambah Kelas Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jurusan.kelas.store', $jurusan->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   placeholder="misal: {{ $jurusan->nama }} 1" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kapasitas Siswa</label>
                            <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" 
                                   value="25" min="1" required>
                            @error('kapasitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Buat Kelas
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List Kelas -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">📚 Daftar Kelas ({{ $kelas->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($kelas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 30%">Nama Kelas</th>
                                        <th style="width: 20%">Kapasitas</th>
                                        <th style="width: 15%">Siswa</th>
                                        <th style="width: 15%">Sisa</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kelas as $k)
                                    <tr>
                                        <td><strong>{{ $k->nama }}</strong></td>
                                        <td><span class="badge bg-secondary">{{ $k->kapasitas }}</span></td>
                                        <td>
                                            <span class="badge bg-warning text-dark">{{ $k->calon_siswa_count }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $sisa = $k->kapasitas - $k->calon_siswa_count;
                                                $color = $sisa > 10 ? 'success' : ($sisa > 0 ? 'warning' : 'danger');
                                            @endphp
                                            <span class="badge bg-{{ $color }}">{{ $sisa }}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                                    data-bs-target="#editKelas{{ $k->id }}" title="Edit kapasitas">
                                                ✏️
                                            </button>
                                            @if($k->calon_siswa_count == 0)
                                                <form action="{{ route('admin.jurusan.kelas.destroy', [$jurusan->id, $k->id]) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="if(confirm('Hapus kelas ini?')) this.parentForm.submit()" 
                                                            title="Hapus kelas">
                                                        🗑️
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted" title="Tidak bisa hapus, ada siswa">🔒</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i> Belum ada kelas. Buat kelas baru di form samping.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kelas -->
@foreach($kelas as $k)
<div class="modal fade" id="editKelas{{ $k->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit {{ $k->nama }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.jurusan.kelas.update', [$jurusan->id, $k->id]) }}" method="POST">
        @csrf @method('PUT')
        <div class="modal-body">
          <label class="form-label">Kapasitas</label>
          <input type="number" name="kapasitas" class="form-control" value="{{ $k->kapasitas }}" min="{{ $k->calon_siswa_count }}" required>
          <small class="text-muted">Minimum: {{ $k->calon_siswa_count }} (jumlah siswa saat ini)</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
