<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route utama aplikasi Laravel 11 PPDB kamu.
| Dibagi jadi beberapa bagian:
| 1️⃣ Guest (belum login)
| 2️⃣ Authenticated (sudah login)
| 3️⃣ Role Admin & Siswa
|---------------------------------------------------------------------------
*/

// ==============================
// 1️⃣ Halaman utama (Welcome)
// ==============================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// ==============================
// 2️⃣ Route untuk user yang belum login (guest)
// ==============================
Route::middleware('guest')->group(function () {

    // --- Login ---
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // --- Registrasi ---
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // --- Verifikasi Email (OTP) ---
    Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
    Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.post');
    Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

    // --- Lupa Password ---
    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

    Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');

    // --- Login Sosial (Google / Facebook) ---
    Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');
});


// ==============================
// 3️⃣ Route untuk user yang sudah login
// ==============================
Route::middleware(['auth'])->group(function () {

    // --- Redirect Dashboard Berdasarkan Role ---
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        if ($role === 'Admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'Siswa') {
            return redirect()->route('siswa.dashboard');
        } else {
            abort(403, 'Role tidak dikenali.');
        }
    })->name('dashboard');

    // --- Logout (POST & GET untuk fleksibilitas tombol link) ---
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');

    // --- Resource Calon Siswa ---
    Route::resource('calon_siswa', CalonSiswaController::class);
});


// ==============================
// 4️⃣ Route untuk Admin
// ==============================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});


// ==============================
// 5️⃣ Route untuk Siswa
// ==============================
Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaDashboard::class, 'index'])->name('siswa.dashboard');
});
