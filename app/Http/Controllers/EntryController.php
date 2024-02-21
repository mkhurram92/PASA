<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Account;
use App\Models\Transaction;

class EntryController extends Controller
{
    public function index()
    {
        $entries = Entry::all();
        return view('page.entries.index', compact('entries'));
    }

    public function create()
    {
        $accounts = Account::all();
        $transactions = Transaction::all();

        return view('page.entries.create', compact('accounts', 'transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'transaction_id' => 'required|exists:transactions,id',
            'type' => 'required|in:debit,credit',
            'amount' => 'required|numeric',
        ]);

        Entry::create($request->all());

        return redirect()->route('entries.index')->with('success', 'Entry created successfully');
    }

    public function show(Entry $entry)
    {
        return view('page.entries.show', compact('entry'));
    }

    public function edit($id)
    {
        $entry = Entry::findOrFail($id);
        $accounts = Account::all();
        $transactions = Transaction::all();

        return view('page.entries.edit', compact('entry', 'accounts', 'transactions'));
    }

    public function update(Request $request, Entry $entry)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'transaction_id' => 'required|exists:transactions,id',
            'type' => 'required|in:debit,credit',
            'amount' => 'required|numeric',
        ]);

        $entry->update($request->all());

        return redirect()->route('entries.index')->with('success', 'Entry updated successfully');
    }

    public function destroy(Entry $entry)
    {
        $entry->delete();

        return redirect()->route('entries.index')->with('success', 'Entry deleted successfully');
    }
    public function generateReport()
    {
        $entries = Entry::all(); // Adjust this query based on your report requirements

        return view('page.entries.report', compact('entries'));
    }
}
