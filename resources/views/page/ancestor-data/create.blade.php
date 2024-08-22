@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            .ui-datepicker-calendar td {
                font-size: 22px;
            }

            .ui-datepicker-calendar a {
                font-size: 22px !important;
            }

            .ui-datepicker select.ui-datepicker-year,
            .ui-datepicker select.ui-datepicker-month {
                font-size: 22px;
            }

            .ui-datepicker-calendar {
                width: 300px;
                height: 300px;
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

                        <form class="form-horizontal" action="{{ route('ancestor-data.store') }}" method="POST">
                            @csrf
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Pioneer Ancestor Details</h3>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-block"
                                        data-bs-effect="effect-slide-in-right" value="Save Ancestor Details">
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Gender <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" id="gender_select2"
                                                        name="gender"></select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Family Name<span
                                                        class="text-danger"> *</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control uppercase" type="text"
                                                        placeholder="Pioneer's Family Name" name="ancestor_surname">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Given Name<span
                                                        class="text-danger"> *</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Given Name" name="given_name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Preferred Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Preferred Name" name="preferred_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Date</label>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY"
                                                                type="text" name="year_of_birth">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <select class="form-control month-select"
                                                                id="month_of_birth" name="month_of_birth"></select>
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <select class="form-control day-select" id="date_of_birth"
                                                                name="date_of_birth"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Place</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Birth Place"
                                                        name="place_of_birth">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Details</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" id="birth_details" name="birth_details" placeholder="Birth Details" rows="4" maxlength="300"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Death Date</label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY"
                                                                type="text" name="year_of_death">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <select class="form-control month-select"
                                                                id="month_of_death" name="month_of_death"></select>
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <select class="form-control day-select" id="date_of_death"
                                                                name="date_of_death"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Death Place</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Death Place" name="place_of_death">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Death Details</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" id="death_details" name="death_details" placeholder="Death Details" rows="4" maxlength="300"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">General Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" id="notes" name="notes" placeholder="General Notes" rows="8"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header justify-content-between">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h3 class="card-title">Pioneer Journey Details</h3>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Mode of Travel to South
                                                            Australia<span class="text-danger"> *</span></label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2"
                                                                id="source_of_arrival_select2"
                                                                name="source_of_arrival"></select>
                                                        </div>
                                                    </div>

                                                    <div id="ship_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Ship Name - Arrival
                                                            Year</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2"
                                                                id="mode_of_arrival_select2"
                                                                name="mode_of_arrival_id"></select>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="mode_of_travel_id"
                                                        id="mode_of_travel_id" value="" />

                                                    <div id="first_date_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Arrival Date in SA </label>
                                                        <div class="col-md-8">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                id="first_date" name="first_date" readonly disabled>
                                                        </div>
                                                    </div>

                                                    <div id="arrival_date_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Arrival Date in SA </label>
                                                        <div class="col-md-8">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                id="arrival_date_in_sa" name="arrival_date_in_sa" />
                                                        </div>
                                                    </div>

                                                    <div id="evidence_of_arrival_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Evidence of Arrival</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" id="evidence_of_arrival" name="evidence_of_arrival" rows="6" maxlength="300"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3 class="card-title">Pioneer Spouse’s Details</h3>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Marriage Date</label>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-4 pr-1">
                                                                    <input class="form-control" placeholder="YYYY"
                                                                        type="text" name="marriage_year">
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control month-select"
                                                                        id="marriage_month"
                                                                        name="marriage_month"></select>
                                                                </div>
                                                                <div class="col-4 pl-1">
                                                                    <select class="form-control day-select"
                                                                        id="marriage_date"
                                                                        name="marriage_date"></select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Marriage Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Marriage Place" id="marriage_place"
                                                                name="marriage_place">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Spouse’s Family Name</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Spouse’s Family Name"
                                                                id="spouse_family_name" name="spouse_family_name">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Spouse’s Given
                                                            Name(s)</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Spouse’s Given Name(s)"
                                                                id="spouse_given_name" name="spouse_given_name">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Birth Date</label>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-4 pr-1">
                                                                    <input class="form-control" placeholder="YYYY"
                                                                        type="text" name="spouse_birth_year">
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control month-select"
                                                                        id="spouse_birth_month"
                                                                        name="spouse_birth_month"></select>
                                                                </div>
                                                                <div class="col-4 pl-1">
                                                                    <select class="form-control day-select"
                                                                        id="spouse_birth_date"
                                                                        name="spouse_birth_date"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Birth Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Birth Place" name="spouse_birth_place">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Death Date</label>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-4 pr-1">
                                                                    <input class="form-control" placeholder="YYYY"
                                                                        type="text" name="spouse_death_year">
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control month-select"
                                                                        id="spouse_death_month"
                                                                        name="spouse_death_month"></select>
                                                                </div>
                                                                <div class="col-4 pl-1">
                                                                    <select class="form-control day-select"
                                                                        id="spouse_death_date"
                                                                        name="spouse_death_date"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Death Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Death Place" name="spouse_death_place">
                                                        </div>
                                                    </div>
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
<!-- MODAL EFFECTS -->
<div id="crud"></div>
@section('scripts')
    @include('plugins.select2')
    <script>
        initMonthSelect2();
        initDaySelect2();

        $(document).ready(function() {

            function handleSourceOfArrivalChange() {
                const selectedValue = $("#source_of_arrival_select2").val();

                var modeOfArrivalSelect = document.getElementById('ship_section');
                var firstDateInput = document.getElementById('first_date_section');
                var arrivalDateInSaInput = document.getElementById('arrival_date_section');
                var evidenceOfArrivalTextarea = document.getElementById('evidence_of_arrival_section');

                modeOfArrivalSelect.hidden = true;
                firstDateInput.hidden = true;
                arrivalDateInSaInput.hidden = true;
                evidenceOfArrivalTextarea.hidden = true;

                if (selectedValue == 1 || selectedValue == 2) {
                    modeOfArrivalSelect.hidden = false;
                    firstDateInput.hidden = false;
                } else if (selectedValue == 3) {
                    arrivalDateInSaInput.hidden = false;
                    evidenceOfArrivalTextarea.hidden = false;
                } else {
                    modeOfArrivalSelect.hidden = true;
                    firstDateInput.hidden = true;
                    arrivalDateInSaInput.hidden = true;
                    evidenceOfArrivalTextarea.hidden = true;
                }
            }

            // Attach the function to the change event of the element with ID "source_of_arrival_select2"
            $("#source_of_arrival_select2").on("change", handleSourceOfArrivalChange);
        });
    </script>

    @include('page.ancestor-data.scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
