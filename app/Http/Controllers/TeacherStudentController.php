<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absence;


class TeacherStudentController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
    $today = now()->format('Y-m-d'); 

    $shift = $request->shift;
    $section = $request->section;

    $students = collect();
    
    if ($shift && $section) {
        $date =  now()->toDateString(); // or a dynamic date
        $fullClass = "$section - $shift"; // e.g., "Class A - Morning"
        $students = User::role('user')
        ->where('department_id', $user->department_id)
        ->where('class', $user->class)
        ->whereJsonContains('assigned_classes', $fullClass)
        ->whereDoesntHave('absencesAsStudent', function ($query) use ($date) {
            $query->where('date', $date);
        })
        ->get();
    }

    return view('admin.teachers.students.index', compact('students','today'));
}


    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'absent_students' => 'required|array',
        'absent_students.*' => 'exists:users,id',
    ]);

    $teacherId = auth()->id();
    $date = $request->input('date');

    foreach ($request->absent_students as $studentId) {
        Absence::firstOrCreate([
            'student_id' => $studentId,
            'teacher_id' => auth()->user()->id,
            'date' => $date,
        ]);
    }

    return redirect()->back()->with('success', 'Absences recorded successfully.');
}
public function show(Request $request)
{
    $date = $request->input('date', today()->toDateString());
    $shift = $request->input('shift');
    $section = $request->input('section');
    $teacherId = auth()->user()->id;

    $absences = Absence::with('student')
        ->where('teacher_id', $teacherId)
        ->where('date', $date)
        ->when($shift && $section, function ($query) use ($shift, $section) {
            $combined = "{$section} - {$shift}";
            $query->whereHas('student', function ($q) use ($combined) {
                $q->whereJsonContains('assigned_classes', $combined);
            });
        })
        ->get();

    return view('admin.teachers.students.show', compact('absences', 'date', 'shift', 'section'));
}

public function destroy($id)
{
    $absence = Absence::findOrFail($id);

    // Optional: ensure the logged-in teacher owns the absence record
    if ($absence->teacher_id !== auth()->id()) {
        abort(403);
    }

    $absence->delete();

    return redirect()->back()->with('success', 'Absence record deleted successfully.');
}


}
