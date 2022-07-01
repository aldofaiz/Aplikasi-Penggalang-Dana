<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Program;
use App\Models\Organization;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $category_count = Category::count();
        $program_count = Program::count();
        $program_submission_count = Program::where('program_withdraw_status', '=', 'submission')->count();
        $organization_pending_count = Organization::where('organization_status', '=', 'pending')->count();
        return view('admin.content.dashboard',compact('category_count', 'program_count', 'program_submission_count', 'organization_pending_count'));
    }
}
