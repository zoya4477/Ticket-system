<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        // List all departments, paginated
        $departments = Department::paginate(10);
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        // Show create form
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        // Validate and store new department
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        Department::create(['name' => $request->name]);

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        // Show edit form
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        // Validate and update department
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
        ]);

        $department->update(['name' => $request->name]);

        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        // Delete department
        $department->delete();
        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department deleted successfully.');
    }

    // Optional: Add show() if you want /departments/{id} to work
    public function show(Department $department)
    {
        return view('admin.departments.show', compact('department'));
    }
}