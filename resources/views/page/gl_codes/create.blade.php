<!-- resources/views/page/gl_codes/create.blade.php -->

@include('layout.header')
@include('layout.sidebar')

<!-- app-content start-->
<div class="app-content main-content">
    <div class="side-app">
        <style>
            /* Increase the size of the day cells */
            .ui-datepicker-calendar td {
                font-size: 22px;
                /* Adjust the padding as needed */
            }

            .ui-datepicker-calendar a {
                font-size: 22px !important;

                /* Adjust the padding as needed */
            }

            /* Increase the size of the month/year dropdowns */
            .ui-datepicker select.ui-datepicker-year,
            .ui-datepicker select.ui-datepicker-month {
                font-size: 22px;
                /* Adjust the font size as needed */
            }

            .ui-datepicker-calendar {
                width: 300px;
                height: 300px;
                /* Set the height to 100% */
            }
        </style>
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
                        <form class="form-horizontal" id="gl_save_form" action="{{ route('gl_codes.store') }}"
                            method="POST">
                            @csrf
                            <div class="card-header justify-content-between">
                                <h3 class="card-title">Create G/L Code</h3>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-block" id="submitBtn">
                                        Save G/L Code
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">GL Name<span
                                                        class="text-danger"></span></label>

                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" placeholder="GL Name"
                                                        value="" id="name" name="name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label">Parent G/L Name<span
                                                        class="text-danger"></span></label>

                                                <div class="col-md-9">
                                                    <select name="parent_id" id="parent_id" class="form-control"
                                                        required>
                                                        <option value=""></option>
                                                        @foreach ($parentGlCodes as $parentGlCode)
                                                            <option value="{{ $parentGlCode->id }}">
                                                                {{ $parentGlCode->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 row">
                                                <label class="col-md-3 form-label" for="description">Description<span
                                                        class="text-danger"></span></label>

                                                <div class="col-md-9">
                                                    <textarea name="description" id="description" class="form-control"></textarea>
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
@section('scripts')
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Submit the form using AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('gl_codes.store') }}',
                data: $('#gl_save_form').serialize(),
                dataType: 'json',
                success: function(response) {
                    // Check if the submission was successful
                    if (response.status) {
                        // Show SweetAlert for success
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            timer: 10000,
                            timerProgressBar: true,
                        }).then((result) => {
                            // Redirect if needed
                            if (response.redirectTo) {
                                window.location.href = response.redirectTo;
                            }
                        });
                    } else {
                        // Show SweetAlert for failure with detailed error message
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            //timer: 10000,
                            //timerProgressBar: true,
                        }).then(() => {
                            // Check if there is a specific exception message
                            let exceptionMessage = "";
                            if (response.exception) {
                                exceptionMessage = response.exception;
                            }

                            // Show additional alert with exception (if available)
                            if (exceptionMessage) {
                                Swal.fire({
                                    title: 'Exception Details',
                                    html: `<p>${exceptionMessage}</p>`,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK',
                                });
                            }
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle AJAX error and get detailed error message
                    let errorMessage = "An error occurred while processing your request.";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.statusText) {
                        errorMessage = xhr.statusText;
                    }

                    // Show SweetAlert for AJAX error with specific error message
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        //timer: 10000,
                        //timerProgressBar: true,
                    });
                }
            });
        });
    </script>

    @include('layout.footer')
