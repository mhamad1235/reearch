


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
                    <h1>Edit Teacher</h1>
                    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
                        @csrf
                        @method('PUT')
            
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $teacher->name }}" required>
                        </div>
            
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $teacher->email }}" required>
                        </div>
            
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" class="form-control" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ $teacher->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="form-group">
                            <label for="class">Class</label>
                            <select name="class" class="form-control" required>
                                <option value="1" {{ $teacher->class == 1 ? 'selected' : '' }}>Class 1</option>
                                <option value="2" {{ $teacher->class == 2 ? 'selected' : '' }}>Class 2</option>
                                  <option value="3" {{ $teacher->class == 3 ? 'selected' : '' }}>Class 3</option>
                                <option value="4" {{ $teacher->class == 4 ? 'selected' : '' }}>Class 4</option>
                            </select>
                        </div>
            
                        <div class="form-group">
                            <label for="course_ids">Courses</label>
                            <select name="course_ids[]" class="form-control" multiple required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" 
                                        {{ $teacher->courses->contains($course->id) ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
            
                        <button type="submit" class="btn btn-primary">Update Teacher</button>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

