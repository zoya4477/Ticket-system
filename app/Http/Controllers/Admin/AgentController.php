<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
class AgentController extends Controller
{
    // List all agents
    public function index()
    {
        $roleId = Role::where('name', 'Agent')->first()?->id;
        $agents = User::where('role_id', $roleId)->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    // Show form to create new agent
    public function create()
    {
        $departments = Department::all(); 
        return view('admin.agents.create', compact('departments'));
    }    

    // Store new agent
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'required|exists:departments,id',
        ]);

        $role = Role::where('name', 'Agent')->first();
        if (!$role) {
            return redirect()->back()->with('error', 'Agent role not found.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $role->id,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('admin.agents.index')->with('success', 'Agent created successfully.');
    }

    // Show form to edit existing agent
    public function edit($id)
    {
        $agent = User::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    // Update existing agent
    public function update(Request $request, $id)
    {
        $agent = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $agent->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $agent->name = $request->name;
        $agent->email = $request->email;
        if ($request->password) {
            $agent->password = bcrypt($request->password);
        }
        $agent->save();

        return redirect()->route('admin.agents.index')->with('success', 'Agent updated successfully.');
    }

    // Delete agent
    public function destroy($id)
    {
        $agent = User::findOrFail($id);
        $agent->delete();

        return redirect()->route('admin.agents.index')->with('success', 'Agent deleted successfully.');
    }
}