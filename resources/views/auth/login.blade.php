<!DOCTYPE htmllang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Pioneers" name="description">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('/favicons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>Pioneers</title>

    <!--Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{asset('/favicons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('/favicons/favicon.ico') }}">


    <!-- Bootstrap css -->
    <link id="style" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <!-- Plugin css -->
    <link href="{{ asset('css/plugin.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('css/animated.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('plugins/web-fonts/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet" />

</head>

<body class="main-body light-mode ltr page-style1 error-page bg4">


    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row justify-content-center mt-7 mt-sm-0">
                    <div class="col-lg-10">
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
                        <div class="card-group mb-0">
                            <div class="card p-4 page-content">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="card-body page-single-content">
                                        <div class="w-100">
                                            <div class="">
                                                <h1 class="mb-2">Login</h1>
                                                <p class="text-muted">Sign In to your account</p>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3" />
                                                        <circle cx="12" cy="8" opacity=".3" r="2" />
                                                        <path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" /></svg></span>
                                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            </div>
                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                        <g fill="none">
                                                            <path d="M0 0h24v24H0V0z" />
                                                            <path d="M0 0h24v24H0V0z" opacity=".87" />
                                                        </g>
                                                        <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3" />
                                                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                                                    </svg></span>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="submit" role="button" class="btn btn-lg btn-primary btn-block" value="{{ __('Login') }}">
                                                </div>
                                                <div class="col-12">
                                                    <a href="forgot-password-1.html" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card text-white bg-primary py-5 d-none d-lg-block page-content mt-0">
                                <div class="card-body text-center justify-content-center page-single-content">
                                    <img src="{{ asset("images/pattern/login.png") }}" alt="img">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="text-center pt-4">
                            <div class="font-weight-normal fs-16">You Don't have an account <a class="btn-link font-weight-normal" href="register-3.html">Register Here</a></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery js-->
    <script src="{{ 'js/vendors/jquery.min.js' }}"></script>

    <!-- Bootstrap5 js-->
    <script src="{{ 'plugins/bootstrap/js/popper.min.js' }}"></script>
    <script src="{{ 'plugins/bootstrap/js/bootstrap.min.js' }}"></script>

    <!--Othercharts js-->
    <script src="{{ 'plugins/othercharts/jquery.sparkline.min.js' }}"></script>

    <!-- Circle-progress js-->
    <script src="{{ 'js/vendors/circle-progress.min.js' }}"></script>

    <!-- Jquery-rating js-->
    <script src="{{ 'plugins/rating/jquery.rating-stars.js' }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('plugins/p-scrollbar/p-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('js/themeColors.js') }}"></script>

    <!-- Switcher-Styles js -->
    <script src="{{ asset('js/switcher-styles.js') }}"></script>

    <!-- Custom js-->
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
