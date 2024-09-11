<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('page.reports.index');
    }

    public function show($type, Request $request)
    {
        switch ($type) {
            case 'profit-and-loss':
                return $this->profitAndLoss($request);
            default:
                abort(404);
        }
    }

    public function profitAndLoss(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $month = $request->input('month');
        $year = $request->input('year');

        $incomeTypeId = TransactionType::where('name', 'Income')->value('id');
        $expenditureTypeId = TransactionType::where('name', 'Expenditure')->value('id');

        $reportData = $this->getProfitAndLossData($incomeTypeId, $expenditureTypeId, $startDate, $endDate, $month, $year);

        return $this->generatePDF($reportData);
    }

    private function getProfitAndLossData($incomeTypeId, $expenditureTypeId, $startDate, $endDate, $month, $year)
    {
        $query = Transaction::select(
            'gl_codes_parent.name as parent_gl_code_name',
            'gl_codes.name as gl_code_name',
            DB::raw('SUM(CASE WHEN transactions.transaction_type_id = ' . $incomeTypeId . ' THEN transactions.amount ELSE 0 END) as total_income'),
            DB::raw('SUM(CASE WHEN transactions.transaction_type_id = ' . $expenditureTypeId . ' THEN transactions.amount ELSE 0 END) as total_expense')
        )
            ->join('gl_codes', 'transactions.gl_code_id', '=', 'gl_codes.id')
            ->join('gl_codes_parent', 'gl_codes.parent_id', '=', 'gl_codes_parent.id')
            ->groupBy('gl_codes_parent.name', 'gl_codes.name');

        if ($startDate && $endDate) {
            $query->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59']);
        } elseif ($month && $year) {
            $query->whereMonth('transactions.created_at', $month)
                ->whereYear('transactions.created_at', $year);
        } elseif ($year) {
            $query->whereYear('transactions.created_at', $year);
        }

        return $query->orderBy('gl_codes_parent.name', 'asc')->get();
    }

    private function generatePDF($reportData)
    {
        $pdf = Pdf::loadView('page.reports.profit_and_loss', compact('reportData'));
        return $pdf->stream('profit_and_loss_report.pdf');
    }

    // Example Income and Expenditure method
    private function incomeAndExpenditure(Request $request)
    {
        // Placeholder logic for now
        return $this->generatePDF(['data' => []]);
    }

    // Example Balance Sheet method
    private function balanceSheet(Request $request)
    {
        // Placeholder logic for the Balance Sheet report
        return $this->generatePDF(['data' => []]);
    }
}
