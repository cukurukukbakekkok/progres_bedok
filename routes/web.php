<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\CalonSiswaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\CalonSiswaController as AdminCalonSiswa;
use App\Http\Controllers\Siswa\DokumenController;

/* 1. Halaman Utama */
Route::get('/', function () {
    // Ambil pengumuman aktif dengan filter scheduling
    // Jika starts_at/ends_at NULL, tampilkan juga (untuk backward compatibility)
    $pengumuman = \App\Models\Pengumuman::where('is_active', 1)
        ->where(function ($query) {
            $query->whereNull('starts_at')
                  ->orWhere('starts_at', '<=', now());
        })
        ->where(function ($query) {
            $query->whereNull('ends_at')
                  ->orWhere('ends_at', '>=', now());
        })
        ->latest('tanggal_post')
        ->limit(3)
        ->limit(3)
        ->get();

    // Ambil promo aktif
    $promo = \App\Models\Promo::where('is_active', 1)
        ->where(function ($query) {
            $query->whereNull('tanggal_mulai')
                  ->orWhere('tanggal_mulai', '<=', now());
        })
        ->where(function ($query) {
            $query->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', now());
        })
        ->get();

    // Hitung statistik dinamis
    $totalPendaftar = \App\Models\CalonSiswa::where('data_confirmed', true)->count();
    
    // Kursi tersedia = total kuota gelombang aktif
    $kursiTersedia = \App\Models\GelombangPendaftaran::where('status', 'aktif')->sum('kuota');
    
    // Jumlah jurusan
    $jurusanCount = count(\App\Models\CalonSiswa::$hargaJurusan ?? []);

    return view('welcome', compact('pengumuman', 'promo', 'totalPendaftar', 'kursiTersedia', 'jurusanCount'));
})->name('welcome');
Route::get('/verify/{kode}', [CalonSiswaController::class, 'verifyCertificate'])->name('verify.certificate');

/* 2. Guest (Belum Login) */
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
    Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.post');
    Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

    // --- Forgot Password OTP Routes ---
    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendForgotPasswordOtp'])->name('password.email');

    Route::get('/reset-password-otp', [AuthController::class, 'showResetPasswordOtpForm'])->name('password.reset.otp');
    Route::post('/reset-password-otp', [AuthController::class, 'resetPasswordWithOtp'])->name('password.update.otp');
});

/* 3. Setelah Login */
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Auth::user()->role === 'Admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('siswa.dashboard');
    })->name('dashboard');

    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
});

/* 4. Admin */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

   /* 📌 Gelombang Pendaftaran */
Route::prefix('gelombang')->name('gelombang.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'store'])->name('store');
    Route::get('/{id}', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'show'])->name('show');
    Route::get('/{id}/siswa', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'siswa'])->name('siswa');
    Route::get('/{id}/edit', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'edit'])->name('edit');
    Route::put('/{id}', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'update'])->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\Admin\GelombangPendaftaranController::class, 'destroy'])->name('destroy');
});

   /* 📌 Calon Siswa */
Route::prefix('calon_siswa')->name('calon_siswa.')->group(function () {

    Route::get('/', [AdminCalonSiswa::class, 'index'])->name('index');
    Route::get('/{id}', [AdminCalonSiswa::class, 'show'])->name('show');

    // 🔥 Tombol aksi detail
    Route::post('/{id}/verifikasi', [AdminCalonSiswa::class, 'verifikasi'])->name('verifikasi');
    Route::post('/{id}/validasi', [AdminCalonSiswa::class, 'validasi'])->name('validasi');
    Route::post('/{id}/setujui', [AdminCalonSiswa::class, 'setujui'])->name('setujui');
    Route::post('/{id}/tolak', [AdminCalonSiswa::class, 'tolak'])->name('tolak');

    // --- 📜 Delivery Flow Admin ---
    Route::get('/{id}/preview-bukti', [AdminCalonSiswa::class, 'previewBukti'])->name('preview_bukti');
    Route::post('/{id}/kirim-bukti', [AdminCalonSiswa::class, 'kirimBukti'])->name('kirim_bukti');


    Route::delete('/{id}', [AdminCalonSiswa::class, 'destroy'])->name('destroy');
});

    /* 📌 Dokumen Siswa */
