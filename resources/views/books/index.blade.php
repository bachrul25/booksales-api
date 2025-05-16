@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-4">Book Collection</h1>
        <p class="lead">Explore our wide selection of books from various authors</p>
    </div>
</div>

<div class="row">
    @foreach($books as $book)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h3 class="card-title">{{ $book->title }}</h3>
                <p class="text-muted mb-2">
                    <i class="fas fa-user-pen me-1"></i>
                    <a href="{{ route('authors.show', $book->author->id) }}" class="text-decoration-none">
                        {{ $book->author->name }}
                    </a>
                </p>
                <p class="card-text">{{ Str::limit($book->description, 120) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-secondary">
                        {{ \Carbon\Carbon::parse($book->published_date)->format('Y') }}
                    </span>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-book-open me-1"></i> Read More
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection