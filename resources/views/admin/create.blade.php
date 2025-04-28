<!-- resources/views/admin/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Department</h1>
        <form action="{{ route('admin.departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
