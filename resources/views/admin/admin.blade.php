<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel – Adventure Land</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Lilita One -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg px-4 justify-content-between" style="background-color: #0074BC;">
        <a class="navbar-brand text-white d-flex align-items-center gap-2" href="#">
            <img src="{{ asset('images/imgMainLogo.png') }}" alt="Logo" height="40" class="navlogo">
        </a>
        <img src="{{ asset('images/imgAdminNavHeader.png') }}" alt="Decorative Header" height="50" class="ms-auto">
    </nav>

    <div class="d-flex" id="adminPanel">
        <div class="text-white p-3 d-flex flex-column justify-content-between sidebar">
            <div>
                <h4 class="mb-4 text-center sidetext">Manage</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.index') }}" class="nav-link text-white">Dashboard</a>
                    </li>
                    @if(Auth::user()->role !== 'new')
                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.products.index') }}" class="nav-link text-white">Products</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Categories</a>
                        </li>
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item mb-2">
                                <a href="{{ route('admin.users.index') }}" class="nav-link text-white">Users</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>

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

        <div class="flex-grow-1 p-4 main-content">
            <h2 class="text-center fw-bold mb-4" style="font-size: 4.5rem; font-family: 'Lilita One', cursive; color: #ffffff; 
                -webkit-text-stroke: 1.2px #0074BC; text-shadow: 1px 1px #B2EBF2;">
                Welcome, {{ Auth::user()->name }}!
            </h2>

            @if(Auth::user()->role === 'new')
                <div class="text-center mt-5">
                    <div class="card mx-auto shadow" style="max-width: 500px;">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <i class="fas fa-clock text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="text-muted mb-3">Account Pending</h4>
                            <p class="text-muted">Please wait for the admin to assign you a role to access the dashboard features.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary h-100 shadow">
                            <div class="card-body text-center">
                                <h5 class="card-title">Products</h5>
                                <p class="display-6 fw-bold">{{ $productCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success h-100 shadow">
                            <div class="card-body text-center">
                                <h5 class="card-title">Categories</h5>
                                <p class="display-6 fw-bold">{{ $categoryCount }}</p>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->role === 'admin')
                    <div class="col-md-4">
                        <div class="card text-white bg-warning h-100 shadow">
                            <div class="card-body text-center">
                                <h5 class="card-title">Users</h5>
                                <p class="display-6 fw-bold">{{ $userCount }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-info text-white fw-semibold">
                        Activity Log
                    </div>
                    <ul class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                        @forelse($activityLogs as $log)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $log->user->name }}</strong> 
                                        {{ strtolower($log->action) }} 
                                        <span class="text-muted">({{ $log->subject_type }} ID: {{ $log->subject_id }})</span>
                                    </div>
                                    <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No recent activity.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="text-center" style="margin-top: 4rem;">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success me-2">+ Add Product</a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary me-2">+ Add Category</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.users.create') }}" class="btn btn-warning">+ Add User</a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>