<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('admin_logged_in')) {
            return redirect('/admin/masuk');
        }

        return $next($request);
    }

}
