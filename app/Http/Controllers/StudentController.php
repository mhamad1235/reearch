<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UploadedMarkFile;
use Illuminate\Support\Facades\File;

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
    public function mark()
        {
            $teachers = User::role('teacher')
        ->where('department_id', auth()->user()->department_id)
        ->where('class',auth()->user()->class) // Use department_id instead of user ID
        ->get();


            return view('admin.teachers.students.mark', [
                'teachers' => $teachers
            ]);
        }

     public function showMarkFile($id)
{
    $teacher = User::findOrFail($id);
    $markFile = UploadedMarkFile::where('teacher_id', $teacher->id)->get();

    if (!$markFile) {
        return back()->with('error', 'No mark file found for this teacher.');
    }

    return view('admin.teachers.students.file-preview', compact('teacher', 'markFile'));
}

}
