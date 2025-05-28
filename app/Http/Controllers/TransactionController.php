<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        // Hanya admin yang bisa melihat semua transaksi
        if (!Auth::user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $transactions = Transaction::with(['customer', 'book'])->get();

        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Generate order number
        $latestOrder = Transaction::latest()->first();
        $orderNumber = 'ORD-' . str_pad($latestOrder ? $latestOrder->id + 1 : 1, 4, "0", STR_PAD_LEFT);

        // 3. Get logged in user
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        // 4. Find book
        $book = Book::find($request->book_id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        // 5. Check stock
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient book stock'
            ], 400);
        }

        // 6. Calculate total
        $totalAmount = $book->price * $request->quantity;

        // 7. Reduce book stock
        $book->stock -= $request->quantity;
        $book->save();

        // 8. Save transaction
        $transaction = Transaction::create([
            'order_number' => $orderNumber,
            'customer_id' => $user->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'data' => $transaction->load(['customer', 'book'])
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'book'])->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        // Hanya admin atau customer yang membuat transaksi yang bisa melihat
        if (Auth::user()->id !== $transaction->customer_id && !Auth::user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        // Hanya customer yang membuat transaksi yang bisa update
        if (Auth::user()->id !== $transaction->customer_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'sometimes|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update logic here (similar to store)
        // ...

        return response()->json([
            'success' => true,
            'data' => $transaction->fresh(['customer', 'book'])
        ]);
    }

    public function destroy($id)
    {
        // Hanya admin yang bisa menghapus
        if (!Auth::user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }
}
