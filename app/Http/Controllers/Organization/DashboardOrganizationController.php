<?php

namespace App\Http\Controllers\Organization;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Program;

class DashboardOrganizationController extends Controller
{
    public function index()
    {
        $organization = Organization::where('user_id', '=', Auth::user()->id)->first();
        $count_program = Program::where('organization_id', '=', $organization->id)->count();
        $count_program_withdraw = Program::where('program_withdraw_status', '!=', 'none')->where('organization_id', '=', $organization->id)->count();
        $withdraw = Program::join('donations', 'programs.id', '=', 'donations.program_id')->where('programs.program_withdraw_status', '=', 'finished')->where('organization_id', '=', $organization->id)->sum('amount');
        return view('organization.content.dashboard',compact('count_program', 'count_program_withdraw', 'withdraw'));
    }
}
