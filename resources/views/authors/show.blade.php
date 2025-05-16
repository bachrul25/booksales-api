@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-4">{{ $author->name }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('authors.index') }}">Authors</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $author->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <i class="fas fa-user-circle fa-5x text-secondary mb-3"></i>
                <h3>{{ $author->name }}</h3>
                <p class="text-muted mb-1"><i class="fas fa-envelope me-2"></i> {{ $author->email }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-4">About the Author</h3>
                <p class="author-bio">{{ $author->bio }}</p>

                <hr class="my-4">

                <h3 class="mb-4">Published Works</h3>
                @if($author->books->count() > 0)
                <div class="list-group">
                    @foreach($author->books as $book)
                    <a href="{{ route('books.show', $book->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $book->title }}</h5>
                            <small class="text-muted">{{ $book->published_date->format('Y') }}</small>
                        </div>
                        <p class="mb-1">{{ Str::limit($book->description, 100) }}</p>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    This author hasn't published any books yet.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection