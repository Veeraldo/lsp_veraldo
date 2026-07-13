<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PasienMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'pasien') {
            if (Auth::user()->status_akun !== 'approved') {
                Auth::logout();
                return redirect('/')->with('error', 'Akun Anda belum diverifikasi oleh Admin. Silakan tunggu.');
            }
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses Pasien.');
    }
}
