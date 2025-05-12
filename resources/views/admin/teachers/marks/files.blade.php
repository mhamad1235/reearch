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
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <h4 class="mb-0">Uploaded Mark Files</h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Original Name</th>
                                <th>Uploaded At</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->original_name }}</td>
                                    <td>{{ $file->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ asset($file->file_path) }}" target="_blank" class="btn btn-sm btn-success">Download</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
