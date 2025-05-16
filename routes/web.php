<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Models\Author;
use App\Models\Book;

// Landing Page
Route::get('/', function () {
    return view('welcome', [
        'featuredAuthors' => Author::inRandomOrder()->limit(3)->get(),
        'popularBooks' => Book::with('author')->inRandomOrder()->limit(3)->get()
    ]);
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resources
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('books', BookController::class)->only(['index', 'show']);
