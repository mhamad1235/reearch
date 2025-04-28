
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
                    <h4>Example Index Page</h4>
                </div>
                <div class="card-body">
                    <p>This is the main content of the page.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
