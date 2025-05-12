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
            <h4 class="mb-4">Marks Files Uploaded by {{ $teacher->name }}</h4>

            @forelse ($markFile as $item)
                <div class="card shadow-sm p-4 mb-4">
                    <p><strong>File Name:</strong> {{ $item->original_name }}</p>
                    <p><str ong>Uploaded At:</strong> {{ $item->created_at->format('Y-m-d H:i') }}</p>
                    <a href="{{ asset($item->file_path) }}" class="btn btn-success" target="_blank">
                        View / Download File
                    </a>
                </div>
            @empty
                <div class="alert alert-info">No uploaded mark files found.</div>
            @endforelse
        </div>
    </div>
</div>

@endsection
