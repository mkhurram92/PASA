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
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Gender<span class="text-danger">
                                                </span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $ancestor?->Gender?->name }}" name="gender" readonly
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-4 form-label">Pioneer’s Family Name<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{ $ancestor?->ancestor_surname }}" disabled readonly
                                                    name="ancestor_surname">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-4 form-label">Pioneer’s Given Name<span
                                                    class="text-danger"></span></label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{ $ancestor?->given_name }}" disabled readonly
                                                    name="given_name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-4 form-label">Pioneer's Preferred Name</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text"
                                                    value="{{ $ancestor?->maiden_surname }}" disabled readonly
                                                    name="maiden_surname">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Birth Date</label>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @php
                                                            $year = $ancestor?->year_of_birth ?? '';
                                                            $month = $ancestor?->month_of_birth ?? '';
                                                            $day = $ancestor?->date_of_birth ?? '';
                                            
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
                                            <label class="col-md-4 form-label">Birth Place</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" disabled readonly name="place_of_birth">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-4 form-label">Death Date</label>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @php
                                                            $year = $ancestor?->year_of_death ?? '';
                                                            $month = $ancestor?->month_of_death ?? '';
                                                            $day = $ancestor?->date_of_death ?? '';
                                            
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
                                            <label class="col-md-4 form-label">Death Place</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" disabled readonly name="place_of_death">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header justify-content-between">
                                        <h3 class="card-title"></h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h3 class="card-title">Pioneer Journey Details</h3>
                                                <div class="row mb-3">
                                                    <label class="col-md-4 form-label">Mode of Travel to South
                                                        Australia<span class="text-danger"></span></label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" value="{{ $ancestor?->sourceOfArrival?->name }}" disabled
                                                            readonly>
                                                    </div>
                                                </div>
                                                @if ($ancestor->source_of_arrival == 1 || $ancestor->source_of_arrival == 2)
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Ship Name - Arrival Year<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" 
                                                            value="{{ $ancestor?->mode_of_travel?->ship?->name_of_ship . ' - ' . $ancestor?->mode_of_travel?->year }}"
                                                                disabled readonly>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    // Assuming these values come from your model or database
                                                    $date_of_arrival = $ancestor?->mode_of_travel?->date_of_arrival;
                                                    $month_of_arrival = $ancestor?->mode_of_travel?->month_of_arrival;
                                                    $year_of_arrival = $ancestor?->mode_of_travel?->year_of_arrival;
                                                    
                                                    // Initialize the result
                                                    $formatted_date = null;
                                                    
                                                    // Check the conditions and format the date accordingly
                                                    if ($year_of_arrival) {
                                                        if ($month_of_arrival) {
                                                            if ($date_of_arrival) {
                                                                $formatted_date = sprintf('%04d-%02d-%02d', $year_of_arrival, $month_of_arrival, $date_of_arrival);
                                                            } else {
                                                                $formatted_date = sprintf('%04d-%02d', $year_of_arrival, $month_of_arrival);
                                                            }
                                                        } else {
                                                            $formatted_date = sprintf('%04d', $year_of_arrival);
                                                        }
                                                    }
                                                    ?>
                                                    <div class="row mb-3">
                                                        <label class="col-md-4 form-label">Arrival Date in SA<span class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" value="{{ $formatted_date }}" disabled readonly>
                                                        </div>
                                                    </div>                                                    
                                                    <!--<div class="row mb-3">
                                                        <label class="col-md-4 form-label">Arrival Port in SA<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" value="{{ $ancestor?->mode_of_travel?->port?->name }}"
                                                                disabled readonly>
                                                        </div>
                                                    </div>-->
                                                @else
                                                    <div class="mb-3 row">
                                                        <label class="col-md-4 form-label">Arrivals Date in SA<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" value="{{ $ancestor?->localTravelDetails?->travel_date }}"
                                                                disabled readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-md-4 form-label">Arrival Evidence<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" rows="5" disabled readonly>{{ $ancestor?->localTravelDetails?->description }}</textarea>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <h3 class="card-title">Pioneer Spouse’s Details</h3>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Marriage Date<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text" 
                                                            value="{{ $ancestor?->spouse_details?->marriage_date }}"
                                                                id="marriage_date" name="marriage_date" disabled
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Marriage Place<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="marriage_place" name="marriage_place"
                                                            value="{{ $ancestor?->spouse_details?->marriage_place }}" disabled readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Spouse’s Family Name<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" id="spouse_family_name" name="spouse_family_name"
                                                                value="{{ $ancestor?->spouse_details?->spouse_family_name }}"
                                                                disabled readonly> 
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Spouse’s Given Name(s)<span
                                                                class="text-danger"></span></label>

                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" value="{{ $ancestor?->spouse_details?->spouse_given_name }}"
                                                                id="spouse_given_name" name="spouse_given_name"
                                                                disabled readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Birth Date</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text" value="{{ $ancestor?->spouse_details?->spouse_birth_date }}"
                                                                name="spouse_date_of_birth" disabled readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Birth Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="spouse_place_of_birth" disabled readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Death Date</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control fc-datepicker" type="text" value="{{ $ancestor?->spouse_details?->spouse_death_date }}"
                                                                name="spouse_date_of_death"  disabled readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 form-label">Death Place</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="spouse_place_of_death" disabled readonly>
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

            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd',
                changeMonth:true, // Customize the date format as needed
                changeYear: true,
                yearRange: 'c-2000:c+nn'
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
