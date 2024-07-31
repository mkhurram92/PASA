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
                        <form class="form-horizontal" action="{{ route("mode-of-arrivals.update",["mode_of_arrival"=>$modeOfArrival?->id]) }}" method="POST">
                            @method("PUT")
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Update Journey</h3>
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-block" data-bs-effect="effect-slide-in-right" value="Update Arrival">
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ship <span class="text-danger">*</span></label>

                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="ship_select2" name="ship_id">
                                                        <option value="{{ $modeOfArrival?->ship?->id }}" selected>{{ $modeOfArrival?->ship?->name_of_ship }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Year </label>

                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="YYYY" value="{{ $modeOfArrival?->year }}" name="year">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Country  </label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="countries_select2" name="country_id">
                                                        @if (!empty($modeOfArrival?->country?->id))
                                                        <option value="{{ $modeOfArrival?->country?->id }}" selected>{{ $modeOfArrival?->country?->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">County  </label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="counties_select2" name="county_id">
                                                        @if (!empty($modeOfArrival?->county?->id))
                                                        <option value="{{ $modeOfArrival?->county?->id }}" selected>{{ $modeOfArrival?->county?->name }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">City  </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" value="{{  $modeOfArrival?->city_id }}" type="text" name="city_id">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Departure Date</label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY" value="{{ $modeOfArrival ? $modeOfArrival->year_of_departure : '' }}" type="text" name="year_of_departure">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <input class="form-control" placeholder="MM" value="{{ $modeOfArrival && $modeOfArrival->month_of_departure ? sprintf('%02d', $modeOfArrival->month_of_departure) : '' }}" type="text" name="month_of_departure">
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <input class="form-control" placeholder="DD" value="{{ $modeOfArrival && $modeOfArrival->date_of_departure ? sprintf('%02d', $modeOfArrival->date_of_departure) : '' }}" type="text" name="date_of_departure">
                                                        </div>
                                                    </div>
                                                </div>
                                                                                            
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrived At  </label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" name="arrived_at" id="arrived_at_select2">
                                                        <option value="{{ $modeOfArrival?->port?->id }}" selected>{{ $modeOfArrival?->port?->name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Date </label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY" value="{{ $modeOfArrival ? $modeOfArrival->year_of_arrival : '' }}" type="text" name="year_of_arrival">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <input class="form-control" placeholder="MM" value="{{ $modeOfArrival && $modeOfArrival->month_of_arrival ? sprintf('%02d', $modeOfArrival->month_of_arrival) : '' }}" type="text" name="month_of_arrival">
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <input class="form-control" placeholder="DD" value="{{ $modeOfArrival && $modeOfArrival->date_of_arrival ? sprintf('%02d', $modeOfArrival->date_of_arrival) : '' }}" type="text" name="date_of_arrival">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class="col-md-3 form-label">Ship Commander  </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="Ship Commander" value="{{ $modeOfArrival?->ship_commander }}" name="ship_commander">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Embarkation Number  </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Embarkation Number" value="{{ $modeOfArrival?->embarkation_number }}" name="embarkation_number">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="3" placeholder="Notes" name="notes">{{ $modeOfArrival?->notes }}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ports of Call  </label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="3" placeholder="Ports of call" name="ports_of_call">{{ $modeOfArrival?->ports_of_call }} </textarea>
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
@include("page.mode-of-arrivals.scripts")
@endsection
<!-- app-content end-->
@include('layout.footer')
