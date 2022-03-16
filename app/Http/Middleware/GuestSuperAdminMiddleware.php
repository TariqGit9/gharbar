<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestSuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('super-admin')->check()) {
            return redirect()->route('super-admin-index');
        }
        return $next($request);
    }
}
