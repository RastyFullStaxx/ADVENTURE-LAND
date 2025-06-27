<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Adventure Land</title>
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

        <!-- Reset Password Form -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="form-control">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-custom">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>
