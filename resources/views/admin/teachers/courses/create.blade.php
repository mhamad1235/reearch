
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
                    <h2>Create Course</h2>
    <form method="POST" action="{{ route('teacher.courses.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="pdf_file" class="form-label">Upload PDF</label>
            <input type="file" class="form-control" name="pdf_file" id="pdf_file" required>
        </div>

        <button type="submit" class="btn btn-success">Create Course</button>
    </form>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

