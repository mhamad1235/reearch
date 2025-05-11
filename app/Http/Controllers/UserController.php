<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;


class UserController extends Controller
{
    public function index()
    {
        $users = User::role('user')->get(); 
        return view('admin.teachers.users.index', compact('users'));
    }

    public function create()
    {
         $departments = Department::all();
        return view('admin.teachers.users.create' ,compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'department_id' => 'required|exists:departments,id',
            'class' => 'required|integer|between:1,4',
            'assigned_classes'=>'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $data['password'] = bcrypt($data['password']);
    
        $user = User::create($data);
        $user->assignRole('user');
    
        return redirect()->route('teacher.users.index')->with('success', 'Student created successfully.');
    }
    

    public function edit(User $user)
    {
        $departments = Department::all(); // Assuming you have a Department model
        return view('admin.teachers.users.edit', compact('user','departments'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'department_id' => 'required|exists:departments,id',
            'class' => 'required|integer|between:1,4',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
    
        $user->update($data);
    
        return redirect()->route('teacher.users.index')->with('success', 'Student updated successfully.');
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('teacher.users.index')->with('success', 'User deleted.');
    }

    public function show(){
        $user = auth()->user();
        $absences = $user->absencesAsStudent()->with('teacher')->orderByDesc('date')->get();
    
         return view('admin.teachers.users.show-absence',compact('absences')) ;   
    }
}
