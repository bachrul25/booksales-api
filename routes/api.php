<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Read All dan Show dapat diakses publik
| Create, Update, Destroy hanya untuk admin
|
*/

Route::prefix('v1')->group(function () {
    // Public Routes (No Authentication Needed)
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    Route::get('/genres', [GenreController::class, 'index']);
    Route::get('/genres/{id}', [GenreController::class, 'show']);

    // Admin Routes (Require Authentication + Admin Privilege)
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/authors', [AuthorController::class, 'store']);
        Route::put('/authors/{id}', [AuthorController::class, 'update']);
        Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

        Route::post('/genres', [GenreController::class, 'store']);
        Route::put('/genres/{id}', [GenreController::class, 'update']);
        Route::delete('/genres/{id}', [GenreController::class, 'destroy']);
    });
});

// Fallback Route
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Endpoint tidak ditemukan'
    ], 404);
});
