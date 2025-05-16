<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAuthors = Author::count();
        $totalBooks = Book::count();
        $recentAuthors = Author::latest()->take(5)->get();
        $recentBooks = Book::with('author')->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalAuthors',
            'totalBooks',
            'recentAuthors',
            'recentBooks'
        ));
    }
}
