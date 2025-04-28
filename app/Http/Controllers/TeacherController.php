<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Course;

class TeacherController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $teachers = User::role('teacher')->where('department_id',$user->department_id)->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    // Show form to create a teacher
    public function create()
    {
        $departments = Department::all();
        $courses = Course::all();
        return view('admin.teachers.create', compact('departments', 'courses'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
         
            'class' => 'required|in:1,2,3,4', // Ensure the class is between 1 and 
            'password'=>'required'
        ]);
    
        $teacher = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'department_id' => auth()->user()->department_id,
            'class' => $validated['class'],  // Store the class assigned to the teacher
            'password'=>$validated['password']
        ]);
    
        $teacher->assignRole('teacher');
    
        return redirect()->route('admin.teachers.index');
    }
    
    public function edit(User $teacher)
    {
        $departments = Department::all();
        $courses = Course::all();
        return view('admin.teachers.edit', compact('teacher', 'departments', 'courses'));
    }
    
    public function update(Request $request, User $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
            'department_id' => 'required|exists:departments,id',
            'course_ids' => 'required|array',
            'class' => 'required|in:1,2,3,4', // Ensure the class is between 1 and 4
        ]);
    
        $teacher->update($validated);
        $teacher->courses()->sync($validated['course_ids']);
    
        return redirect()->route('admin.teachers.index');
    }
    
}
