<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Pioneers" name="description">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('/favicons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>Pioneers Association of South Australia</title>

    <!-- Favicon -->
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

    <!-- Icons css -->
    <link href="{{ asset('plugins/web-fonts/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet" />

    <!-- Custom css -->
    <style>
        .login-page {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }

        .login-card .input-group {
            margin-bottom: 20px;
        }

        .login-card .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .login-card .btn-link {
            color: #007bff;
        }

        .login-card .form-control {
            border-radius: 0.25rem;
        }
    </style>
</head>

<body class="main-body light-mode ltr page-style1 error-page bg4">
    <div class="login-page">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" style="width: 150px;">
            </div>
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
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="form-group text-center">
                    <a href="forgot-password-1.html" class="btn btn-link">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery js -->
    <script src="{{ asset('js/vendors/jquery.min.js') }}"></script>

    <!-- Bootstrap5 js -->
    <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Othercharts js -->
    <script src="{{ asset('plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!-- Circle-progress js -->
    <script src="{{ asset('js/vendors/circle-progress.min.js') }}"></script>

    <!-- jQuery-rating js -->
    <script src="{{ asset('plugins/rating/jquery.rating-stars.js') }}"></script>

    <!-- P-scroll js -->
    <script src="{{ asset('plugins/p-scrollbar/p-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('js/themeColors.js') }}"></script>

    <!-- Switcher-Styles js -->
    <script src="{{ asset('js/switcher-styles.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
