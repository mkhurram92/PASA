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
                                <!--<a class="btn btn-success mr-2">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>-->
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
                                            <label class="col-md-4 form-label">Transaction Type<span class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$transaction->transactionType->name}}" disabled readonly>
                                            </div>
                                        </div>
                                        <!-- Your existing Blade code for Parent G/L dropdown -->
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Parent G/L<span class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$transaction->glCode->glCodesParent->name}}" disabled readonly>
                                            </div>
                                        </div>

                                        <!-- Sub G/L dropdown -->
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Sub G/L<span class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$transaction->glCode->name}}" disabled readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Transaction Account<span class="text-danger"></span></label>

                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$transaction->account->name}}" disabled readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Amount<span class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$transaction->amount}}" disabled readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Description<span class="text-danger"></span></label>

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