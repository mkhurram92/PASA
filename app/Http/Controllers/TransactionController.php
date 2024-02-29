<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\GlCode;
use App\Models\GlCodesParent;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

        return view('page.transaction.create', compact('parentGlCodes', 'subGlCodes', 'transactionType', 'accounts'));
    }

    public function store(Request $request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            $rules = [
                'transaction_type' => 'required',
                //'parent_id' => 'required|exists:parent_gl_codes,id',
                'subGlCodes' => 'required',
                'account_type' => 'required|exists:accounts,id',
                'amount' => 'required|numeric',
            ];

            // Custom validation messages
            $messages = [
                'transaction_type' => 'Transaction type is required',
                //'parent_id' => 'Parent GL is required',
                'subGlCodes' => 'Sub GL is required',
                'account_type' => 'Transaction account is required',
                'amount' => 'Amount field is required',
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules, $messages);

            // Check if validation fails
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            // Create a new Transaction instance
            $transaction = new Transaction([
                'transaction_type_id' => $request->input('transaction_type'),
                //'parent_id' => $request->input('parent_id'),
                'gl_code_id' => $request->input('subGlCodes'),
                'account_id' => $request->input('account_type'),
                'amount' => $request->input('amount'),
            ]);

            $transaction->save();

            // Commit the database transaction
            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Transaction Added Successfully",
                "redirectTo" => route("transaction.index")
            ]);
        } catch (\Exception $e) {
            // Rollback the database transaction on error
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($transaction_id)
    {
        $transaction = Transaction::with(
            [
                'glCode', 'account', 'transactionType', 'glCode.glCodesParent'
            ]
        )->find($transaction_id);

        return view('page.transaction.view', compact('transaction'));
    }
    
    public function edit(Transaction $transaction)
    {
        $transactionType = TransactionType::OrderBy('name')->get();

        $parentGlCodes = GlCodesParent::OrderBy('name')->get();

        $subGlCodes = GlCode::OrderBy('name')->get();

        $accounts = Account::OrderBy('name')->get();
        
        return view('page.transaction.edit', compact('transaction', 'parentGlCodes', 'subGlCodes', 'transactionType', 'accounts'));
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