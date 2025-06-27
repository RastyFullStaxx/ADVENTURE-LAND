<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Adventure Land Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap 5.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Auth Styles -->
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

        <!-- Optional Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    </head>
    <body>
        <div class="login-card">
            <!-- Logo -->
            <img src="{{ asset('images/imgMainLogo.png') }}" alt="Adventure Land Logo" class="login-logo">

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-info mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" required class="form-control">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-link small">Forgot your password?</a>
                    @endif

                    <button type="submit" class="btn btn-custom">Log In</button>
                </div>
            </form>

            <!-- Link to Register -->
            <div class="text-center mt-4">
                <p class="mb-0">Don't have an account?
                    <a href="{{ route('register') }}" class="text-link">Register here</a>
                </p>
            </div>
        </div>
    </body>
</html>
