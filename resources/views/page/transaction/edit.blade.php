<!-- resources/views/page/gl_codes/edit.blade.php -->

@include('layout.header')
@include('layout.sidebar')

<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            /* Increase the size of the day cells */
            .ui-datepicker-calendar td {
                font-size: 22px;
                /* Adjust the padding as needed */
            }

            .ui-datepicker-calendar a {
                font-size: 22px !important;
                /* Adjust the padding as needed */
            }

            /* Increase the size of the month/year dropdowns */
            .ui-datepicker select.ui-datepicker-year,
            .ui-datepicker select.ui-datepicker-month {
                font-size: 22px;
                /* Adjust the font size as needed */
            }

            .ui-datepicker-calendar {
                width: 300px;
                height: 300px;
                /* Set the height to 100% */
            }

            /* Custom CSS */
            .custom-select-wrapper {
                position: relative;
                display: inline-block;
            }

            .custom-select {
                display: inline-block;
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .custom-select:after {
                content: "\25BC";
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
            }
        </style>
        <div class="container-fluid main-container">

            <!--Page header-->
            <div class="page-header">
                <div class="page-leftheader">
                    <h4 class="page-title"></h4>
                </div>
            </div>
            <!--End Page header-->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <form class="form-horizontal" id="transaction_update_form"
                            action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Edit Transaction</h3>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-block" id="submitBtn">
                                        Update Transaction
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Transaction Type</label>
                                                <div class="col-md-8">
                                                    @foreach ($transactionType as $transaction_type)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="transaction_type_id"
                                                                id="transaction_type_{{ $transaction_type->id }}"
                                                                value="{{ $transaction_type->id }}"
                                                                {{ (string) $transaction->transaction_type_id === (string) $transaction_type->id ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="transaction_type_{{ $transaction_type->id }}">
                                                                {{ $transaction_type->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Parent G/L Dropdown -->
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Parent G/L</label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="parent_id" id="parent_id" class="custom-select"
                                                        onchange="updateSubGlCodes()">
                                                        <option value="">Select a Parent G/L</option>
                                                        @foreach ($parentGlCodes as $parentGlCode)
                                                            <option value="{{ $parentGlCode->id }}"
                                                                {{ isset($transaction->glCode->parent_id) && (int) $transaction->glCode->parent_id === (int) $parentGlCode->id ? 'selected' : '' }}>
                                                                {{ $parentGlCode->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Sub G/L Dropdown -->
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Sub G/L</label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="gl_code_id" id="subGlCodes" class="custom-select"
                                                        onchange="updateParentGl()">
                                                        <option value="">Select a Sub G/L</option>
                                                        @foreach ($subGlCodes as $subGlCode)
                                                            <option value="{{ $subGlCode->id }}"
                                                                {{ (int) $transaction->gl_code_id === (int) $subGlCode->id ? 'selected' : '' }}>
                                                                {{ $subGlCode->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Transaction Account Dropdown -->
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Transaction Account</label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="account_id" id="account_id" class="custom-select">
                                                        <option value="">Select a Transaction Account</option>
                                                        @foreach ($accounts as $account)
                                                            <option value="{{ $account->id }}"
                                                                {{ (int) $transaction->account_id === (int) $account->id ? 'selected' : '' }}>
                                                                {{ $account->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Amount<span
                                                        class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Amount"
                                                        value="{{ $transaction->amount }}" id="amount"
                                                        name="amount">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label" for="description">Description<span
                                                        class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <textarea name="description" id="description" class="form-control">{{ $transaction->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Convert PHP data to JavaScript
        var subGlCodes = @json($subGlCodes);

        function updateSubGlCodes() {
            var parentId = document.getElementById('parent_id').value;
            var subGlSelect = document.getElementById('subGlCodes');

            console.log("Selected Parent ID:", parentId); // Debug output
            console.log("Sub G/L Codes:", subGlCodes); // Debug output

            // Clear existing options
            subGlSelect.innerHTML = '<option value="">Select a Sub G/L</option>';

            // Filter sub G/L codes based on selected parent
            if (parentId) { // Check if parentId is not empty
                var filteredSubGlCodes = subGlCodes.filter(function(glCode) {
                    return glCode.parent_id == parentId;
                });

                console.log("Filtered Sub G/L Codes:", filteredSubGlCodes); // Debug output

                // Populate sub G/L dropdown
                filteredSubGlCodes.forEach(function(glCode) {
                    var option = document.createElement('option');
                    option.value = glCode.id;
                    option.text = glCode.name;
                    subGlSelect.appendChild(option);
                });

                // Set the selected sub G/L code if applicable
                @if (isset($transaction->gl_code_id))
                    var selectedSubGlId = {{ $transaction->gl_code_id }};
                    subGlSelect.value = selectedSubGlId;
                @endif
            } else {
                console.log("No Parent G/L selected.");
            }
        }

        function updateParentGl() {
            var subGlSelect = document.getElementById('subGlCodes');
            var selectedSubGlId = subGlSelect.value;
            var selectedSubGl = subGlCodes.find(glCode => glCode.id == selectedSubGlId);

            if (selectedSubGl && selectedSubGl.parent_id) {
                document.getElementById('parent_id').value = selectedSubGl.parent_id;
            } else {
                document.getElementById('parent_id').value = '';
            }
        }

        // Initialize sub G/L options on page load if editing an existing transaction
        document.addEventListener('DOMContentLoaded', function() {
            updateSubGlCodes();
            updateParentGl();
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('submitBtn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Serialize the form data
                var formData = new FormData(document.getElementById('transaction_update_form'));

                // Send the form data via AJAX
                fetch(document.getElementById('transaction_update_form').action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            // If response is not OK, treat it as an error
                            return response.json().then(data => {
                                throw new Error(data.message ||
                                    'An error occurred while updating the transaction.');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Success alert
                            Swal.fire({
                                title: 'Success!',
                                text: data.message || 'Transaction updated successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                timer:'10000',
                            }).then(() => {
                                window.location.href = "{{ route('transaction.index') }}";
                            });
                        } else {
                            // Error alert with message from response
                            Swal.fire({
                                title: 'Error!',
                                text: data.message ||
                                    'An error occurred while updating the transaction.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        // Handle any errors
                        Swal.fire({
                            title: 'Error!',
                            text: error.message ||
                                'An unexpected error occurred while updating the transaction.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection

@include('layout.footer')
