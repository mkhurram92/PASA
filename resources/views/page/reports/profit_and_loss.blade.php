{{-- resources/views/page/reports/profit_and_loss.blade.php --}}
@include('layout.header')
@include('layout.sidebar')

<div class="app-content main-content">
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

        th,
        td {
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

        thead,
        tbody tr {
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

    <div class="side-app">
        <div class="container-fluid main-container">
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Profit and Loss Report</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 p-12">
                    <div class="card">
                        <div class="card-body p-2">
                            <form action="{{ route('report.show', 'profit-and-loss') }}" method="GET" class="mb-4">
                                <div class="row">
                                    <!-- Month Filter -->
                                    <div class="col-md-3">
                                        <label for="month">Month</label>
                                        <select name="month" id="month" class="form-control">
                                            <option value="">Select Month</option>
                                            @for ($m = 1; $m <= 12; $m++)
                                                <option value="{{ $m }}"
                                                    {{ request('month') == $m ? 'selected' : '' }}>
                                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Year Filter -->
                                    <div class="col-md-3">
                                        <label for="year">Year</label>
                                        <select name="year" id="year" class="form-control">
                                            <option value="">Select Year</option>
                                            @for ($y = date('Y'); $y >= 2000; $y--)
                                                <option value="{{ $y }}"
                                                    {{ request('year') == $y ? 'selected' : '' }}>
                                                    {{ $y }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Date Range Filter -->
                                    <div class="col-md-3">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ request('start_date') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="end_date">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ request('end_date') }}">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('report.show', 'profit-and-loss') }}"
                                            class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-12">
                    <div class="card">
                        <div class="card-body p-2">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@include('layout.footer')
