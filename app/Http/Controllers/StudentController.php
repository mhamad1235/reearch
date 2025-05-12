<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UploadedMarkFile;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GenericImport;
use Spatie\SimpleExcel\SimpleExcelReader;
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

       
      $markFiles = UploadedMarkFile::whereIn('teacher_id', $teachers->pluck('id'))->get();




            return view('admin.teachers.students.mark', [
                'teachers' => $teachers,
                'markFiles'=>$markFiles
            ]);
        }



public function showMarkFile($id,$index)
{
    $teacher = User::findOrFail($id);
    $markFiles = UploadedMarkFile::where('teacher_id', $teacher->id)
    ->where('id',$index)
    ->get();

    if ($markFiles->isEmpty()) {
        return back()->with('error', 'No mark file found for this teacher.');
    }

    $firstFile = $markFiles->first();
    $filePath = public_path($firstFile->file_path);

    if (!file_exists($filePath)) {
        return back()->with('error', 'The mark file could not be found at: ' . $filePath);
    }

   try {
      // Inside your try block
$data = Excel::toArray([], $filePath);

// Flatten the data and remove completely empty rows
$filteredData = array_filter($data[0], function($row) {
    return !empty(array_filter($row, function($cell) {
        return !empty(trim($cell));
    }));
});

// Find the row that looks most like headers
$headers = [];
$rows = [];

foreach ($filteredData as $row) {
    // Look for the row that contains "Student Name", "Exam Name", etc.
    if (in_array('Student Name', $row) && in_array('Exam Name', $row)) {
        $headers = $row;
    } elseif (!empty($headers)) {
        $rows[] = $row;
    }
}

// If we didn't find headers automatically, use the first non-empty row
if (empty($headers) && !empty($filteredData)) {
    $headers = array_shift($filteredData);
    $rows = $filteredData;
}

        return view('admin.teachers.students.file-preview', [
            'teacher' => $teacher,
            'markFiles' => $markFiles,
            'headers' => $headers,
            'rows' => $rows,
            'activeFile' => $firstFile
        ]);

    } catch (\Exception $e) {
        return back()->with('error', 'Could not read the Excel file: ' . $e->getMessage());
    }
}
}
