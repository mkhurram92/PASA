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

                        <form class="form-horizontal" id="member_save_form" action="{{ route('members.store') }}"
                            method="POST">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Member Personal Details</h3>

                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-block" id="submitBtn">
                                        Save Member Details
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">

                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Title <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <select name="title" class="form-control form-select select2"
                                                        id="title">
                                                        @forelse ($data['titles'] as $title)
                                                            <option value="{{ $title?->id }}">
                                                                {{ $title?->name }}
                                                            </option>
                                                        @empty
                                                            <option >Select Title</option>
                                                        @endforelse
                                                        <option value="Other">Other.</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <input class="form-control" type="text" id="title_detail"
                                                        placeholder="Type Title Here" name="title_detail">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Family Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Family Name" id="family_name" 
                                                        name="family_name" >
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Given Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Given Name"
                                                        id= "given_name" name="given_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Preferred Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Preferred Name" 
                                                        name="preferred_name" id="preferred_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Initials</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Initials"  name="initials">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Post Nominal</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Post Nominal" 
                                                        name="post_nominal">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Date</label>
                                                <div class="col-md-8">
                                                    <input class="form-control fc-datepicker" type="text"
                                                         name="date_of_birth">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Member Contact Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Unit / Apartment No.<span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Unit/Apartment No."  name="unit_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Street Name<span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" placeholder="PO Box"
                                                     name="number_street">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">City / Town / Suburb <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Suburb"
                                                     name="suburb">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">State / County <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <select name="state" class="form-control form-select select2"
                                                    id="state">
                                                    @forelse ($data['states'] as $state)
                                                        <option value="{{ $state?->id }}">
                                                            {{ $state?->name }}
                                                        </option>
                                                    @empty
                                                        <option >Select States</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Country<span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <select name="country" class="form-control form-select select2"
                                                    id="country">
                                                    <option value="Australia">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Post Code <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Post Code"
                                                     name="post_code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Home Phone</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Home Phone"
                                                     name="phone">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Mobile Phone</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Mobile Phone"
                                                     name="mobile">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Email Address<span class="tx-danger">
                                                    *</span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Email Address"  name="email">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">General
                                                Notes</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="general_notes" rows="5" placeholder="General Notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Membership Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Membership
                                                Number</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Membership Number" 
                                                    name="membership_number">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Username <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" placeholder="User Name"
                                                     name="username">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Membership Type </label>
                                            <div class="col-md-8">
                                                <select name="member_type_id" class="form-control form-select select2"
                                                    id="member_type_id">
                                                    @forelse ($data['membership_types'] as $type)
                                                        <option value="{{ $type?->id }}">
                                                            {{ $type?->name }}
                                                        </option>
                                                    @empty
                                                        <option >Select Membership Type
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Membership Status
                                            </label>
                                            <div class="col-md-8">
                                                <select name="member_status_id"
                                                    class="form-control form-select select2" id="member_status_id"
                                                    readonly disabled>
                                                    @forelse ($data['membership_status'] as $status)
                                                        <option value="{{ $status?->id }}">
                                                            {{ $status?->name }}
                                                        </option>
                                                    @empty
                                                        <option >Select Membership Status
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        {{--    <div class="mb-3 row">
                                            <label class="col-md-8 form-label">Date Membership
                                                Commenced (Membership Approval Date) </label>
                                            <div class="col-md-4">
                                                <input class="form-control fc-datepicker" type="text"
                                                     readonly disabled name="date_membership_approved">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Date Membership Ended
                                            </label>
                                            <div class="col-md-8">
                                                <input class="form-control fc-datepicker" type="text"
                                                     name="date_membership_end">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">End Status
                                                Notes</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="end_status_notes" rows="3" placeholder="End Status Notes"></textarea>
                                            </div>
                                        </div>
                                    --}}
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Key Holder</label>
                                            <div class="col-md-8">
                                                <input id="key_holder" type="checkbox" class="checkbox-input"
                                                    name="key_holder" value='1'>
                                            </div>
                                        </div>
                                        <div class="mb-3 row key_held" style="display: none;">
                                            <label class="col-md-4 form-label">Key Held</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="key_held" rows="3" placeholder="Key Held"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Journal<span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-md-4">
                                                <div class="mb-3 mb-sm-0 d-flex align-items-center">
                                                    <label class="form-label mb-0 me-2">Emailed</label>
                                                    <input id="emailed" type="radio" class="radio-input"
                                                        name="journal" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 mb-sm-0 d-flex align-items-center">
                                                    <label class="form-label mb-0 me-2">Posted</label>
                                                    <input id="posted" type="radio" class="radio-input"
                                                        name="journal" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-6 form-label">Registration form
                                                received</label>
                                            <div class="col-md-6">
                                                <input id="registration_form_received" type="checkbox"
                                                    class="checkbox-input" name="registration_form_received"
                                                    value='1'>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-6 form-label">Signed Confidentiality
                                                agreement
                                                received</label>
                                            <div class="col-md-6">
                                                <input id="signed_agreement" type="checkbox" class="checkbox-input"
                                                    name="signed_agreement" value='1'>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Volunteer</label>
                                            <div class="col-md-8">
                                                <input id="volunteer" type="checkbox" class="checkbox-input"
                                                    name="volunteer" value='1'>
                                            </div>
                                        </div>
                                        <div class="volunteer_details" style="display: none;">
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Experience</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Experience" 
                                                        name="experience">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Health
                                                    Issues</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Health Issues" 
                                                        name="health_issues">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Contact
                                                    received</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Contact"  name="contact">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Skills</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Skills"  name="skills">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Availability</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Availability" 
                                                        name="availability">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Volunteer Skills and
                                                    Working Preferences</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" name="volunteer_skills_working" rows="3"
                                                        placeholder="Enter Volunteer Skills and Working Preferences"></textarea>
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
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    @include('plugins.select2')
    <script>
        $(document).ready(function() {

            $("#title_detail").hide();

            var otherValue = "Other";

            $("#title").change(function() {
                if ($(this).val() === otherValue) {
                    $("#title_detail").show();
                } else {
                    $("#title_detail").hide();
                }
            });

            $("#title").trigger("change");
        });

        $("#title").select2();
        $("#state").select2();
        $("#member_type_id").select2();
        $("#member_status_id").select2();
        $("#country").select2();
        var dt_ship_elem = $("#ship-table"),
            dt_ship = "";
        window.addEventListener("DOMContentLoaded", function() {
            if (typeof initShipSelect !== "undefined") {
                initShipSelect();
            }
            if (typeof initCountiesSelect !== "undefined") {
                initCountiesSelect();
            }
            if (typeof initPortsSelect !== "undefined") {
                initPortsSelect();
            }

            // Datepicker
            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true, // Customize the date format as needed
                yearRange: 'c-250:c+nn'
            });

            $(document).on("change", "#daterange-btn", function() {
                initDataTable()
            });
            $(document).on("submit", "#crud form", function() {
                initDataTable()
            });
            $('#volunteer').change(function() {
                if ($(this).prop('checked')) {
                    $('.volunteer_details').show();
                } else {
                    $('.volunteer_details').hide();
                }
            });
            if ($("#volunteer").prop('checked')) {
                $('.volunteer_details').show();
            } else {
                $('.volunteer_details').hide();
            }

            $('#key_holder').change(function() {
                if ($(this).prop('checked')) {
                    $('.key_held').show();
                } else {
                    $('.key_held').hide();
                }
            });

            if ($("#key_holder").prop('checked')) {
                $('.key_held').show();
            } else {
                $('.key_held').hide();
            }

        });

        document.getElementById('submitBtn').addEventListener('click', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Submit the form using AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('members.store') }}',
                data: $('#member_save_form').serialize(),
                dataType: 'json',
                success: function(response) {
                    // Check if the submission was successful
                    if (response.status) {
                        // Show SweetAlert for success
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            timer: 10000,
                            timerProgressBar: true,
                        }).then((result) => {
                            // Redirect if needed
                            if (response.redirectTo) {
                                window.location.href = response.redirectTo;
                            }
                        });
                    } else {
                        // Show SweetAlert for failure with detailed error message
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            //timer: 10000,
                            //timerProgressBar: true,
                        }).then(() => {
                            // Check if there is a specific exception message
                            let exceptionMessage = "";
                            if (response.exception) {
                                exceptionMessage = response.exception;
                            }

                            // Show additional alert with exception (if available)
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
                    // Handle AJAX error and get detailed error message
                    let errorMessage = "An error occurred while processing your request.";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.statusText) {
                        errorMessage = xhr.statusText;
                    }

                    // Show SweetAlert for AJAX error with specific error message
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        //timer: 10000,
                        //timerProgressBar: true,
                    });
                }
            });
        });
    </script>
@endsection

@include('layout.footer')
