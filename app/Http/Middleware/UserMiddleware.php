<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class UserMiddleware
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
        // if (!auth('users')->check()) {
        //     return redirect()->route('login');
        // }
        // return $next($request);
        if(Auth::check())
        {
            return $next($request);
        }
        return redirect('/login');
    }
}
