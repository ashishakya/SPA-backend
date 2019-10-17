<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*') // any domain can connect/access
            ->header('Access-Control-Allow-Methods', 'GET POST DELETE PUT PATCH OPTIONS') //which http method to allow
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }
}
