<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function show($type, Request $request)
    {
        switch ($type) {
            case 'profit-and-loss':
                return $this->profitAndLoss($request);
            default:
                abort(404); // Handle unknown report types
        }
    }

    private function profitAndLoss(Request $request)
    {
        // Log the request inputs to check what is being passed from the form
        Log::info('Filter Inputs:', [
            'month' => $request->input('month'),
            'year' => $request->input('year'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);
        // Get transaction type IDs for income and expenditure
        $incomeTypeId = TransactionType::where('name', 'Income')->value('id');
        $expenditureTypeId = TransactionType::where('name', 'Expenditure')->value('id');

        // Fetch filters from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $month = $request->input('month');
        $year = $request->input('year');

        // Convert start_date and end_date from dd/mm/yyyy to YYYY-MM-DD
        
        Log::info('Filters applied:', [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'month' => $month,
            'year' => $year
        ]);
        // Build the query
        $query = Transaction::select(
            'gl_codes_parent.name as parent_gl_code_name',
            'gl_codes.name as gl_code_name',
            DB::raw('SUM(CASE WHEN transactions.transaction_type_id = ' . $incomeTypeId . ' THEN transactions.amount ELSE 0 END) as total_income'),
            DB::raw('SUM(CASE WHEN transactions.transaction_type_id = ' . $expenditureTypeId . ' THEN transactions.amount ELSE 0 END) as total_expense')
        )
            ->join('gl_codes', 'transactions.gl_code_id', '=', 'gl_codes.id')
            ->join('gl_codes_parent', 'gl_codes.parent_id', '=', 'gl_codes_parent.id')
            ->groupBy('gl_codes_parent.name', 'gl_codes.name');

        // Priority: First, check if a date range is provided.
        if ($startDate && $endDate) {
            // Include the entire end day by appending 23:59:59
            $endDate = $endDate . ' 23:59:59';
            $query->whereBetween('transactions.created_at', [$startDate, $endDate]);
        }
        // If date range is not provided, filter by month and year
        elseif ($month && $year) {
            $query->whereMonth('transactions.created_at', $month)
                ->whereYear('transactions.created_at', $year);
        }
        // If only year is provided (without a month)
        elseif ($year) {
            $query->whereYear('transactions.created_at', $year);
        }

        // Execute the query and get the results
        $reportData = $query->orderBy('gl_codes_parent.name', 'asc')->get();

        // Return the view with the filtered data
        return view('page.reports.profit_and_loss', compact('reportData'));
    }
}
