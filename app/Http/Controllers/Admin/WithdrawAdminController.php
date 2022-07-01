<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class WithdrawAdminController extends Controller
{
    public function submissionIndex()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->select('programs.*', 'organizations.organization_name')
        ->where('programs.program_withdraw_status', '=', 'submission')
        ->get();
        return view('admin.content.withdraw.submission',compact('programs'));
    }

    public function approvedUpdate(Request $request, Program $program)
    {
        $program->setStatusWithdrawApproved();

        return redirect()->route('admin.withdraw.submission')->with('success','Berhasil Menyetujui Penarikan Dana.');
    }

    public function approvedIndex()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->select('programs.*', 'organizations.organization_name')
        ->where('programs.program_withdraw_status', '=', 'approved')
        ->get();
        return view('admin.content.withdraw.approved',compact('programs'));
    }

    public function finishedUpdate(Request $request, Program $program)
    {
        $program->setStatusWithdrawFinished();

        return redirect()->route('admin.withdraw.approved')->with('success','Berhasil Memperbaharui Penyerahan Dana.');
    }

    public function finishedIndex()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->select('programs.*', 'organizations.organization_name')
        ->where('programs.program_withdraw_status', '=', 'finished')
        ->get();
        return view('admin.content.withdraw.finished',compact('programs'));
    }

}
