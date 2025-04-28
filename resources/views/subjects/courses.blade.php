
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
                    <h1>Courses by {{ $teacher->name }}</h1>
    <ul class="list-group">
        @foreach($courses as $course)
            <li class="list-group-item">
                <a href="{{ asset($course->pdf_path) }}" target="_blank">{{ $course->name }}</a>
            </li>
        @endforeach
    </ul>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

