<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('page.transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('page.transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }

    public function show(Transaction $transaction)
    {
        return view('page.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('page.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required|string',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
