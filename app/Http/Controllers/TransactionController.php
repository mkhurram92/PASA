<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AdditionalMemberInfos;
use App\Models\GlCode;
use App\Models\GlCodesParent;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        $gl_code_parent = GlCodesParent::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($gl_code_parent, '');

        $transaction_type = TransactionType::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($transaction_type, '');

        $account_type = Account::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($account_type, '');

        $suppliers = Supplier::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($suppliers, '');

        $customers = Customer::orderBy('name', 'asc')->pluck('name')->toArray();
        array_unshift($customers, '');

        $transactions = Transaction::with(['account', 'transactionType', 'glCodesParent', 'supplier', 'customer', 'member'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($transaction) {
                $transaction->related_name = $transaction->related_name; // Automatically compute the related name
                return $transaction;
            });


        return view('page.transaction.index', compact('transactions', 'gl_code_parent', 'transaction_type', 'account_type', 'suppliers', 'customers'));
    }

    public function create()
    {
        $transactionType = TransactionType::OrderBy('name', 'asc')->get();

        $parentGlCodes = GlCodesParent::OrderBy('name', 'asc')->get();

        $accounts = Account::OrderBy('name', 'asc')->get();

        $suppliers = Supplier::OrderBy('name', 'asc')->get();

        $customers = Customer::OrderBy('name', 'asc')->get();

        $memberships = AdditionalMemberInfos::with('member')
            ->orderBy('member_id', 'asc')
            ->get();

        return view('page.transaction.create', compact('parentGlCodes', 'transactionType', 'accounts', 'suppliers', 'customers', 'memberships'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Initialize IDs to null
            $member_id = null;
            $supplier_id = null;
            $customer_id = null;

            // Determine the transaction type and handle accordingly
            if ($request->transaction_type == '1') { // Income
                if ($request->paying_for_member == 'yes') {
                    $member_id = $request->membership_number;
                } elseif ($request->paying_for_member == 'no') {
                    $customer_id = $request->customer_id;
                }
            } elseif ($request->transaction_type == '2') { // Expenditure
                $supplier_id = $request->supplier_id;
            }
            
            // Create the transaction with only the relevant fields
            $transaction = Transaction::create([
                'transaction_type_id' => $request->transaction_type,
                'gl_code_id' => $request->parent_id,
                'account_id' => $request->account_type,
                'amount' => $request->amount,
                'description' => $request->description,
                'supplier_id' => $supplier_id,
                'customer_id' => $customer_id,
                'member_id' => $member_id,
                'created_at' => $request->transaction_date,
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Transaction Added Successfully",
                "redirectTo" => route("transaction.index")
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show($transaction_id)
    {
        // Load all necessary relationships, including member and additionalInfo
        $transaction = Transaction::with([
            'member.additionalInfo',
            'customer',
            'supplier',
            'account',
            'transactionType',
            'glCodesParent'
        ])->find($transaction_id);

        if ($transaction) {
            // Handle member-related information
            if ($transaction->member) {
                $member = $transaction->member;

                // Get membership number from additionalinfo
                $membershipNumber = $member->additionalInfo->member_id ?? null;

                // Get member's name
                $memberName = $member->family_name . ' ' . $member->given_name;

                // Combine membership number with name if available, otherwise just use name
                $transaction->member_info = $membershipNumber ? "$memberName" : $memberName;
            } else {
                $transaction->member_info = null;
            }
        }

        return view('page.transaction.view', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $transactionType = TransactionType::orderBy('name')->get();
        $parentGlCodes = GlCodesParent::orderBy('name')->get();
        $accounts = Account::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();

        // Fetch memberships with the related member's name and membership number
        $memberships = AdditionalMemberInfos::with('member')
            ->orderBy('membership_number')
            ->get();

        return view('page.transaction.edit', compact('transaction', 'parentGlCodes', 'transactionType', 'accounts', 'suppliers', 'customers', 'memberships'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            // Initialize IDs to null
            $member_id = null;
            $supplier_id = null;
            $customer_id = null;

            // Determine the transaction type and handle accordingly
            if ($request->transaction_type == '1') { // Income
                if ($request->paying_for_member == 'yes' && $request->membership_number) {
                    $membership = AdditionalMemberInfos::find($request->membership_number);
                    $member_id = $membership ? $membership->member_id : null;
                } elseif ($request->paying_for_member == 'no') {
                    $customer_id = $request->customer_id;
                }
            } elseif ($request->transaction_type == '2') { // Expenditure
                $supplier_id = $request->supplier_id;
            }

            // Update the transaction with only the relevant fields
            $transaction->update([
                'transaction_type_id' => $request->transaction_type,
                'gl_code_id' => $request->parent_id,
                'account_id' => $request->account_type,
                'amount' => $request->amount,
                'description' => $request->description,
                'supplier_id' => $supplier_id,
                'customer_id' => $customer_id,
                'member_id' => $member_id,
                'created_at' => $request->transaction_date,
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Transaction Updated Successfully",
                "redirectTo" => route("transaction.index")
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully!');
    }
}
