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
            <div class="card shadow-sm border-0 rounded-4">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-journal-bookmark fs-2"></i>
                            <h2 class="mb-0 fw-semibold">My Courses</h2>
                        </div>
                        <a href="{{ route('teacher.courses.create') }}" class="btn btn-light rounded-pill px-4 py-2">
                            <i class="bi bi-plus-circle me-2"></i>Add New Course
                        </a>
                    </div>
                </div>

                <!-- Course List -->
                <div class="card-body p-4">
                    @if($courses->isEmpty())
                        <div class="alert alert-info d-flex align-items-center gap-3">
                            <i class="bi bi-info-circle-fill fs-4"></i>
                            <div>No courses found. Start by adding your first course.</div>
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($courses as $course)
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center shadow-sm mb-3 rounded-3">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="bi bi-journal-text fs-4 text-primary"></i>
                                    <div>
                                        <h5 class="mb-1 fw-medium">{{ $course->name }}</h5>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ asset($course->pdf_path) }}" target="_blank" 
                                       class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-eye me-2"></i>View PDF
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .list-group-item {
        transition: all 0.2s ease;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .list-group-item:hover {
        transform: translateX(5px);
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>
@endsection