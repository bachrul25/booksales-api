@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-4">{{ $book->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="mb-4">Book Details</h3>
                <div class="mb-4">
                    <h5>Description</h5>
                    <p class="book-description">{{ $book->description }}</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Publication Date</h5>
                        <p>{{ $book->published_date->format('F j, Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Author</h5>
                        <p>
                            <a href="{{ route('authors.show', $book->author->id) }}" class="text-decoration-none">
                                <i class="fas fa-user-pen me-1"></i> {{ $book->author->name }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-book-open fa-5x text-primary mb-3"></i>
                <h3>{{ $book->title }}</h3>
                <p class="text-muted">by {{ $book->author->name }}</p>
                <hr>
                <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Collection
                </a>
            </div>
        </div>
    </div>
</div>
@endsection