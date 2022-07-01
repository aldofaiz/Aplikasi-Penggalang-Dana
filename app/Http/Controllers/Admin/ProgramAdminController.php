<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Program;

class ProgramAdminController extends Controller
{
    public function index()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->select('programs.*', 'organizations.organization_name')
        ->get();
        return view('admin.content.program.index',compact('programs'));
    }

    public function create(){}

    public function store(Request $request){}

    public function show(Program $program)
    {
        $category = $program->category;
        $organization = $program->organization;
        return view('admin.content.program.show',compact('program','category','organization'));
    }

    public function edit(Program $program)
    {
        $categories = Category::all();
        return view('admin.content.program.edit',compact('program', 'categories'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'program_title' => 'required',            
            'program_description' => 'required',
            'program_deadline' => 'required',
            'program_target_funds' => 'required',
            'program_status' => 'required',
        ]);
    
        $program->update([
            'organization_id' => $request->organization_id,
            'category_id' => $request->category_id,
            'program_title' => $request->program_title,
            'program_description' => $request->program_description,
            'program_deadline' => $request->program_deadline,
            'program_target_funds' => $request->program_target_funds,
            'program_status' => $request->program_status,
        ]);

        if ($request->hasFile('program_poster')){

            $request->validate([
                'program_poster' => 'required|mimes:jpg,jpeg,png',
            ]);

            if(\File::exists('storage/'.$program->program_poster)){
                \File::delete('storage/'.$program->program_poster);
            }
        
            $fileNamePoster = $request->organization_id.$request->category_id.time().'.'.$request->program_poster->extension();
            $poster = $request->file('program_poster')->storeAs('poster',$fileNamePoster);

            $program->update([
                'program_poster' => $poster,           
            ]);
        }

        if ($request->hasFile('program_proposal_file')){

            $request->validate([
                'program_proposal_file' => 'required|mimes:pdf',
            ]);

            if(\File::exists('storage/'.$program->program_proposal_file)){
                \File::delete('storage/'.$program->program_proposal_file);
            }
        
            $fileNameProposal = $request->organization_id.$request->category_id.time().'.'.$request->program_proposal_file->extension();
            $proposal = $request->file('program_proposal_file')->storeAs('proposal',$fileNameProposal);

            $program->update([
                'program_proposal_file' => $proposal,           
            ]);
        }

        if ($request->hasFile('program_report_file')){

            $request->validate([
                'program_report_file' => 'required|mimes:pdf',
            ]);

            if(\File::exists('storage/'.$program->program_report_file)){
                \File::delete('storage/'.$program->program_report_file);
            }
        
            $fileNameReport = $request->organization_id.$request->category_id.time().'.'.$request->program_report_file->extension();
            $report = $request->file('program_report_file')->storeAs('report',$fileNameReport);

            $program->update([
                'program_report_file' => $report,           
            ]);
        }

        return redirect()->route('admin.program.index')->with('success','Berhasil Memperbarui Program.');
    }

    public function destroy(Program $program)
    {
        if(\File::exists('storage/'.$program->program_poster)){
            \File::delete('storage/'.$program->program_poster);
        }
        if(\File::exists('storage/'.$program->program_proposal_file)){
            \File::delete('storage/'.$program->program_proposal_file);
        }
        if(\File::exists('storage/'.$program->program_report_file)){
            \File::delete('storage/'.$program->program_report_file);
        }
        $program->delete();
        return redirect()->route('admin.program.index')->with('success','Berhasil Menghapus Program.');
    }
}
