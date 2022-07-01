<?php

namespace App\Http\Controllers\Organization;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class WithdrawOrganizationController extends Controller
{
    public function index()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->where('organizations.user_id', '=', Auth::user()->id)
        ->where('programs.program_status', '=', 'finished')
        ->select('programs.*')
        ->get();
        return view('organization.content.withdraw.index',compact('programs'));
    }

    public function create()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->where('organizations.user_id', '=', Auth::user()->id)
        ->where('programs.program_status', '=', 'finished')
        ->where('programs.program_withdraw_status', '=', 'none')
        ->select('programs.*')
        ->get();
        return view('organization.content.withdraw.create',compact('programs'));
    }
    
    public function submission(Request $request)
    {
        $program = Program::where('id', $request->id)->first();

        $program->setStatusWithdrawSubmission();

        return redirect()->route('organization.withdraw.index')->with('success','Berhasil Mengajukan Penarikan Dana Program.');
    }
}
