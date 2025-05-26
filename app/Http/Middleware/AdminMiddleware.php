<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil user yang sedang login
        $user = Auth::user(); // ✅ GUNAKAN `user()` bukan `users()`

        // Pastikan user login dan punya atribut is_admin = true
        if (!$user || !$user->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Hanya admin yang dapat mengakses ini.'
            ], 403);
        }

        return $next($request);
    }
}
