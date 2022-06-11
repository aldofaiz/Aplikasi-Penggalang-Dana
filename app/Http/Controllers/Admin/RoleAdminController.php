<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleAdminController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.content.role',compact('roles'));
    }

    public function create(){}

    public function store(Request $request){}

    public function show(Role $role){}

    public function edit(Role $role){}

    public function update(Request $request, Role $role){}

    public function destroy(Role $role){}
}
