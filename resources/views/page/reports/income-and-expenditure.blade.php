<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income and Expenditure Report</title>
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

        .center-align {
            text-align: left;
        }

        .supplier-indent {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Pioneers Association of South Australia</h1>
            <h4>23 Leigh Street, Adelaide 5000</h4>
            <h3>Income and Expenditure</h3>

            @if (request('start_date') && request('end_date'))
                <p>From: {{ request('start_date') }} To: {{ request('end_date') }}</p>
            @elseif(request('month') && request('year'))
                <p>Month: {{ date('F', mktime(0, 0, 0, request('month'), 1)) }} {{ request('year') }}</p>
            @elseif(request('year'))
                <p>Year: {{ request('year') }}</p>
            @endif
        </div>

        <!-- Income Section -->
        <h2>Income</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="left-align">Account</th>
                        <th class="left-align">Selected Period</th>
                        <th class="left-align">Year to Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalIncome = 0;
                    @endphp

                    @foreach ($reportData as $parentGlCode => $transactions)
                        @php
                            $parentTotalIncome = 0;
                            $hasIncome = false;
                        @endphp

                        <!-- Filter transactions to see if there is any income -->
                        @foreach ($transactions as $transaction)
                            @if ($transaction->transaction_type_id == 1)
                                @php
                                    $hasIncome = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach

                        <!-- Display only if there is income -->
                        @if ($hasIncome)
                            <!-- Display the Account Name (Parent GL Code) -->
                            <tr>
                                <td><strong>{{ $parentGlCode }}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <!-- List each member/customer and their respective amounts under the account -->
                            @foreach ($transactions as $transaction)
                                @if ($transaction->transaction_type_id == 1)
                                    <tr>
                                        <td class="supplier-indent">
                                            @if ($transaction->member_id)
                                            Membership No. {{ $transaction->membership_number ?? 'Unknown Member' }}
                                            @elseif ($transaction->customer_id)
                                                {{ $transaction->customer_name ?? 'Unknown Customer' }}
                                            @else
                                                Unknown Source
                                            @endif
                                        </td>
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                    </tr>
                                    @php
                                        $parentTotalIncome += $transaction->amount;
                                        $totalIncome += $transaction->amount;
                                    @endphp
                                @endif
                            @endforeach

                            <!-- Optionally, show the total income for each parent GL Code if desired -->
                            @if ($parentTotalIncome > 0)
                                <tr>
                                    <td class="left-align"><strong>Total for {{ $parentGlCode }}</strong></td>
                                    <td class="left-align"><strong>${{ number_format($parentTotalIncome, 2) }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        @endif
                    @endforeach

                    <!-- Grand Total Income -->
                    <tr class="total-row">
                        <td class="left-align"><strong>Total Income</strong></td>
                        <td class="left-align"><strong>${{ number_format($totalIncome, 2) }}</strong></td>
                        <td></td>
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
                        <th class="left-align">Account</th>
                        <th class="left-align">Selected Period</th>
                        <th class="left-align">Year to Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalExpense = 0;
                    @endphp

                    @foreach ($reportData as $parentGlCode => $transactions)
                        @php
                            $parentTotalExpense = 0;
                            $hasExpense = false;
                        @endphp

                        <!-- Filter transactions to see if there is any expense -->
                        @foreach ($transactions as $transaction)
                            @if ($transaction->transaction_type_id == 2)
                                @php
                                    $hasExpense = true;
                                    break; // Exit loop once expense is found
                                @endphp
                            @endif
                        @endforeach
                        <!-- Display only if there is expense -->
                        @if ($hasExpense)
                            <!-- Display the Account Name (Parent GL Code) -->
                            <tr>
                                <td><strong>{{ $parentGlCode }}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <!-- List each supplier and their respective amounts under the account -->
                            @foreach ($transactions as $transaction)
                                @if ($transaction->transaction_type_id == 2)
                                    <tr>
                                        <td class="supplier-indent">
                                            {{ $transaction->supplier_name ?? 'Unknown Supplier' }}
                                        </td>
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                    </tr>
                                    @php
                                        $parentTotalExpense += $transaction->amount;
                                        $totalExpense += $transaction->amount;
                                    @endphp
                                @endif
                            @endforeach

                            <!-- Optionally, show the total expense for each parent GL Code if desired -->
                            @if ($parentTotalExpense > 0)
                                <tr>
                                    <td class="left-align"><strong>Total for {{ $parentGlCode }}</strong></td>
                                    <td class="left-align">
                                        <strong>${{ number_format($parentTotalExpense, 2) }}</strong></td>
                                    <td></td>
                                </tr>
                            @endif
                        @endif
                    @endforeach

                    <!-- Grand Total Expense -->
                    <tr class="total-row">
                        <td class="left-align"><strong>Total Expense</strong></td>
                        <td class="left-align"><strong>${{ number_format($totalExpense, 2) }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Net Profit/Loss Calculation -->
        <div class="net-profit-loss">
            @php
                $netProfitLoss = $totalIncome - $totalExpense;
            @endphp
            <strong>Net Surplus/Loss: ${{ number_format($netProfitLoss, 2) }}</strong>
        </div>
    </div>
</body>

</html>
