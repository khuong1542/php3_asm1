<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <base href="{{asset('')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="admintheme/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="admintheme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="admintheme/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="admintheme/index2.html"><b>Đăng nhập</b> </a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">

                @if(Session::has('error'))
                <p class="text-danger text-center">
                    {{ Session::get('error') }}</p>
                @endif
                <form action="" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" value="1">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>
    <script src="admintheme/plugins/jquery/jquery.min.js"></script>
    <script src="admintheme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admintheme/dist/js/adminlte.min.js"></script>
</body>

</html>