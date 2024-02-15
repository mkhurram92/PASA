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

                        <div class="card-header justify-content-between">
                            <h3 class="card-title">Member Details</h3>
                            <div class="text-right d-flex">
                                <a class="btn btn-info"
                                    href="{{ route('members.view-member', ['id' => $member->id]) }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <form action="{{ route('members.detail-update', ['id' => $member->id]) }}"
                                    method="POST">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-6">
                                            <h4 class="card-title">Personal Details</h4>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Title <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <select name="title" class="form-control form-select select2"
                                                        id="title">
                                                        @forelse ($data['titles'] as $title)
                                                            <option value="{{ $title?->id }}"
                                                                @if ($title?->id == $member?->title_id) selected @endif>
                                                                {{ $title?->name }}</option>
                                                        @empty
                                                            <option value="">Select Title</option>
                                                        @endforelse
                                                        <option value="Other">Other.</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" id="title_detail"
                                                        placeholder="Type Title Here" name="title_detail"
                                                        value="{{ $member?->title_detail }}">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Family Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Family Name"
                                                        name="family_name" value="{{ $member?->family_name }}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Given Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Given Name"
                                                        value="{{ $member?->given_name }}" name="given_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Preferred Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Preferred Name"
                                                        value="{{ $member?->preferred_name }}" name="preferred_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Initials <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Initials" value="{{ $member?->initials }}"
                                                        name="initials">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Post Nominal</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Post Nominal"
                                                        value="{{ $member?->post_nominal }}" name="post_nominal">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Birth Date <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control fc-datepicker" type="text" value="{{ $member?->date_of_birth }}"
                                                        name="date_of_birth">
                                                </div>
                                            </div>

                                            

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Unit/Apartment No.<span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Unit/Apartment No."
                                                        value="{{ $member?->unit_no }}" name="unit_no">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Street & No / PO Box<span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Street & No / PO Box."
                                                        value="{{ $member?->number_street }}" name="number_street">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">City/Town Suburb <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Suburb"
                                                        value="{{ $member?->suburb }}" name="suburb">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">State/County <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select name="state" class="form-control form-select select2"
                                                        id="state">
                                                        @forelse ($data['states'] as $state)
                                                            <option value="{{ $state?->id }}"
                                                                @if ($state?->id == $member?->state) selected @endif>
                                                                {{ $state?->name }}</option>
                                                        @empty
                                                            <option value="">Select States</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">County <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select name="country" class="form-control form-select select2"
                                                        id="country">
                                                        <option value="Australia">Australia</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Post Code <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        placeholder="Post Code" value="{{ $member?->post_code }}"
                                                        name="post_code">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Home Phone</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        placeholder="Home Phone" value="{{ $member?->phone }}"
                                                        name="phone">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Mobile Phone</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        placeholder="Mobile Phone" value="{{ $member?->mobile }}"
                                                        name="mobile">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Email <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        value="{{ $member?->email }}" name="email">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">General
                                                    Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="general_notes" rows="3" placeholder="General Notes">{{ $member?->additionalInfo?->general_notes }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="card-title">Membership Details</h4>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Membership Number</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Membership Number"
                                                        value="{{ $member?->additionalInfo?->membership_number }}"
                                                        name="membership_number">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Given Name <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="User Name" value="{{ $member?->username }}"
                                                        name="username">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-8 form-label">Date Membership Commenced
                                                    (Membership
                                                    Approval Date) </label>
                                                <div class="col-md-4">
                                                    <input class="form-control fc-datepicker" type="text"
                                                        value="{{ $member?->additionalInfo?->date_membership_approved }}"
                                                        name="date_membership_approved">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Membership Type </label>
                                                <div class="col-md-9">
                                                    <select name="member_type_id"
                                                        class="form-control form-select select2" id="member_type_id">
                                                        @forelse ($data['membership_types'] as $type)
                                                            <option value="{{ $type?->id }}"
                                                                @if ($type?->id == $member?->member_type_id) selected @endif>
                                                                {{ $type?->name }}</option>
                                                        @empty
                                                            <option value="">Select Membership Type</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Membership Status </label>
                                                <div class="col-md-9">
                                                    <select name="member_status_id"
                                                        class="form-control form-select select2"
                                                        id="member_status_id">
                                                        @forelse ($data['membership_status'] as $status)
                                                            <option value="{{ $status?->id }}"
                                                                @if ($status?->id == $member?->member_status_id) selected @endif>
                                                                {{ $status?->name }}</option>
                                                        @empty
                                                            <option value="">Select Membership Status</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Date Membership Ended </label>
                                                <div class="col-md-9">
                                                    <input class="form-control fc-datepicker" type="text"
                                                        value="{{ $member?->additionalInfo?->date_membership_end }}"
                                                        name="date_membership_end">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">End Status
                                                    Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="end_status_notes" rows="3" placeholder="End Status Notes">{{ $member?->additionalInfo?->end_status_notes }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Journal<span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="mb-3 mb-sm-0 d-flex align-items-center">
                                                        <label class="form-label mb-0 me-2">Emailed</label>
                                                        <input id="emailed" type="radio" class="radio-input"
                                                            name="journal" value="0"
                                                            @if ($member?->journal == 0) checked @endif>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3 mb-sm-0 d-flex align-items-center">
                                                        <label class="form-label mb-0 me-2">Posted</label>
                                                        <input id="posted" type="radio" class="radio-input"
                                                            name="journal" value="1"
                                                            @if ($member?->journal == 1) checked @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Partner Member</label>
                                                <div class="col-md-9">
                                                    <input id="partner_member" type="checkbox" class="checkbox-input"
                                                        name="partner_member" value='1'
                                                        @if ($member?->additionalInfo?->partner_member == 1) checked @endif>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-6 form-label">Volunteer</label>
                                                <div class="col-md-6">
                                                    <input id="volunteer" type="checkbox" class="checkbox-input"
                                                        name="volunteer" value='1'
                                                        @if ($member?->additionalInfo?->volunteer == 1) checked @endif>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-6 form-label">Registration form received</label>
                                                <div class="col-md-6">
                                                    <input id="registration_form_received" type="checkbox"
                                                        class="checkbox-input" name="registration_form_received"
                                                        value='1'
                                                        @if ($member?->additionalInfo?->registration_form_received == 1) checked @endif>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-6 form-label">Signed Confidentiality agreement
                                                    received</label>
                                                <div class="col-md-6">
                                                    <input id="signed_agreement" type="checkbox"
                                                        class="checkbox-input" name="signed_agreement" value='1'
                                                        @if ($member?->additionalInfo?->signed_agreement == 1) checked @endif>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Volunteer Skills and Working
                                                    Preferences</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="volunteer_skills_working" rows="3"
                                                        placeholder="Enter Volunteer Skills and Working Preferences">{{ $member?->additionalInfo?->volunteer_skills_working }}</textarea>
                                                </div>
                                            </div>
                                            <div class="volunteer_details" style="display: none;">
                                                <h4 class="card-title">Volunteer Details</h4>
                                                <div class="mb-3 row">
                                                    <label class="col-md-6 form-label">Experience</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text"
                                                            placeholder="Enter Experience"
                                                            value="{{ $member?->volunteerDetails?->experience }}"
                                                            name="experience">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-6 form-label">Health Issues</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text"
                                                            placeholder="Enter Health Issues"
                                                            value="{{ $member?->volunteerDetails?->health_issues }}"
                                                            name="health_issues">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-6 form-label">Contact
                                                        received</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text"
                                                            placeholder="Enter Contact"
                                                            value="{{ $member?->volunteerDetails?->contact }}"
                                                            name="contact">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-6 form-label">Skills</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text"
                                                            placeholder="Enter Skills"
                                                            value="{{ $member?->volunteerDetails?->skills }}"
                                                            name="skills">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-6 form-label">Availability</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text"
                                                            placeholder="Enter Availability"
                                                            value="{{ $member?->volunteerDetails?->availability }}"
                                                            name="availability">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Key Holder</label>
                                                <div class="col-md-9">
                                                    <input id="key_holder" type="checkbox" class="checkbox-input"
                                                        name="key_holder" value='1'
                                                        @if ($member?->additionalInfo?->key_holder == 1) checked @endif>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Key Held</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="key_held" rows="3" placeholder="Key Held">{{ $member?->additionalInfo?->key_held }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type = 'submit' class ='btn btn-primary'>
                                                Update Member
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        });
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
