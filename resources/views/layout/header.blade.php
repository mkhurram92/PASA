<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Pioneers" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>Pioneers SA</title>

    <!--Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('/favicons/favicon.ico') }}">


    <!-- Bootstrap css -->
    <link id="style" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <!-- Plugin css -->
    <link href="{{ asset('css/plugin.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('/css/animated.css') }}" rel="stylesheet" />

    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('plugins/web-fonts/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet" />

</head>

<body class="main-body app sidebar-mini light-mode ltr">

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('images/svgs/loader.svg') }}" alt="loader">
    </div>

    <div class="page">
        <div class="page-main">

            <!--app header-->
            <div class="app-header header top-header">
                <div class="container-fluid main-container">
                    <div class="d-flex">
                        <div class="dropdown side-nav">
                            <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                                <a class="open-toggle" href="javascript:void(0)">
                                    <svg class="header-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="3" y1="12" x2="21" y2="12"></line>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <line x1="3" y1="18" x2="21" y2="18"></line>
                                    </svg>
                                </a>
                                <a class="close-toggle" href="javascript:void(0)">
                                    <svg class="header-icon" xmlns="http://www.w3.org/2000/svg" height="24"
                                        viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <a class="header-brand" href="index.html">
                            <img src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}"
                                class="header-brand-img desktop-lgo" alt="Dashtic logo">
                            <img src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}"
                                class="header-brand-img dark-logo" alt="Dashtic logo">
                            <img src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}"
                                class="header-brand-img mobile-logo" alt="Dashtic logo">
                            <img src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}"
                                class="header-brand-img darkmobile-logo" alt="Dashtic logo">
                        </a>
                        <div class="d-flex order-lg-2 ms-lg-auto">
                            <button class="navbar-toggler navresponsive-toggler d-lg-none" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical "></span>
                            </button>
                            <div class="navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" data-bs-toggle="search"
                                            class="nav-link nav-link-lg d-lg-none navsearch">
                                            <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24"
                                                height="100%" width="100%" preserveAspectRatio="xMidYMid meet"
                                                focusable="false">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                            </svg>
                                        </a>
                                        <div class="dropdown profile-dropdown">
                                            <a href="javascript:void(0)" class="nav-link icon leading-none"
                                                data-bs-toggle="dropdown">
                                                <span>
                                                    <img src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}"
                                                        alt="img" class="avatar avatar-md brround">
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                                <!-- Change Password Link -->
                                                <a href="{{ route('password.change') }}" class="dropdown-item d-flex">
                                                    <svg class="header-icon me-3" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path d="M12 7h-1V5h1v2zm0 4h-1V9h1v2zm0 4h-1v-2h1v2zm-1-10h2v1h-2V5zm0 8h2v1h-2v-1zm0 4h2v1h-2v-1zm6-3h-2v-1h2v1zm-4 0h-2v-1h2v1zm4 0h-2v-1h2v1zm-4-4h-2V9h2v2zm4 0h-2V9h2v2zM5 5h2v2H5V5zm0 4h2v2H5V9zm0 4h2v2H5v-2zm0 4h2v2H5v-2zM8 5h1v2H8V5zm8 4h-1v2h1V9z" />
                                                    </svg>
                                                    <div class="mt-1">Change Password</div>
                                                </a>
                                            
                                                <!-- Sign out Form -->
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <div class="dropdown-item d-flex" id="logout">
                                                        <svg class="header-icon me-3" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                                            <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none" />
                                                            <path d="M6 20h12V10H6v10zm2-6h3v-3h2v3h3v2h-3v3h-2v-3H8v-2z" opacity=".3" />
                                                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H8.9V6zM18 20H6V10h12v10zm-7-1h2v-3h3v-2h-3v-3h-2v3H8v2h3z" />
                                                        </svg>
                                                        <div class="mt-1">Sign out</div>
                                                    </div>
                                                </form>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/app header-->
