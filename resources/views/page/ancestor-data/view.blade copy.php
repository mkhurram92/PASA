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
                            <h3 class="card-title">Pioneer Ancestor Details</h3>
                            <div>
                                <a class="btn btn-success mr-2" href="{{ url()->current() }}/edit">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>
                                <a class="btn btn-info" href="{{ route('ancestor-data.index') }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <label class="col-md-4 form-label">Pioneer’s Family Name<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="ANCESTOR SURNAME"
                                                    value="{{ $ancestor?->ancestor_surname }}" disabled readonly
                                                    name="ancestor_surname">
                                            </div>
                                        </div>
                                        <!--<div class="row mb-3">
                                            <label class="col-md-3 form-label">MAIDEN SURNAME</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="MAIDEN SURNAME"
                                                    value="{{ $ancestor?->maiden_surname }}" disabled readonly
                                                    name="maiden_surname">

                                            </div>
                                        </div>-->
                                        <div class="row mb-3">
                                            <label class="col-md-4 form-label">Pioneer’s Given Name(s)<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" placeholder="Given Name"
                                                    value="{{ $ancestor?->given_name }}" disabled readonly
                                                    name="given_name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Birth Date</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Birth Date"
                                                    value="{{ $ancestor?->date_of_birth }}" disabled readonly
                                                    name="date_of_birth">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Birth Place</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Birth Place"
                                                    value="" disabled readonly
                                                    name="place_of_birth">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Death Date</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Death Date"
                                                    value="{{ $ancestor?->date_of_death }}" disabled readonly
                                                    name="date_of_death">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Death Place</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    placeholder="Death Place"
                                                    value="" disabled readonly
                                                    name="place_of_death">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 form-label">Mode of Arrival <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Mode of Travel"
                                                    value="{{ $ancestor?->sourceOfArrival?->name }}" disabled readonly>
                                            </div>
                                        </div>
                                        @if ($ancestor->source_of_arrival == 1)
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Voyage <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Voyage"
                                                        value="{{ $ancestor?->Voyage?->ship?->name_of_ship . '-' . $ancestor?->Voyage?->year }}"
                                                        disabled readonly>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row mb-3">
                                            <label class="col-md-3 form-label">Mode of Arrival <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Mode of Travel"
                                                    value="{{ $ancestor?->mode_of_travel?->ship?->name_of_ship . ' - ' . $ancestor?->mode_of_travel?->year }}"
                                                    disabled readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">From <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="From"
                                                    value="{{ $ancestor?->county?->name }}" disabled readonly
                                                    name="from">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">First Date <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="First Date"
                                                    value="{{ $ancestor?->first_date }}" disabled readonly
                                                    name="first_date">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Country of Origin <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Country of Origin"
                                                    value="{{ $ancestor?->departureCountry?->name }}" disabled
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">County of Origin <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="County of Origin"
                                                    value="{{ $ancestor?->county?->name }}" disabled readonly>

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">City of Origin <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="City of Origin"
                                                    value="{{ $ancestor?->departureCity?->name }}" disabled readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Address of Origin <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Address of Origin"
                                                    value="{{ $ancestor?->departure_full_address }}" disabled
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Birth Date</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Date of Birth"
                                                    value="{{ $ancestor?->date_of_birth }}" disabled readonly
                                                    name="date_of_birth">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Notes</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="2" placeholder="Notes" disabled readonly name="notes">{{ $ancestor?->notes }}</textarea>

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Emigrant No</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Emigrant No"
                                                    value="{{ $ancestor?->emigrant_no }}" disabled readonly
                                                    name="emigrant_no">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Occupation</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" placeholder="Occupation"
                                                    value="{{ $ancestor?->occupation_relation?->name ?? 'N/A' }}"
                                                    disabled readonly name="occupation">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Arrival Country <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Arrival Country"
                                                    value="{{ $ancestor?->arrivalCountry?->name ?? 'N/A' }}" disabled
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Arrival Postcode <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text"
                                                    placeholder="Arrival Postcode"
                                                    value="{{ $ancestor?->arrival_postcode ?? 'N/A' }}" disabled
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Arrival Full Address <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="3" placeholder="Address" name="arrival_full_address" disabled readonly>{{ $ancestor?->arrival_full_address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        })
    </script>
@endsection
<!-- app-content end-->
@include('layout.footer')
