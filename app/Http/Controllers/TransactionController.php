<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::with('glCode', 'account', 'transactionType', 'glCode.glCodesParent')->get();

        return view('page.transaction.index', compact('transaction'));
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

        return redirect()->route('transaction.index')->with('success', 'Transaction created successfully!');
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

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully!');
    }
}
