<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | {{ $setting->title ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="{{ $setting->title ?? '' }}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/panel/images/favicon.ico') }}">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('/panel/libs/owl.carousel/assets/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/panel/libs/owl.carousel/assets/owl.theme.default.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('/panel/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/panel/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/panel/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">

    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-8">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">

                                                <h4 class="mb-3"><i
                                                        class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span
                                                        class="text-primary">5k</span>+ Satisfied clients</h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel"
                                                        id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" Fantastic theme with a
                                                                    ton of options. If you just want the HTML to
                                                                    integrate with your project, then this is the
                                                                    package. You can find the files in the 'dist'
                                                                    folder...no need to install git and all the other
                                                                    stuff the documentation talks about. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">Abs1981</h4>
                                                                    <p class="font-size-14 mb-0">- Makfy User</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" If Every Vendor on Envato
                                                                    are as supportive as Themesbrand, Development with
                                                                    be a nice experience. You guys are Wonderful. Keep
                                                                    us the good work. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                    <p class="font-size-14 mb-0">- Makfy User</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-4">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="{{ route('admin.home') }}" class="d-block auth-logo">
                                        <img src="{{ asset('/assets/images/logo.png') }}" alt="" height="60"
                                            class="auth-logo-dark">
                                        <img src="{{ asset('/panel/images/logo-light.png') }}" alt="" height="18"
                                            class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to {{ $setting->title ?? '' }}.</p>
                                    </div>

                                    <div class="mt-4">
                                        <form action="{{ route('admin.login') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email Address</label>
                                                <input required name="email" value="{{ old('email') }}" type="email"
                                                    class="form-control form-control-lg border-left-0"
                                                    id="exampleInputEmail" placeholder="Username" />
                                                @if ($errors->has('email'))
                                                    <span
                                                        class="invalid-feedback text-right">{{ $errors->first('email') }}</span>
                                                @else
                                                    <div class="invalid-feedback text-right">please enter your email
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">

                                                </div>
                                                <label class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">

                                                    <input required name="password" type="password"
                                                        class="form-control form-control-lg border-left-0"
                                                        aria-label="Password" aria-describedby="password-addon"
                                                        id="exampleInputPassword" placeholder="Password" />
                                                    <button class="btn btn-light " type="button" id="password-addon"><i
                                                            class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>
                                            <div class="mt-3 d-grid">

                                                @if ($errors->any())
                                                    <h5 class="text-danger float-left">{{ $errors->first() }}</h5>
                                                    <br>
                                                @endif
                                            </div>


                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light"
                                                    type="submit">Log In</button>
                                            </div>



                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())

                                        </script> Makfy. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                        Kod Solutions</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('/panel/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/panel/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/panel/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/panel/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/panel/libs/node-waves/waves.min.js') }}"></script>

    <!-- owl.carousel js -->
    <script src="{{ asset('/panel/libs/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- auth-2-carousel init -->
    <script src="{{ asset('/panel/js/pages/auth-2-carousel.init.js') }}"></script>

    <!-- App js -->
    <script src="{{asset('/panel/js/app.js"></script>

</body>

</html>
