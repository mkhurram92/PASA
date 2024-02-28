<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\GlCode;
use App\Models\GlCodesParent;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionType;

class TransactionController extends Controller
{
    public function index()
    {
        $gl_code_parent = GlCodesParent::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($gl_code_parent, '');

        $gl_code_sub = GlCode::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($gl_code_sub, '');

        $transaction_type = TransactionType::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($transaction_type, '');

        $account_type = Account::orderBy('id', 'asc')->pluck('name')->toArray();
        array_unshift($account_type, '');

        $transaction = Transaction::with('glCode', 'account', 'transactionType', 'glCode.glCodesParent')->get();

        return view('page.transaction.index', compact('transaction', 'gl_code_parent', 'gl_code_sub', 'transaction_type', 'account_type'));
    }

    public function create()
    {
        $transactionType = TransactionType::OrderBy('name')->get();

        $parentGlCodes = GlCodesParent::OrderBy('name')->get();
        
        $subGlCodes = GlCode::OrderBy('name')->get();

        $accounts = Account::OrderBy('name')->get();

        return view('page.transaction.create', compact('parentGlCodes', 'subGlCodes','transactionType','accounts'));
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
