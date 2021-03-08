
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">
        <link href="{{ asset('public/assets/libs/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .wrapper {
                padding-top: 90px;
            }
        </style>
        @yield('css')
    </head> 

    <body class="{{ Route::current()->uri() == 'success' ? 'bg-white' : ''}}">

        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">

                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        @if (Route::current()->uri() !== 'success')
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fas fa-user font-20 align-middle"></i>
                                <span class="pro-user-name ml-1 text-capitalize">
                                    {{ auth('student')->user()->name }} <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="{{ route('logout.student') }}" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </li>            
                        @endif

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <span class="logo text-center">
                            <span class="logo-lg">
                                <img src="{{ asset('public/assets/images/logo-corporate.png') }}" alt="" height="60">
                                <!-- <span class="logo-lg-text-light">Xeria</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">X</span> -->
                                <img src="{{ asset('public/assets/images/logo-sm.png') }}" alt="" height="24">
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end Topbar -->
        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid">
                @yield('content')
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    
        <!-- Vendor js -->
        <script src="{{ asset('public/assets/js/vendor.min.js') }}"></script>
        <!-- Summernote js -->
        <script src="{{ asset('public/assets/libs/summernote/summernote-bs4.min.js') }}"></script>

        <!-- Init js -->
        <script src="{{ asset('public/assets/js/pages/form-summernote.init.js') }}"></script>
        @yield('js')
        <!-- App js -->
        <script src="{{ asset('public/assets/js/app.min.js') }}"></script>
        
    </body>
</html>