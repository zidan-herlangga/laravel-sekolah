<?php

namespace App\Middleware; // atau namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 1. Cek apakah user sudah login
        if (!$user) {
            return redirect()->route('admin.login');
        }

        // 2. Cek Role: Izinkan Admin, Penulis, SPMB
        // Kita tambahkan 'spmb' ke dalam daftar yang diizinkan
        if (!in_array($user->role, ['admin', 'penulis', 'spmb'])) {
            abort(403, 'Akses ditolak. Anda tidak memiliki role yang cukup.');
        }

        return $next($request);
    }
}