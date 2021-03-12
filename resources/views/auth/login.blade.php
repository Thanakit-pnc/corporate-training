
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
                <div class="d-flex justify-content-between align-items-center py-1">
                    <img src="{{ asset('public/assets/images/logo-corporate.png') }}" alt="Corporate">
                    <h3 class="my-0 text-white"><i class="fas fa-code-branch"></i> Backoffice</h3>
                </div>
            </div>
        </div>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-header bg-primary text-center">
                                <h2 class="my-0 text-white">Sign In (Admin)</h2>
                            </div>
                            <div class="card-body">

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('login') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
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

        <!-- Vendor js -->
        <script src="{{  asset('public/assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{  asset('public/assets/js/app.min.js') }}"></script>
        
        <script>
            $('#year').text(new Date().getFullYear())
        </script>
    </body>
</html>