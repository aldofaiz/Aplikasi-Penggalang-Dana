<?php

namespace App\Http\Controllers\Organization;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Program;

class ProfileOrganizationController extends Controller
{
    public function profile()
    {
        $organization = Organization::where('user_id', '=', Auth::user()->id)->first();
        $count_program = Program::where('organization_id', '=', $organization->id)->count();
        return view('organization.content.profile',compact('organization', 'count_program'));        
    }

    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'organization_name' => 'required',
            'PIC' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'rekening_number' => 'required|numeric',
            'rekening_name' => 'required',
            'bank_name' => 'required',
        ]);

        $organization->update([
            'organization_name' => $request->organization_name,
            'PIC' => $request->PIC,
            'phone_number' => $request->phone_number,
            'rekening_number' => $request->rekening_number,
            'rekening_name' => $request->rekening_name,
            'bank_name' => $request->bank_name,            
        ]);
    
        if ($request->hasFile('organization_logo')){

            $request->validate([
                'organization_logo' => 'required|mimes:jpg,jpeg,png',
            ]);

            if(\File::exists('storage/'.$organization->organization_logo)){
                \File::delete('storage/'.$organization->organization_logo);
            }
        
            $fileName = time().'.'.$request->organization_logo->extension();
            $logo = $request->file('organization_logo')->storeAs('logo',$fileName);

            $organization->update([
                'organization_logo' => $logo,           
            ]);
        }    
    
        return redirect()->route('organization.profile')->with('success','Berhasil Memperbarui Organisasi.');        
    }
}
