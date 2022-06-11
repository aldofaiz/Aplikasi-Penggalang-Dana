<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationAdminController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('admin.content.user.organization.index',compact('organizations'));
    }

    public function create(){}

    public function store(Request $request){}

    public function show(Organization $organization)
    {
        $user = $organization->user;
        return view('admin.content.user.organization.show',compact('organization', 'user'));
    }

    public function edit(Organization $organization)
    {
        return view('admin.content.user.organization.edit',compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'organization_name' => 'required',
            'PIC' => 'required',
            'phone_number' => 'required',
            'rekening_number' => 'required',
            'rekening_name' => 'required',
            'bank_name' => 'required',
            'organization_status' => 'required',
        ]);
    
        $organization->update([
            'organization_name' => $request->organization_name,
            'PIC' => $request->PIC,
            'phone_number' => $request->phone_number,
            'rekening_number' => $request->rekening_number,
            'rekening_name' => $request->rekening_name,
            'bank_name' => $request->bank_name,
            'organization_status' => $request->organization_status,
        ]);
    
        return redirect()->route('admin.organization.index')->with('success','Berhasil Memperbarui Organisasi.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();   
        return redirect()->route('admin.organization.index')->with('success','Berhasil Menghapus Organisasi.');
    }
}
