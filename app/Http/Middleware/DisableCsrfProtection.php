<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableCsrfProtection
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('api/*')) {
            \Illuminate\Support\Facades\Cookie::queue('XSRF-TOKEN', '', -1);
        }

        return $next($request);
    }
}
