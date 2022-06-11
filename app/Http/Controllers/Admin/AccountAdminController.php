<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountAdminController extends Controller
{
    public function index()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.role_name')
        ->get();
        return view('admin.content.user.account.index',compact('users'));
    }

    public function create(){}

    public function store(Request $request){}

    public function show(User $user)
    {
        $role = $user->role;
        return view('admin.content.user.account.show',compact('user', 'role'));
    }

    public function edit(User $user){}

    public function update(Request $request, User $user){}

    public function destroy(User $user)
    {
        $user->delete();    
        return redirect()->route('admin.account.index')->with('success','Berhasil Menghapus Akun.');
    }
}
