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
                            <h3 class="card-title">View Journey</h3>
                            <div>
                                <a class="btn btn-success mr-2" href="{{ url()->current() }}/edit">
                                    <i class="pe-7s-pen btn-icon-wrapper" style="font-size:20px;"> Edit</i>
                                </a>
                                <a class="btn btn-info" href="{{ route('mode-of-arrivals.index') }}">
                                    <i class="fa fa-arrow-circle-left" style="font-size:20px;"> Back</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Ship</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival->ship->name_of_ship }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Arrival Year</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival->year ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Country</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival->country->name ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">County</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival->county->name ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">City</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival->city_id ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Departure Date</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @php
                                                            $year = $modeOfArrival->year_of_departure ?? '';
                                                            $month = $modeOfArrival->month_of_departure ?? '';
                                                            $day = $modeOfArrival->date_of_departure ?? '';
                                            
                                                            $date = $year;
                                            
                                                            if ($month) {
                                                                $date .= '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                                                            }
                                            
                                                            if ($day) {
                                                                $date .= '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                            }
                                                        @endphp
                                            
                                                        <input class="form-control" value="{{ $date }}" readonly disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Arrived Place in SA</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival->port->name ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Arrival Date in SA</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @php
                                                            $year = $modeOfArrival->year_of_arrival ?? '';
                                                            $month = $modeOfArrival->month_of_arrival ?? '';
                                                            $day = $modeOfArrival->date_of_arrival ?? '';
                                            
                                                            $date = $year;
                                            
                                                            if ($month) {
                                                                $date .= '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                                                            }
                                            
                                                            if ($day) {
                                                                $date .= '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                            }
                                                        @endphp
                                            
                                                        <input class="form-control" value="{{ $date }}" readonly disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <label class="col-md-3 form-label">Ship Commander</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="{{ $modeOfArrival?->ship_commander ?? '' }}" readonly disabled>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Embarkation Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{ $modeOfArrival?->embarkation_number ?? '' }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Notes</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="4" readonly disabled>{{ $modeOfArrival?->notes  ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-3 form-label">Ports of Call</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="4" readonly disabled> {{ $modeOfArrival?->ports_of_call ?? '' }} </textarea>
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
    var dt_ship_elem = $("#ship-table")
        , dt_ship = "";
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
            showOtherMonths: true
            , selectOtherMonths: true
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
