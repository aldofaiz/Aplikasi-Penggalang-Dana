<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\User;
use App\Models\Organization;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        $organizations = Organization::where("organization_status", "=", "active")->get();
        $programs = Program::where("program_status", "=", "published")->orderBy('program_deadline')->offset(0)->limit(3)->get();
        $programs_done = Program::where("program_status", "=", "finished")->orderBy('program_deadline', 'desc')->offset(0)->limit(3)->get();
        return view('web.content.home',compact('programs','programs_done','organizations'));
    }

    public function program()
    {
        $programs = Program::where("program_status", "=", "published")->orderBy('program_deadline')->paginate(9);
        return view('web.content.program.program',compact('programs'))->with('i', (request()->input('page', 1) - 1) * 9);
    }

    public function program_done()
    {
        $programs_done = Program::where("program_status", "=", "finished")->orderBy('program_deadline', 'desc')->paginate(9);
        return view('web.content.program.program-done',compact('programs_done'))->with('i', (request()->input('page', 1) - 1) * 9);
    }

    public function program_detail(Program $program)
    {
        $category = $program->category;
        $organization = $program->organization;
        return view('web.content.program.program-detail',compact('program','category','organization'));
    }

    public function recapitulate()
    {
        $count_program = Program::count();
        $count_donor = Donor::count();
        $distribution = Program::join('donations', 'programs.id', '=', 'donations.program_id')->where('programs.program_withdraw_status', '=', 'finished')->sum('amount');
        $donations = Donation::where('donation_status', '=', 'success')->orderBy('id', 'desc')->get();
        return view('web.content.recap',compact('count_program','count_donor','donations','distribution'));
    }

    public function about()
    {
        return view('web.content.about');
    }

    public function donor_profile()
    {
        $donor = Donor::where('user_id', '=', Auth::user()->id)->first();
        $user = $donor->user;
        return view('web.content.donor.profile',compact('donor','user'));
    }

    public function donor_profile_update(Request $request)
    {
        Donor::where('user_id', '=', Auth::user()->id)->update([
            'phone_number' => $request->phone_number,
        ]);
        User::where('id', '=', Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success','Data telah diperbarui.');
    }

    public function donor_data_donation()
    {
        $donor = Donor::where('user_id', '=', Auth::user()->id)->first();
        $user = $donor->user;
        $donations = Donation::join('programs', 'donations.program_id', '=', 'programs.id')
        ->join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->join('categories', 'programs.category_id', '=', 'categories.id')
        ->select('donations.*', 'programs.program_title', 'organizations.organization_name', 'categories.category_name')
        ->where('donor_id', '=', $donor->id)->get();
        
        return view('web.content.donor.data-donation',compact('donor','user','donations'));
    }
}
