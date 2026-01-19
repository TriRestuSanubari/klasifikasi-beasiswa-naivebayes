<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Middleware AuthCheck
 * Mengecek apakah user sudah login
 */
class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        // jika belum login
        if (!Session::get('login')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
