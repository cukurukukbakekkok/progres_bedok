<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 🧱 Daftarkan alias middleware (tanpa Kernel)
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'siswa' => \App\Http\Middleware\SiswaMiddleware::class,
        ]);

        // Jika mau menambah global middleware bisa di sini:
        // $middleware->append(\App\Http\Middleware\PreventRequestsDuringMaintenance::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
