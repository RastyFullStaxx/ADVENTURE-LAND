<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========================================================
         PAGE METADATA & STYLES
         ======================================================== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel – Adventure Land')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Lolita One -->
    <link href="https://fonts.googleapis.com/css2?family=Lolita+One&display=swap" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <!-- ========================================================
         NAVBAR
         ======================================================== -->
    <nav class="navbar navbar-expand-lg px-4" style="background-color: #0074BC;">
        <a class="navbar-brand text-white" href="#">
            <img src="{{ asset('images/imgViewDetailsMainLogo.png') }}" alt="Logo" height="40">
            Adventure Land Admin
        </a>
        <div class="ms-auto">
            <a href="{{ route('home') }}" class="btn btn-light btn-sm">← Back to Home</a>
        </div>
    </nav>

    <!-- ========================================================
         ADMIN PANEL CONTAINER
         ======================================================== -->
    <div class="d-flex" id="adminPanel">

        <!-- ================================================
             SIDEBAR
             ================================================ -->
        <div class="text-white p-3 sidebar">
            <h4 class="mb-4">Manage</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('admin.index') }}" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.products.index') }}" class="nav-link text-white">Products</a></li>
                <li class="nav-item mb-2"><a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Categories</a></li>
                {{-- If the user is an admin, show the Users link
                    else hide it
                 --}}
                @if(Auth::user()->role === 'admin')
                    <li class="nav-item mb-2"><a href="{{ route('admin.users.index') }}" class="nav-link text-white">Users</a></li>
                @endif
            </ul>
        </div>

        <!-- ================================================
             MAIN CONTENT AREA
             ================================================ -->
        <div class="flex-grow-1 p-4 main-content">
            @yield('content') {{-- THIS is where each page injects its specific content --}}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page-specific scripts -->
    @yield('scripts')

</body>
</html>

