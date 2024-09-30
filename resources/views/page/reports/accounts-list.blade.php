<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts List</title>
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
            font-size: 16px;
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
            padding: 8px; /* Ensure equal padding */
            text-align: left; /* Align text to the left for readability */
            border-bottom: 1px solid #ddd; /* Add borders for better alignment */
        }

        th {
            background-color: #f7f7f7;
            color: #000;
            font-weight: bold;
            text-align: left; /* Keep headers left-aligned */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Set proportional column widths */
        th:nth-child(1), td:nth-child(1) {
            width: 40%; /* 40% for Account Name */
        }

        th:nth-child(2), td:nth-child(2) {
            width: 30%; /* 30% for Account Type */
        }

        th:nth-child(3), td:nth-child(3) {
            width: 30%; /* 30% for Balance */
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Pioneers Association of South Australia</h1>
            <h4>23 Leigh Street, Adelaide 5000</h4>
            <h3>Accounts List</h3>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->accountType ? $account->accountType->name : 'No Account Type' }}</td>
                        <td>${{ number_format($account->balance, 2) }}</td> <!-- Format balance -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
