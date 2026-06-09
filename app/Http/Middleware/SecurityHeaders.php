<?php

namespace App\Http\Middleware;

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

        $cdn_domains = implode(' ', [
            'https://cdn.tailwindcss.com',
            'https://cdn.jsdelivr.net',
            'https://cdn.tiny.cloud',
            'https://cdnjs.cloudflare.com',
            'https://*.disqus.com',
            'https://*.disquscdn.com',
            'https://disqusads.com',
        ]);

        $midtrans = implode(' ', [
            'https://app.sandbox.midtrans.com',
            'https://app.midtrans.com',
            'https://api.sandbox.midtrans.com',
            'https://api.midtrans.com',
        ]);

        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' data: {$cdn_domains} {$midtrans}",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com {$cdn_domains} {$midtrans}",
            "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com",
            "img-src 'self' data: blob: https: {$midtrans}",
            "frame-src 'self' https://www.google.com https://www.google.co.id https://disqus.com https://disqusads.com {$midtrans}",
            "connect-src 'self' {$cdn_domains} {$midtrans} https://links.services.disqus.com",
            "worker-src 'self' blob:",
            "upgrade-insecure-requests",
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        return $response;
    }
}