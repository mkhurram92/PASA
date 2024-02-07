@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
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
                            <h3 class="card-title">Member Details</h3>
                            <div>
                                <a class="btn btn-success mr-2" href="#" id="viewPedigreeLink">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;">View Pedigree</i>
                                </a>
                                <a class="btn btn-success mr-2" href="{{ url()->current() }}/edit" id="editLink">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;">Edit</i>
                                </a>

                                <a class="btn btn-info" href="{{ route('members.index') }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                                @if (!$member?->approved_at)
                                    <form id="curdForm" name="curdForm" class="form-horizontal " method="POST"
                                        action="{{ route('members.update', ['member' => $member?->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success close-modal">Approve</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">User Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="User name"
                                                    value="{{ $member?->username }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Email</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $member?->email }}"
                                                    readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Title</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Country"
                                                    value="{{ $member?->title }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Given Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Given Name"
                                                    value="{{ $member?->given_name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Family Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Family Name"
                                                    value="{{ $member?->family_name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Preferred Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Preferred Name"
                                                    value="{{ $member?->preferred_name }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Date of Birth</label>
                                            <div class="col-md-9">
                                                <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                                    type="text" value="{{ $member?->date_of_birth }}" readonly
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 form-label">Street Number</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Street Number"
                                                    value="{{ $member?->number_street }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Suburb</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Suburb"
                                                    value="{{ $member?->suburb }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">State</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="State"
                                                    value="{{ $data['state_name'] ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Post Code</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Post Code"
                                                    value="{{ $member?->post_code }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Mobile</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Mobile"
                                                    value="{{ $member?->mobile }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($member?->member_type == 'PRIMARY')
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
                                                <label class="col-md-3 form-label">Place of Arrival</label>
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
                                                <label class="col-md-3 form-label">Date of Death</label>
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
                                                <label class="col-md-3 form-label">Place Of Origin</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Place Of Origin"
                                                        value="{{ $member?->ancestor?->place_of_origin }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Name Of the Ship</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Name Of the Ship"
                                                        value="{{ $data['name_of_the_ship'] ?? '' }}" readonly
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Date of Birth</label>
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
                        @endif

                        <div class="card-header justify-content-between">
                            <h3 class="card-title">Parent</h3>
                        </div>
                        @if ($member?->parent_member)
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class='row'>
                                                <div class="mb-3 col-lg-6">
                                                    <label class="col-md-3 form-label">Username</label>
                                                    <div class="col-md-12">
                                                        <input class="form-control" type="text" placeholder="Name"
                                                            value="{{ $member?->parent_member?->username }}" readonly
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <label class="col-md-3 form-label">Fullname</label>
                                                    <div class="col-md-12">
                                                        <input class="form-control" type="text" placeholder="Name"
                                                            value="{{ $member?->parent_member?->title . ' ' . $member?->parent_member?->given_name }}"
                                                            readonly disabled>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-12">
                                                    <label class="col-md-3 form-label">Address</label>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control">{{ $member?->parent_member?->number_street . ' ' . $member?->parent_member?->suburb . ' ' . $member?->parent_member?->state . ' ' . $member?->parent_member?->post_code . ' ' . $member?->parent_member?->country }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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

        var currentUrl = window.location.href;

        // Extract the ID from the URL (assuming it's the last digit after the last '/')
        var id = currentUrl.match(/\d+$/)[0];

        // Update the href attribute with the extracted ID
        document.getElementById("viewPedigreeLink").href = "/ancestors/public/members/view-pedigree/" + id;

        /**var dt_ship_elem = $("#ship-table"),
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
                selectOtherMonths: true
            });


            $(document).on("change", "#daterange-btn", function() {
                initDataTable()
            })
            $(document).on("submit", "#crud form", function() {
                initDataTable()
            })
        })**/
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
