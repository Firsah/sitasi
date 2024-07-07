<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class UpdateLastActive
{
    /**
     * Handle an incoming request.
     *Middleware ini digunakan Memperbarui kolom last_active_at setiap kali pengguna melakukan request
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $user = Auth::user();

            if ($user instanceof User) {
                $user->last_active_at = now();
                $user->save();
            }
        }

        return $next($request);
    }

    // lalu  Daftarkan middleware ini di app/Http/Kernel.php:
}
