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

    <!-- Google Font: Lilita One -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <!-- ========================================================
         NAVBAR
         ======================================================== -->
    <nav class="navbar navbar-expand-lg px-4 d-flex justify-content-between align-items-center" style="background-color: #0074BC;">
        <a class="navbar-brand text-white d-flex align-items-center gap-2" href="#">
            <img src="{{ asset('images/imgMainLogo.png') }}" alt="Logo" class="navlogo">
            
        </a>

        <img src="{{ asset('images/imgAdminNavHeader.png') }}" alt="Nav Cloud" height="65" style="object-fit: contain;">
    </nav>

    <!-- ========================================================
         ADMIN PANEL CONTAINER
         ======================================================== -->
    <div class="d-flex" id="adminPanel">
        <!-- ================================================
             SIDEBAR
             ================================================ -->
        <div class="text-white p-3 d-flex flex-column justify-content-between sidebar">
            <!-- Sidebar links -->
            <div>
                <h4 class="mb-4 text-center">Manage</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('admin.index') }}" class="nav-link text-white">Dashboard</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('admin.products.index') }}" class="nav-link text-white">Products</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Categories</a></li>

                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item mb-2"><a href="{{ route('admin.users.index') }}" class="nav-link text-white">Users</a></li>
                    @endif
                </ul>
            </div>

            <!-- Bottom: User Info + Logout -->
            <div class="logout-section">
                <div class="user-role">
                    {{ strtoupper(Auth::user()->role === 'product-manager' ? 'Product Manager' : Auth::user()->role) }}
                </div>
                <div class="user-name">
                    {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
                <a href="{{ route('home') }}" class="btn btn-secondary">View Website</a>
            </div>
        </div>

        <!-- ================================================
             MAIN CONTENT AREA
             ================================================ -->
        <div class="flex-grow-1 p-4 main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>
</html>
