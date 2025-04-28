
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3">
            <x-sidebar />
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h1>Teachers</h1>
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary mb-3">Add Teacher</a>
            
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Classes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->department->name }}</td>
                                    <td>{{ $teacher->class }}</td>
                                    <td>
                                        <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
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
              
            </div>
        </div>
    </div>
</div>
@endsection

