<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit and Loss Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            margin: 0 auto;
            /* Changed to 0 to remove extra space */
            max-width: 900px;
            padding: 15px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        h1 {
            color: #000;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        h2 {
            color: #000;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 5px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .table-container {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        th,
        td {
            padding: 3px 4px;
            text-align: left;
        }

        th {
            background-color: #f7f7f7;
            color: #000;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .total-row {
            font-weight: bold;
            background-color: #f7f7f7;
        }

        .net-profit-loss {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
        }

        .right-align {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Pioneers Association of South Australia</h1>
            <h4>23 Leigh Street, Adelaide 5000</h4>
            <h3>Profit and Loss Report</h3>
        </div>


        <!-- Income Section -->
        <h2>Income</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Parent GL</th>
                        <th>Sub GL</th>
                        <th class="right-align">Amount</th>
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
                                <td class="right-align">${{ number_format($data->total_income, 2) }}</td>
                            </tr>
                            @php
                                $totalIncome += $data->total_income;
                            @endphp
                        @endif
                    @endforeach

                    <!-- Total Income -->
                    <tr class="total-row">
                        <td colspan="2" class="right-align"><strong>Total Income</strong></td>
                        <td class="right-align"><strong>${{ number_format($totalIncome, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Expenditure Section -->
        <h2>Expenditure</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Parent GL</th>
                        <th>Sub GL</th>
                        <th class="right-align">Amount</th>
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
                                <td class="right-align">${{ number_format($data->total_expense, 2) }}</td>
                            </tr>
                            @php
                                $totalExpense += $data->total_expense;
                            @endphp
                        @endif
                    @endforeach

                    <!-- Total Expense -->
                    <tr class="total-row">
                        <td colspan="2" class="right-align"><strong>Total Expense</strong></td>
                        <td class="right-align"><strong>${{ number_format($totalExpense, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Net Profit/Loss Calculation -->
        <div class="net-profit-loss">
            Net Profit/Loss: ${{ number_format($totalIncome - $totalExpense, 2) }}
        </div>
    </div>
</body>
</html>
