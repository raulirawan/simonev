<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/auth.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png" type="image/png">
</head>

<body>
    <style>
        body {
            background-image: url({{ asset('assets/images/bg-fix.jpeg') }});
            background-repeat: no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12 mx-auto ">
                <div id="auth-left">

                    {{-- <h1 class="auth-title">Log in.</h1> --}}
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo-removebg-preview.png') }}" width="150px">

                    </div>
                    <h1>Login Simonev</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror form-control-xl"
                                placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</body>

</html>
