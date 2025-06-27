<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Password - Adventure Land</title>
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
        <img src="{{ asset('images/imgViewDetailsMainLogo.png') }}" alt="Adventure Land Logo" class="login-logo">

        <!-- Instruction Text -->
        <p class="text-secondary text-center mb-4">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <!-- Form -->
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Submit -->
            <div class="text-end">
                <button type="submit" class="btn btn-custom">Confirm</button>
            </div>
        </form>
    </div>
</body>
</html>
