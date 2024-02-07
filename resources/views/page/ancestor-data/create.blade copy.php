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
                                                <label class="col-md-4 form-label">Gender <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" id="gender_select2"
                                                        name="gender">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Family Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control uppercase" type="text"
                                                        placeholder="Pioneer's Family Name" value=""
                                                        name="ancestor_surname">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 form-label">Pioneer's Given Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text"
                                                        placeholder="Pioneer's Given Name" value=""
                                                        name="given_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Date</label>
                                                <div class="col-md-8">
                                                    <input class="form-control fc-datepicker" type="text"
                                                        placeholder="Birth Date" value="" name="date_of_birth">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Birth Place</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Birth Place"
                                                        value="" name="place_of_birth">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Death Date</label>
                                                <div class="col-md-8">
                                                    <input class="form-control fc-datepicker" type="text"
                                                        placeholder="Death Date" value="" name="date_of_death">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-4 form-label">Death Place</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" placeholder="Death Place"
                                                        value="" name="place_of_death">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header justify-content-between">
                                            <h3 class="card-title">Pioneer Journey Details</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Mode of Travel to South
                                                            Australia<span class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2"
                                                                id="source_of_arrival_select2" name="source_of_arrival">
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Ship Name<span
                                                                class="text-danger">*</span></label>

                                                        <div class="col-md-9">
                                                            <select class="form-control select2"
                                                                id="mode_of_arrival_select2"
                                                                name="mode_of_travel_native_bith">
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Arrival Date in SA<span
                                                                class="text-danger">*</span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text"
                                                                placeholder="First Date" value="01/01/1750"
                                                                id="first_date" name="first_date" readonly disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Country of Origin <span
                                                                class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2"
                                                                id="countries_select2"
                                                                name="departure_country"></select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">County of Origin <span
                                                                class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2"
                                                                placeholder="Select item" id="counties_select2"
                                                                name="from"></select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">City of Origin <span
                                                                class="text-danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2"
                                                                placeholder="Select item" id="cities_select2"
                                                                name="departure_city"></select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Address of Origin </label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text"
                                                                placeholder="Address of Origin" value=""
                                                                name="departure_full_address">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-md-3 form-label">Notes</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" rows="2" placeholder="Notes" name="notes"></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-3 form-label">Emigrant No</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="text"
                                                            placeholder="Emigrant No" value=""
                                                            name="emigrant_no">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-3 form-label">Occupation</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control select2" id="occupation_select2"
                                                            name="occupation">
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Country <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="arrival_countries_select2" name="arrival_country">
                                                    </select>
                                                </div>
                                            </div> --}}
                                                <div class="mb-3 row">
                                                    <label class="col-md-3 form-label">States <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <select class="form-control select2" id="states_select2"
                                                            name="arrival_state">
                                                            @if (!empty($defaultState))
                                                                <option value="{{ $defaultState?->id }}" selected>
                                                                    {{ $defaultState?->name }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Postcode <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Arrival Postcode" value="" name="arrival_postcode">
                                                </div>
                                            </div> --}}
                                                <div class="mb-3 row">
                                                    <label class="col-md-3 form-label">Arrival Address <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="text"
                                                            placeholder="Arrival Address" value=""
                                                            name="arrival_full_address">
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
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- MODAL EFFECTS -->
<div id="crud"></div>
@section('scripts')
    @include('plugins.select2')
    <script>
        var dt_ship_elem = $("#ship-table"),
            dt_ship = "";
    </script>
    @include('page.ancestor-data.scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
