@extends('layouts.main')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
    .form-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 32px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        transition: .3s;
    }
    .form-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.18);
    }
    .input-box {
        border: 2px solid #d9d9d9;
        border-radius: 10px;
        padding: 12px 16px;
        width: 100%;
        transition: .25s;
    }
    .input-box:focus {
        border-color: #0066ff;
        box-shadow: 0 0 0 3px rgba(0,102,255,0.18);
        outline: none;
    }
    label {
        font-weight: 600;
    }
</style>

<div class="max-w-4xl mx-auto mt-10 animate__animated animate__fadeInUp">
    <div class="form-card">

        <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">
            Formulir Pendaftaran Siswa Baru
        </h2>
        <p class="text-center text-gray-600 mb-8">Lengkapi data diri dengan benar sebelum mengirim</p>

        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('siswa.pendaftaran.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="input-box" required>
            </div>

            <div>
                <label>NISN</label>
                <input type="text" name="nisn" class="input-box" required>
            </div>

            <div>
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="input-box" required>
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="input-box" required>
            </div>

            <div>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="input-box" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div>
                <label>Asal Sekolah</label>
                <input type="text" name="asal_sekolah" class="input-box" required>
            </div>

            <div>
                <label>Nama Orang Tua</label>
                <input type="text" name="nama_orang_tua" class="input-box" required>
            </div>

            <div>
                <label>No HP</label>
                <input type="text" name="no_hp" class="input-box" required>
            </div>

            <div>
                <label>Alamat</label>
                <textarea name="alamat" class="input-box" rows="3" required></textarea>
            </div>

            <button class="w-full py-3 bg-blue-600 text-white rounded-xl font-semibold
            hover:bg-blue-700 transition-all duration-300 hover:shadow-xl animate__animated animate__pulse animate__infinite">
                Kirim Pendaftaran
            </button>
        </form>

    </div>
</div>
@endsection
