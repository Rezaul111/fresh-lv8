<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}admin/assets/images/favicon.png">
    <title>Admin Panel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin/" />
    <!-- Custom CSS -->
    <link href="{{asset('/')}}admin/assets/dist/css/style.min.css" rel="stylesheet">

</head>

<body>
<div class="main-wrapper">
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" {{--style="background:url(admin/assets/images/big/auth-bg.jpg) no-repeat center center;"--}}>
        <div class="auth-box">
            <div id="loginform">
                <div class="logo">
                    {{--<span class=""><img src="{{asset('/')}}admin/assets/images/big/33.jpg" alt="logo" style="height: 100px;width: 100px" /></span>--}}
                    <h4 class="text-purple font-weight-bolder my-4" style="font-family: 'Century Gothic'">WELCOME TO LOGIN</h4>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12 ">
                        <div class="card-text text-center">
                            @if($error = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                    {{ $error }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Enter Your Email" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary "><i class="mdi mdi-account-key mr-1"> </i>LOGIN</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link ml-3" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password ?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="{{asset('/')}}admin/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('/')}}admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="{{asset('/')}}admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ============================================================== -->

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>
</body>

</html>
