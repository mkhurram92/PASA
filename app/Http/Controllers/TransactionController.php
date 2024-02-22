<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('glCode')->get();
        return view('page.transaction.index', compact('transactions'));
    
    }

    public function create()
    {
        // Add logic if needed, e.g., fetching G/L codes for dropdown

        return view('page.transaction.create');
    }

    public function store(Request $request)
    {
        // Validate the request

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    public function edit(Transaction $transaction)
    {
        // Add logic if needed, e.g., fetching G/L codes for dropdown

        return view('page.transaction.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Validate the request

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
