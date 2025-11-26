<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\CalonSiswaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\CalonSiswaController as AdminCalonSiswa;

/* 1. Halaman Utama */
Route::get('/', function () {
    return view('welcome');
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

    /* 📌 Calon Siswa */
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
});

/* 5. Siswa */
Route::middleware(['auth', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    /* 📌 Form Pendaftaran */
    Route::get('/pendaftaran', [CalonSiswaController::class, 'create'])->name('pendaftaran');
    Route::post('/pendaftaran', [CalonSiswaController::class, 'store'])->name('pendaftaran.store');
});

/* 6. Pengumuman Publik */
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.public.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.public.show');

