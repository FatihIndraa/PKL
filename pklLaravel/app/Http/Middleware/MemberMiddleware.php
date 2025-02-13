<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role member
        if (Auth::check() && Auth::user()->role === 'member') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }
}

