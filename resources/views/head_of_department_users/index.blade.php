@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Head of Department Users</h1>
        <a href="{{ route('head_of_department_users.create') }}" class="btn btn-primary mb-3">Create Head of Department User</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              

                
                @foreach ($headsOfDepartment as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->department->name }}</td>
                        <td>
                            <a href="{{ route('head_of_department_users.edit', $user) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('head_of_department_users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
