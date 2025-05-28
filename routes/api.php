<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Pembagian akses endpoint:
| - Read All dan Show: dapat diakses publik
| - Create, Update: hanya untuk customer terautentikasi
| - Destroy dan Index (transaksi): hanya untuk admin
|
*/

Route::prefix('v1')->group(function () {
    // Public Routes (No Authentication Needed)
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    Route::get('/genres', [GenreController::class, 'index']);
    Route::get('/genres/{id}', [GenreController::class, 'show']);
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);

    // Authenticated Customer Routes
    Route::middleware(['auth:sanctum'])->group(function () {
        // Transaction routes for customers
        Route::post('/transactions', [TransactionController::class, 'store']);
        Route::get('/transactions/{id}', [TransactionController::class, 'show']);
        Route::put('/transactions/{id}', [TransactionController::class, 'update']);

        // Book review/rating routes (contoh tambahan)
        // Route::post('/books/{id}/reviews', [BookController::class, 'addReview']);
    });

    // Admin Only Routes
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        // Author management
        Route::post('/authors', [AuthorController::class, 'store']);
        Route::put('/authors/{id}', [AuthorController::class, 'update']);
        Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

        // Genre management
        Route::post('/genres', [GenreController::class, 'store']);
        Route::put('/genres/{id}', [GenreController::class, 'update']);
        Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

        // Book management
        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);

        // Transaction management
        Route::get('/transactions', [TransactionController::class, 'index']);
        Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
    });
});

// Fallback Route
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Endpoint tidak ditemukan'
    ], 404);
});
