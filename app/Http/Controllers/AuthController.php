<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Mail\ResetPasswordMail;
use App\Mail\SendOtpMail;


use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        // Validate the request data
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // akan bernilai true jika dicentang
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required',
        ]);

        // Manually verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return back()->withErrors([
                'g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.',
            ])->withInput();
        }

        // buat agar dia memverifikasi email dulu dari kolom is_verified(boolean)
        // tpi kalau yang login  role nya admin, ndk perlu verifikasi

        // $user = User::where('email', $credentials['email'])->first();
        // if ($user->role != 'admin' && !$user->is_verified) {
        //     return back()->withErrors([
        //         'verify_email' => 'Email belum diverifikasi. silahkan hubugi Admin',
        //     ]);
        // }


        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }


        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required',
        ]);

        // Manually verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return back()->withErrors([
                'g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.',
            ])->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'Siswa',
        ]);


        // Set session untuk email yang akan diverifikasi
        // session(['verify_email' => $user->email]);
        // return $this->sendOtp($user, true); // true: from register

        // Set session with the registered email
        $request->session()->flash('registered_email', $request->email);

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function sendOtp($user = null, $fromRegister = false)
    {
        if (!$user) {
            if (Auth::check()) {
                $user = Auth::user();
            } elseif (session('verify_email')) {
                $user = User::where('email', session('verify_email'))->firstOrFail();
            } else {
                return redirect()->route('login')->withErrors(['email' => 'Email tidak ditemukan.']);
            }
        }


        $setResendOtp = 60; // dalam ms / detik


        if (session('last_otp_sent') && abs((int) now()->diffInSeconds(session('last_otp_sent'))) < $setResendOtp) {
            return back()->withErrors(['otp' => 'Tunggu ' . $setResendOtp . ' detik sebelum mengirim ulang OTP.']);
        }

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->otp_code = bcrypt($otp);
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Mail::raw("Kode OTP kamu adalah: $otp (berlaku 5 menit)", function ($message) use ($user) {
        //     $message->to($user->email)
        //         ->subject('Verifikasi Email - PPDB SMK');
        // });
        session([
            'verify_email' => $user->email,
            'last_otp_sent' => now(),
        ]);

        // Jika dari register, tampilkan alert success dan countdown
        if ($fromRegister) {
            return redirect()->route('verify.form')->with('success', 'Kode OTP telah dikirim ke ' . $user->email);
        }
        // Jika dari resend, tampilkan alert success
        return back()->with('success', 'Kode OTP baru telah dikirim ke ' . $user->email);
    }




    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Ambil user dari session (bukan dari Auth, karena user belum login)
        $user = null;
        if (session('verify_email')) {
            $user = User::where('email', session('verify_email'))->first();
        }

        // Pastikan user ditemukan dan instance model
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Data verifikasi tidak ditemukan.']);
        }

        // Cek OTP dan expired
        if (!Hash::check($request->otp, $user->otp_code)) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }
        if (now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        // Sukses verifikasi
        $user->is_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Hapus session verifikasi
        session()->forget(['verify_email', 'last_otp_sent']);

        // Set session with the registered email
        $request->session()->flash('registered_email', $request->email);

        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi!');
    }
    // Tampilkan form verifikasi email
    public function showVerifyForm()
    {


        // Jika tidak ada session verify_email dan belum login, redirect ke login
        if (!session('verify_email') || !Auth::check()) {
            if (Auth::check()) {

                // Jika sudah login, set session verify_email jika belum ada
                // maka bisa asumsikan , user ini sedang memverifikasi email dari halaman dashboard
                $user = Auth::user();
                return $this->sendOtp($user, true);
            }

            return redirect()->route('login');
        }


        // Tidak mengubah session apapun, hanya hitung cooldown dari session
        $cooldown = 0;
        $setResendOtp = 60;
        if (session('last_otp_sent')) {
            $diff = (int) now()->diffInSeconds(session('last_otp_sent'));
            $cooldown = abs($diff);
        }
        // dd((session('last_otp_sent')));
        // session()->forget('last_otp_sent');
        // dd($cooldown);
        // session()->forget(['verify_email', 'last_otp_sent']);


        // dd(session('last_otp_sent') && abs((int)now()->diffInSeconds(session('last_otp_sent'))) < 60);
        return view('auth.verify-email', [
            'cooldown' => $cooldown,
            'timeResendOtp' => $setResendOtp
        ]);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        // ambil URL full sekarang
        $currentUrl = request()->fullUrl();

        // cek apakah mengandung 'localhost'
        if (str_contains($currentUrl, 'localhost')) {
            // ganti localhost -> 127.0.0.1
            $newUrl = str_replace('localhost', '127.0.0.1', $currentUrl);

            // redirect ke URL baru
            return redirect()->to($newUrl);
        }
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $socialUser->email,
        ], [
            'name' => $socialUser->name ?? $socialUser->getNickname(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
            'is_verified' => true
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }


    // --- Fitur Lupa Password OTP (Baru) ---

    // 1. Tampilkan Form Input Email
    public function showRequestForm()
    {
        return view('auth.forgot-password'); // Fixed view path
    }

    // 2. Kirim OTP ke Email
    public function sendForgotPasswordOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);
        $user = User::where('email', $request->email)->first();

        // Simpan OTP di kolom user
        $user->otp_code = $otp; // Pastikan kolom otp_code tipe string/varchar
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save(); // Save tanpa hash untuk simplicity sesuai request user, atau hash jika perlu aman

        // Kirim Email
        try {
            Mail::to($user->email)->send(new \App\Mail\ResetPasswordOtpMail($otp));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email: ' . $e->getMessage()]);
        }

        return redirect()->route('password.reset.otp', ['email' => $user->email])
            ->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    // 3. Tampilkan Form Input OTP & Password Baru
    public function showResetPasswordOtpForm(Request $request)
    {
        return view('auth.reset-password-otp', ['email' => $request->email]);
    }

    // 4. Proses Reset Password dengan OTP
    public function resetPasswordWithOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah OTP cocok
        // Note: Jika di database disimpan plain text:
        if ($user->otp_code != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // Cek Kedaluwarsa
        if (!$user->otp_expires_at || now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kedaluwarsa.']);
        }

        // Reset Password
        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
