<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\AccountBalance;
use Carbon\Carbon;

class UpdateAccountBalances extends Command
{
    // The name and signature of the console command
    protected $signature = 'balances:update';

    // The console command description
    protected $description = 'Update opening and closing balances for GL codes';

    // Execute the console command
    public function handle()
    {
        // Get the financial year start and end
        [$financialYearStart, $financialYearEnd] = $this->getFinancialYear();

        // Fetch all distinct gl_code_id (which acts as gl_codes_parent_id)
        $codes = DB::table('transactions')
            ->select('gl_code_id')
            ->distinct()
            ->whereNotNull('gl_code_id')
            ->get();

        foreach ($codes as $code) {
            $glCodeId = $code->gl_code_id;  // Treat gl_code_id as gl_codes_parent_id

            // Add logging to ensure we are getting valid gl_code_id
            $this->info("Processing gl_code_id: " . $glCodeId);

            // Skip if glCodeId is NULL or invalid
            if (is_null($glCodeId)) {
                $this->error("Skipping invalid GL code (gl_code_id is NULL).");
                continue;
            }

            // Calculate opening and closing balances
            $openingBalance = $this->calculateOpeningBalance($glCodeId, $financialYearStart);
            $closingBalance = $this->calculateClosingBalance($glCodeId, $financialYearStart, $financialYearEnd);

            // Insert or update the balance for each GL code (gl_codes_parent_id)
            AccountBalance::updateOrCreate(
                [
                    'gl_codes_parent_id' => $glCodeId,
                    'financial_year_start' => $financialYearStart->toDateString(),
                    'financial_year_end' => $financialYearEnd->toDateString(),
                ],
                [
                    'opening_balance' => $openingBalance,
                    'closing_balance' => $closingBalance,
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
            // Financial year starts 1st July of the current year and ends 30th June next year
            $financialYearStart = Carbon::createFromDate($currentDate->year, 7, 1);
            $financialYearEnd = Carbon::createFromDate($currentDate->year + 1, 6, 30);
        } else {
            // Financial year starts 1st July last year and ends 30th June this year
            $financialYearStart = Carbon::createFromDate($currentDate->year - 1, 7, 1);
            $financialYearEnd = Carbon::createFromDate($currentDate->year, 6, 30);
        }
        return [$financialYearStart, $financialYearEnd];
    }

    // Helper method to calculate the opening balance
    private function calculateOpeningBalance($glCodeId, $financialYearStart)
    {
        return DB::table('transactions')
            ->where('gl_code_id', $glCodeId)
            ->whereDate('created_at', '<', $financialYearStart)
            ->sum('amount');
    }

    // Helper method to calculate the closing balance
    private function calculateClosingBalance($glCodeId, $financialYearStart, $financialYearEnd)
    {
        return DB::table('transactions')
            ->where('gl_code_id', $glCodeId)
            ->whereBetween('created_at', [$financialYearStart, $financialYearEnd])
            ->sum('amount');
    }
}
