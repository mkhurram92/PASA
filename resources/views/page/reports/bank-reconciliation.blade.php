<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconciliation Report</title>
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

        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header h4 {
            margin: 2px 0;
            font-size: 12px;
        }

        .header h3 {
            margin: 10px 0;
            font-size: 13px;
            font-weight: bold;
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
            <h3>23 Leigh Street, Adelaide 5000</h3>
            <h3>Bank Reconciliation Report</h3>

            @if (request('start_date') && request('end_date'))
                <p>From: {{ request('start_date') }} To: {{ request('end_date') }}</p>
            @elseif(request('month') && request('year'))
                <p>Month: {{ date('F', mktime(0, 0, 0, request('month'), 1)) }} {{ request('year') }}</p>
            @elseif(request('year'))
                <p>Year: {{ request('year') }}</p>
            @endif
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th class="center-align">Date</th>
                        <th>Memo/Payee</th>
                        <th class="right-align">Deposit</th>
                        <th class="right-align">Withdrawal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="total-row">
                        <td colspan="3" class="right-align">Total</td>
                        <td class="right-align">$0.00</td>
                        <td class="right-align">$0.00</td>
                        <!-- Final balance -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
