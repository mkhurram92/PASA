<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Register</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #fff;
            color: #000;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            margin: 0 auto;
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
        
        h1, h3 {
            color: #000;
            text-align: center;
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

        th, td {
            padding: 3px 4px;
            text-align: left;
        }

        th {
            background-color: #f7f7f7;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .right-align {
            text-align: right;
        }

        .center-align {
            text-align: center;
        }

        .total-row {
            font-weight: bold;
            background-color: #f7f7f7;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Pioneers Association of South Australia</h1>
            <h3>23 Leigh Street, Adelaide 5000</h3>
            <h3>Bank Register Report for {{ $reportData['account_name'] }}</h3>
            @if (request('start_date') && request('end_date'))
                <p>{{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} to {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</p>
            @elseif(request('month') && request('year'))
                <p>Month : {{ date('F', mktime(0, 0, 0, request('month'), 1)) }} {{ request('year') }}</p>
            @elseif(request('year'))
                <p>Year : {{ request('year') }}</p>
            @endif
        </div>

        <!-- Transactions Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Type</th>
                        <th class="center-align">Date</th> <!-- Centered Date -->
                        <th>Memo/Payee</th>
                        <th class="right-align">Deposit</th>
                        <th class="right-align">Withdrawal</th>
                        <th class="right-align">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData['transactions'] as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->transaction_type_id == 1 ? 'CR' : 'CD' }}</td>
                            <td class="center-align">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y') }}</td> <!-- Centered Date -->
                            <td></td>
                            <td class="right-align">
                                {{ $transaction->transaction_type_id == 1 ? number_format($transaction->amount, 2) : '' }}
                            </td>
                            <td class="right-align">
                                {{ $transaction->transaction_type_id == 2 ? number_format($transaction->amount, 2) : '' }}
                            </td>
                            <td class="right-align">{{ number_format($transaction->balance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
