<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pioneers SA') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap css -->
    <link id="style" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <!-- Plugin css -->
    <link href="{{ asset('css/plugin.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('/css/animated.css') }}" rel="stylesheet" />

    {{-- select 2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

    <!---Icons css-->
    <link href="{{ asset('plugins/web-fonts/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet" />
    <style>
        .row.element {
            display: flex;
            flex-wrap: wrap;
        }

        .col-sm-3 {
            width: 25%;
            box-sizing: border-box;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
        }

        .parallel-radio {
            display: flex;
            align-items: center;
        }

        .radio-label {
            margin-right: 10px;
        }

        .input-group {
            width: 100%;
            box-sizing: border-box;
        }
    </style>
    @yield('head')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="row w-100">
                    <div class="col-md-3 d-flex align-items-center">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <h2 class="mb-0">@yield('title')</h2>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-center">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}"
                                class="w-20" alt="Pioneers SA">
                        </a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </nav>        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Jquery js-->
    <script src="{{ asset('js/vendors/jquery.min.js') }}"></script>

    <!-- Bootstrap5 js-->
    <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Jquery.steps js -->
    <script src="{{ asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Select2 js -->
    {{-- <script src="{{ asset('js/select2.js') }}"></script> --}}
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Sweet alert js -->
    <script src="{{ asset('plugins/sweet-alert/jquery.sweet-modal.min.js') }}"></script>
    <script src="{{ asset('plugins/sweet-alert/sweetalert.min.js') }}"></script>

    <!-- Index js-->
    {{-- <script src="{{ asset('js/index1.js') }}"></script> --}}


    <!-- Custom js-->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/add-row.js') }}"></script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(x, status, error) {
                if (x.status == 401) {
                    $.growl.error({
                        message: "Session expired! Please login"
                    });
                } else if (x.status == 403) {
                    $.growl.error({
                        message: "You are not authorized to access this area"
                    });
                } else if (x.status == 422) {
                    const errors = parseErrorsIntoArray(x.responseJSON);
                    $.each(errors, (i, errorMsg) => {
                        $.growl.error({
                            message: errorMsg
                        });
                    })
                } else if (x.status == 500) {
                    $.growl.error({
                        message: "Unknown error occurred"
                    });
                } else if (x.status == 404) {
                    $.growl.error({
                        message: "Resource not found"
                    });
                }
            }
        });
        const parseErrorsIntoArray = errorObject => {
            let errors = [];
            $.each(errorObject.errors, (i, error) => {
                if ($.isArray(error) && error.length > 0) {
                    $.each(error, (j, errorMsg) => {
                        if ($.trim(errorMsg) != "") {
                            errors.push(errorMsg);
                        }
                    })
                } else {
                    if ($.trim(error) != "") {
                        errors.push(error);
                    }
                }
            })
            return errors;
        }
        $(document).on("click", "#logout", function(e) {
            e.preventDefault();
            $(e.target).parents("form")[0].submit();
        })
        $(document).on("submit", "form", function(e) {
            e.preventDefault();
            $.ajax($(e.target).attr("action"), {
                    type: "POST",
                    data: $(e.target).serialize(),
                })
                .done(res => {
                    if (res?.status && res?.message) {
                        $.growl.notice({
                            title: "",
                            message: res?.message
                        });
                        if (res?.redirectTo) {
                            window.location.href = res?.redirectTo;
                        }

                        $('#crud').find(".modal").modal('hide');
                    }
                })
        })
        window.addEventListener("DOMContentLoaded", function() {
            try {
                $.fn.select2.defaults.set("allowClear", true);
                $.fn.select2.defaults.set("placeholder", "Select item");
                $(document).on("click", ".close-modal", function(e) {
                    $(e.target).parents(".modal").modal("hide");
                })

            } catch (error) {
                console.log(error);
            }

        })
    </script>

    @yield('scripts')
</body>

</html>
