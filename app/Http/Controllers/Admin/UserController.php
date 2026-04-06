<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role','department')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.users.create', compact('roles','departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role_id'=>'required',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id,
            'department_id'=>$request->department_id
        ]);

        return redirect()->route('admin.users.index')
            ->with('success','User Created');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('admin.users.edit', compact('user','roles','departments'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'role_id'=>'required',
        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role_id'=>$request->role_id,
            'department_id'=>$request->department_id
        ]);

        return redirect()->route('admin.users.index')
            ->with('success','User Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','User Deleted');
    }
}