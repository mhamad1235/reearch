






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
                    <h2>Create New Student</h2>

                    <form action="{{ route('teacher.users.store') }}" method="POST">
                        @csrf
                
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                
                        <!-- Department -->
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select name="department_id" id="department_id" class="form-select" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                

                        
                        <!-- Class -->
                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <select name="class" id="class" class="form-select" required>
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}">Class {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Assign Classes</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Morning</strong><br>
                                    <label><input type="checkbox" name="assigned_classes[]" value="Class A - Morning"> Class A</label><br>
                                    <label><input type="checkbox" name="assigned_classes[]" value="Class B - Morning"> Class B</label>
                                </div>
                                <div class="col-md-6">
                                    <strong>Evening</strong><br>
                                    <label><input type="checkbox" name="assigned_classes[]" value="Class A - Evening"> Class A</label><br>
                                    <label><input type="checkbox" name="assigned_classes[]" value="Class B - Evening"> Class B</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <!-- Password confirmation -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
                
                
                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

