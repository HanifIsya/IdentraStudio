<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    // Periksa apakah user sudah login DAN memiliki role 'admin'
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Jika bukan admin, arahkan kembali ke dashboard user dengan pesan error
    return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}

}
