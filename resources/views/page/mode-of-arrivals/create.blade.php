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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="form-horizontal" action="{{ route('mode-of-arrivals.store') }}" method="POST">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Add a Journey</h3>

                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-block"
                                        data-bs-effect="effect-slide-in-right" value="Save Journey">

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ship Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="ship_select2"
                                                        name="ship_id">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Departure Year <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="YYYY"
                                                        value="" name="year">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Departure Date <span
                                                        class="text-danger">*</span></label>

                                                <div class="col-md-9">
                                                    <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                                        value="01/01/1830" type="text" name="date_of_departure">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Country<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="countries_select2"
                                                        name="country_id"></select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">County<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" placeholder="Select item"
                                                        id="counties_select2" name="county_id"></select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">City<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" placeholder="Select item"
                                                        id="cities_select2" name="city_id"></select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ports of Call <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="4" placeholder="Ports of Call" name="ports_of_call"></textarea>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrived Place in SA <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" name="arrived_at"
                                                        id="arrived_at_select2">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Date in SA <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                                        value="01/01/1830" type="text" name="date_of_arrival">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class="col-md-3 form-label">Ship Commander <span
                                                        class="text-danger">*</span></label>

                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Ship Commander" name="ship_commander">

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Embarkation Number <span
                                                        class="text-danger">*</span></label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        placeholder="Embarkation Number" name="embarkation_number">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="6" placeholder="Notes" name="notes"></textarea>

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
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- MODAL EFFECTS -->
<div id="crud"></div>
@section('scripts')
    @include('plugins.select2')
    <script>
        var dt_ship_elem = $("#ship-table"),
            dt_ship = "";

        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd',
            changeMonth: true, // Customize the date format as needed
            changeYear: true,
            yearRange: 'c-2000:c+nn'
        });
    </script>
    @include('page.mode-of-arrivals.scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
