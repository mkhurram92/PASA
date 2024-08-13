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
    <title>Reset Password - Pioneers SA</title>

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
        .login-container {
            display: flex;
            min-height: 100vh;
        }

        .login-form {
            width: 50%;
            display: flex;
            flex-direction: column; /* Ensure form elements stack vertically */
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: #f8f9fa;
            position: relative;
            z-index: 1;
        }

        .login-info {
            background-color: #505151; /* Dark background color */
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .login-info div {
            position: relative;
            z-index: 1;
        }

        .login-info img {
            max-width: 80%;
        }

        .login-form form {
            width: 100%;
            max-width: 400px;
        }

        .login-form .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .login-form .btn-link {
            color: #007bff;
        }

        .login-form .form-control {
            border-radius: 0.25rem;
        }
    </style>
</head>

<body class="main-body light-mode ltr page-style1 error-page bg4">
    <div class="login-container">
        <div class="login-form">
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
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email) }}" required autocomplete="email" autofocus>
                </div>
                <div class="form-group">
                    <label for="password" >{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </div>
                <div class="form-group text-center">
                    <a href="{{ route('login') }}" class="btn btn-link">Back to Login</a>
                </div>
            </form>
        </div>
        <div class="login-info">
            <div>
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" style="width: 200px; margin-bottom: 20px;">
                <h1>Forgot Password?</h1>
                <p>Forgot your password? Enter your email to receive a reset link.</p>
            </div>
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