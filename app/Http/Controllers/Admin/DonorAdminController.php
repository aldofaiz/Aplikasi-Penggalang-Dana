<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;

class DonorAdminController extends Controller
{
    public function index()
    {
        $donors = Donor::join('users', 'donors.user_id', '=', 'users.id')
        ->select('donors.*', 'users.name', 'users.email')
        ->get();
        return view('admin.content.user.donor.index',compact('donors'));
    }

    public function create(){}

    public function store(Request $request){}

    public function show(Donor $donor)
    {
        $user = $donor->user;
        return view('admin.content.user.donor.show',compact('donor', 'user'));
    }

    public function edit(Donor $donor){}

    public function update(Request $request, Donor $donor){}

    public function destroy(Donor $donor)
    {
        $donor->delete();   
        return redirect()->route('admin.donor.index')->with('success','Berhasil Menghapus Donatur.');
    }
}
