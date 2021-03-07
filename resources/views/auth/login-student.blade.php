
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="bg-primary">
            <div class="container">
                <div class="d-flex justify-content-between py-1 logo">
                    <img src="{{ asset('public/assets/images/logo-corporate.png') }}" alt="Corporate">
                    <img src="{{ asset('public/assets/images/logo-nc-white.png') }}" alt="New Cambridge">
                </div>
            </div>
        </div>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body">
                                
                                <div class="text-center">
                                    <p class="text-muted mb-3">Enter your username and password to access.</p>
                                </div>

                                <form action="{{ route('login.student') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Username">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary width-lg" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt bg-primary text-white">
            <span id="year"></span> &copy; Corporate Online Test by <a href="https://newcambridge.com" target="_blank" class="text-white font-weight-bold">New Cambridge</a> 
        </footer>

        <!-- Vendor js -->
        <script src="{{  asset('public/assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{  asset('public/assets/js/app.min.js') }}"></script>
        
        <script>
            $('#year').text(new Date().getFullYear())
        </script>
    </body>
</html>