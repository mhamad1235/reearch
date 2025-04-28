
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
                    <h1>My Courses</h1>
                    <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary mb-3">Add New Course</a>
            
                    @if($courses->isEmpty())
                        <p>No courses found.</p>
                    @else
                        <ul class="list-group">
                            @foreach($courses as $course)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $course->name }}
                                    <a href="{{ asset($course->pdf_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View PDF</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

