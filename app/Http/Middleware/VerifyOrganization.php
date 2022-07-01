<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Models\Organization;

class VerifyOrganization
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
        $organization = Organization::where('user_id', '=', Auth::user()->id)->first();
        if ($organization->organization_status == "active") {
            return $next($request);
        }
        if ($organization->organization_status == "pending") {
            return redirect()->route('organization.profile')->with('success','Silakan Lengkapi Data Organisasi dan Menunggu Verifikasi Admin');
        }
        if ($organization->organization_status == "nonactive") {
            return redirect()->route('organization.profile')->with('warning','Status Organisasi Nonaktif');
        }
        if ($organization->organization_status == "blacklist") {
            return redirect()->route('organization.profile')->with('danger','Status Organisasi Blacklist');
        }    
    }
}
