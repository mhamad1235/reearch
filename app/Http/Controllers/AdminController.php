<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;  // Example for CRUD on departments

class AdminController extends Controller
{
    public function index()
    {
        $departments = Department::all();  // Show all departments
        return view('admin.dashboard', compact('departments'));
    }

    public function create()
    {
        return view('admin.create');  // Show form to create a new department
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create($request->all());  // Store new department
        return redirect()->route('admin.departments')->with('success', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        return view('admin.edit', compact('department'));  // Show form to edit the department
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($request->all());  // Update department details
        return redirect()->route('admin.departments')->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();  // Delete the department
        return redirect()->route('admin.departments')->with('success', 'Department deleted successfully');
    }
}
