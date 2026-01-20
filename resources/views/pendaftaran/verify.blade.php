@extends('layouts.landing')

@section('title', 'Verifikasi Sertifikat PPDB')

@section('content')
<div class="py-5" style="background: linear-gradient(135deg, #f6f9fc 0%, #eef2f7 100%); min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                @if($calon)
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__zoomIn">
                        <div class="card-header bg-success text-white py-4">
                            <i class="ti ti-circle-check fs-1"></i>
                            <h3 class="fw-bold mb-0">Sertifikat Valid</h3>
                        </div>
                        <div class="card-body p-5">
                            <p class="text-muted mb-4">Sertifikat pendaftaran ini terdaftar secara resmi di sistem PPDB SMK ANTARTIKA 1 SDA.</p>
                            
                            <div class="bg-light p-4 rounded-3 text-start">
                                <div class="mb-3">
                                    <label class="text-muted small fw-bold text-uppercase">Nama Lengkap</label>
                                    <div class="fs-5 fw-bold">{{ $calon->nama_lengkap }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small fw-bold text-uppercase">Kode Pendaftaran</label>
                                    <div class="fs-5 fw-bold text-primary">{{ $calon->kode_pendaftaran }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small fw-bold text-uppercase">Jurusan</label>
                                    <div class="fs-5 fw-bold">{{ $calon->jurusan }}</div>
                                </div>
                                <div>
                                    <label class="text-muted small fw-bold text-uppercase">Tahun Ajaran</label>
                                    <div class="fs-5 fw-bold">{{ date('Y') }}/{{ date('Y')+1 }}</div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary rounded-pill px-4">Kembali ke Beranda</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__shakeX">
                        <div class="card-header bg-danger text-white py-4">
                            <i class="ti ti-circle-x fs-1"></i>
                            <h3 class="fw-bold mb-0">Sertifikat Tidak Valid</h3>
                        </div>
                        <div class="card-body p-5">
                            <p class="text-muted mb-4">Maaf, kode sertifikat yang Anda masukkan tidak ditemukan dalam sistem kami atau belum memenuhi syarat kelulusan.</p>
                            
                            <div class="alert alert-danger border-0 bg-danger-subtle text-danger">
                                Pastikan Anda melakukan scan langsung dari sertifikat resmi yang dikeluarkan oleh panitia PPDB.
                            </div>

                            <div class="mt-5">
                                <a href="{{ route('welcome') }}" class="btn btn-primary rounded-pill px-4">Kembali ke Beranda</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
