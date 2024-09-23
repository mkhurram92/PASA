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
}
