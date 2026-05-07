<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Redirect Guest to Login
        $middleware->redirectGuestsTo(function () {
            return route('admin.login');
        });

        // 2. Alias Middleware (PENTING)
        // Pastikan nama class di sini PERSIS sama dengan nama file
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'check.role' => \App\Http\Middleware\CheckRole::class,
            'is.spmb' => \App\Http\Middleware\IsSpmbMiddleware::class,
        ]);

        // 3. Menghandle SecurityHeaders (SOLUSI STABIL)
        // Kita daftarkan SecurityHeaders sebagai Class Middleware, bukan Closure
        // Pastikan file ada di: app/Http/Middleware/SecurityHeaders.php
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();