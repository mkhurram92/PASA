<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\AccountBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateAccountBalances extends Command
{
    protected $signature = 'balances:update';
    protected $description = 'Update opening and closing balances for GL codes';

    public function handle()
    {
        Log::info('UpdateAccountBalances command started.');
        // Get the financial year start and end
        [$financialYearStart, $financialYearEnd] = $this->getFinancialYear();

        // Fetch all gl_codes_parent_id from the gl_codes_parent table
        $codes = DB::table('gl_codes_parent')
            ->select('id')  // Select all parent GL codes
            ->get();

        foreach ($codes as $code) {
            $glCodesParentId = $code->id;

            // Calculate the opening balance (sum of all transactions before the financial year start)
            $openingBalance = $this->calculateOpeningBalance($glCodesParentId, $financialYearStart);

            // Calculate the closing balance (sum of all transactions within the financial year)
            $closingBalance = $this->calculateClosingBalance($glCodesParentId, $financialYearStart, $financialYearEnd);

            // Insert or update the balance for each GL code (gl_codes_parent_id)
            AccountBalance::updateOrCreate(
                [
                    'gl_codes_parent_id' => $glCodesParentId,
                    'financial_year_start' => $financialYearStart->toDateString(),
                    'financial_year_end' => $financialYearEnd->toDateString(),
                ],
                [
                    'opening_balance' => $openingBalance ?? 0,  // Set to 0 if no opening balance
                    'closing_balance' => $closingBalance ?? 0,  // Set to 0 if no closing balance
                ]
            );
        }

        $this->info('Opening and closing balances updated successfully for all GL codes.');
    }

    // Helper method to calculate the financial year start and end
    private function getFinancialYear()
    {
        $currentDate = Carbon::now();
        if ($currentDate->month >= 7) {
            $financialYearStart = Carbon::createFromDate($currentDate->year, 7, 1);
            $financialYearEnd = Carbon::createFromDate($currentDate->year + 1, 6, 30);
        } else {
            $financialYearStart = Carbon::createFromDate($currentDate->year - 1, 7, 1);
            $financialYearEnd = Carbon::createFromDate($currentDate->year, 6, 30);
        }
        return [$financialYearStart, $financialYearEnd];
    }

    // Helper method to calculate the opening balance
    private function calculateOpeningBalance($glCodesParentId, $financialYearStart)
    {
        return DB::table('transactions')
            ->where('gl_code_id', $glCodesParentId)
            ->whereDate('created_at', '<', $financialYearStart)
            ->sum('amount');
    }

    // Helper method to calculate the closing balance
    private function calculateClosingBalance($glCodesParentId, $financialYearStart, $financialYearEnd)
    {
        return DB::table('transactions')
            ->where('gl_code_id', $glCodesParentId)
            ->whereBetween('created_at', [$financialYearStart, $financialYearEnd])
            ->sum('amount');
    }
}
