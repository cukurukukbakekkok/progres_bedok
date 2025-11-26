<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Siswa') {
            return $next($request);
        }
        abort(403, 'Akses hanya untuk Siswa');
    }
}
