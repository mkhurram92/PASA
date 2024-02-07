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
                        <form class="form-horizontal" action="{{ route("ancestor-data.update",["ancestor_datum"=>$ancestor?->id]) }}" method="POST">
                            @method("PUT")
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Update an Ancestor Details</h3>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-block" data-bs-effect="effect-slide-in-right" value="Save Ancestor Details">
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Gender <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="gender_select2" name="gender">
                                                        @if (!empty($ancestor?->Gender?->id))
                                                        <option value="{{ $ancestor?->Gender?->id }}" selected>{{ $ancestor?->Gender?->name}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 form-label">ANCESTOR SURNAME <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control uppercase" id="ancestor_surname" type="text" placeholder="ANCESTOR SURNAME" value="{{ $ancestor?->ancestor_surname }}" name="ancestor_surname">
                                                </div>
                                            </div>
                                            <div class="row mb-3" style="display: none" id="maiden_surname_container">

                                                <label class="col-md-3 form-label">MAIDEN SURNAME</label>
                                                <div class="col-md-9">
                                                    <input class="form-control uppercase" type="text" placeholder="MAIDEN SURNAME" value="{{ $ancestor?->maiden_surname }}" id="maiden_surname" name="maiden_surname">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 form-label">Given Name <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Given Name" value="{{ $ancestor?->given_name }}" name="given_name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Source of Arrival <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="source_of_arrival_select2" name="source_of_arrival">
                                                        @if (!empty($ancestor?->sourceOfArrival?->id))
                                                        <option value="{{ $ancestor?->sourceOfArrival?->id }}" selected>{{ $ancestor?->sourceOfArrival?->name}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Mode of Travel <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="mode_of_arrival_select2" name="mode_of_travel_native_bith">
                                                        @if (!empty($ancestor?->mode_of_travel?->id))
                                                        <option value="{{ $ancestor?->mode_of_travel?->id }}" selected>{{ $ancestor?->mode_of_travel?->ship?->name_of_ship ." - ".$ancestor?->mode_of_travel?->year }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Date of Arrival <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control fc-datepicker" type="text" placeholder="Date of Arrival" value="{{ $ancestor?->first_date }}" id="first_date" name="first_date" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Country of Origin <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="countries_select2" name="departure_country">
                                                        @if (!empty($ancestor?->departureCountry?->id))
                                                        <option value="{{ $ancestor?->departureCountry?->id }}" selected>{{ $ancestor?->departureCountry?->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">County of Origin <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="counties_select2" name="from">
                                                        @if (!empty($ancestor?->county?->id))
                                                        <option value="{{ $ancestor?->county?->id }}" selected>{{ $ancestor?->county?->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">City of Origin <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" placeholder="Select item" id="cities_select2" name="departure_city">
                                                        @if (!empty($ancestor?->departureCity?->id))
                                                        <option value="{{ $ancestor?->departureCity?->id }}" selected>{{ $ancestor?->departureCity?->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Address of Origin </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Address" value="{{ $ancestor?->departure_full_address }}" name="departure_full_address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Date of Birth</label>
                                                <div class="col-md-9">
                                                    <input class="form-control fc-datepicker" type="text" placeholder="Date of Birth" value="{{ $ancestor?->date_of_birth }}" name="date_of_birth">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="3" placeholder="Notes" name="notes">{{ $ancestor?->notes }}</textarea>

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Emigrant No</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Emigrant No" value="{{ $ancestor?->emigrant_no }}" name="emigrant_no">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Occupation</label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="occupation_select2" name="occupation">
                                                        @if (!empty($ancestor?->occupation_relation?->id))
                                                        <option value="{{ $ancestor?->occupation_relation?->id }}">{{ $ancestor?->occupation_relation?->name }}</option>
                                                        @endif
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
                                                <label class="col-md-3 form-label">States <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="states_select2" name="arrival_state">
                                                        @if (!empty($ancestor?->States?->id))
                                                        <option value="{{ $ancestor?->States?->id }}">{{ $ancestor?->States?->name }}</option>
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
                                                <label class="col-md-3 form-label">Arrival Address <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Arrival Address" value="{{ $ancestor?->arrival_full_address }}" name="arrival_full_address">
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
    var dt_ship_elem = $("#ship-table")
        , dt_ship = "";
</script>
@include("page.ancestor-data.scripts")
@endsection
<!-- app-content end-->
@include('layout.footer')
