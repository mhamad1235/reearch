<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Department;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HeadOfDepartmentUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display a list of all head of department users
    public function index()
    {
        // Fetch all users with the 'head_of_department' role
        $headsOfDepartment = User::role('head_of_department')->get();
        return view('head_of_department_users.index', compact('headsOfDepartment'));
    }

    // Show the form for creating a new head of department user
    public function create()
    {
        $departments = Department::all(); // Get all departments
        return view('head_of_department_users.create', compact('departments'));
    }

    // Store a newly created head of department user
    public function store(Request $request)
    { 
   
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'department_id' => $request->department_id
        ]);

        // Assign the 'head_of_department' role
        $user->assignRole('head_of_department');

        return redirect()->route('head_of_department_users.index')->with('success', 'Head of department user created successfully.');
    }

    // Show the form for editing a head of department user
    public function edit(User $user)
    {
        $departments = Department::all();
        return view('head_of_department_users.edit', compact('user', 'departments'));
    }

    // Update the specified head of department user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'department_id' => 'required|exists:departments,id',
        ]);

        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id, // Update department
        ]);

        return redirect()->route('head_of_department_users.index')->with('success', 'Head of department user updated successfully.');
    }

    // Remove the specified head of department user
    public function destroy(User $user)
    {
        // Ensure that the user is a head of department before deleting
        if ($user->hasRole('head_of_department')) {
            $user->delete();
            return redirect()->route('head_of_department_users.index')->with('success', 'Head of department user deleted successfully.');
        }

        return redirect()->route('head_of_department_users.index')->with('error', 'User is not a head of department.');
    }
}
