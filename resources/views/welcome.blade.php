@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-4">Discover Your Next Favorite Book</h1>
        <p class="lead mb-5">Explore our extensive collection of books from talented authors worldwide</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('authors.index') }}" class="btn btn-light btn-lg px-4">
                <i class="fas fa-user-pen me-2"></i> Browse Authors
            </a>
            <a href="{{ route('books.index') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-book me-2"></i> Explore Books
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Why Choose BookSales API</h2>
            <p class="lead text-muted">Powerful features to enhance your reading experience</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3>Comprehensive Database</h3>
                        <p class="text-muted">Access thousands of books and authors with detailed information and
                            metadata.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3>Fast API</h3>
                        <p class="text-muted">High-performance REST API with quick response times and reliable uptime.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3>Secure Access</h3>
                        <p class="text-muted">OAuth 2.0 authentication and role-based access control for your data
                            security.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Authors Preview -->
<section id="authors" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Featured Authors</h2>
            <p class="lead text-muted">Discover talented writers from our collection</p>
        </div>
        <div class="row g-4">
            @foreach($featuredAuthors as $author)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-user-circle fa-4x text-secondary"></i>
                        </div>
                        <h3>{{ $author->name }}</h3>
                        <p class="text-muted mb-3">{{ Str::limit($author->bio, 80) }}</p>
                        <a href="{{ route('authors.show', $author->id) }}" class="btn btn-outline-primary">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('authors.index') }}" class="btn btn-primary btn-lg px-4">
                View All Authors <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Books Preview -->
<section id="books" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Popular Books</h2>
            <p class="lead text-muted">Explore our most popular titles</p>
        </div>
        <div class="row g-4">
            @foreach($popularBooks as $book)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h3>{{ $book->title }}</h3>
                        <p class="text-muted mb-2">
                            <i class="fas fa-user-pen me-1"></i>
                            {{ $book->author->name }}
                        </p>
                        <p class="mb-3">{{ Str::limit($book->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">
                                {{ \Carbon\Carbon::parse($book->published_date)->format('Y') }}
                            </span>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg px-4">
                Browse All Books <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">What Our Users Say</h2>
            <p class="lead text-muted">Hear from developers and readers who use our API</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 testimonial-card">
                        <p class="fst-italic mb-4">"BookSales API has transformed how we access book data. The
                            documentation is excellent and the response times are fantastic."</p>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle fa-3x text-secondary me-3"></i>
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <p class="text-muted mb-0">CTO, Readable Inc.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 testimonial-card">
                        <p class="fst-italic mb-4">"As an author, I appreciate how easy it is to keep my information
                            updated. The team is responsive and helpful."</p>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle fa-3x text-secondary me-3"></i>
                            <div>
                                <h5 class="mb-0">Michael Chen</h5>
                                <p class="text-muted mb-0">Bestselling Author</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 testimonial-card">
                        <p class="fst-italic mb-4">"Integrating BookSales API into our library system was seamless. The
                            data quality is consistently high."</p>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle fa-3x text-secondary me-3"></i>
                            <div>
                                <h5 class="mb-0">David Wilson</h5>
                                <p class="text-muted mb-0">Systems Librarian</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Ready to Get Started?</h2>
        <p class="lead mb-5">Join thousands of developers and book lovers using our API today</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('authors.index') }}" class="btn btn-light btn-lg px-4">
                Explore Dashboard
            </a>
            <a href="#" class="btn btn-outline-light btn-lg px-4">
                API Documentation
            </a>
        </div>
    </div>
</section>
@endsection