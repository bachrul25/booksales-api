@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-4">Our Authors</h1>
        <p class="lead">Discover the talented writers behind your favorite books</p>
    </div>
</div>

<div class="row">
    @foreach($authors as $author)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-4x text-secondary"></i>
                </div>
                <h3 class="card-title">{{ $author->name }}</h3>
                <p class="text-muted mb-3">{{ Str::limit($author->bio, 100) }}</p>
                <div class="d-grid">
                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-primary">
                        <i class="fas fa-eye me-1"></i> View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection