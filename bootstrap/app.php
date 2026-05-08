<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\IsSpmbMiddleware;

use App\Http\Middleware\SecurityHeaders;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    
        // 1. Redirect Guest ke Login secara Dinamis
        $middleware->redirectGuestsTo(function ($request) {
            // Jika URL mengandung kata 'admin', lempar ke login admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // Jika selain itu (seperti /spmb), lempar ke login pendaftar
            return route('login');
        });

        // 2. Alias Middleware (Tetap seperti kode Anda)
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'check.role' => CheckRole::class,
            'is.spmb' => IsSpmbMiddleware::class,
        ]);

        // 3. Security Headers (Tetap)
        $middleware->append(SecurityHeaders::class);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();