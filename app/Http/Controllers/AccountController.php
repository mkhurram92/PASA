<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('page.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('page.accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:Asset,Liability,Equity,Income,Expense',
            'balance' => 'numeric',
        ]);

        Account::create($request->all());

        return redirect()->route('accounts.index')->with('success', 'Account created successfully');
    }

    public function show(Account $account)
    {
        return view('page.accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        return view('page.accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:Asset,Liability,Equity,Income,Expense',
            'balance' => 'numeric',
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully');
    }
}
