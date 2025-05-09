<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthPembeli
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('pembeli_id')) {
            return redirect('/pembeli/masuk');
        }

        return $next($request);
    }
    
}
