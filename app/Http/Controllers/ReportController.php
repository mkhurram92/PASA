<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function show($type)
    {
        switch ($type) {
            case 'profit-and-loss':
                return $this->profitAndLoss();
            // Define other cases as needed
            default:
                abort(404); // Handle unknown report types
        }
    }

    private function profitAndLoss()
    {
        // Get transaction type IDs for income and expenditure
        $incomeTypeId = TransactionType::where('name', 'Income')->value('id');
        $expenditureTypeId = TransactionType::where('name', 'Expenditure')->value('id');

        // Query to aggregate data by parent_gl_code_name and gl_code_name
        $reportData = Transaction::select(
                'gl_codes_parent.name as parent_gl_code_name',
                'gl_codes.name as gl_code_name',
                DB::raw('SUM(CASE WHEN transactions.transaction_type_id = '.$incomeTypeId.' THEN transactions.amount ELSE 0 END) as total_income'),
                DB::raw('SUM(CASE WHEN transactions.transaction_type_id = '.$expenditureTypeId.' THEN transactions.amount ELSE 0 END) as total_expense')
            )
            ->join('gl_codes', 'transactions.gl_code_id', '=', 'gl_codes.id')
            ->join('gl_codes_parent', 'gl_codes.parent_id', '=', 'gl_codes_parent.id')
            ->groupBy('gl_codes_parent.name', 'gl_codes.name')
            ->orderBy('gl_codes_parent.name', 'asc')
            ->get();

        return view('page.reports.profit_and_loss', compact('reportData'));
    }
}
