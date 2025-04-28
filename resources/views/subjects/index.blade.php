
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
                    <ul class="list-group">
                        @foreach($teachers as $teacher)
                            <li class="list-group-item">
                                <a href="{{ route('student.subject.courses', $teacher->id) }}">
                                    {{ $teacher->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
              
            </div>
        </div>
    </div>
</div>
@endsection

