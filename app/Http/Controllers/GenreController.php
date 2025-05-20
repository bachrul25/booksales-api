<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('books')->get();
        return response()->json([
            'success' => true,
            'data' => $genres
        ]);
    }

    public function show($id)
    {
        $genre = Genre::with('books.author')->find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $genre
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres',
            'description' => 'nullable|string'
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'data' => $genre
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:genres,name,' . $id,
            'description' => 'nullable|string'
        ]);

        $genre->update($validated);

        return response()->json([
            'success' => true,
            'data' => $genre
        ]);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted successfully'
        ]);
    }
}
