<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class IsOrganization
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
        if (Auth::user() &&  Auth::user()->role_id == 2) {
            return $next($request);
        }
        if (Auth::user() &&  Auth::user()->role_id == 1) {
            return redirect()->route('admin');
        }
        if (Auth::user() &&  Auth::user()->role_id == 3) {
            return redirect()->route('home');
        }
    }
}
