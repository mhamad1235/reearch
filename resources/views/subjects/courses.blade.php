@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3">
            <x-sidebar />
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-journal-bookmark fs-4"></i>
                        <h2 class="mb-0 fw-semibold">{{ $teacher->name }}'s Courses</h2>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($courses->isEmpty())
                        <div class="alert alert-info m-4 rounded-3 shadow-sm">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            No courses available for this teacher
                        </div>
                    @else
                        <div class="list-group list-group-flush rounded-3">
                            @foreach($courses as $course)
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-4 course-item">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="bi bi-file-earmark-pdf fs-5 text-danger"></i>
                                    <div>
                                        <h6 class="mb-0 fw-medium">{{ $course->name }}</h6>
                                    </div>
                                </div>
                                <a href="{{ asset($course->pdf_path) }}" target="_blank" 
                                   class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="bi bi-download me-2"></i>View PDF
                                </a>
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
    .course-item {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .course-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .course-item:last-child {
        border-bottom: none;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
@endsection