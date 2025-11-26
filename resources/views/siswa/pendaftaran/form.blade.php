<div class="row">
    <div class="col-md-6 mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $data->nama_lengkap ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>NISN</label>
        <input type="text" name="nisn" value="{{ old('nisn', $data->nisn ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data->tanggal_lahir ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $data->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>Asal Sekolah</label>
        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $data->asal_sekolah ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Nama Orang Tua</label>
        <input type="text" name="nama_orang_tua" value="{{ old('nama_orang_tua', $data->nama_orang_tua ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-12 mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $data->no_hp ?? '') }}" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
        @isset($data)
            <small>File sekarang: {{ $data->foto }}</small>
        @endisset
    </div>

    <div class="col-md-6 mb-3">
        <label>Dokumen (PDF)</label>
        <input type="file" name="dokumen" class="form-control">
        @isset($data)
            <small>File sekarang: {{ $data->dokumen }}</small>
        @endisset
    </div>
</div>
