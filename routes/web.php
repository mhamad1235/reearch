<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HeadOfDepartmentUserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherStudentController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Models\Post;
use Illuminate\Support\Facades\App;

Auth::routes();
 Route::get('/', function () {
    $locale = App::getLocale(); // e.g., 'en' or 'ku'
    if ($locale=='ar') {
        $locale='ku';
    }
    $posts = Post::select("id", "image", "name_$locale as name", "description_$locale as description")
        ->latest()
        ->get();

    return view('welcome', compact('posts'));
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('language/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $lang]);
    app()->setLocale($lang);
    return redirect()->back();
})->name('change.language');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/departments', [AdminController::class, 'index'])->name('admin.departments');
    Route::get('/admin/departments/create', [AdminController::class, 'create'])->name('admin.departments.create');
    Route::post('/admin/departments', [AdminController::class, 'store'])->name('admin.departments.store');
    Route::get('/admin/departments/{department}/edit', [AdminController::class, 'edit'])->name('admin.departments.edit');
    Route::put('/admin/departments/{department}', [AdminController::class, 'update'])->name('admin.departments.update');
    Route::delete('/admin/departments/{department}', [AdminController::class, 'destroy'])->name('admin.departments.destroy');
      Route::get('/student-dashboard', function () {
        return view('student-dashboard');
    })->name('student.dashboard');
});

Route::middleware(['auth'])->group(function () {
    // List head of department users
    Route::get('/admin/heads-of-department', [HeadOfDepartmentUserController::class, 'index'])->name('head_of_department_users.index');

    // Create new head of department user
    Route::get('/admin/heads-of-department/create', [HeadOfDepartmentUserController::class, 'create'])->name('head_of_department_users.create');
    Route::post('/admin/heads-of-department', [HeadOfDepartmentUserController::class, 'store'])->name('head_of_department_users.store');

    // Edit head of department user
    Route::get('/admin/heads-of-department/{user}/edit', [HeadOfDepartmentUserController::class, 'edit'])->name('head_of_department_users.edit');
    Route::put('/admin/heads-of-department/{user}', [HeadOfDepartmentUserController::class, 'update'])->name('head_of_department_users.update');

    // Delete head of department user
    Route::delete('/admin/heads-of-department/{user}', [HeadOfDepartmentUserController::class, 'destroy'])->name('head_of_department_users.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Show list of teachers (users with teacher role)
    Route::get('/admin/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');

    // Create new teacher
    Route::get('/admin/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/admin/teachers', [TeacherController::class, 'store'])->name('admin.teachers.store');

    // Edit teacher
    Route::get('/admin/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/admin/teachers/{teacher}', [TeacherController::class, 'update'])->name('admin.teachers.update');

    // Delete teacher
    Route::delete('/admin/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('teacher.course');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('teacher.courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('teacher.courses.store');
    Route::resource('posts', PostController::class);

});
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/students', [TeacherStudentController::class, 'index'])->name('teacher.students');
    Route::post('/teacher/absences', [TeacherStudentController::class, 'store'])->name('teacher.absences.store');
    Route::get('/teacher/absences', [TeacherStudentController::class, 'show'])->name('teacher.show');
    Route::delete('/teacher/absences/{id}', [TeacherStudentController::class, 'destroy'])->name('teacher.absences.destroy');
});

Route::middleware(['auth'])->prefix('student')->group(function () {
    Route::get('/subjects', [StudentController::class, 'teachers'])->name('student.subject');
    Route::get('/subjects/{teacher}/courses', [StudentController::class, 'teacherCourses'])->name('student.subject.course');
    Route::get('/marks', [StudentController::class, 'mark'])->name('student.marks');
Route::get('/teacher/{teacher}/mark-file/{file}', [StudentController::class, 'showMarkFile'])
    ->name('student.subject.courses');


});

Route::middleware(['auth'])->group(function () {
    Route::get('/student/absence', [UserController::class, 'show'])->name('student.absence');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('teacher.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('teacher.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('teacher.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('teacher.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('teacher.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('teacher.users.destroy');
});

Route::middleware(['auth'])->prefix('teacher')->group(function () {
    Route::get('/marks', [MarkController::class, 'index'])->name('teacher.courses');
    Route::post('/marks/upload', [MarkController::class, 'upload'])->name('teacher.marks.upload');
    Route::get('/marks/files', [MarkController::class, 'files'])->name('teacher.marks.files');

});

