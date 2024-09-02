{{-- resources/views/page/reports/profit_and_loss.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit and Loss Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Profit and Loss Report</h1>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>GL Code Name</th>
                    <th>Total Income</th>
                    <th>Total Expense</th>
                    <th>Profit/Loss</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentParentGLCode = null;
                    $subTotalIncome = 0;
                    $subTotalExpense = 0;
                    $subTotalProfitLoss = 0;
                @endphp

                @foreach ($reportData as $data)
                    <!-- Display a new heading for a new Parent GL Code -->
                    @if ($currentParentGLCode !== $data->parent_gl_code_name)
                        <!-- Display subtotal for the previous parent GL code, if any -->
                        @if ($currentParentGLCode !== null)
                            <tr class="table-secondary">
                                <td colspan="2" class="text-right"><strong>Subtotal for {{ $currentParentGLCode }}</strong></td>
                                <td><strong>${{ number_format($subTotalIncome, 2) }}</strong></td>
                                <td><strong>${{ number_format($subTotalExpense, 2) }}</strong></td>
                                <td><strong>${{ number_format($subTotalProfitLoss, 2) }}</strong></td>
                            </tr>
                        @endif

                        <!-- Reset subtotal counters -->
                        @php
                            $subTotalIncome = 0;
                            $subTotalExpense = 0;
                            $subTotalProfitLoss = 0;
                        @endphp

                        <!-- Set the new parent GL code -->
                        @php
                            $currentParentGLCode = $data->parent_gl_code_name;
                        @endphp

                        <!-- Display the parent GL code as a heading -->
                        <tr>
                            <td colspan="5" class="font-weight-bold bg-primary text-white">{{ $currentParentGLCode }}</td>
                        </tr>
                    @endif

                    <!-- Display the transaction data -->
                    <tr>
                        <td>{{ $data->date }}</td>
                        <td>{{ $data->gl_code_name }}</td>
                        <td>${{ number_format($data->total_income, 2) }}</td>
                        <td>${{ number_format($data->total_expense, 2) }}</td>
                        <td>${{ number_format($data->total_profit_loss, 2) }}</td>
                    </tr>

                    <!-- Add current row's totals to the subtotals -->
                    @php
                        $subTotalIncome += $data->total_income;
                        $subTotalExpense += $data->total_expense;
                        $subTotalProfitLoss += $data->total_profit_loss;
                    @endphp
                @endforeach

                <!-- Final subtotal for the last parent GL code -->
                @if ($currentParentGLCode !== null)
                    <tr class="table-secondary">
                        <td colspan="2" class="text-right"><strong>Subtotal for {{ $currentParentGLCode }}</strong></td>
                        <td><strong>${{ number_format($subTotalIncome, 2) }}</strong></td>
                        <td><strong>${{ number_format($subTotalExpense, 2) }}</strong></td>
                        <td><strong>${{ number_format($subTotalProfitLoss, 2) }}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
