<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genres'])->get();
        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    public function show($id)
    {
        $book = Book::with(['author', 'genres'])->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'description' => 'required|string',
            'published_date' => 'required|date',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $book = Book::create($validated);

        if (isset($validated['genres'])) {
            $book->genres()->attach($validated['genres']);
        }

        return response()->json([
            'success' => true,
            'data' => $book->load(['author', 'genres'])
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author_id' => 'sometimes|exists:authors,id',
            'description' => 'sometimes|string',
            'published_date' => 'sometimes|date',
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,id'
        ]);

        $book->update($validated);

        if (isset($validated['genres'])) {
            $book->genres()->sync($validated['genres']);
        }

        return response()->json([
            'success' => true,
            'data' => $book->load(['author', 'genres'])
        ]);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ]);
    }
}
