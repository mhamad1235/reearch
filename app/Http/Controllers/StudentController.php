<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function teachers()
{
    $teachers = User::role('teacher')->with('courses')->get();
    return view('subjects.index', compact('teachers'));
}

public function teacherCourses(User $teacher)
{
    $courses = $teacher->courses;
    return view('subjects.courses', compact('teacher', 'courses'));
}
}