Route::prefix('dokumen_siswa')->name('dokumen_siswa.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DokumenSiswaController::class, 'index'])->name('index');
    Route::get('/{id}', [\App\Http\Controllers\Admin\DokumenSiswaController::class, 'show'])->name('show');
    Route::post('/{id}/validasi', [\App\Http\Controllers\Admin\DokumenSiswaController::class, 'validasi'])->name('validasi');
});


    /* 📌 Pengumuman */
    Route::resource('pengumuman', PengumumanController::class)->names([
        'index'   => 'pengumuman.index',
        'create'  => 'pengumuman.create',
        'store'   => 'pengumuman.store',
        'show'    => 'pengumuman.show',
        'edit'    => 'pengumuman.edit',
        'update'  => 'pengumuman.update',
        'destroy' => 'pengumuman.destroy',
    ]);

    /* 📌 Jurusan & Kelas (basic management) */
    Route::prefix('jurusan')->name('jurusan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\JurusanController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\JurusanController::class, 'show'])->name('show');
        Route::post('/{id}/kelas', [\App\Http\Controllers\Admin\JurusanController::class, 'kelasStore'])->name('kelas.store');
        Route::put('/{id}/kelas/{kelasId}', [\App\Http\Controllers\Admin\JurusanController::class, 'kelasUpdate'])->name('kelas.update');
        Route::delete('/{id}/kelas/{kelasId}', [\App\Http\Controllers\Admin\JurusanController::class, 'kelasDestroy'])->name('kelas.destroy');
    });

    /* 📌 Pembayaran Siswa */
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PembayaranController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\PembayaranController::class, 'show'])->name('show');
        Route::post('/{id}/validasi', [\App\Http\Controllers\Admin\PembayaranController::class, 'validasi'])->name('validasi');
    });

    /* 📌 Promo */
    Route::prefix('promo')->name('promo.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PromoController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\PromoController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\PromoController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\PromoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\PromoController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\PromoController::class, 'destroy'])->name('destroy');
        Route::post('/validate-code', [\App\Http\Controllers\Admin\PromoController::class, 'validateCode'])->name('validate-code');
    });
});

/* 5. Siswa */
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/biodata', [\App\Http\Controllers\Siswa\DashboardController::class, 'biodata'])->name('biodata');

    /* 📌 Form Pendaftaran */
    Route::get('/pendaftaran', [CalonSiswaController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [CalonSiswaController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/{id}/edit', [CalonSiswaController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{id}', [CalonSiswaController::class, 'update'])->name('pendaftaran.update');
    Route::get('/pendaftaran/gelombang/{id}', [CalonSiswaController::class, 'getGelombangData'])->name('pendaftaran.gelombang.data');
    Route::get('/pendaftaran/{id}/detail', [CalonSiswaController::class, 'detail'])->name('pendaftaran.detail');
    Route::get('/pendaftaran/{id}/confirmation', [CalonSiswaController::class, 'confirmation'])->name('pendaftaran.confirmation');
    Route::post('/pendaftaran/{id}/confirm', [CalonSiswaController::class, 'confirm'])->name('pendaftaran.confirm');

    /* 📌 Dokumen Siswa */
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');

    /* 📌 Pembayaran Siswa */
    Route::get('/pembayaran', [\App\Http\Controllers\Siswa\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [\App\Http\Controllers\Siswa\PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::post('/pembayaran/check-promo', [\App\Http\Controllers\Siswa\PembayaranController::class, 'checkPromo'])->name('pembayaran.check-promo');
    Route::get('/pembayaran/show', [\App\Http\Controllers\Siswa\PembayaranController::class, 'show'])->name('pembayaran.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/pendaftaran/{id}/download-bukti', [CalonSiswaController::class, 'downloadBukti'])->name('siswa.pendaftaran.download_bukti');
});

/* 6. Pengumuman Publik */
Route::get('/pengumuman', [PengumumanController::class, 'publicIndex'])->name('pengumuman.public.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'publicShow'])->name('pengumuman.public.show');
