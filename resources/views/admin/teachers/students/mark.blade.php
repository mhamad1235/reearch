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
                        <i class="bi bi-person-lines-fill fs-4"></i>
                        <h4 class="mb-0 fw-semibold">Teaching Staff</h4>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($teachers->isEmpty())
                        <div class="alert alert-info m-4 rounded-3 shadow-sm">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            No teachers available in your department
                        </div>
                    @else
                        <div class="list-group list-group-flush rounded-3">
                          @foreach($teachers as $teacher)
    <div class="list-group-item d-flex align-items-center gap-3 py-3 px-4 teacher-item">
        <i class="bi bi-person-square fs-5 text-primary"></i>
        <div>
            <h6 class="mb-0 fw-medium">{{ $teacher->name }}</h6>

            {{-- Show each of this teacher's mark files --}}
            @foreach ($markFiles->where('teacher_id', $teacher->id) as $item)
                <a href="{{ route('student.subject.courses', ['teacher' => $teacher->id, 'file' => $item->id]) }}" class="btn btn-sm btn-outline-primary my-1">
                    View File: {{ $item->original_name }}
                </a>
            @endforeach
<br>
            <small class="text-muted">Department of {{ $teacher->department->name ?? 'General Studies' }}</small>
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
    .teacher-item {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .teacher-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .teacher-item:last-child {
        border-bottom: none;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
@endsection