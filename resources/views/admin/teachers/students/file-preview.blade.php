@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
    .data-table-card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: none;
    }
    .table-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
    }
    .table thead th {
        vertical-align: middle;
        font-weight: 600;
    }
    .badge-exam {
        background-color: #4e73df;
    }
    .badge-points {
        background-color: #1cc88a;
    }
    .action-btns .btn {
        border-radius: 20px;
        font-weight: 500;
    }
    .sidebar-col {
        background: #f8f9fa;
        min-height: calc(100vh - 56px);
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }
    .main-content {
        background: #fff;
        padding: 2rem;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(106, 17, 203, 0.05);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar-col p-0">
            <x-sidebar />
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="bi bi-file-earmark-spreadsheet text-primary me-2"></i>
                    Exam Results - {{ $teacher->name }}
                </h2>
                <div>
                    {{-- <a href="{{ asset('/' . $activeFile->file_path) }}" 
                       class="btn btn-outline-primary" download>
                        <i class="bi bi-download me-1"></i> Download Original
                    </a> --}}
                </div>
            </div>

            <div class="card data-table-card mb-4">
                <div class="card-body p-0">
                    @if(!empty($headers))
                        <div class="table-responsive">
                            <table id="examResultsTable" class="table table-hover align-middle mb-0">
                                <thead class="table-header">
                                    <tr>
                                        @foreach($headers as $header)
                                            <th class="text-black">{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $index => $row)
                                        <tr>
                                            @foreach(array_slice($row, 0, count($headers)) as $cell)
                                                <td>
                                                    @if($loop->parent->first && in_array(strtolower($headers[$loop->index]), ['date', 'exam date']))
                                                        <span class="badge bg-light text-dark">
                                                            {{ \Carbon\Carbon::parse($cell)->format('M d, Y') }}
                                                        </span>
                                                    @elseif($loop->parent->first && strtolower($headers[$loop->index]) == 'exam name')
                                                        <span class="badge badge-exam">{{ $cell }}</span>
                                                    @elseif($loop->parent->first && strtolower($headers[$loop->index]) == 'points')
                                                        <span class="badge badge-points">{{ $cell }}</span>
                                                    @else
                                                        {{ $cell }}
                                                    @endif
                                                </td>
                                            @endforeach
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning m-4">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            No valid data found in the Excel file. Please check the file format.
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>File Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong><i class="bi bi-file-earmark me-2"></i>File Name:</strong> {{ $activeFile->original_name }}</p>
                            <p><strong><i class="bi bi-calendar me-2"></i>Uploaded:</strong> {{ $activeFile->created_at->format('M d, Y h:i A') }}</p>
                            <p><strong><i class="bi bi-database me-2"></i>Records:</strong> {{ count($rows) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-graph-up me-2"></i>Quick Stats</h6>
                        </div>
                        <div class="card-body">
                            @if(!empty($rows) && in_array('Points', $headers))
                                @php
                                    $points = array_column(array_slice($rows, 0, count($headers)), array_search('Points', $headers));
                                    $average = count($points) > 0 ? array_sum($points)/count($points) : 0;
                                    $max = count($points) > 0 ? max($points) : 0;
                                    $min = count($points) > 0 ? min($points) : 0;
                                @endphp
                                <p><strong>Average Score:</strong> {{ round($average, 2) }}</p>
                                <p><strong>Highest Score:</strong> {{ $max }}</p>
                                <p><strong>Lowest Score:</strong> {{ $min }}</p>
                            @else
                                <p class="text-muted">No points data available for statistics</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
   
</script>
@endsection

@endsection