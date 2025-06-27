<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Adventure Land</title>
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

        <!-- Info Text -->
        <p class="text-secondary text-center mb-4">
            Forgot your password? No problem. Just enter your email address and we’ll send you a password reset link.
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Submit -->
            <div class="text-end">
                <button type="submit" class="btn btn-custom">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </div>
</body>
</html>
