@include('layout.header')
@include('layout.sidebar')

<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-leftheader">
                    <h3 class="page-title">Reports</h3>
                </div>
            </div>
            <form>
                <div class="card">
                    <div class="card-body p-2">
                        <!-- First Row -->
                        <div class="row">
                            <!-- Month Dropdown -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="month" class="form-label">Month</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">Select Month</option>
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                            @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Year Dropdown -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year" class="form-label">Year</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">Select Year</option>
                                        @for ($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row">
                            <!-- Report Type Dropdown -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="report_type" class="form-label">Report Type</label>
                                    <select name="report_type" id="report_type" class="form-control">
                                        <option>Select Report</option>
                                        <option value="income-and-expenditure">Income and Expenditure</option>
                                        <option value="bank-register">Bank Register</option>
                                        <option value="accounts-list">Accounts List</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Bank Accounts Dropdown (Initially hidden) -->
                            <div class="col-md-3" id="bankAccountContainer" style="display: none;">
                                <div class="form-group">
                                    <label for="bank_account" class="form-label">Bank Account</label>
                                    <select name="bank_account" id="bank_account" class="form-control">
                                        <option value="">Select Bank Account</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Preview Button -->
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button" id="previewButton" class="btn btn-primary w-100">Preview
                                    Report</button>
                            </div>

                            <!-- Clear Filters Button -->
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button" id="clearFiltersButton" class="btn btn-secondary w-100">Clear
                                    Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Event listener for Report Type Dropdown change
    document.getElementById('report_type').addEventListener('change', function() {
        var reportType = this.value;
        var bankAccountContainer = document.getElementById('bankAccountContainer');
        var bankAccountDropdown = document.getElementById('bank_account');

        // Check if the selected report type is 'Bank Register'
        if (reportType === 'bank-register') {
            // Show the bank account dropdown
            bankAccountContainer.style.display = 'block';

            // Fetch bank accounts via AJAX
            fetch("{{ route('get.bank.accounts') }}")
                .then(response => response.json())
                .then(data => {
                    // Clear previous options
                    bankAccountDropdown.innerHTML = '<option value="">Select Bank Account</option>';

                    // Populate the bank accounts dropdown
                    data.forEach(function(account) {
                        var option = document.createElement('option');
                        option.value = account.id;
                        option.text = account.name;
                        bankAccountDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching bank accounts:', error);
                });
        } else {
            // Hide the bank account dropdown if not 'Bank Register'
            bankAccountContainer.style.display = 'none';
            bankAccountDropdown.innerHTML = '<option value="">Select Bank Account</option>';
        }
    });

    // Event listener for Preview Button click
    document.getElementById('previewButton').addEventListener('click', function() {
        var reportType = document.getElementById('report_type').value;
        var bankAccount = document.getElementById('bank_account').value;

        // Check if "Bank Register" is selected and ensure a bank account is selected
        if (reportType === 'bank-register' && !bankAccount) {
            alert('Please select a bank account for the Bank Register report.');
            return; // Stop the report generation if a bank account is not selected
        }

        // Proceed with generating the report
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        var url = "{{ route('report.show', ':report_type') }}".replace(':report_type', reportType);
        var params = [];

        if (month) params.push('month=' + encodeURIComponent(month));
        if (year) params.push('year=' + encodeURIComponent(year));
        if (startDate) params.push('start_date=' + encodeURIComponent(startDate));
        if (endDate) params.push('end_date=' + encodeURIComponent(endDate));
        if (bankAccount) params.push('bank_account=' + encodeURIComponent(bankAccount));

        if (params.length > 0) {
            url += '?' + params.join('&');
        }

        window.open(url, '_blank');
    });

    // Clear Filters Button Logic
    document.getElementById('clearFiltersButton').addEventListener('click', function() {
        document.getElementById('month').value = '';
        document.getElementById('year').value = '';
        document.getElementById('start_date').value = '';
        document.getElementById('end_date').value = '';
        document.getElementById('report_type').value = 'Select Report';
        document.getElementById('bank_account').innerHTML = '<option value="">Select Bank Account</option>';
        document.getElementById('bankAccountContainer').style.display = 'none';
    });
</script>

@include('layout.footer')