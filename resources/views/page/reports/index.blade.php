@include('layout.header')
@include('layout.sidebar')

<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Reports</h3>
                </div>
            </div>
            <form>
                <div class="card">
                    <div class="card-body p-2">
                        <div class="row">
                            <!-- Month Dropdown -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="month" class="form-label">Month</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">Select Month</option>
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Year Dropdown -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="year" class="form-label">Year</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Select Year</option>
                                        @for ($y = date('Y'); $y >= 2000; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                            </div>

                            <!-- Report Type Dropdown -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="report_type" class="form-label">Report Type</label>
                                    <select name="report_type" id="report_type" class="form-control">
                                        <option>Select Report</option>
                                        <option value="profit-and-loss">Profit and Loss Statement</option>
                                        <option value="income-and-expenditure">Income and Expenditure Statement</option>
                                        <option value="balance-sheet">Balance Sheet</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Preview Button -->
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" id="previewButton" class="btn btn-primary w-100">Preview Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- JavaScript to Handle Button Click -->
<script>
    document.getElementById('previewButton').addEventListener('click', function() {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var reportType = document.getElementById('report_type').value; // Capture the report type

        // Construct the URL for the report preview
        var url = "{{ route('report.show', ':report_type') }}".replace(':report_type', reportType);
        var params = [];

        if (month) params.push('month=' + encodeURIComponent(month));
        if (year) params.push('year=' + encodeURIComponent(year));
        if (startDate) params.push('start_date=' + encodeURIComponent(startDate));
        if (endDate) params.push('end_date=' + encodeURIComponent(endDate));

        if (params.length > 0) {
            url += '?' + params.join('&');
        }

        // Open the report preview in a new tab
        window.open(url, '_blank');
    });
</script>

@include('layout.footer')