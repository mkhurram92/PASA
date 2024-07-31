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
                        <form id="journey-form" class="form-horizontal" action="{{ route('mode-of-arrivals.store') }}"
                            method="POST">
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Add a Journey</h3>

                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary btn-block"
                                        data-bs-effect="effect-slide-in-right" value="Save Journey">

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ship <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="ship_select2"
                                                        name="ship_id">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Year </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="YYYY"
                                                        value="" name="year">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Country </label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" id="countries_select2"
                                                        name="country_id"></select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">County </label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" placeholder="Select item"
                                                        id="counties_select2" name="county_id"></select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">City </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" placeholder="City" type="text"
                                                        name="city_id">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Departure Date </label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY"
                                                                type="text" name="year_of_departure">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <select class="form-control month-select"
                                                                name="month_of_departure"></select>
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <select class="form-control day-select"
                                                                name="date_of_departure"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrived Place in SA </label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" name="arrived_at"
                                                        id="arrived_at_select2">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Arrival Date in SA </label>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <input class="form-control" placeholder="YYYY"
                                                                value="" type="text" name="year_of_arrival">
                                                        </div>
                                                        <div class="col-4 px-1">
                                                            <select class="form-control month-select"
                                                                name="month_of_arrival"></select>
                                                        </div>
                                                        <div class="col-4 pl-1">
                                                            <select class="form-control day-select"
                                                                name="date_of_arrival"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class="col-md-3 form-label">Ship Commander </label>

                                                <div class="col-md-9">
                                                    <input class="form-control" type="text"
                                                        placeholder="Ship Commander" name="ship_commander">

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Embarkation Number </label>

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control"
                                                        placeholder="Embarkation Number" name="embarkation_number">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Notes</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="4" placeholder="Notes" name="notes"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Ports of Call </label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" rows="4" placeholder="Ports of Call" name="ports_of_call"></textarea>
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
        </div>
    </div>
</div>

<!-- MODAL EFFECTS -->
<div id="crud"></div>
@section('scripts')
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    @include('plugins.select2')
    <script>
        initMonthSelect2();
        initDaySelect2();

        $(document).ready(function() {

            // Handle form submission via AJAX
            $('#journey-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK',
                                timer: 10000,
                                timerProgressBar: true,
                            }).then((result) => {
                                if (response.redirectTo) {
                                    window.location.href = response.redirectTo;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        // Extract error message from response
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message :
                            'An unexpected error occurred. Please try again later.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
    @include('page.mode-of-arrivals.scripts')
@endsection
<!-- app-content end-->
@include('layout.footer')
