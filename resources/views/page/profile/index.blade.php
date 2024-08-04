@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            .form-control[readonly] {
                font-size: medium;
                color: black;
            }

            .form-label {
                font-size: medium;
            }

            .custom-font {
                font-size: medium;
                color: black;
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

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Member Personal Details</h3>
                            <div>
                                <a class="btn btn-warning mr-2" href="{{ url('members/view-ancestor/' . $member?->id) }}"
                                    id="ancestor-view">
                                    <i class="fa fa-sitemap" style="font-size:20px;"></i> Ancestor
                                </a>
                                <a class="btn btn-danger mr-2" href="{{ url('members/view-pedigree/' . $member_id) }}" >
                                    <i class="fa fa-users" style="font-size:20px;"> Pedigree</i>
                                </a>
                                <a class="btn btn-success mr-2" href="{{ url('members/edit-member/' . $member_id) }}" >
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Title</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->title?->name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Family Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->family_name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Given Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->given_name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Preferred Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->preferred_name }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Initials</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->initials }}" name="initials" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Post Nominal</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->post_nominal }}" name="post_nominal" readonly
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Birth Date</label>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @php
                                                            $year = $member?->year_of_birth ?? '';
                                                            $month = $member?->month_of_birth ?? '';
                                                            $day = $member?->date_of_birth ?? '';

                                                            $date = $year;

                                                            if ($month) {
                                                                $date .= '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                                                            }

                                                            if ($day) {
                                                                $date .= '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                            }
                                                        @endphp

                                                        <input class="form-control" value="{{ $date }}"
                                                            readonly disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Member Contact Details</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Country</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $member?->address?->country?->name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">State / County</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $member?->address?->state?->name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">City / Town / Suburb</label>
                                            <div class="col-md-8">
                                                <input class="form-control fc-datepicker" type="text"
                                                    value="{{ $member?->address?->suburb }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Unit / Apartment No. </label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->address?->unit_no }}" name="unit_no" readonly
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Street Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->address?->number_street }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Post Code</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $member?->address?->post_code }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Home Phone (including Area Code)</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                        value="{{ $member?->contact?->area_code }}" name="area_code"
                                                        style="width: 25%; margin-right: 10px;" readonly disabled>
                                                    <input class="form-control" type="text"
                                                        value="{{ $member?->contact?->phone }}" name="phone"
                                                        style="width: calc(75% - 10px);" readonly disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Mobile Phone</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $member?->contact?->mobile }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Email</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->contact?->email }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">General
                                                Notes</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="general_notes" rows="5" readonly disabled>{{ $member?->additionalInfo?->general_notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Membership Details</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Membership
                                                Number</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->additionalInfo?->membership_number }}"
                                                    name="membership_number" readonly disabled>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">User Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->username }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Membership Type </label>
                                            <div class="col-md-8">
                                                <select name="member_type_id" class="form-control form-select select2"
                                                    id="member_type_id" readonly disabled>
                                                    @forelse ($data['membership_types'] as $type)
                                                        <option value="{{ $type?->id }}"
                                                            @if ($type?->id == $member?->member_type_id) selected @endif>
                                                            {{ $type?->name }}
                                                        </option>
                                                    @empty
                                                        <option value="">Select Membership Type
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
                                                        <option value="{{ $status?->id }}"
                                                            @if ($status?->id == $member?->member_status_id) selected @endif>
                                                            {{ $status?->name }}
                                                        </option>
                                                    @empty
                                                        <option value="">Select Membership Status
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-8 form-label">Date Membership
                                                Commenced (Membership Approval Date) </label>
                                            <div class="col-md-4">
                                                <input class="form-control fc-datepicker" type="text"
                                                    value="{{ $member?->approved_at }}"
                                                    name="date_membership_approved" readonly disabled>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Date Membership Ended
                                            </label>
                                            <div class="col-md-8">
                                                <input class="form-control fc-datepicker" type="text"
                                                    value="{{ $member?->additionalInfo?->date_membership_end }}"
                                                    name="date_membership_end" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">End Status
                                                Notes</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="end_status_notes" rows="3" readonly disabled>{{ $member?->additionalInfo?->end_status_notes }}</textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Volunteer</label>
                                            <div class="col-md-8">
                                                <span id="volunteerStatus" class="custom-font"></span>
                                            </div>
                                        </div>

                                        @if ($member?->additionalInfo?->volunteer == 1)
                                            <div class="volunteer_details">
                                                <div class="mb-3 row">
                                                    <label class="col-md-4 form-label">Experience</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="experience" readonly disabled>{{ $member?->volunteerDetails?->experience }} </textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-4 form-label">Health
                                                        Issues</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="health_issues" readonly disabled>{{ $member?->volunteerDetails?->health_issues }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-4 form-label">Contact
                                                        received</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="contact" readonly disabled>{{ $member?->volunteerDetails?->contact }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-4 form-label">Skills</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="skills" readonly disabled>{{ $member?->volunteerDetails?->skills }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-4 form-label">Availability</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="availability" readonly disabled>{{ $member?->volunteerDetails?->availability }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-4 form-label">Volunteer Skills and
                                                        Working Preferences</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" readonly disabled name="volunteer_skills_working" rows="3">{{ $member?->additionalInfo?->volunteer_skills_working }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-6 form-label">Journal</label>
                                            <div class="col-md-6">
                                                <span id="journalStatus" class="custom-font"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-6 form-label">Registration form received</label>
                                            <div class="col-md-6">
                                                <span id="registrationFormStatus" class="custom-font"></span>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-6 form-label">Signed Confidentiality agreement
                                                received</label>
                                            <div class="col-md-6">
                                                <span id="signedAgreementStatus" class="custom-font"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Key Holder</label>
                                            <div class="col-md-8">
                                                <span id="displayStatus" class="custom-font"></span>
                                            </div>
                                        </div>

                                        @if ($member?->additionalInfo?->key_holder == 1)
                                            <div class="mb-3 row key_held">
                                                <label class="col-md-4 form-label">Key Held</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" name="key_held" readonly disabled rows="3">{{ $member?->additionalInfo?->key_held }}</textarea>
                                                </div>
                                            </div>
                                        @endif
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

<!-- MODAL EFFECTS -->
<div id="crud"></div>
@section('scripts')
    @include('plugins.select2')

    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#approveButton').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to approve the membership.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('members.update', ['member' => $member?->id]) }}',
                            method: 'PUT',
                            data: {
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response && response.status === true) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.message,
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'OK',
                                        timerProgressBar: true,
                                        allowOutsideClick: false,
                                        timer: 10000,
                                    }).then(() => {
                                        window.location.href = response
                                            .redirectTo;
                                    });
                                } else {
                                    console.error('Error updating member:', response
                                        .message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error updating member:', error);
                            }
                        });
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var displayStatus = document.getElementById('displayStatus');
            var volunteerStatus = document.getElementById('volunteerStatus');
            var registrationFormStatus = document.getElementById('registrationFormStatus');
            var signedAgreementStatus = document.getElementById('signedAgreementStatus');
            var journalStatus = document.getElementById('journalStatus');

            // Initial display based on the value
            displayStatus.textContent =
                @if ($member?->additionalInfo?->key_holder == 1)
                    'Yes'
                @else
                    'No'
                @endif ;

            volunteerStatus.textContent =
                @if ($member?->additionalInfo?->volunteer == 1)
                    'Yes'
                @else
                    'No'
                @endif ;
            registrationFormStatus.textContent =
                @if ($member?->additionalInfo?->registration_form_received == 1)
                    'Yes'
                @else
                    'No'
                @endif ;
            signedAgreementStatus.textContent =
                @if ($member?->additionalInfo?->signed_agreement == 1)
                    'Yes'
                @else
                    'No'
                @endif ;
            journalStatus.textContent =
                @if ($member?->journal == 0)
                    'Emailed'
                @else
                    'Posted'
                @endif ;

        });
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
