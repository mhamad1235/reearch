<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function teachers()
{
    $teachers = User::role('teacher')
    ->where('department_id', auth()->user()->department_id)
    ->where('class',auth()->user()->class) // Use department_id instead of user ID
    ->with('courses')
    ->get();

    return view('subjects.index', compact('teachers'));
}

public function teacherCourses(User $teacher)
{
    $courses = $teacher->courses;
    return view('subjects.courses', compact('teacher', 'courses'));
}
}
