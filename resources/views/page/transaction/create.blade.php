<!-- resources/views/page/gl_codes/create.blade.php -->

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
                        <form class="form-horizontal" id="transaction_save_form" action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Add a Transaction</h3>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-block" id="submitBtn">
                                        Save Transaction
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Transaction Type<span class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    @foreach ($transactionType as $transaction_type)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="transaction_type" id="transaction_type_{{ $transaction_type->id }}" value="{{ $transaction_type->id }}">
                                                        <label class="form-check-label" for="transaction_type_{{ $transaction_type->id }}">
                                                            {{ $transaction_type->name }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Your existing Blade code for Parent G/L dropdown -->
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Parent G/L<span class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="parent_id" id="parent_id" class="custom-select" onchange="updateSubGlCodes()">
                                                        <option value=""></option>
                                                        @foreach ($parentGlCodes as $parentGlCode)
                                                        <option value="{{ $parentGlCode->id }}">
                                                            {{ $parentGlCode->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Sub G/L dropdown -->
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Sub G/L<span class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="subGlCodes" id="subGlCodes" class="custom-select">
                                                        <option value=""></option>
                                                        <!-- Options will be dynamically populated using JavaScript -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Transaction Account<span class="text-danger"></span></label>

                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="account_type" id="account_type" class="custom-select">
                                                        <option value=""></option>
                                                        @foreach ($accounts as $account)
                                                        <option value="{{ $account->id }}">
                                                            {{ $account->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Amount<span class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Amount" value="0.00" id="amount" name="amount">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label" for="description">Description<span class="text-danger"></span></label>

                                                <div class="col-md-8">
                                                    <textarea name="description" id="description" class="form-control"></textarea>
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
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

<script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('transaction.store') }}',
            data: $('#transaction_save_form').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        timer: 10000,
                        timerProgressBar: true,
                    }).then((result) => {
                        if (response.redirectTo) {
                            window.location.href = response.redirectTo;
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                    }).then(() => {
                        let exceptionMessage = "";
                        if (response.exception) {
                            exceptionMessage = response.exception;
                        }
                        if (exceptionMessage) {
                            Swal.fire({
                                title: 'Exception Details',
                                html: `<p>${exceptionMessage}</p>`,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                            });
                        }
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                let errorMessage = "An error occurred while processing your request.";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.statusText) {
                    errorMessage = xhr.statusText;
                }
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                });
            }
        });
    });

    $(document).ready(function() {
        $('#amount').on('input', function() {
            // Allow digits and a single dot
            $(this).val($(this).val().replace(/[^0-9.]/g, ''));

            // Ensure there's only one dot
            if ($(this).val().split('.').length > 2) {
                var parts = $(this).val().split('.');
                $(this).val(parts[0] + '.' + parts.slice(1).join(''));
            }
        });
    });

    function updateSubGlCodes() {
        var parentId = document.getElementById('parent_id').value;
        var subGlCodesDropdown = document.getElementById('subGlCodes');

        // Clear existing options
        subGlCodesDropdown.innerHTML = '<option value=""></option>';

        // Populate options based on the selected Parent G/L
        @foreach ($subGlCodes as $subGlCode)
            if ({{ $subGlCode->glCodesParent->id }} == parentId) {
                var option = document.createElement('option');
                option.value = {{ $subGlCode->id }};
                option.text = '{{ $subGlCode->name }}';
                subGlCodesDropdown.add(option);
            }
        @endforeach
    }

</script>
@endsection

@include('layout.footer')