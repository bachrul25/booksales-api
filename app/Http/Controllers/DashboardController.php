<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_authors' => Author::count(),
            'total_books' => Book::count(),
            'total_genres' => Genre::count(),
            'recent_books' => Book::with('author')
                ->latest()
                ->limit(5)
                ->get(),
            'popular_genres' => Genre::withCount('books')
                ->orderBy('books_count', 'desc')
                ->limit(5)
                ->get()
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
