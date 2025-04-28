<!-- resources/views/admin/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Department</h1>
        <form action="{{ route('admin.departments.update', $department) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $department->name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
