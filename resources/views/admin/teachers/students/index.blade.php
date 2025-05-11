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
                <!-- Card Header -->
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clipboard2-pulse fs-4"></i>
                        <h4 class="mb-0 fw-semibold">Mark Student Absences</h4>
                    </div>
                </div>

                <!-- Filter Form -->
                <form action="{{ route('teacher.students') }}" method="GET" class="mb-4 px-3 pt-4">
                    <div class="row g-3">
                        <!-- Shift Selection -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="shift" id="shift" class="form-select" required>
                                    <option value="">Select Shift</option>
                                    <option value="Morning" {{ request('shift') == 'Morning' ? 'selected' : '' }}>Morning</option>
                                    <option value="Evening" {{ request('shift') == 'Evening' ? 'selected' : '' }}>Evening</option>
                                </select>
                                <label for="shift" class="fw-medium">Select Shift</label>
                            </div>
                        </div>

                        <!-- Class Selection -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="section" id="section" class="form-select" required>
                                    <option value="">Select Class</option>
                                    <option value="Class A" {{ request('section') == 'Class A' ? 'selected' : '' }}>Class A</option>
                                    <option value="Class B" {{ request('section') == 'Class B' ? 'selected' : '' }}>Class B</option>
                                </select>
                                <label for="section" class="fw-medium">Select Class</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success px-4 py-2">
                                <i class="bi bi-funnel-fill me-2"></i>Filter Students
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Absence Form -->
                <div class="card-body px-3 pb-4">
                    <form action="{{ route('teacher.absences.store') }}" method="POST">
                        @csrf

                        <!-- Date Picker -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-calendar-event text-primary"></i>
                                    </span>
                                    <input type="date" name="date" class="form-control ps-3" 
                                           required value="{{ $today}}">
                                </div>
                            </div>
                        </div>

                        <!-- Absent Students -->
                        <div class="mb-4">
                            <h5 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                                <i class="bi bi-person-lines-fill text-primary"></i>
                                Select Absent Students
                            </h5>
                            
                            <div class="row g-3">
                                @forelse ($students as $student)
                                <div class="col-md-6">
                                    <div class="student-card position-relative">
                                        <input type="checkbox" name="absent_students[]" 
                                               value="{{ $student->id }}" 
                                               id="student-{{ $student->id }}" 
                                               class="form-check-input position-absolute top-50 start-0 translate-middle-y">
                                        <label for="student-{{ $student->id }}" 
                                               class="d-block bg-light-hover rounded-3 p-3 ps-5 cursor-pointer">
                                            <span class="fw-medium text-dark">{{ $student->name }}</span>
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info d-flex align-items-center gap-2">
                                        <i class="bi bi-info-circle-fill"></i>
                                        No students found for your department/class.
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 ">
                            <button type="submit" class="btn btn-danger px-4 py-2 fw-medium">
                                <i class="bi bi-save2-fill me-2"></i>Submit Absences
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .student-card:hover label {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
    }
    
    .student-card label {
        transition: all 0.2s ease;
    }
    
    .form-floating>.form-select~label {
        opacity: 0.8;
    }
    
    .bg-light-hover:hover {
        background-color: #f8f9fa !important;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection