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

        // Saya menambahkan wildcard *.disqus.com dan *.disquscdn.com agar mencakup semua subdomain
        $cdn_domains = implode(' ', [
            'https://cdn.tailwindcss.com',
            'https://cdn.jsdelivr.net',
            'https://cdn.tiny.cloud',
            'https://cdnjs.cloudflare.com',
            'https://*.disqus.com',
            'https://*.disquscdn.com',
            'https://disqusads.com',
        ]);

        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' data: {$cdn_domains}",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com {$cdn_domains}",
            "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com",
            "img-src 'self' data: blob: https:", // Lebih aman daripada '*'
            "frame-src 'self' https://www.google.com https://www.google.co.id https://disqus.com https://disqusads.com",
            "connect-src 'self' {$cdn_domains} https://links.services.disqus.com", // Tambahan untuk Disqus
            "worker-src 'self' blob:",
            "upgrade-insecure-requests", // Otomatis upgrade HTTP ke HTTPS
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        return $response;
    }
}