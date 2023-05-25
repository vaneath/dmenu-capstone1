<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminAuthenticate
{
    //if user is not super admin, redirect to home page
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role != 'superadmin') {
            return redirect('/');
        }
        return $next($request);
    }
}
