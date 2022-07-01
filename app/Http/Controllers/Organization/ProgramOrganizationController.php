<?php

namespace App\Http\Controllers\Organization;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Organization;
use App\Models\Program;
use Path\To\DOMDocument;
use Intervention\Image\ImageManagerStatic as Image;

class ProgramOrganizationController extends Controller
{
    public function index()
    {
        $programs = Program::join('organizations', 'programs.organization_id', '=', 'organizations.id')
        ->where('organizations.user_id', '=', Auth::user()->id)
        ->select('programs.*')
        ->get();
        return view('organization.content.program.index',compact('programs'));
    }

    public function create()
    {
        $categories = Category::all();
        $organization = Organization::where('user_id', '=', Auth::user()->id)->first();
        return view('organization.content.program.create',compact('categories', 'organization'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_title' => 'required',
            'program_poster' => 'required|mimes:jpg,jpeg,png',
            'program_description' => 'required',
            'program_deadline' => 'required',
            'program_target_funds' => 'required',
            'program_proposal_file' => 'required|mimes:pdf',
            'program_status' => 'required',
        ]);
        
        /*
        $storage = "storage/description";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->program_description,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images=$dom->getElementsByTagName('img');
        foreach($images as $img){
            $src = $img->getAttribute('src');
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameDescription = uniqid();
                $fileNameDescriptionRand = substr(md5($fileNameDescription),6,6).'_'.time();
                $filepath = ("$storage/$fileNameDescriptionRand.$mimetype");
                $image = Image::make($src)
                    ->resize(1200,1200)
                    ->encode($mimetype,100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }
        */

        $fileNamePoster = $request->organization_id.$request->category_id.time().'.'.$request->program_poster->extension();
        $poster = $request->file('program_poster')->storeAs('poster',$fileNamePoster);
        
        $fileNameProposal = $request->organization_id.$request->category_id.time().'.'.$request->program_proposal_file->extension();
        $proposal = $request->file('program_proposal_file')->storeAs('proposal',$fileNameProposal);
        
        Program::create([
            'organization_id' => $request->organization_id,
            'category_id' => $request->category_id,
            'program_title' => $request->program_title,
            'program_poster' => $poster,
            'program_description' => $request->program_description,
            //'program_description' => $dom->saveHTML(),
            'program_deadline' => $request->program_deadline,
            'program_target_funds' => $request->program_target_funds,
            'program_proposal_file' => $proposal,
            'program_status' => $request->program_status,
        ]);

        return redirect()->route('organization.program.index')->with('success','Berhasil Membuat Program.');
    }

    public function show(Program $program)
    {
        $category = $program->category;
        return view('organization.content.program.show',compact('program','category'));
    }

    public function edit(Program $program)
    {
        $categories = Category::all();
        return view('organization.content.program.edit',compact('program', 'categories'));
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

        return redirect()->route('organization.program.index')->with('success','Berhasil Memperbarui Program.');
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
        return redirect()->route('organization.program.index')->with('success','Berhasil Menghapus Program.');
    }
}
