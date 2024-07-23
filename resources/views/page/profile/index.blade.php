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

            body {
                background: white;
            }
        </style>
        <div class="container-fluid main-container mt-5">
            <div class="row my-5">
                <div class="col-12">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="tab-menu-heading p-0">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab5" class="active" data-bs-toggle="tab">Profile</a></li>
                            <li><a href="#tab6" data-bs-toggle="tab">Ancestor</a></li>
                            <li><a href="#tab7" data-bs-toggle="tab">Pedigree</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab5">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Member Personal Details</h3>
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
                                                        value="{{ $member?->initials }}" name="initials" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Post Nominal</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        value="{{ $member?->post_nominal }}" name="post_nominal"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Date</label>
                                                <div class="col-md-8">
                                                    <input class="form-control fc-datepicker" type="text"
                                                        value="{{ $member?->date_of_birth }}" readonly disabled>
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
                                                <label class="col-md-4 form-label">Unit / Apartment No.
                                                </label>
                                                <div class="col-md-8">
                                                    <input class="form-control fc-datepicker" type="text"
                                                        value="{{ $member?->address?->unit_no }}" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Street Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        value="{{ $member?->address?->number_street }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">City / Town / Suburb</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $member?->address?->suburb }}" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">State / County</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $member?->address?->state?->name }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Country</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $member?->address?->country?->name }}" readonly
                                                        disabled>
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
                                                <label class="col-md-4 form-label">Home Phone</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                        value="{{ $member?->contact?->phone }}" readonly disabled>
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
                                                    <input type="text" class="form-control"
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
                                                        placeholder="Membership Number"
                                                        value="{{ $member?->additionalInfo?->membership_number }}"
                                                        name="membership_number" readonly disabled>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">User Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="User name" value="{{ $member?->username }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Membership Type </label>
                                                <div class="col-md-8">
                                                    <select name="member_type_id"
                                                        class="form-control form-select select2" id="member_type_id"
                                                        readonly disabled>
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
                                                    <textarea class="form-control" name="end_status_notes" rows="3" placeholder="" readonly disabled>{{ $member?->additionalInfo?->end_status_notes }}</textarea>
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
                                                        <textarea class="form-control" name="key_held" readonly disabled rows="3" placeholder="Key Held">{{ $member?->additionalInfo?->key_held }}</textarea>
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
                                                <label class="col-md-6 form-label">Volunteer</label>
                                                <div class="col-md-6">
                                                    <span id="volunteerStatus" class="custom-font"></span>
                                                </div>
                                            </div>

                                            @if ($member?->additionalInfo?->volunteer == 1)
                                                <div class="volunteer_details">
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Experience</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" placeholder=""
                                                                value="{{ $member?->volunteerDetails?->experience }}"
                                                                name="experience" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Health
                                                            Issues</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" placeholder=""
                                                                value="{{ $member?->volunteerDetails?->health_issues }}"
                                                                name="health_issues" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Contact
                                                            received</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" placeholder=""
                                                                value="{{ $member?->volunteerDetails?->contact }}"
                                                                name="contact" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Skills</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" placeholder=""
                                                                value="{{ $member?->volunteerDetails?->skills }}"
                                                                name="skills" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Availability</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" placeholder=""
                                                                value="{{ $member?->volunteerDetails?->availability }}"
                                                                name="availability" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Volunteer Skills and
                                                            Working Preferences</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" readonly disabled name="volunteer_skills_working" rows="3" placeholder="">{{ $member?->additionalInfo?->volunteer_skills_working }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab6">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Ancestor</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Gender</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Gender"
                                                        value="{{ Str::ucfirst($data['gender_name']) ?? '' }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Maiden Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Maiden Name"
                                                        value="{{ $member?->ancestor?->maiden_name }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Place in SA</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Place of Arrival"
                                                        value="{{ $data['place_of_arrival'] ?? '' }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Partner Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Partner Name"
                                                        value="{{ $member?->ancestor?->partner_name }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Death Date</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Date of Death"
                                                        value="{{ $member?->ancestor?->date_of_death ?? '' }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Full Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Full Name"
                                                        value="{{ $member?->ancestor?->full_name }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Origin Place</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Place Of Origin"
                                                        value="{{ $member?->ancestor?->place_of_origin }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ship Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Name Of the Ship"
                                                        value="{{ $data['name_of_the_ship'] ?? '' }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Birth Date</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Date of Birth"
                                                        value="{{ $member?->ancestor?->date_of_birth ?? '' }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab7">
                            @if ($member)
                                @if (count($member?->pedigree))
                                    <div class="card-header justify-content-between">
                                        <h3 class="card-title">Pioneer Member's Pedigree Chart</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="card-body">
                                            @foreach ($member?->pedigree as $pedigree)
                                                <div class="row">
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <a class="form-control-label"
                                                                style="color: #022ff8; font-size:16px">Generation x
                                                                {{ $pedigree->pedigree_level + 1 }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Father Name</label>
                                                            <input
                                                                class="form-control @if ($pedigree->pioneer_parents == 1) text-danger @endif"
                                                                value="{{ $pedigree->f_name }}" type="text" readonly disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Birth Date</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->date_of_birth ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Birth Place</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->place_of_birth ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Death Date</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->date_of_death ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Death Place</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->place_of_death ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Marriage Date</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->date_of_marriage ?? '' }}"
                                                                readonly disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Mother Name</label>
                                                            <input
                                                                class="form-control @if ($pedigree->pioneer_parents == 0) text-danger @endif"
                                                                id="email" value="{{ $pedigree->m_name }}" type="text" readonly disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Birth Date</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->m_birth_date ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Birth Place</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->m_birth_place ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Death Date</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->m_death_date ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Death Place</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->m_death_place ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Marriage Place</label>
                                                            <input class="form-control" type="text" value="{{ $pedigree->place_of_marriage ?? '' }}"
                                                                readonly disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="crud"></div>
@section('scripts')
    <script>
        $("#juniorsTable").DataTable({
            "order": []
        });
        $(document).on("click", ".show-siblings", function(e) {
            e.preventDefault();
            $.ajax($(e.target).attr("href"), {
                    type: "GET"
                })
                .done(res => {
                    if (res?.html) {
                        $("#crud").html(res?.html)
                        $("#crud").find(".modal:not(.show)").modal("show");
                    }
                })
        })

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