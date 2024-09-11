<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit and Loss Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .net-profit {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
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
                <td colspan="2">Total Income</td>
                <td>${{ number_format($totalIncome, 2) }}</td>
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

            <!-- Total Expenditure -->
            <tr class="total-row">
                <td colspan="2">Total Expenditure</td>
                <td>${{ number_format($totalExpense, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Net Profit/Loss -->
    <div class="net-profit">
        Net Profit/Loss: ${{ number_format($totalIncome - $totalExpense, 2) }}
    </div>
</body>
</html>
