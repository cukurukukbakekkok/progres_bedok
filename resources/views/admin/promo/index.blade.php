@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">🏷️ Kelola Kode Promo</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0 fw-bold text-primary">Daftar Promo Aktif</h5>
                <a href="{{ route('admin.promo.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="ti ti-plus me-2"></i> Buat Promo Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="py-3 ps-4">Kode Promo</th>
                            <th class="py-3">Diskon</th>
                            <th class="py-3">Berlaku Untuk</th>
                            <th class="py-3">Masa Berlaku</th>
                            <th class="py-3">Penggunaan</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promo as $p)
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark border px-3 py-2 fs-6 font-monospace">{{ $p->kode_promo }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">Rp {{ number_format($p->diskon_nominal, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    @if($p->gelombang)
                                        <span class="badge bg-info text-dark">{{ $p->gelombang->nama_gelombang }}</span>
                                    @else
                                        <span class="badge bg-secondary">Semua Gelombang</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->tanggal_mulai && $p->tanggal_selesai)
                                        <small>{{ date('d/m/y', strtotime($p->tanggal_mulai)) }} - {{ date('d/m/y', strtotime($p->tanggal_selesai)) }}</small>
                                    @else
                                        <span class="text-muted small">Selamanya</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $p->used_count }} / {{ $p->max_usage > 0 ? $p->max_usage : '∞' }}
                                </td>
                                <td>
                                    @if($p->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.promo.edit', $p->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.promo.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus promo ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="ti ti-ticket fa-3x mb-3" style="font-size: 3rem;"></i>
                                        <p>Belum ada kode promo yang dibuat.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $promo->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
