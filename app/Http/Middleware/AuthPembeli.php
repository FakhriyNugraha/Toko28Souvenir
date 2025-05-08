<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthPembeli
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('pembeli_id')) {
            return redirect()->route('pembeli.login')->withErrors(['invalid' => 'Silakan login terlebih dahulu.']);
        }

        return $next($request);
    }
}
