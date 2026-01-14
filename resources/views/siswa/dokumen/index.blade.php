@php
    $calon = \App\Models\CalonSiswa::where('user_id', Auth::id())->first();
@endphp

@if($calon)
    @php
        $dokumen = $calon->dokumenPersyaratan;
    @endphp
    @include('siswa.dokumen.upload')
@else
    <div class="container mt-5">
        <div class="alert alert-warning" role="alert">
            <h4>⚠️ Biodata Belum Diisi</h4>
            <p>Silakan isi pendaftaran biodata terlebih dahulu sebelum upload dokumen.</p>
            <a href="{{ route('siswa.pendaftaran.create') }}" class="btn btn-primary">Isi Pendaftaran</a>
        </div>
    </div>
@endif

