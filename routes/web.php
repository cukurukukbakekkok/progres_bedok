<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['guest'])->group(
    function () {

        Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');

        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
        
        Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // pastikan view dashboard.blade.php sudah ada
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});




        Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
        Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');


        // Request reset link
        Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');

        // Reset password form
        Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
    }
);
