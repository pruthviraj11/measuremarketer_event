<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Measuremarketer Event</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/fevicon.png') }}">



    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">

    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/joinNow.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body>

    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6">
                                <div class="logo">
                                    <a href="{{ route('index') }}">
                                        <img class="logoImage" src="{{ asset('assets/img/optimize-logo.png') }}"
                                            alt="Logo">
                                    </a>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 d-none d-lg-block">
                                <div class="buy_tkt">
                                    <!-- Join Event button (always visible) -->

                                    @if (Session::has('user'))
                                        <!-- Check if user session exists -->
                                        <!-- My Account button (for logged-in users) -->
                                        <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('registerd_event') }}" target="_blank">My Account</a>
                                        </div>

                                        <!-- Logout button (for logged-in users) -->
                                        <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('userlogout') }}" target="_blank"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        </div>

                                        <!-- Logout form for CSRF protection -->
                                        <form id="logout-form" action="{{ route('userlogout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        {{-- <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('join_event') }}" target="_blank">Join Event</a>
                                        </div> --}}

                                        <!-- Login button (for users not logged in) -->
                                        {{-- <div class="book_btn d-none d-lg-block">
                                            <a href="{{ route('users_login') }}" target="_blank">Login</a>
                                        </div> --}}
                                    @endif

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
