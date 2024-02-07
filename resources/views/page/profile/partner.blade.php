@include('layout.header')
@include('layout.sidebar')
<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <div class="container-fluid main-container mt-5">
            <div class="row my-5">
                <div class="col-12">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>
                <div class="col-md-12">
                    @if (empty($member?->partner_id))
                        <a href="{{ route('ParterForm') }}" class="btn btn-primary" target="_blank">Add Partner</a>
                    @endif
                </div>

            </div>
            <div class="panel panel-primary">
                <div class=" tab-menu-heading p-0 bg-light">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            @if (!empty($member?->partner_id))
                                <li><a href="#tab8" data-bs-toggle="tab" class="active">Partner</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        @if (!empty($member?->partner_id))
                            <form action="{{ route('UpdatePartnerMemberFormWizard') }}" method="POST">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                <section>
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <h3 class="mb-0">Partner Information</h3>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="form-control-label">Username: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" id="username" name="username"
                                                value="{{ $member?->partner_member?->username }}"
                                                placeholder="Enter username" required="" type="text">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="form-control-label">Password: </label>
                                            <input class="form-control" id="password" name="password" value=""
                                                placeholder="Leave blank to use current" type="password">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="form-control-label">Confirmation Password: </label>
                                            <input class="form-control" id="password_confirmation"
                                                name="password_confirmation" value=""
                                                placeholder="Leave blank to use current" type="password">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="form-control-label">Email: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" id="email" name="email"
                                                value="{{ $member?->partner_member?->email }}" placeholder="Enter Email"
                                                required="" type="text">
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="form-control-label">Confirmation Email: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" id="email_confirmation"
                                                name="email_confirmation" value="{{ $member?->partner_member?->email }}"
                                                placeholder="Enter Same Email" required="" type="email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h3> Application Personal Details</h3>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2 my-2">
                                                    <label class="form-control-label">Title: <span
                                                            class="tx-danger">*</span></label>
                                                    <select name="title" class="form-control form-select select2"
                                                        id="title">
                                                        <option value="Mr."
                                                            {{ $member?->partner_member?->title == 'Mr.' ? 'selected' : '' }}>
                                                            Mr.</option>
                                                        <option value="Mrs."
                                                            {{ $member?->partner_member?->title == 'Mrs.' ? 'selected' : '' }}>
                                                            Mrs.</option>
                                                        <option value="Miss."
                                                            {{ $member?->partner_member?->title == 'Miss.' ? 'selected' : '' }}>
                                                            Miss.</option>
                                                        <option value="Ms."
                                                            {{ $member?->partner_member?->title == 'Ms.' ? 'selected' : '' }}>
                                                            Ms.</option>
                                                        <option value="Dr."
                                                            {{ $member?->partner_member?->title == 'Dr.' ? 'selected' : '' }}>
                                                            Dr.</option>
                                                        <option value="Sir."
                                                            {{ $member?->partner_member?->title == 'Sir.' ? 'selected' : '' }}>
                                                            Sir.</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5 my-2">
                                                    <label class="form-control-label">Given name: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="given_name" name="given_name"
                                                        value="{{ $member?->partner_member?->given_name }}"
                                                        placeholder="Enter given name" required="" type="text">
                                                </div>
                                                <div class="col-md-5 my-2">
                                                    <label class="form-control-label">Family Name: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="family_name" name="family_name"
                                                        value="{{ $member?->partner_member?->family_name }}"
                                                        placeholder="Enter Family name" required=""
                                                        type="text">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Preferred Name: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="preferred_name"
                                                        name="preferred_name"
                                                        value="{{ $member?->partner_member?->preferred_name }}"
                                                        placeholder="Enter Preferred Name" required=""
                                                        type="text">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Date of Birth: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="date_of_birth"
                                                        name="date_of_birth"
                                                        value="{{ $member?->partner_member?->date_of_birth }}"
                                                        placeholder="Enter Date of Birth" required=""
                                                        type="date">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Gender: <span
                                                            class="tx-danger">*</span></label>
                                                    <select name="gender" class="form-control form-select select2"
                                                        id="gender">
                                                        @forelse ($genders as $gender)
                                                            <option value="{{ $gender->id }}"
                                                                @if ($member?->partner_member?->gender == $gender->id)  @endif>
                                                                {{ ucwords($gender->name) }}</option>
                                                        @empty
                                                            <option value="">Select option</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Number & Street: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="number_street"
                                                        name="number_street"
                                                        value="{{ $member?->partner_member?->number_street }}"
                                                        placeholder="Enter Number & Street" required=""
                                                        type="text">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Suburb: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="suburb" name="suburb"
                                                        value="{{ $member?->partner_member?->suburb }}"
                                                        placeholder="Enter Suburb" required="" type="text">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">State: <span
                                                            class="tx-danger">*</span></label>
                                                    <select name="state" class="form-control form-select select2"
                                                        id="state">
                                                        @forelse ($states as $state)
                                                            <option value="{{ $state?->id }}"
                                                                @if ($state?->id == $member?->partner_member?->state)  @endif>
                                                                {{ $state?->name }}</option>
                                                        @empty
                                                            <option value="">Select state</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Country: <span
                                                            class="tx-danger">*</span></label>
                                                    <select name="country" class="form-control form-select select2"
                                                        id="country">
                                                        <option value="Australia" selected>Australia</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Post Code/Zip: <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="post_code" name="post_code"
                                                        value="{{ $member?->partner_member?->post_code }}"
                                                        placeholder="Enter Post Code/Zip" required=""
                                                        type="text">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Phone (Home): <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="phone" name="phone"
                                                        value="{{ $member?->partner_member?->phone }}"
                                                        placeholder="Enter Phone (Home)" required=""
                                                        type="text">
                                                </div>
                                                <div class="col-md-6 my-2">
                                                    <label class="form-control-label">Phone (Mobile): <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" id="mobile" name="mobile"
                                                        value="{{ $member?->partner_member?->mobile }}"
                                                        placeholder="Enter Phone (Mobile)" required=""
                                                        type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="crud"></div>
@section('scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
