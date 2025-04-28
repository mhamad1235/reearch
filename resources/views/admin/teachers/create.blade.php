
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
                    <h1>Create Teacher</h1>
                    <form action="{{ route('admin.teachers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
            
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
            
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
            
                    
            
                        <div class="form-group">
                            <label for="class">Class</label>
                            <select name="class" class="form-control" required>
                                <option value="1">Class 1</option>
                                <option value="2">Class 2</option>
                                <option value="3">Class 3</option>
                                <option value="4">Class 4</option>
                            </select>
                        </div>
            
                     
            
                        <button type="submit" class="btn btn-primary">Create Teacher</button>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

