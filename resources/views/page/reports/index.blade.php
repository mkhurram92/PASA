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
                            <!-- Report Type Dropdown -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="report_type" class="form-label">Report Type</label>
                                    <select name="report_type" id="report_type" class="form-control">
                                        <option>Select Report</option>
                                        <option value="income-and-expenditure">Income and Expenditure</option>
                                        <option value="bank-register">Bank Register</option>
                                        <option value="accounts-list">Accounts List</option>
                                        <option value="bank-reconciliation">Bank Reconciliation</option>
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
                            <div class="col-md-3" id="accountsListDateContainer" style="display: none;">
                                <div class="form-group">
                                    <label for="accounts_list_date" class="form-label">Select Date</label>
                                    <input type="date" name="accounts_list_date" id="accounts_list_date"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Second Row -->
                        <div class="row">
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

                        <!-- Third Row -->
                        <div class="row">
                           
                            <div class="col-md-3 d-flex align-items-end"></div>
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
        var accountsListDateContainer = document.getElementById('accountsListDateContainer');

        // Check if the selected report type is 'Bank Register'
        if (reportType === 'bank-register') {
            // Show the bank account dropdown
            bankAccountContainer.style.display = 'block';
            accountsListDateContainer.style.display = 'none';

            // Fetch and populate bank accounts via AJAX
            fetch("{{ route('get.bank.accounts') }}")
                .then(response => response.json())
                .then(data => {
                    var bankAccountDropdown = document.getElementById('bank_account');
                    bankAccountDropdown.innerHTML = '<option value="">Select Bank Account</option>';
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
        } else if (reportType === 'accounts-list') {
            // Show the date field for Accounts List report
            accountsListDateContainer.style.display = 'block';
            bankAccountContainer.style.display = 'none';
            document.getElementById('month').disabled = true;
            document.getElementById('year').disabled = true;
            document.getElementById('start_date').disabled = true;
            document.getElementById('end_date').disabled = true;
        } else {
            // Hide the bank account and accounts list date fields
            bankAccountContainer.style.display = 'none';
            accountsListDateContainer.style.display = 'none';
            document.getElementById('month').disabled = false;
            document.getElementById('year').disabled = false;
            document.getElementById('start_date').disabled = false;
            document.getElementById('end_date').disabled = false;
        }
    });

    // Event listener for Preview Button click
    document.getElementById('previewButton').addEventListener('click', function() {
        var reportType = document.getElementById('report_type').value;
        var bankAccount = document.getElementById('bank_account').value;
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var accountsListDate = document.getElementById('accounts_list_date').value;

        // Validation: Ensure report type is selected
        if (!reportType || reportType === 'Select Report') {
            alert('Please select a report type.');
            return;
        }

        // Validation for Accounts List Report: only a single date is required
        if (reportType === 'accounts-list') {
            if (!accountsListDate) {
                alert('Please select a date for the Accounts List report.');
                return; // Stop if no date is selected for the Accounts List report
            }
        } else {
            // Validation for other report types
            if (!month && !year && !startDate && !endDate) {
                alert('Please select either a month/year, year, or a date range to generate the report.');
                return; // Stop report generation if no filters are provided
            }

            // Validation: If the month is selected, the year must be selected as well
            if (month && !year) {
                alert('Please select a year when choosing a month.');
                return;
            }

            // Validation: If start or end date is provided, ensure both are provided for date range
            if ((startDate && !endDate) || (!startDate && endDate)) {
                alert('Please provide both start and end dates for the date range.');
                return;
            }

            // Validation for Bank Register Report: ensure a bank account is selected
            if (reportType === 'bank-register' && !bankAccount) {
                alert('Please select a bank account for the Bank Register report.');
                return;
            }
        }

        // Proceed with generating the report
        var url = "{{ route('report.show', ':report_type') }}".replace(':report_type', reportType);
        var params = [];

        if (month) params.push('month=' + encodeURIComponent(month));
        if (year) params.push('year=' + encodeURIComponent(year));
        if (startDate) params.push('start_date=' + encodeURIComponent(startDate));
        if (endDate) params.push('end_date=' + encodeURIComponent(endDate));
        if (bankAccount) params.push('bank_account=' + encodeURIComponent(bankAccount));
        if (accountsListDate) params.push('date=' + encodeURIComponent(accountsListDate));

        if (params.length > 0) {
            url += '?' + params.join('&');
        }

        window.open(url, '_blank');
    });


    document.getElementById('month').addEventListener('change', function() {
        if (this.value || document.getElementById('year').value) {
            document.getElementById('start_date').disabled = true;
            document.getElementById('end_date').disabled = true;
        } else {
            document.getElementById('start_date').disabled = false;
            document.getElementById('end_date').disabled = false;
        }
    });

    document.getElementById('year').addEventListener('change', function() {
        if (this.value || document.getElementById('month').value) {
            document.getElementById('start_date').disabled = true;
            document.getElementById('end_date').disabled = true;
        } else {
            document.getElementById('start_date').disabled = false;
            document.getElementById('end_date').disabled = false;
        }
    });

    document.getElementById('start_date').addEventListener('change', function() {
        if (this.value || document.getElementById('end_date').value) {
            document.getElementById('month').disabled = true;
            document.getElementById('year').disabled = true;
        } else {
            document.getElementById('month').disabled = false;
            document.getElementById('year').disabled = false;
        }
    });

    document.getElementById('end_date').addEventListener('change', function() {
        if (this.value || document.getElementById('start_date').value) {
            document.getElementById('month').disabled = true;
            document.getElementById('year').disabled = true;
        } else {
            document.getElementById('month').disabled = false;
            document.getElementById('year').disabled = false;
        }
    });

    // Clear Filters Button Logic
    document.getElementById('clearFiltersButton').addEventListener('click', function() {
        // Reset all input fields
        document.getElementById('month').value = '';
        document.getElementById('year').value = '';
        document.getElementById('start_date').value = '';
        document.getElementById('end_date').value = '';
        document.getElementById('report_type').value = 'Select Report';
        document.getElementById('bank_account').innerHTML = '<option value="">Select Bank Account</option>';
        document.getElementById('bankAccountContainer').style.display = 'none';

        // Re-enable disabled fields
        document.getElementById('month').disabled = false;
        document.getElementById('year').disabled = false;
        document.getElementById('start_date').disabled = false;
        document.getElementById('end_date').disabled = false;
        bankAccountContainer.style.display = 'none';
        accountsListDateContainer.style.display = 'none';
    });
</script>

@include('layout.footer')
