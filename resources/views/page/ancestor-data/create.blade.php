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

                        <form class="form-horizontal" action="{{ route('ancestor-data.store') }}" method="POST">
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
                                                <label class="col-md-4 form-label">Gender <span class="text-danger">
                                                        *</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" id="gender_select2"
                                                        name="gender">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Family Name<span
                                                        class="text-danger"> *</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control uppercase" type="text"
                                                        placeholder="Pioneer's Family Name" value=""
                                                        name="ancestor_surname">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Given Name<span
                                                        class="text-danger"> *</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Given Name" value=""
                                                        name="given_name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Preffered Name<span
                                                        class="text-danger"></span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Preffered Name" value=""
                                                        name="preferred_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Birth Date</label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY" value="" type="text" name="year_of_birth">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <input class="form-control" placeholder="MM" value="" type="text" name="month_of_birth">
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <input class="form-control" placeholder="DD" value="" type="text" name="date_of_birth">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Birth Place</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Birth Place"
                                                        value="" name="place_of_birth">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Death Date</label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY" value="" type="text" name="year_of_death">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <input class="form-control" placeholder="MM" value="" type="text" name="month_of_death">
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <input class="form-control" placeholder="DD" value="" type="text" name="date_of_death">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Death Place</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Death Place"
                                                        value="" name="place_of_death">
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
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div id="ship_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Ship Name - Arrival Year<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2"
                                                                id="mode_of_arrival_select2"
                                                                name="mode_of_arrival_id">
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="mode_of_travel_id"
                                                        id="mode_of_travel_id" value="" />

                                                    <div id="first_date_section" class="mb-3 row">
                                                        <label class="col-md-4 form-label">Arrival Date in SA </label>

                                                        <div class="col-md-8">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                value="" id="first_date" name="first_date" readonly disabled>
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
                                                        <label class="col-md-4 form-label">Evidence of Arrival<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-8">
                                                            <textarea class="form-control" id="evidence_of_arrival" 
                                                            name="evidence_of_arrival" rows="6" maxlength="300"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3 class="card-title">Pioneer Spouse’s Details</h3>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-7 form-label">Did this person travel to SA
                                                            aboard the same ship?<span
                                                                class="text-danger">*</span></label>
                                                        <div class="col-md-5">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="travel_to_sa" id="travel_to_sa_yes"
                                                                    value="yes">
                                                                <label class="form-check-label"
                                                                    for="travel_to_sa_yes">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="travel_to_sa" id="travel_to_sa_no"
                                                                    value="no">
                                                                <label class="form-check-label"
                                                                    for="travel_to_sa_no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="marriage_date_section" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Marriage Date<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                placeholder="Marriage Date" value=""
                                                                id="marriage_date" name="marriage_date">
                                                        </div>
                                                    </div>

                                                    <div id="marriage_date_section" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Marriage Place<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Marriage Place" value=""
                                                                id="marriage_place" name="marriage_place">
                                                        </div>
                                                    </div>
                                                    <div id="spouse_family_name_section" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Spouse’s Family Name<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Spouse’s Family Name" value=""
                                                                id="spouse_family_name" name="spouse_family_name">
                                                        </div>
                                                    </div>
                                                    <div id="spouse_given_name_section" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Spouse’s Given Name(s)<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Spouse’s Given Name(s)" value=""
                                                                id="spouse_given_name" name="spouse_given_name">
                                                        </div>
                                                    </div>
                                                    <div id="spouse_date_of_birth" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Birth Date</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                placeholder="Birth Date" id="spouse_birth_date"
                                                                value="" name="spouse_birth_date">
                                                        </div>
                                                    </div>
                                                    <div id="spouse_place_of_birth" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Birth Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Birth Place" value=""
                                                                name="spouse_place_of_birth">
                                                        </div>
                                                    </div>
                                                    <div id="spouse_date_of_death" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Death Date</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                placeholder="Death Date" value=""
                                                                id="spouse_death_date" name="spouse_death_date">
                                                        </div>
                                                    </div>
                                                    <div id="spouse_place_of_death" class="mb-3 row">
                                                        <label class="col-md-3 form-label">Death Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Death Place" value=""
                                                                name="spouse_place_of_death">
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
        $(document).ready(function() {
            // Hide specificsections  on page load
            $("#marriage_date_section, #marriage_place_section, #spouse_family_name_section, #spouse_given_name_section, #spouse_birth_section, #spouse_death_section, #spouse_place_of_death, #spouse_date_of_death, #spouse_place_of_birth, #spouse_date_of_birth")
                .hide();

            // Handle radio button click
            $("input[name='travel_to_sa']").on("change", function() {
                // Check if 'Yes' is selected
                if ($(this).val() === "yes") {
                    // Show specific sections
                    $("#marriage_date_section, #marriage_place_section, #spouse_family_name_section, #spouse_given_name_section, #spouse_birth_section, #spouse_death_section,  #spouse_place_of_death, #spouse_date_of_death, #spouse_place_of_birth, #spouse_date_of_birth")
                        .show();
                } else {
                    // Hide specific sections
                    $("#marriage_date_section, #marriage_place_section, #spouse_family_name_section, #spouse_given_name_section, #spouse_birth_section, #spouse_death_section,  #spouse_place_of_death, #spouse_date_of_death, #spouse_place_of_birth, #spouse_date_of_birth")
                        .hide();
                }
            });
        });

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

    </script>

    @include('page.ancestor-data.scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
