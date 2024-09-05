<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['amount', 'transaction_type_id', 'account_id', 'gl_code_id', 'description', 'member_id'];

    public function glCode()
    {
        return $this->belongsTo(GlCode::class, 'gl_code_id');
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
        // Create a new Transaction instance
        $transaction = self::create([
            'transaction_type_id' => $transactionType,
            'gl_code_id' => $glCodeId,
            'account_id' => $accountId,
            'amount' => $amount,
            'description' => $description,
            'member_id' => $memberId,
        ]);

        // Find the related account
        $account = Account::find($accountId);

        // Update account balance based on the transaction type
        if ($transactionType == 1) {
            // Income (credit)
            $account->balance += $amount;
        } elseif ($transactionType == 2) {
            // Expenditure (debit)
            $account->balance -= $amount;
        }

        // Save the account with the updated balance
        $account->save();

        return $transaction;
    }
}
