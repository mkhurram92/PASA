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
                {{-- <div class="col-md-12"> --}}
                {{-- <a href="{{ route('JuniorForm') }}" class="btn btn-primary">Add Junior</a> --}}
                {{-- @if (empty($member?->partner_id))
                        <a href="{{ route('ParterForm') }}" class="btn btn-primary">Add Partner</a>
                    @endif --}}
                {{-- </div> --}}
            </div>
            <div class="panel panel-primary">
                <div class=" tab-menu-heading p-0 bg-light">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab5" class="active" data-bs-toggle="tab">Profile</a></li>
                            <li><a href="#tab6" data-bs-toggle="tab">Ancestor</a></li>
                            <li><a href="#tab7" data-bs-toggle="tab">Padigree</a></li>
                            {{-- @if ($juniors->isNotEmpty())
                                <li><a href="#juniorTab" data-bs-toggle="tab">Juniors</a></li>
                            @endif --}}
                            {{-- @if (!empty($member?->partner_id))
                                <li><a href="#tab8" data-bs-toggle="tab">Partner</a></li>
                            @endif --}}
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab5">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Member</h3>
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
                                                    <input class="form-control" type="text"
                                                        value="{{ $member?->email }}" readonly disabled>
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
                                                    <input class="form-control" type="text"
                                                        placeholder="Preferred Name"
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
                                                    <input class="form-control" type="text"
                                                        placeholder="Street Number"
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
                                                    <input type="text" class="form-control"
                                                        placeholder="Post Code" value="{{ $member?->post_code }}"
                                                        readonly disabled>
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
                        </div>
                        <div class="tab-pane" id="tab7">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Pedigrees</h3>
                            </div>
                            @if ($member)
                                @if (count($member?->pedigree))
                                    <div class="card-header justify-content-between">
                                        <h3 class="card-title">Pedigrees Chart</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="card-body">
                                            @foreach ($member?->pedigree as $pedigree)
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="form-control-label">Level:</label>
                                                        <input class="form-control"
                                                            value="{{ $pedigree?->pedigree_level }}" readonly disabled
                                                            type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-control-label">Father
                                                            Name:</label>
                                                        <input
                                                            class="form-control @if ($pedigree->pioneer_parents == 1) text-danger @endif"
                                                            value="{{ $pedigree?->f_name }}" required=""
                                                            type="text" readonly disabled>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-control-label">Mother
                                                            Name:</label>
                                                        <input
                                                            class="form-control
                                                    @if ($pedigree->pioneer_parents == 0) text-danger @endif"
                                                            id="email" value="{{ $pedigree?->m_name }}"
                                                            required="" type="text" readonly disabled>
                                                    </div>
                                                    @if (!is_null($pedigree?->date_of_birth))
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Date of Birth</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Date of Birth"
                                                                value="{{ $pedigree?->date_of_birth ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                    @endif
                                                    @if (!is_null($pedigree?->place_of_birth))
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Place of Birth</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Place of Birth"
                                                                value="{{ $pedigree?->place_of_birth ?? '' }}"
                                                                readonly disabled>
                                                        </div>
                                                    @endif
                                                    @if (!is_null($pedigree?->date_of_death))
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Date of Death</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Date of Death"
                                                                value="{{ $pedigree?->date_of_death ?? '' }}" readonly
                                                                disabled>
                                                        </div>
                                                    @endif
                                                    @if (!is_null($pedigree?->place_of_death))
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Place of Death</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Place of Death"
                                                                value="{{ $pedigree?->place_of_death ?? '' }}"
                                                                readonly disabled>
                                                        </div>
                                                    @endif
                                                    @if (!is_null($pedigree?->date_of_marriage))
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Date of Marriage</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Date of Marriage"
                                                                value="{{ $pedigree?->date_of_marriage ?? '' }}"
                                                                readonly disabled>
                                                        </div>
                                                    @endif
                                                    @if (!is_null($pedigree?->place_of_marriage))
                                                        <div class="col-md-2">
                                                            <label class="form-control-label">Place of Marriage</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Place of Marriage"
                                                                value="{{ $pedigree?->place_of_marriage ?? '' }}"
                                                                readonly disabled>
                                                        </div>
                                                    @endif
                                                </div>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        {{-- @if ($juniors->isNotEmpty())
                            <div class="tab-pane " id="juniorTab">
                                <table class="table table-light" id="juniorsTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Date of birth</th>
                                            <th>Gender</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($juniors as $index => $junior)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $junior->given_name ?? 'N/A' }}</td>
                                                <td>{{ $junior->date_of_birth ?? 'N/A' }}</td>
                                                <td>{{ ucwords($junior->withGender->name ?? 'N/A') }}</td>
                                                <td>{{ $junior->withSubscription?->start_date ?? 'N/A' }}</td>
                                                <td>{{ $junior->withSubscription?->end_date ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ route('JuniorSiblings', ['junior' => $junior?->id]) }}"
                                                        class="btn btn-primary btn-sm show-siblings">Siblings</a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Date of birth</th>
                                            <th>Gender</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif --}}
                        {{-- @if (!empty($member?->partner_id))
                            <div class="tab-pane " id="tab8">
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
                                                <input class="form-control" id="password" name="password"
                                                    value="" placeholder="Leave blank to use current"
                                                    type="password">
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
                                                    value="{{ $member?->partner_member?->email }}"
                                                    placeholder="Enter Email" required="" type="text">
                                            </div>
                                            <div class="col-md-4 my-2">
                                                <label class="form-control-label">Confirmation Email: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" id="email_confirmation"
                                                    name="email_confirmation"
                                                    value="{{ $member?->partner_member?->email }}"
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
                                                        <select name="title"
                                                            class="form-control form-select select2" id="title">
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
                                                            placeholder="Enter given name" required=""
                                                            type="text">
                                                    </div>
                                                    <div class="col-md-5 my-2">
                                                        <label class="form-control-label">Family Name: <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control" id="family_name"
                                                            name="family_name"
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
                                                        <select name="gender"
                                                            class="form-control form-select select2" id="gender">
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
                                                        <select name="state"
                                                            class="form-control form-select select2" id="state">
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
                                                        <select name="country"
                                                            class="form-control form-select select2" id="country">
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
                            </div>
                        @endif --}}
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
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
