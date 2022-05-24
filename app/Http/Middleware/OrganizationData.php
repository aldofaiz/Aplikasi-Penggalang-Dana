<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Organization;
use Auth;

class OrganizationData
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
        $id = Auth::user()->id;
        $data = Organization::where('user_id',$id)->count();
        if($data == 0){
            Organization::create([
                'user_id' => $id,
            ]);
            return redirect()->route('organization.profile');
        }
        return $next($request);
    }
}
