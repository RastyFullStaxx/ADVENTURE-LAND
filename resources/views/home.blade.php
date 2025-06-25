<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kael's Adventure Land</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Lilita One -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!-- Overlay -->
    <div id="pageIntroOverlay"></div>

    <!-- HEADER -->
    <header id="headerBar" class="fixed-top d-flex justify-content-between align-items-center px-4 py-2 bg-glass-blue">
        <img src="{{ asset('images/icoNavLogo.png') }}" alt="Nav Logo" class="nav-logo button-hover button-click">
        <img src="{{ asset('images/imgMenuBurger.png') }}" alt="Menu" class="burger-menu button-hover button-click">
    </header>

    <!-- MAIN HEADER CLOUDS -->
    <main class="main-section">
        <div class="cloud-layer-1">
            <img src="{{ asset('images/imgTransparentWhiteLayerClouds.png') }}" class="cloud cloud-bounce-soft">
            <img src="{{ asset('images/imgTransparentWhiteLayerClouds.png') }}" class="cloud cloud-bounce-soft">
            <img src="{{ asset('images/imgTransparentWhiteLayerClouds.png') }}" class="cloud cloud-bounce-soft">
        </div>

        <div class="cloud-layer-2">
            <img src="{{ asset('images/imgWhiteLayerClouds.png') }}" class="cloud cloud-bounce-playful">
            <img src="{{ asset('images/imgWhiteLayerClouds.png') }}" class="cloud cloud-bounce-playful">
            <img src="{{ asset('images/imgWhiteLayerClouds.png') }}" class="cloud cloud-bounce-playful">
        </div>

        <div class="logo-section text-center">
            <img src="{{ asset('images/imgMainLogo.png') }}" alt="Main Logo" class="main-logo img-fluid">
        </div>
    </main>

    <!-- MENU OVERLAY -->
    <div id="menuOverlay" class="menu-overlay">
        <img src="{{ asset('images/imgMenuCloud.png') }}" class="menu-cloud">
        <img src="{{ asset('images/imgMenuClose.png') }}" alt="Close Menu" class="menu-close button-hover button-click">
        <div class="menu-links">
            <a href="#playgrounds" class="menu-item">Playgrounds</a>
            <a href="#slides" class="menu-item">Slides</a>
            <a href="#climbs" class="menu-item">Climbs</a>
            <a href="#ball-pits" class="menu-item">Ball Pits</a>
            <a href="#packages" class="menu-item">Packages</a>
            <a href="#" class="menu-item">About Us</a>
            <a href="#" class="menu-item">Safety Rules</a>
            <a href="#" class="menu-item">FAQs</a>
            <img src="{{ asset('images/btnMenuContactUs.png') }}" class="menu-contact-btn button-hover button-click" alt="Contact Us">
        </div>
    </div>

    <!-- WHITE SECTION WITH TAGLINE AND MENU -->
    <section class="white-section text-center py-5 px-3">
        <p class="lead lilita text-dark mb-3" style="font-size: 1.5rem;">
            Jump, Slide, and Climb. Adventure Delivered to Your Doorstep!
        </p>

        <img src="{{ asset('images/btnViewRentals.png') }}" alt="View Rentals"
             class="mb-4 button-hover button-click"
             style="cursor: pointer; width: 240px; max-width: 100%;">

        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="#playgrounds" class="btn menu-tab playgrounds lilita active">
                Playgrounds<br><small>Perfect for jumping & interactive play</small>
            </a>
            <a href="#slides" class="btn menu-tab slides lilita">
                Slides<br><small>Perfect for sliding</small>
            </a>
            <a href="#climbs" class="btn menu-tab climbs lilita">
                Climbs<br><small>Perfect for climbing</small>
            </a>
            <a href="#ball-pits" class="btn menu-tab ballpits lilita">
                Ball Pits<br><small>Perfect for diving into soft fun</small>
            </a>
            <a href="#packages" class="btn menu-tab packages lilita">
                Packages<br><small>Perfect for event bundles</small>
            </a>
        </div>
    </section>

    <!-- CATEGORY PRODUCT GRID SECTION -->
    @php
        $colorMap = [
            'Playgrounds' => '#99CCFF',
            'Slides' => '#8BC43F',
            'Climbs' => '#EF4445',
            'Ball Pits' => '#FF9900',
            'Packages' => '#FF0099',
        ];
    @endphp

    @foreach($categories as $category)
        @php
            // Skip if it's the "Packages" category and any product image path doesn't include 'simple'
            if ($category->name === 'Packages') {
                $category->products = $category->products->filter(function ($product) {
                    return str_contains($product->image_path, 'simple');
                });
            }
        @endphp

        <section class="py-5 white-section category-section" id="{{ Str::slug($category->name) }}">
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="lilita" style="color: {{ $colorMap[$category->name] ?? '#333' }};">
                        {{ $category->name }}
                    </h2>
                </div>

                <div class="row justify-content-center">
                    @foreach($category->products as $product)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card shadow text-center p-3 border-0"
                                style="border-radius: 15px; background-color: {{ $colorMap[$category->name] }}20;">

                                <img src="{{ asset('images/' . $product->image_path) }}"
                                    alt="{{ $product->name }}"
                                    class="card-img-top img-fluid"
                                    style="border-radius: 10px; max-height: 220px; object-fit: contain;">

                                <div class="card-body">
                                    <h5 class="card-title lilita text-dark">{{ $product->name }}</h5>
                                    <p class="fw-bold text-dark">PHP {{ number_format($product->price) }}</p>
                                    <a href="#" class="btn btn-outline-dark btn-sm fw-bold">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach


    <!-- CLOUD DIVIDER -->
    <div class="cloud-divider">
        <img src="{{ asset('images/imgWhiteInvertedCloud.png') }}" alt="Cloud Divider" class="img-fluid w-100">
    </div>

    <!-- FLOATING CONTACT FOOTER -->
    <div id="bottomBar" class="fixed-bottom d-flex justify-content-center gap-3 py-3 bg-glass-blue">
        <img src="{{ asset('images/btnContactUsNow.png') }}" alt="Contact Us" height="50" class="button-hover button-click">
        <img src="{{ asset('images/btnCallUsNow.png') }}" alt="Call Us" height="50" class="button-hover button-click">
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
