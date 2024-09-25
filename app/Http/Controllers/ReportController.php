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
            case 'income-and-expenditure':
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
            'suppliers.name as supplier_name',
            'customers.name as customer_name', // Assuming customer names are stored here
            'transactions.amount',
            'transactions.transaction_type_id',
            'transactions.member_id',
            'transactions.customer_id'
        )
            ->join('gl_codes_parent', 'transactions.gl_code_id', '=', 'gl_codes_parent.id')
            ->leftJoin('suppliers', 'transactions.supplier_id', '=', 'suppliers.id')
            ->leftJoin('customers', 'transactions.customer_id', '=', 'customers.id') // Join with customers table
            ->groupBy('gl_codes_parent.name', 'suppliers.name', 'customers.name', 'transactions.amount', 'transactions.transaction_type_id', 'transactions.member_id', 'transactions.customer_id')
            ->orderBy('gl_codes_parent.name', 'asc');

        // Apply date filters
        if ($startDate && $endDate) {
            $query->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59']);
        } elseif ($month && $year) {
            $query->whereMonth('transactions.created_at', $month)
                ->whereYear('transactions.created_at', $year);
        } elseif ($year) {
            $query->whereYear('transactions.created_at', $year);
        }

        // Fetch the data
        $results = $query->get();

        // Group by parent GL code
        $groupedResults = $results->groupBy('parent_gl_code_name');

        return $groupedResults;
    }


    private function generatePDF($reportData)
    {
        $pdf = Pdf::loadView('page.reports.income-and-expenditure', compact('reportData'));
        return $pdf->stream('income-and-expenditure.pdf');
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
