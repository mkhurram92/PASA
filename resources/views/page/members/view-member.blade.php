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
                                <a class="btn btn-danger mr-2" href="#" id="viewPedigreeLink">
                                    <i class="fa fa-users" style="font-size:20px;"> Pedigree</i>
                                </a>
                                <a class="btn btn-success mr-2" href="{{ url()->current() }}/edit" id="editLink">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
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
                                            <label class="col-md-3 form-label">Title</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Country"
                                                    value="{{ $member?->title_id }}" readonly disabled>
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
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Preferred Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Preferred Name"
                                                    value="{{ $member?->preferred_name }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Date of Birth</label>
                                            <div class="col-md-9">
                                                <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                                    type="text" value="{{ $member?->date_of_birth }}" readonly
                                                    disabled>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Contact Details</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Membership Number</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Membership Number" value="" readonly disabled>
                                            </div>
                                        </div>
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
                                                <input class="form-control" type="text"
                                                    value="{{ $member?->email }}" readonly disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <label class="col-md-3 form-label">Street Number</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Street Number" value="{{ $member?->number_street }}"
                                                    readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Suburb / City</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Suburb"
                                                    value="{{ $member?->suburb }}, {{ $data['state_name'] ?? '' }}"
                                                    readonly disabled>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Post Code</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Post Code"
                                                    value="{{ $member?->post_code }}" readonly disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Parent Details</h3>
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
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
