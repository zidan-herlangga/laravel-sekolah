<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $userRole = $request->user()->role;
        $allowedRoles = array_map('trim', explode(',', $role));
        
        if (!in_array($userRole, $allowedRoles)) {
            abort(403);
        }
        return $next($request);
    }
}