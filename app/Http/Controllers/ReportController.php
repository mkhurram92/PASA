<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function show($type, Request $request)
    {
        switch ($type) {
            case 'profit-and-loss':
                return $this->profitAndLoss($request);
            // Define other cases as needed
            default:
                abort(404); // Handle unknown report types
        }
    }

    private function profitAndLoss(Request $request)
    {
        // Get transaction type IDs for income and expenditure
        $incomeTypeId = TransactionType::where('name', 'Income')->value('id');
        $expenditureTypeId = TransactionType::where('name', 'Expenditure')->value('id');

        // Fetch filters from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Build the query
        $query = Transaction::select(
                'gl_codes_parent.name as parent_gl_code_name',
                'gl_codes.name as gl_code_name',
                DB::raw('SUM(CASE WHEN transactions.transaction_type_id = '.$incomeTypeId.' THEN transactions.amount ELSE 0 END) as total_income'),
                DB::raw('SUM(CASE WHEN transactions.transaction_type_id = '.$expenditureTypeId.' THEN transactions.amount ELSE 0 END) as total_expense')
            )
            ->join('gl_codes', 'transactions.gl_code_id', '=', 'gl_codes.id')
            ->join('gl_codes_parent', 'gl_codes.parent_id', '=', 'gl_codes_parent.id')
            ->groupBy('gl_codes_parent.name', 'gl_codes.name');

        // Apply date range filter
        if ($startDate && $endDate) {
            $query->whereBetween('transactions.created_at', [$startDate, $endDate]);
        }

        // Execute the query and get the results
        $reportData = $query->orderBy('gl_codes_parent.name', 'asc')->get();

        // Return the view with the filtered data
        return view('page.reports.profit_and_loss', compact('reportData'));
    }
}
