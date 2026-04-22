<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Penggunaan: middleware('role:admin') atau middleware('role:user')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Belum login → simpan intended URL agar setelah login kembali ke sini
        if (! $request->user()) {
            return redirect()->guest(route('login'));
        }

        $user = $request->user();

        // Cocok role → lanjutkan
        if ($user->role === $role) {
            return $next($request);
        }

        // Admin mencoba akses route user-only → redirect ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('warning', 'Admin tidak dapat mengakses halaman booking.');
        }

        // User mencoba akses route admin-only → 403
        abort(403, 'Akses ditolak. Anda tidak memiliki izin sebagai Admin.');
    }
}
