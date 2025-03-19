<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
{
    $transactions = Transaction::all();

    return response()->json([
        'status' => 200,
        'message' => 'Transactions retrieved successfully.',
        'data' => $transactions
    ], 200);
}

    public function store(Request $request)
    {
        $request->validate([
            'id_Item' => 'required|exists:items,id_Item',
            'amount' => 'required|integer',
            'transaction_date' => 'required|date',
            'transaction_type' => 'required|in:in,out'
        ]);

        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('item')->find($id);

        if (!$transaction) return response()->json(['message' => 'Transaction not found'], 404);

        return response()->json($transaction, 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) return response()->json(['message' => 'Transaction not found'], 404);

        $request->validate([
            'id_Item' => 'exists:items,id_Item',
            'amount' => 'integer',
            'transaction_date' => 'date',
            'transaction_type' => 'in:in,out'
        ]);

        $transaction->update($request->all());
        return response()->json($transaction, 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) return response()->json(['message' => 'Transaction not found'], 404);

        $transaction->delete();
        return response()->json(['message' => 'Transaction deleted successfully'], 200);
    }
}
