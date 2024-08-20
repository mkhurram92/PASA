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

            .swal2-container {
                z-index: 12000 !important;
                /* Increase the z-index */
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
                                @if ($showRenewButton)
                                    <a class="btn btn-primary mr-2" href="#" id="renewButton">
                                        <i class="fa fa-refresh" style="font-size:20px;"> Renew</i>
                                    </a>
                                @endif
                                @if (!$member?->additionalInfo?->date_membership_approved && $member?->contact?->email)
                                    <a class="btn btn-success" id="approveButton">
                                        <i class="fa fa-thumbs-up" style="font-size:20px;"> Approve</i>
                                    </a>
                                @endif
                                <a class="btn btn-warning mr-2"
                                    href="{{ url('members/view-ancestor/' . $member?->id) }}" id="ancestor-view">
                                    <i class="fa fa-sitemap" style="font-size:20px;"></i> Ancestor
                                </a>
                                <a class="btn btn-danger mr-2" href="#" id="viewPedigreeLink">
                                    <i class="fa fa-users" style="font-size:20px;"> Pedigree</i>
                                </a>
                                <a class="btn btn-success mr-2" href="{{ url()->current() }}/edit" id="editLink">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>
                                <a class="btn btn-info" href="{{ route('members.index') }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
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
                                                    value="{{ $member?->address?->country?->name }}" readonly
                                                    disabled>
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
                                            <label class="col-md-4 form-label">General Notes</label>
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
                                            <label class="col-md-4 form-label">Membership Type</label>
                                            <div class="col-md-8">
                                                <select name="member_type_id" class="form-control form-select select2"
                                                    id="member_type_id" readonly disabled>
                                                    @forelse ($data['membership_types'] as $type)
                                                        <option value="{{ $type?->id }}"
                                                            @if ($type?->id == $member?->member_type_id) selected @endif>
                                                            {{ $type?->name }}
                                                        </option>
                                                    @empty
                                                        <option value="">Select Membership Type</option>
                                                    @endforelse
                                                </select>
                                                <!-- Hidden fields for prices -->
                                                <input type="hidden" name="email_price" id="email_price"
                                                    value="{{ $data['membership_types']->firstWhere('id', $member?->member_type_id)?->email_price }}">
                                                <input type="hidden" name="post_price" id="post_price"
                                                    value="{{ $data['membership_types']->firstWhere('id', $member?->member_type_id)?->post_price }}">
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
                                                    value="{{ $member?->additionalInfo?->date_membership_approved }}"
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
@include('models.payment-renewal')

<script src="https://js.stripe.com/v3/"></script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('scripts')
    @include('plugins.select2')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var renewButton = document.getElementById('renewButton');
            if (renewButton) {
                renewButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    var emailPrice = document.getElementById('email_price').value;
                    var postPrice = document.getElementById('post_price').value;
                    var journalStatus = document.getElementById('journalStatus').textContent.trim();

                    var selectedPrice = (journalStatus === 'Emailed') ? emailPrice : postPrice;
                    document.getElementById('selectedPriceField').innerText = selectedPrice;

                    var paymentModal = new bootstrap.Modal(document.getElementById('paymentRenewalModal'));
                    paymentModal.show();
                });
            }

            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();

            var card = elements.create('card', {
                hidePostalCode: true,
                style: {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                }
            });

            card.mount('#card-element');

            var stripeFields = document.getElementById('stripeFields');
            var cashFields = document.getElementById('cashFields');
            var onlineOption = document.getElementById('onlineOption');
            var cashOption = document.getElementById('cashOption');
            var proceedButton = document.getElementById('submitPaymentMethod');
            var paymentRenewalModalElement = document.getElementById('paymentRenewalModal');
            var paymentRenewalModal = new bootstrap.Modal(paymentRenewalModalElement, {
                keyboard: false
            });

            stripeFields.style.display = 'none';

            onlineOption.addEventListener('change', function() {
                if (this.checked) {
                    stripeFields.style.display = 'block';
                }
            });

            cashOption.addEventListener('change', function() {
                if (this.checked) {
                    stripeFields.style.display = 'none';
                }
            });

            proceedButton.addEventListener('click', function(e) {
                e.preventDefault();

                var selectedPrice = document.getElementById('selectedPriceField').innerText;

                if (onlineOption.checked) {
                    var cardholderName = document.getElementById('cardholder-name').value;
                    var billingAddress = {
                        line1: document.getElementById('billing-address').value,
                        city: document.getElementById('billing-city').value,
                        state: document.getElementById('billing-state').value,
                        postal_code: document.getElementById('billing-postal').value,
                        country: document.getElementById('billing-country').value,
                    };

                    stripe.createToken(card, {
                        name: cardholderName,
                        address_line1: billingAddress.line1,
                        address_city: billingAddress.city,
                        address_state: billingAddress.state,
                        address_zip: billingAddress.postal_code,
                        address_country: billingAddress.country
                    }).then(function(result) {
                        if (result.error) {
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            processPayment(result.token.id, selectedPrice);
                        }
                    });
                } else if (cashOption.checked) {
                    updateRenewalDate();
                } else {
                    Swal.fire({
                        title: 'No Payment Method Selected',
                        text: 'Please select a payment method.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });

            function processPayment(token, amount) {
                $.ajax({
                    url: '{{ route('payment.process') }}',
                    method: 'POST',
                    data: {
                        stripeToken: token,
                        amount: amount,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            updateRenewalDate();
                        } else {
                            Swal.fire({
                                title: 'Payment Failed',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'An error occurred',
                            text: error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

            function updateRenewalDate() {
                $.ajax({
                    url: '{{ route('update.renewal.date') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        memberId: '{{ $member->id }}',
                        renewalDate: new Date().toISOString().slice(0, 10)
                    },
                    success: function(updateResponse) {
                        if (updateResponse.success) {
                            Swal.fire({
                                title: 'Membership Renewal Successful!',
                                text: 'Your membership has been renewed successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location
                            .reload(); // Refresh the page after the user clicks "OK"
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to update the renewal date.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while updating the renewal date.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });

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

        document.getElementById('editLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Extract the current URL and the id from it
            var currentUrl = window.location.href;
            var id = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

            // Construct the new URL for editing
            var newUrl = currentUrl.replace('/view-member/', '/edit-member/');

            // Redirect to the new URL
            window.location.href = newUrl;
        });

        document.getElementById('viewPedigreeLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Extract the current URL and the id from it
            var currentUrl = window.location.href;
            var id = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

            // Construct the new URL for editing
            var newUrl = currentUrl.replace('/view-member/', '/view-pedigree/');

            // Redirect to the new URL
            window.location.href = newUrl;
        });
        document.getElementById('viewAncestorsLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Extract the current URL and the id from it
            var currentUrl = window.location.href;
            var id = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);

            // Construct the new URL for editing
            var newUrl = currentUrl.replace('/view-member/', '/view-ancestor/');

            // Redirect to the new URL
            window.location.href = newUrl;
        });
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
