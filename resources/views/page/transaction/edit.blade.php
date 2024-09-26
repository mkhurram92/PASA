@include('layout.header')
@include('layout.sidebar')

<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            /* Your existing CSS styles */
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
                        <form class="form-horizontal" id="transaction_save_form" action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Include the PUT method -->
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Edit Transaction</h3>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" id="submitBtn">
                                        Update Transaction
                                    </button>
                                    <a class="btn btn-info ml-3" href="{{ url()->previous() }}">
                                        <i class="fa fa-arrow-circle-left" style="font-size:20px;"></i> Back
                                    </a>
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
                                                        <input class="form-check-input" type="radio" name="transaction_type" id="transaction_type_{{ $transaction_type->id }}" value="{{ $transaction_type->id }}"
                                                            @if($transaction->transaction_type_id == $transaction_type->id) checked @endif>
                                                        <label class="form-check-label" for="transaction_type_{{ $transaction_type->id }}">
                                                            {{ $transaction_type->name }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Supplier dropdown -->
                                            <div class="mb-3 row" id="supplier-container" @if($transaction->transaction_type_id != 2) style="display: none;" @endif>
                                                <label class="col-md-4 form-label">Supplier<span class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="supplier_id" id="supplier_id" class="custom-select form-control">
                                                        <option value=""></option>
                                                        @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}" @if($transaction->supplier_id == $supplier->id) selected @endif>
                                                            {{ $supplier->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Paying for Member section -->
                                            <div class="mb-3 row" id="paying-for-member-container" @if($transaction->transaction_type_id != 1) style="display: none;" @endif>
                                                <label class="col-md-4 form-label">Paid By Member<span class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="paying_for_member" id="paying_for_member_yes" value="yes"
                                                            @if($transaction->member_id) checked @endif>
                                                        <label class="form-check-label" for="paying_for_member_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="paying_for_member" id="paying_for_member_no" value="no"
                                                            @if($transaction->customer_id) checked @endif>
                                                        <label class="form-check-label" for="paying_for_member_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row" id="customer-list-container" @if(!$transaction->customer_id) style="display: none;" @endif>
                                                <label class="col-md-4 form-label">Customer Name<span class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="customer_id" id="customer_id" class="custom-select form-control">
                                                        <option value=""></option>
                                                        @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}" @if($transaction->customer_id == $customer->id) selected @endif>
                                                            {{ $customer->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Membership Number dropdown -->
                                            <div class="mb-3 row" id="membership-number-container" @if(!$transaction->member_id) style="display: none;" @endif>
                                                <label class="col-md-4 form-label">Membership Number<span class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="membership_number" id="membership_number" class="custom-select form-control">
                                                        <option value=""></option>
                                                        @foreach ($memberships as $membership)
                                                        <option value="{{ $membership->id }}" @if($transaction->member_id == $membership->member_id) selected @endif>
                                                            @if ($membership->membership_number)
                                                                {{ $membership->membership_number }} - {{ $membership->member->family_name }} {{ $membership->member->given_name }}
                                                            @else
                                                                {{ $membership->member->family_name }} {{ $membership->member->given_name }}
                                                            @endif
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Your existing Blade code for Account dropdown -->
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Account<span class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="parent_id" id="parent_id" class="custom-select form-control">
                                                        <option value=""></option>
                                                        @foreach ($parentGlCodes as $parentGlCode)
                                                        <option value="{{ $parentGlCode->id }}" @if($transaction->gl_code_id == $parentGlCode->id) selected @endif>
                                                            {{ $parentGlCode->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Transaction Account<span class="text-danger"></span></label>

                                                <div class="col-md-8 custom-select-wrapper">
                                                    <select name="account_type" id="account_type" class="custom-select form-control">
                                                        <option value=""></option>
                                                        @foreach ($accounts as $account)
                                                        <option value="{{ $account->id }}" @if($transaction->account_id == $account->id) selected @endif>
                                                            {{ $account->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Amount<span class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Amount" value="{{ $transaction->amount }}" id="amount" name="amount">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Transaction Date<span class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="date" id="transaction_date" name="transaction_date" value="{{ $transaction->created_at->format('Y-m-d') }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label" for="description">Description<span class="text-danger"></span></label>

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
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

<script>
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('transaction.update', $transaction->id) }}',
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
        // Set today's date if transaction_date is empty (for new transactions)
        if ($('#transaction_date').val() === '') {
            var today = new Date().toISOString().split('T')[0];
            $('#transaction_date').val(today);
        }

        // Handle transaction type change
        $('input[name="transaction_type"]').on('change', function() {
            var selectedTransactionType = $('input[name="transaction_type"]:checked').val();

            // Assuming '2' is the ID for Expenditure and '1' is the ID for Income
            if (selectedTransactionType == '2') { // Expenditure
                $('#supplier-container').show();
                $('#paying-for-member-container').hide();
                $('#customer-list-container').hide();
                $('#membership-number-container').hide();

                // Clear Income-related fields only
                $('#membership_id').val(''); // Clear membership
                $('#customer_id').val(''); // Clear customer

            } else if (selectedTransactionType == '1') { // Income
                $('#paying-for-member-container').show();
                $('#supplier-container').hide();

                // Clear Expenditure-related fields only
                $('#supplier_id').val(''); // Clear supplier

                // Trigger the paying-for-member change event to show/hide related fields
                $('input[name="paying_for_member"]:checked').trigger('change');
            } else {
                // If no transaction type is selected, clear all relevant fields and hide everything
                $('#supplier-container').hide();
                $('#paying-for-member-container').hide();
                $('#customer-list-container').hide();
                $('#membership-number-container').hide();

                $('#membership_id').val(''); // Clear membership
                $('#customer_id').val(''); // Clear customer
                $('#supplier_id').val(''); // Clear supplier
            }
        });

        // Handle paying for member change
        $('input[name="paying_for_member"]').on('change', function() {
            var selectedPayingForMember = $('input[name="paying_for_member"]:checked').val();

            if (selectedPayingForMember == 'yes') { // Paying for Member
                $('#membership-number-container').show();
                $('#customer-list-container').hide();

                // Clear customer fields when paying for member
                $('#customer_id').val(''); // Clear customer
            } else if (selectedPayingForMember == 'no') { // Not Paying for Member
                $('#membership-number-container').hide();
                $('#customer-list-container').show();

                // Clear membership fields when not paying for member
                $('#membership_id').val(''); // Clear membership
                $('#member_id').val(''); // Clear member
            } else {
                // If no selection is made, clear all and hide containers
                $('#membership-number-container').hide();
                $('#customer-list-container').hide();

                $('#membership_id').val(''); // Clear membership
                $('#customer_id').val(''); // Clear customer
            }
        });

        $('#amount').on('input', function() {
            // Allow digits and a single dot
            $(this).val($(this).val().replace(/[^0-9.]/g, ''));

            // Ensure there's only one dot
            if ($(this).val().split('.').length > 2) {
                var parts = $(this).val().split('.');
                $(this).val(parts[0] + '.' + parts.slice(1).join(''));
            }
        });

        // Trigger change event on page load to set the initial state
        $('input[name="transaction_type"]:checked').trigger('change');
        $('input[name="paying_for_member"]:checked').trigger('change');
    });

</script>

@endsection

@include('layout.footer')
