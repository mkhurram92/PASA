{{-- resources/views/page/reports/profit_and_loss.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit and Loss Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            max-width: 900px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #1a73e8;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        h2 {
            color: #333;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 2px solid #1a73e8;
            padding-bottom: 10px;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #1a73e8;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }
        tbody {
            display: block;
            max-height: 400px;
            overflow-y: auto; 
        }
        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        tr:nth-child(even) {
            background-color: #f7f9fc;
        }
        tr:hover {
            background-color: #e9f1ff;
        }
        .table-secondary {
            background-color: #f1f3f4;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #e0f3ff;
        }
        .net-profit-loss {
            font-size: 18px;
            font-weight: bold;
            background-color: #e0f3ff;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profit and Loss Report</h1>

        <!-- Income Section -->
        <h2>Income</h2>
        <table>
            <thead>
                <tr>
                    <th>Parent GL</th>
                    <th>Sub GL</th>
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
                <tr class="total-row">
                    <td colspan="2" class="text-right"><strong>Total Income</strong></td>
                    <td><strong>${{ number_format($totalIncome, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Expenditure Section -->
        <h2>Expenditure</h2>
        <table>
            <thead>
                <tr>
                    <th>Parent GL</th>
                    <th>Sub GL</th>
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
                <tr class="total-row">
                    <td colspan="2" class="text-right"><strong>Total Expense</strong></td>
                    <td><strong>${{ number_format($totalExpense, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Net Profit/Loss Calculation -->
        <div class="net-profit-loss">
            Net Profit/Loss: ${{ number_format($totalIncome - $totalExpense, 2) }}
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
