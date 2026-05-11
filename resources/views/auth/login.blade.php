<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kyla Resto</title>



    <link rel="shortcut icon" href="{{ asset('mazer/dist/assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="">
  <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/app-dark.css') }}">
  <link rel="stylesheet" href="{{ asset('mazer/dist/assets/compiled/css/auth.css') }}">
</head>

<body>
<script src="{{ asset('mazer/dist/assets/static/js/initTheme.js') }}"></script>
<div id="auth">

<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="{{ asset('mazer/dist/assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Kyla Resto</h1>
            <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm py-3 rounded-3 d-flex align-items-center">
                    <i class="bi bi-shield-exclamation fs-4 me-2"></i>

                    <div>
                        <strong>Login Failed!</strong><br>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" required autocomplete="current-password" name="password" id="password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log In</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
</body>

</html>

