@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clipboard2-check fs-4"></i>
                        <h4 class="mb-0 fw-semibold">Student Absence Records</h4>
                    </div>
                </div>

                <!-- Filter Form -->
                <div class="card-body">
                    <form method="GET" action="{{ route('teacher.show') }}" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <!-- Date Filter -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-calendar-event"></i>
                                        </span>
                                        <input type="date" name="date" id="date" 
                                               value="{{ $date ?? date('Y-m-d') }}" 
                                               class="form-control" required>
                                    </div>
                                
                                </div>
                            </div>

                            <!-- Shift Filter -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="shift" id="shift" class="form-select">
                                        <option value="">All Shifts</option>
                                        <option value="Morning" {{ request('shift') == 'Morning' ? 'selected' : '' }}>Morning</option>
                                        <option value="Evening" {{ request('shift') == 'Evening' ? 'selected' : '' }}>Evening</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Section Filter -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="section" id="section" class="form-select">
                                        <option value="">All Sections</option>
                                        <option value="Class A" {{ request('section') == 'Class A' ? 'selected' : '' }}>Class A</option>
                                        <option value="Class B" {{ request('section') == 'Class B' ? 'selected' : '' }}>Class B</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Filter Button -->
                            <div class="col-md-12">
                                <button  class="btn btn-success w-25 py-2 fw-medium">
                                    <i class="bi bi-funnel-fill me-2"></i>Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Absence List -->
                    <div class="mt-4">
                        <h5 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-clipboard2-data text-primary"></i>
                            Absence Records for {{ \Carbon\Carbon::parse($date ?? now())->format('F j, Y') }}
                        </h5>

                        <div class="list-group">
                            @forelse ($absences as $absence)
                            <div class="list-group-item d-flex justify-content-between align-items-center shadow-sm mb-2 rounded-3">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="bi bi-person-x fs-5 text-danger"></i>
                                    <div>
                                        <h6 class="mb-0 fw-medium">{{ $absence->student->name }}</h6>
                                        <small class="text-muted">
                                            {{ $absence->created_at->format('h:i A') }} • 
                                            {{ $absence->student->section }}
                                        </small>
                                    </div>
                                </div>
                                <form action="{{ route('teacher.absences.destroy', $absence->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this absence record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                            @empty
                            <div class="alert alert-success d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill fs-5"></i>
                                No absence records found for the selected criteria
                            </div>
                            @endforelse
                        </div>
                    </div>
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
    
    .form-floating>.form-control:not(:placeholder-shown)~label,
    .form-floating>.form-select~label {
        opacity: 0.8;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }
</style>
@endsection