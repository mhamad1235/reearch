





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
                    <h2>Edit Student</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                
                    <form action="{{ route('teacher.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>
                
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>
                
                        <!-- Department -->
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select name="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Class -->
                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <select name="class" class="form-control" required>
                                <option value="">Select Class</option>
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}" {{ $user->class == $i ? 'selected' : '' }}>Class {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                
                        <!-- Password (Optional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                
                        <button type="submit" class="btn btn-primary">Update Student</button>
                        <a href="{{ route('teacher.users.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

