<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;  

class CourseController extends Controller
{
    public function index()
{
    $courses = auth()->user()->courses; // Teacher's courses
    return view('admin.teachers.courses.index', compact('courses'));
}

public function create()
{
    return view('admin.teachers.courses.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'pdf_file' => 'required|mimes:pdf|max:2048',
    ]);

    // Upload the PDF
    $file = $request->file('pdf_file');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('assets/pdf'), $filename);

    // Save course
    Course::create([
        'name' => $request->name,
        'teacher_id' => auth()->user()->id,
        'pdf_path' => 'assets/pdf/' . $filename,
    ]);

    return redirect()->route('teacher.courses')->with('success', 'Course added successfully');
}


}
