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
                <!-- Card Header -->
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-post fs-2"></i>
                            <h2 class="mb-0 fw-semibold">Posts</h2>
                        </div>
                        <a href="{{ route('posts.create') }}" class="btn btn-light rounded-pill px-4 py-2">
                            <i class="bi bi-plus-circle me-2"></i>Add New Post
                        </a>
                    </div>
                </div>

                <!-- Post List -->
                <div class="card-body p-4">
                    @if($posts->isEmpty())
                        <div class="alert alert-info d-flex align-items-center gap-3">
                            <i class="bi bi-info-circle-fill fs-4"></i>
                            <div>No posts found. Start by adding your first post.</div>
                        </div>
                    @else
                        <div class="list-group">
                            @foreach($posts as $post)
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center shadow-sm mb-3 rounded-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if($post->image)
                                        <img src="{{ asset($post->image) }}" alt="Post Image" width="60" class="rounded">
                                    @endif
                                    <div>
                                        <h5 class="mb-1 fw-medium">{{ $post->name }}</h5>
                                        <p class="mb-1">{{ Str::limit($post->description, 100) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
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

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .rounded {
        border-radius: 0.5rem;
    }
</style>
@endsection
