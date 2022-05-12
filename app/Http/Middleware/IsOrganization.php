<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
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
        else if (Auth::user() &&  Auth::user()->role_id == 1) {
            return redirect()->route('admin');
        }
        else{
            return redirect()->route('home');
        }
    }
}
