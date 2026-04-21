<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Daftar domain CDN yang digunakan
        $cdn_domains = 'https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://cdn.tiny.cloud https://cdnjs.cloudflare.com https://adminlte.io';

        $response->headers->set('Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' {$cdn_domains}; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com {$cdn_domains}; " .
            "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; " .
            "img-src 'self' data: blob: *; " .
            "frame-src 'self' https://www.google.com https://www.google.co.id; " .
            "connect-src 'self' {$cdn_domains}; " . // <- YANG DIUBAH: CDN dimasukkan ke sini
            "worker-src 'self' blob:;"
        );

        return $response;
    }
}