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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Transaction Details</h3>
                            <div>
                                <a class="btn btn-success mr-2"
                                    href="{{ route('transaction.edit', $transaction->id) }}">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>
                                <a class="btn btn-info" href="{{ route('transaction.index') }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Transaction Type<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $transaction->transactionType->name }}" disabled readonly>
                                            </div>
                                        </div>
                                        <!-- Conditionally display the Supplier dropdown if Transaction Type is "Expenditure" -->
                                        @if ($transaction->transactionType->name == 'Expenditure')
                                            <!-- Supplier dropdown -->
                                            <div class="mb-3 row" id="supplier-container">
                                                <label class="col-md-4 form-label">Supplier<span
                                                        class="text-danger"></span></label>
                                                <div class="col-md-8 custom-select-wrapper">
                                                    <input type="text" class="form-control"
                                                        value="{{ optional($transaction->supplier)->name }}" disabled
                                                        readonly>
                                                </div>
                                            </div>
                                            <!-- Paying for Member section -->
                                        @elseif ($transaction->transactionType->name == 'Income')
                                            <div class="mb-3 row" id="paying-for-member-container">
                                                <label class="col-md-4 form-label">Paid By Member<span
                                                        class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $transaction->member_id ? 'Yes' : ($transaction->customer_id ? 'No' : 'Not Applicable') }}"
                                                        disabled readonly>
                                                </div>
                                            </div>

                                            @if ($transaction->member_id)
                                                <!-- Membership Number dropdown -->
                                                <div class="mb-3 row" id="membership-number-container">
                                                    <label class="col-md-4 form-label">Membership Number<span
                                                            class="text-danger"></span></label>
                                                    <div class="col-md-8 custom-select-wrapper">
                                                        <input type="text" class="form-control"
                                                            value="{{ optional($transaction->membership)->membership_number }}"
                                                            disabled readonly>
                                                    </div>
                                                </div>
                                            @elseif ($transaction->customer_id)
                                                <!-- Customer Name input -->
                                                <div class="mb-3 row" id="customer-list-container">
                                                    <label class="col-md-4 form-label">Customer Name<span
                                                            class="text-danger"></span></label>
                                                    <div class="col-md-8 custom-select-wrapper">
                                                        <input type="text" class="form-control"
                                                            value="{{ optional($transaction->customer)->name }}"
                                                            disabled readonly>
                                                    </div>
                                                </div>
                                            @endif

                                        @endif
                                        <!-- Your existing Blade code for Account dropdown -->
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Account<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ optional($transaction->glCodesParent)->name ?? 'No Account' }}"
                                                    disabled readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Transaction Account<span
                                                    class="text-danger"></span></label>

                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ optional($transaction->account)->name ?? 'No Transaction Account' }}"
                                                    disabled readonly>

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Amount<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="${{ $transaction->amount }}" disabled readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Transaction Date<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $transaction->created_at->format('Y-m-d') }}" disabled
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Description<span
                                                    class="text-danger"></span></label>

                                            <div class="col-md-8">
                                                <textarea class="form-control" disabled readonly>{{ $transaction->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
