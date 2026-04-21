<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // --- UPDATE DAFTAR DOMAIN ---
        // Saya menambahkan wildcard *.disqus.com dan *.disquscdn.com agar mencakup semua subdomain
        $cdn_domains = implode(' ', [
            'https://cdn.tailwindcss.com',
            'https://cdn.jsdelivr.net',
            'https://cdn.tiny.cloud',
            'https://cdnjs.cloudflare.com',
            'https://adminlte.io',
            'https://*.disqus.com',      // Untuk zidanherlangga.disqus.com, referrer.disqus.com, dll
            'https://*.disquscdn.com',   // Untuk c.disquscdn.com (assets CSS/JS Disqus)
            'https://disqusads.com',     // Untuk iklan/analytics Disqus
        ]);

        $response->headers->set('Content-Security-Policy',
            "default-src 'self'; " .
            // Script: Tambahkan 'data:' untuk support inline script modern
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' data: {$cdn_domains}; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com {$cdn_domains}; " .
            "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; " .
            "img-src 'self' data: blob: *; " .
            // Frame: Tambahkan https://disqus.com untuk embed utama
            "frame-src 'self' https://www.google.com https://www.google.co.id https://disqus.com https://disqusads.com; " .
            "connect-src 'self' {$cdn_domains}; " .
            "worker-src 'self' blob:;"
        );

        return $response;
    }
}