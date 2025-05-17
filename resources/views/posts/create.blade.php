@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3">
            <x-sidebar />
        </div>

        <!-- Form Section -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-plus-square fs-4"></i>
                        <h4 class="mb-0">Create Post</h4>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn btn-light btn-sm rounded-pill">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </a>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <hr>
                        <h5 class="text-primary fw-bold mb-3">English</h5>
                        <div class="mb-3">
                            <label class="form-label">Name (EN)</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description (EN)</label>
                            <textarea name="description_en" class="form-control" rows="3">{{ old('description_en') }}</textarea>
                        </div>

                        <hr>
                        <h5 class="text-success fw-bold mb-3">Kurdish</h5>
                        <div class="mb-3">
                            <label class="form-label">Name (KU)</label>
                            <input type="text" name="name_ku" class="form-control" value="{{ old('name_ku') }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description (KU)</label>
                            <textarea name="description_ku" class="form-control" rows="3">{{ old('description_ku') }}</textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <i class="bi bi-check-circle me-2"></i>Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
