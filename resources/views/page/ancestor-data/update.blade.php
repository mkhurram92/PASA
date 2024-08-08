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
                        <form class="form-horizontal"
                            action="{{ route('ancestor-data.update', ['ancestor_datum' => $ancestor?->id]) }}"
                            method="POST">
                            @method('PUT')
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Update an Ancestor Details</h3>
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
                                                <label class="col-md-4 form-label">Gender<span class="text-danger">
                                                        *</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" id="gender_select2"
                                                        name="gender">
                                                        @if (!empty($ancestor?->Gender?->id))
                                                            <option value="{{ $ancestor?->Gender?->id }}" selected>
                                                                {{ $ancestor?->Gender?->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Family Name<span
                                                        class="text-danger"> *</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control uppercase" id="ancestor_surname"
                                                        type="text" placeholder="Pioneer's Family Name"
                                                        value="{{ $ancestor?->ancestor_surname }}"
                                                        name="ancestor_surname">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Given Name<span
                                                        class="text-danger"> *</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Given Name"
                                                        value="{{ $ancestor?->given_name }}" name="given_name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Preferred Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Preferred Name"
                                                        value="{{ $ancestor?->maiden_surname }}" id="maiden_surname"
                                                        name="maiden_surname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Date</label>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY"
                                                                value="{{ $ancestor ? $ancestor?->year_of_birth : '' }}"
                                                                type="text" name="year_of_birth">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                                <select class="form-control month-select"
                                                                        id="month_of_birth"
                                                                        name="month_of_birth"></select>
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                                <select class="form-control month-select"
                                                                        id="date_of_birth"
                                                                        name="date_of_birth"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Place</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Birth Place"
                                                        value="{{ $ancestor?->place_of_birth }}" name="place_of_birth">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Death Date</label>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY"
                                                                value="{{ $ancestor ? $ancestor?->year_of_death : '' }}"
                                                                type="text" name="year_of_death">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                                <select class="form-control month-select"
                                                                        id="month_of_death"
                                                                        name="month_of_death"></select>
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <select class="form-control day-select"
                                                                        id="date_of_death"
                                                                        name="date_of_death"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Death Place</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Death Place"
                                                        value="{{ $ancestor?->place_of_death }}"
                                                        name="place_of_death">

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
                                                                name="source_of_arrival">
                                                                @if (!empty($ancestor?->sourceOfArrival?->id))
                                                                    <option
                                                                        value="{{ $ancestor?->sourceOfArrival?->id }}"
                                                                        selected>
                                                                        {{ $ancestor?->sourceOfArrival?->name }}
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row" id="ship_section">
                                                        <label class="col-md-4 form-label">Ship Name - Arrival Year
                                                            <span class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2"
                                                                id="mode_of_arrival_select2"
                                                                name="mode_of_travel_native_bith">
                                                                @if (!empty($ancestor?->mode_of_travel?->id))
                                                                    <option
                                                                        value="{{ $ancestor?->mode_of_travel?->id }}"
                                                                        selected>
                                                                        {{ $ancestor?->mode_of_travel?->ship?->name_of_ship . ' - ' . $ancestor?->mode_of_travel?->year }}
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="mode_of_travel_id"
                                                        id="mode_of_travel_id" value="" />

                                                    <div class="mb-3 row" id="first_date_section">
                                                        <label class="col-md-4 form-label">Arrival Date in SA <span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                placeholder="Arrival Date in SA"
                                                                value="{{ $ancestor?->first_date }}" id="first_date"
                                                                name="first_date" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div id="arrival_date_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Arrival Date in SA<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-8">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                id="arrival_date_in_sa" name="arrival_date_in_sa"
                                                                value="{{ $ancestor?->localTravelDetails?->travel_date }}">
                                                        </div>
                                                    </div>

                                                    <div id="evidence_of_arrival_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Evidence of Arrival<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" id="evidence_of_arrival" name="evidence_of_arrival" rows="6" maxlength="300">{{ $ancestor?->localTravelDetails?->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3 class="card-title">Pioneer Spouse’s Details</h3>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Marriage Date<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-4 pr-1">
                                                                    <input class="form-control" placeholder="YYYY"
                                                                        value="{{ $ancestor?->spouse_details?->marriage_year }}"
                                                                        type="text" name="marriage_year">
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control month-select"
                                                                        id="marriage_month"
                                                                        name="marriage_month"></select>
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control day-select"
                                                                        id="marriage_date"
                                                                        name="marriage_date"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Marriage Place<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text"
                                                                placeholder="Marriage Place"
                                                                value="{{ $ancestor?->spouse_details?->marriage_place }}"
                                                                id="marriage_place" name="marriage_place"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Spouse’s Family
                                                            Name<span class="text-danger"></span></label>

                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text"
                                                                placeholder="Spouse’s Family Name"
                                                                id="spouse_family_name" name="spouse_family_name"
                                                                value="{{ $ancestor?->spouse_details?->spouse_family_name }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Spouse’s Given
                                                            Name<span class="text-danger"></span></label>

                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text"
                                                                placeholder="Spouse’s Given Name"
                                                                value="{{ $ancestor?->spouse_details?->spouse_given_name }}"
                                                                id="spouse_given_name" name="spouse_given_name">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Birth Date</label>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-4 pr-1">
                                                                    <input class="form-control" placeholder="YYYY"
                                                                        value="{{ $ancestor?->spouse_details?->spouse_birth_year }}"
                                                                        type="text" name="spouse_birth_year">
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control month-select"
                                                                        name="spouse_birth_month"
                                                                        id="spouse_birth_month"></select>

                                                                </div>
                                                                <div class="col-4 pl-1">
                                                                    <select class="form-control day-select"
                                                                        name="spouse_birth_date"
                                                                        id="spouse_birth_date"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Birth Place</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text"
                                                                placeholder="Birth Place"
                                                                value="{{ $ancestor?->spouse_details?->spouse_birth_place }}"
                                                                name="spouse_birth_place">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Death Date</label>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-4 pr-1">
                                                                    <input class="form-control" placeholder="YYYY"
                                                                        value="{{ $ancestor?->spouse_details?->spouse_death_year }}"
                                                                        type="text" name="spouse_death_year">
                                                                </div>
                                                                <div class="col-4 px-1">
                                                                    <select class="form-control month-select"
                                                                        name="spouse_death_month"
                                                                        id="spouse_death_month"></select>
                                                                </div>
                                                                <div class="col-4 pl-1">
                                                                    <select class="form-control day-select"
                                                                        name="spouse_death_date"
                                                                        id="spouse_death_date"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Death Place</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text"
                                                                placeholder="Death Place"
                                                                value="{{ $ancestor?->spouse_details?->spouse_death_place }}"
                                                                name="spouse_death_place">
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
        const existingMonthOfMarriage = ("{{ $ancestor?->spouse_details?->marriage_month }}" || "").padStart(2, '0');
        const existingDateOfMarriage = ("{{ $ancestor?->spouse_details?->marriage_date }}" || "").padStart(2, '0');

        const existingSpouseMonthOfDeath = ("{{ $ancestor?->spouse_details?->spouse_death_month }}" || "").padStart(2, '0');
        const existingSpouseDateOfDeath = ("{{ $ancestor?->spouse_details?->spouse_death_date }}" || "").padStart(2, '0');

        const existingSpouseMonthOfBirth = ("{{ $ancestor?->spouse_details?->spouse_birth_month }}" || "").padStart(2, '0');
        const existingSpouseDateOfBirth = ("{{ $ancestor?->spouse_details?->spouse_birth_date }}" || "").padStart(2, '0');

        const existingMonthOfBirth = ("{{ $ancestor?->month_of_birth }}" || "").padStart(2, '0');
        const existingDateOfBirth = ("{{ $ancestor?->date_of_birth }}" || "").padStart(2, '0');
        
        const existingMonthOfDeath = ("{{ $ancestor?->month_of_death }}" || "").padStart(2, '0');
        const existingDateOfDeath = ("{{ $ancestor?->date_of_death }}" || "").padStart(2, '0');

        initMonthSelect2($("#marriage_month"), existingMonthOfMarriage);
        initDaySelect2($("#marriage_date"), existingDateOfMarriage);

        initMonthSelect2($("#spouse_death_month"), existingSpouseMonthOfDeath);
        initDaySelect2($("#spouse_death_date"), existingSpouseDateOfDeath);
        
        initMonthSelect2($("#spouse_birth_month"), existingSpouseMonthOfBirth);
        initDaySelect2($("#spouse_birth_date"), existingSpouseDateOfBirth);

        initMonthSelect2($("#month_of_birth"), existingMonthOfBirth);
        initDaySelect2($("#date_of_birth"), existingDateOfBirth);
        initMonthSelect2($("#month_of_death"), existingMonthOfDeath);
        initDaySelect2($("#date_of_death"), existingDateOfDeath);



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
        $(document).on("change", "#source_of_arrival_select2", handleSourceOfArrivalChange);

        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd',
            changeMonth: true, // Customize the date format as needed
            changeYear: true,
            yearRange: 'c-250:c+nn'
        });
    </script>

    @include('page.ancestor-data.scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
