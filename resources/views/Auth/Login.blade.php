<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Dasho Bootstrap admin template made using Bootstrap 5 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="admin templates, bootstrap admin templates, bootstrap 5, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Dasho, Dasho bootstrap admin template">
    <meta name="author" content="Phoenixcoded" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>

    <!-- [ signin-img-tabs ] start -->
    <div class="blur-bg-images"></div>
    <div class="auth-wrapper">

        <div class="auth-content container">
            <div class="card">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h2 class="mb-4">Welcome to <span class="text-c-blue">VIN Resto</span></h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has
                                been the industry's.</p>
                            <div class="toggle-block">
                                <ol class="position-relative carousel-indicators justify-content-start">
                                    <li class=""></li>
                                    <li class="active"></li>
                                </ol>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label class="form-label">Masukkan Username</label>
                                        <input type="text" class="form-control" placeholder="Username"
                                            name="username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Masukkan Password</label>
                                        <input type="password" class="form-control" placeholder="Maksimal 14 karakter"
                                            name="password" maxlength="14" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-4 btf">Login</button>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </form>
                                <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html"
                                        class="f-w-400">Reset</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <img src="assets/images/auth/img-auth-2.jpg" alt=""
                            class="img-fluid bd-placeholder-img bd-placeholder-img-lg d-block w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ signin-img-tabs ] end -->

    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>


    <div class="footer-fab">
        <div class="b-bg">
            <i class="fas fa-question"></i>
        </div>
        <div class="fab-hover">
            <ul class="list-unstyled">
                <li><a href="../doc/index-bc-package.html" target="_blank" data-text="UI Kit"
                        class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
                <li><a href="../doc/index.html" target="_blank" data-text="Document"
                        class="btn btn-icon btn-rounded btn-primary m-0"><i
                            class="feather icon feather icon-book"></i></a></li>
            </ul>
        </div>
    </div>


</body>

</html>
