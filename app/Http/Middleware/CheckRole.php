<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            // Jika pengguna belum login
            return redirect('login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            // Jika peran pengguna tidak sesuai
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');

        }

        return $next($request);
    }
}
