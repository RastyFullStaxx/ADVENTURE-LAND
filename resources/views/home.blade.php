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
        use Illuminate\Support\Str;

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
            // Strictly filter only 'simple' images for Packages
            if ($category->name === 'Packages') {
                $category->products = $category->products->filter(function ($product) {
                    return Str::contains(Str::lower($product->image_path), 'simple');
                });

                // Skip section if no simple-package products remain
                if ($category->products->isEmpty()) {
                    continue;
                }
            }
        @endphp

            <section class="py-5 white-section category-section {{ $category->name === 'Playgrounds' ? 'active-category' : 'd-none' }}"
            id="{{ Str::slug($category->name) }}">
                <div class="container">
                    <div class="text-center mb-4">
                        <h2 class="lilita" style="color: {{ $colorMap[$category->name] ?? '#333' }}; font-size:60px;">
                            {{ $category->name }}
                        </h2>
                    </div>

                    <div class="row justify-content-center">
                    @php
                        $styleConfig = [
                            'Playgrounds' => ['main' => '#0066CC', 'secondary' => '#DAECFF'],
                            'Slides' => ['main' => '#8BC43F', 'secondary' => '#EAFFCF'],
                            'Climbs' => ['main' => '#EF4445', 'secondary' => '#FFD7D7'],
                            'Ball Pits' => ['main' => '#FF9900', 'secondary' => '#FFEBCD'],
                            'Packages' => ['main' => '#FF0099', 'secondary' => '#FFDCF1'],
                        ];
                    @endphp

                    @foreach($category->products as $product)
                        @php
                            $mainColor = $styleConfig[$category->name]['main'];
                            $secondaryColor = $styleConfig[$category->name]['secondary'];
                        @endphp

                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 border-0 shadow rounded-4 overflow-hidden">

                                <!-- Upper half - image section -->
                                <div class="p-3 d-flex align-items-center justify-content-center image-section"
                                    style="background-color: {{ $secondaryColor }}; height: 220px;">
                                    <img src="{{ asset('images/' . $product->image_path) }}"
                                        alt="{{ $product->name }}"
                                        class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                </div>

                                <!-- Lower half - info section -->
                                <div class="text-center p-3 d-flex flex-column justify-content-between info-section"
                                    style="background-color: {{ $mainColor }};">
                                    <h5 class="lilita text-white mb-1" style="margin-bottom: 10px !important; font-size: 2rem;">{{ $product->name }}</h5>

                                    <div class="d-grid gap-2">
                                        <!-- Price -->
                                        <div class="btn fw-bold"
                                            style="
                                                background-color: {{ $mainColor }};
                                                color: #FFFFFF;
                                                border: 5px solid {{ $secondaryColor }};
                                                padding-top: 13px;
                                                padding-bottom: 10px;
                                                border-top-left-radius: 25px;
                                                border-top-right-radius: 25px;
                                                border-bottom-left-radius: 0;
                                                border-bottom-right-radius: 0;
                                                cursor: default;
                                                font-size: 1.2rem;
                                                font-family: 'Lilita One', cursive;
                                            "
                                            disabled>
                                            PHP {{ number_format($product->price) }}
                                        </div>

                                        <!-- View Details -->
                                        <a href="#"
                                        class="btn fw-bold"
                                        style="
                                            background-color: {{ $secondaryColor }};
                                            color: {{ $mainColor }};
                                            border: 5px solid {{ $secondaryColor }};
                                            padding-top: 2px;
                                            margin-bottom: 3px;
                                            border-top-left-radius: 0;
                                            border-top-right-radius: 0;
                                            border-bottom-left-radius: 25px;
                                            border-bottom-right-radius: 25px;
                                            font-size: 1.2rem;
                                            font-family: 'Lilita One', cursive;
                                        ">
                                            View Details
                                        </a>
                                    </div>
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
