<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['amount', 'transaction_type_id', 'account_id', 'gl_code_id', 'description', 'member_id', 'customer_id', 'supplier_id', 'created_at'];

    public function glCodesParent()
    {
        return $this->belongsTo(GlCodesParent::class, 'gl_code_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function membership()
    {
        return $this->belongsTo(AdditionalMemberInfos::class, 'member_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public static function createAndProcessTransaction($transactionType, $glCodeId, $accountId, $amount, $description, $memberId)
    {
        $transaction = self::create([
            'transaction_type_id' => $transactionType,
            'gl_code_id' => $glCodeId,
            'account_id' => $accountId,
            'amount' => $amount,
            'description' => $description,
            'member_id' => $memberId,
        ]);

        // Dynamically get the ID for 'Active' status
        $activeStatus = \App\Models\MembershipStatus::where('name', 'Active')->first();

        // Find the member
        $member = Member::find($memberId);

        if ($activeStatus && $member) {
            // Set the member's status to 'Active'
            $member->member_status_id = $activeStatus->id;

            // Save the updated member status
            $member->save();
        }

        return $transaction;
    }

    public function getRelatedNameAttribute()
    {
        if ($this->transaction_type_id == 2 && $this->supplier_id) {
            return $this->supplier->name; // Return Supplier name if it's an expense
        }

        if ($this->transaction_type_id == 1 && $this->member_id) {
            return $this->member->family_name . ' ' . $this->member->given_name; // Return Member name if it's income and member_id is set
        }

        if ($this->transaction_type_id == 1 && $this->customer_id) {
            return $this->customer->name; // Return Customer name if it's income and customer_id is set
        }

        return null; // Return null if none of the conditions are met
    }
}
