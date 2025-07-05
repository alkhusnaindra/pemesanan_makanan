<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMejaSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('nomor_meja')) {
            // Jika nomor_meja belum ada di session, redirect ke home atau halaman scan QR
            return redirect('/')->with('error', 'Silakan mulai pemesanan dari scan nomor meja.');
        }

        return $next($request);
    }
}
