<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MarksImport;
use App\Models\UploadedMarkFile;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
   public function index()
    {
        return view('admin.teachers.marks.upload');
    }

   public function upload(Request $request)
{
    $request->validate([
        'marks_file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    $file = $request->file('marks_file');
    $originalName = $file->getClientOriginalName();
    $filename = time() . '_' . $originalName;
    $file->move(public_path('assets'), $filename);

    $filePath = 'assets/' . $filename;

    // Save info in database
    UploadedMarkFile::create([
        'teacher_id' => Auth::id(),
        'original_name' => $originalName,
        'file_name' => $filename,
        'file_path' => $filePath,
    ]);

    // Optional: also store in session or parse the file
    $data = \Maatwebsite\Excel\Facades\Excel::toArray([], public_path($filePath))[0];

    return view('admin.teachers.marks.upload', [
        'excelData' => $data,
        'filePath' => $filePath,
    ]);
}
public function files()
{
    $files = UploadedMarkFile::where('teacher_id', Auth::id())->latest()->get();

    return view('admin.teachers.marks.files', compact('files'));
}
}
