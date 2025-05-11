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
            <div class="d-flex align-items-center gap-3 mb-4">
                <i class="bi bi-clipboard2-pulse fs-2 text-primary"></i>
                <h2 class="mb-0 fw-semibold">My Absence Records</h2>
            </div>

            @if($absences->isEmpty())
                <div class="alert alert-info d-flex align-items-center gap-3 rounded-4 shadow-sm">
                    <i class="bi bi-check2-circle fs-4"></i>
                    <div class="fw-medium">Perfect attendance! No absences recorded.</div>
                </div>
            @else
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4 py-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clipboard2-data fs-4"></i>
                            <h5 class="mb-0 fw-semibold">Absence History</h5>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive rounded-3">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 fw-medium text-muted">#</th>
                                        <th class="fw-medium text-muted">Date</th>
                                        <th class="pe-4 fw-medium text-muted">Marked By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absences as $index => $absence)
                                    <tr class="absence-row">
                                        <td class="ps-4">{{ $index + 1 }}</td>
                                        <td>
                                            <i class="bi bi-calendar-event me-2 text-muted"></i>
                                            {{ \Carbon\Carbon::parse($absence->date)->format('F j, Y') }}
                                        </td>
                                        <td class="pe-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-person-circle text-primary"></i>
                                                {{ $absence->teacher->name ?? 'System' }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .absence-row {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .absence-row:hover {
        background-color: #f8f9fa;
        transform: translateX(3px);
    }
    
    .table thead {
        border-bottom: 2px solid #dee2e6;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
@endsection