<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $account = Account::all();

        return view('page.accounts.index', compact('account'));
    }

    public function create()
    {
        $html = view("models.account-create")->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $account = Account::create($validatedData);

        return response()->json(["status" => true, "message" => "Transaction Account Created", "redirectTo" => route("accounts.index")]);
    }

    public function show(Account $account)
    {
        $html = view("models.account-view", compact('account'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function edit(Account $account)
    {
        $html = view("models.account-update", compact('account'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    public function update(Request $request, $account)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $account = Account::find($account)->update($validatedData);
        return response()->json(["status" => true, "message" => "Transaction Account Updated", "redirectTo" => route("accounts.index")]);
    }
}
