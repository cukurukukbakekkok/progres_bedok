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
        ->get();
    return view('welcome', compact('pengumuman'));
})->name('welcome');

/* 2. Guest (Belum Login) */
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
    Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.post');
    Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');
    Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
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
});

/* 5. Siswa */
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    /* 📌 Form Pendaftaran */
    Route::get('/pendaftaran', [CalonSiswaController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [CalonSiswaController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/gelombang/{id}', [CalonSiswaController::class, 'getGelombangData'])->name('pendaftaran.gelombang.data');
    Route::get('/pendaftaran/{id}/detail', [CalonSiswaController::class, 'detailBiodata'])->name('pendaftaran.detail');
});

    /* Tambahan untuk dashboard siswa dan biodata siswa */
    Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/biodata', [\App\Http\Controllers\Siswa\DashboardController::class, 'biodata'])->name('biodata');
});


/* 6. Pengumuman Publik */
Route::get('/pengumuman', [PengumumanController::class, 'publicIndex'])->name('pengumuman.public.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'publicShow'])->name('pengumuman.public.show');

    /* 7. Dokumen Siswa */
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');
});

    /* 8. Pembayaran Siswa */
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/pembayaran', [\App\Http\Controllers\Siswa\PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [\App\Http\Controllers\Siswa\PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/show', [\App\Http\Controllers\Siswa\PembayaranController::class, 'show'])->name('pembayaran.show');
});
