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

        <!-- Income Section -->
        <h2 class="mt-4">Income</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Parent GL Code Name</th>
                    <th>GL Code Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalIncome = 0;
                @endphp

                @foreach ($reportData as $data)
                    @if ($data->total_income > 0)
                        <tr>
                            <td>{{ $data->parent_gl_code_name }}</td>
                            <td>{{ $data->gl_code_name }}</td>
                            <td>${{ number_format($data->total_income, 2) }}</td>
                        </tr>
                        @php
                            $totalIncome += $data->total_income;
                        @endphp
                    @endif
                @endforeach

                <!-- Total Income -->
                <tr class="table-secondary">
                    <td colspan="2" class="text-right"><strong>Total Income</strong></td>
                    <td><strong>${{ number_format($totalIncome, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Expenditure Section -->
        <h2 class="mt-4">Expenditure</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Parent GL Code Name</th>
                    <th>GL Code Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalExpense = 0;
                @endphp

                @foreach ($reportData as $data)
                    @if ($data->total_expense > 0)
                        <tr>
                            <td>{{ $data->parent_gl_code_name }}</td>
                            <td>{{ $data->gl_code_name }}</td>
                            <td>${{ number_format($data->total_expense, 2) }}</td>
                        </tr>
                        @php
                            $totalExpense += $data->total_expense;
                        @endphp
                    @endif
                @endforeach

                <!-- Total Expense -->
                <tr class="table-secondary">
                    <td colspan="2" class="text-right"><strong>Total Expense</strong></td>
                    <td><strong>${{ number_format($totalExpense, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Net Profit/Loss Calculation -->
        <h2 class="mt-4">Net Profit/Loss</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">Net Profit/Loss</th>
                    <th>${{ number_format($totalIncome - $totalExpense, 2) }}</th>
                </tr>
            </thead>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
