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
@php

    $colorMap = [
        'Playgrounds' => ['main' => '#0066CC', 'secondary' => '#DAECFF'],
        'Slides'      => ['main' => '#8BC43F', 'secondary' => '#EAFFCF'],
        'Climbs'      => ['main' => '#EF4445', 'secondary' => '#FFD7D7'],
        'Ball Pits'   => ['main' => '#FF9900', 'secondary' => '#FFEBCD'],
        'Packages'    => ['main' => '#FF0099', 'secondary' => '#FFDCF1'],
    ];

    $styleConfigs = [];
    foreach($categories as $category) {
        if (isset($colorMap[$category->name])) {
            $styleConfigs[$category->name] = $colorMap[$category->name];
        } else {
            // Default black & white theme for new categories
            $styleConfigs[$category->name] = [
                'main' => '#000000',
                'secondary' => '#FFFFFF'
            ];
        }
    }
@endphp

    <style>
        @foreach($styleConfigs as $categoryName => $colors)
            @php
                $cssClass = strtolower(str_replace([' ', '-'], '', $categoryName));
            @endphp
            .menu-tab.{{ $cssClass }}.active {
                background-color: {{ $colors['main'] }} !important;
                color: white !important;
                border-color: {{ $colors['main'] }} !important;
            }

            .menu-tab.{{ $cssClass }}.active small {
                color: white !important;
            }
        @endforeach
    </style>

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
            <a href="{{ route('home') }}" class="menu-item">Home</a>
            @foreach($categories as $category)
                <a href="{{ route('home') }}#{{ $category->slug }}" class="menu-item">{{ $category->name }}</a>
            @endforeach
            <a href="#" class="menu-item">About Us</a>
            <a href="#" class="menu-item">Safety Rules</a>
            <a href="#" class="menu-item">FAQs</a>
            <a href="{{ route('login') }}" class="menu-item">Log In</a>
            <img src="{{ asset('images/btnMenuContactUs.png') }}" class="menu-contact-btn button-hover button-click" alt="Contact Us">
        </div>
    </div>

    <!-- WHITE SECTION WITH TAGLINE AND MENU -->
    <section class="white-section text-center py-5 px-3">
        <p class="lead lilita text-dark mb-3" style="font-size: 1.5rem;">
            Jump, Slide, and Climb. Adventure Delivered to Your Doorstep!
        </p>
        <a href="{{ route('viewrentals') }}">
            <img src="{{ asset('images/btnViewRentals.png') }}" alt="View Rentals"
                class="mb-4 button-hover button-click"
                style="cursor: pointer; width: 240px; max-width: 100%;">
        </a>


        <div class="d-flex justify-content-center flex-wrap gap-3">
            @foreach($categories as $index => $category)
                @php
                    // Convert category name to proper CSS class name
                    $cssClassName = strtolower(str_replace([' ', '-'], '', $category->name));
                    // Special handling for specific cases if needed
                    if ($category->name === 'Ball Pits') {
                        $cssClassName = 'ballpits';
                    }
                @endphp
                <a href="#{{ $category->slug }}" 
                class="btn menu-tab {{ $cssClassName }} lilita {{ $index === 0 ? 'active' : '' }}"
                data-category="{{ $category->slug }}"
                data-main-color="{{ $styleConfigs[$category->name]['main'] }}"
                data-secondary-color="{{ $styleConfigs[$category->name]['secondary'] }}">
                    {{ $category->name }}<br>
                    <small>{{ $category->description ?? 'Perfect for ' . strtolower($category->name) }}</small>
                </a>
            @endforeach
        </div>
    </section>


    <!-- CATEGORY PRODUCT GRID SECTION -->
    @foreach($categories as $index => $category)
        @php

            // Color map for default categories
            $colorMap = [
                'Playgrounds' => ['main' => '#0066CC', 'secondary' => '#DAECFF'],
                'Slides'      => ['main' => '#8BC43F', 'secondary' => '#EAFFCF'],
                'Climbs'      => ['main' => '#EF4445', 'secondary' => '#FFD7D7'],
                'Ball Pits'   => ['main' => '#FF9900', 'secondary' => '#FFEBCD'],
                'Packages'    => ['main' => '#FF0099', 'secondary' => '#FFDCF1'],
            ];

            // Use black/white as fallback
            $mainColor = $colorMap[$category->name]['main'] ?? '#000';
            $secondaryColor = $colorMap[$category->name]['secondary'] ?? '#FFF';

            // Filter 'simple' images for Packages
            if ($category->name === 'Packages') {
                $category->products = $category->products->filter(function ($product) {
                    return Str::contains(Str::lower($product->image_path), 'simple');
                });

                if ($category->products->isEmpty()) {
                    continue;
                }
            }

            $isActive = $loop->first ? 'active-category' : 'd-none';
        @endphp

        <section class="py-5 white-section category-section {{ $isActive }}" id="{{ Str::slug($category->name) }}">
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="lilita" style="color: {{ $mainColor }}; font-size:60px;">
                        {{ $category->name }}
                    </h2>
                </div>

                <div class="row justify-content-center">
                    @foreach($category->products as $product)
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
                                    <h5 class="lilita text-white mb-1" style="margin-bottom: 10px !important; font-size: 2rem;">
                                        {{ $product->name }}
                                    </h5>

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
                                        <a href="{{ route('products.show', $product->id) }}"
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


    <!-- INVERTED WHITE CLOUD DIVIDER -->
    <div class="cloud-divider">
        <img src="{{ asset('images/imgWhiteInvertedCloud.png') }}" alt="Cloud Divider" style="background: url('../images/imgCommonQuestionsBackground.png') no-repeat center center / cover;" class="img-fluid w-100">
    </div>

    <!-- COMMON QUESTIONS SECTION -->
    <section class="common-questions-section text-center py-5">
        <div class="container">

            <!-- Header Image -->
            <div class="common-questions-header mb-3">
                <img src="{{ asset('images/imgCommonQuestionsHeader.png') }}" alt="Common Questions Header" class="img-fluid">
            </div>

            <!-- Sub-links -->
            <div class="common-questions-links mb-4">
                <a href="#">View more FAQs</a>
                <a href="#">Ask us anything</a>
            </div>

            <!-- FAQ Buttons in 2-per-row layout -->
            <div class="row gx-4 gy-3 justify-content-center common-questions-buttons">
                @php
                    $questions = [
                        'How do I book an inflatable?',
                        'What happens if it rains?',
                        'What areas do you service?',
                        'How long is the rental duration?',
                        'Do you require a deposit?',
                        'Is there a delivery/setup fee?',
                    ];
                @endphp

                @foreach($questions as $question)
                    <div class="col-12 col-md-6">
                        <button class="faq-button btn fw-bold w-100">
                            {{ $question }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- WHITE CLOUD DIVIDER -->                   
    <div class="cloud-divider">
        <img src="{{ asset('images/imgWhiteLayerClouds.png') }}" alt="Cloud Divider" style="background: url('../images/imgCommonQuestionsBackground.png') no-repeat center center / cover;" class="img-fluid w-100" style="margin-top: 2rem">
    </div>

    <!-- STAR CLIENT SECTION -->
    <section class="star-clients-section position-relative py-5 text-center" style="margin-top: -60px;">

        <!-- Floating Stars (now outside the container) -->
        <img src="{{ asset('images/imgLeftStars.png') }}" class="star-floating-left img-fluid" alt="Left Stars">
        <img src="{{ asset('images/imgRightStars.png') }}" class="star-floating-right img-fluid" alt="Right Stars">

        <div class="container position-relative">

            <!-- Header Image -->
            <div class="mb-4">
                <img src="{{ asset('images/imgOurStarClientsheader.png') }}" alt="Our Star Clients" class="img-fluid" style="max-width: 700px; margin-bottom: 50px;">
            </div>

            <!-- Image Carousel -->
            <div id="starClientCarousel" class="carousel slide starClientCarousel" data-bs-ride="carousel">
                <div class="carousel-inner star-carousel-box shadow rounded-4 bg-white">

                    @php
                        $starClients = [
                            'starclient1.png',
                            'starclient2.png',
                            'starclient4.png',
                            'startclient3.png',
                        ];
                    @endphp

                    @foreach($starClients as $index => $clientImage)
                        <div class="carousel-item @if($index == 0) active @endif">
                            <div class="gallery-frame">
                                <img src="{{ asset('images/starclients/' . $clientImage) }}"
                                    class="star-client-img"
                                    alt="Star Client {{ $index + 1 }}">
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#starClientCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#starClientCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

     <!-- INVERTED WHITE CLOUD DIVIDER -->
     <div class="cloud-divider">
        <img src="{{ asset('images/imgWhiteInvertedCloud.png') }}" alt="Cloud Divider" class="img-fluid w-100" style="background: url('../images/imgCommonQuestionsBackground.png') no-repeat center center / cover;">
    </div>

    <!-- FOOTER SECTION -->
    <footer class="footer-section text-center text-dark">

    <div class="container py-4">
        <div class="row align-items-center justify-content-between">

            <!-- Logo (Left) -->
            <div class="col-auto">
                <img src="{{ asset('images/imgMainLogo.png') }}" alt="Kael's Adventure Land Logo" class="footer-logo img-fluid">
            </div>

            <!-- Links (Center) -->
            <div class="col text-center footer-links">
                <a href="#playgrounds">Playgrounds</a>
                <a href="#slides">Slides</a>
                <a href="#climbs">Climbs</a>
                <a href="#ball-pits">Ball Pits</a>
                <a href="#packages">Packages</a>
                <a href="#about">About Us</a>
            </div>

            <!-- Icons (Right) -->
            <div class="col-auto d-flex gap-3 footer-icons">
                <a href="#" target="_blank"><img src="{{ asset('images/icoFacebook.png') }}" alt="Facebook" class="footer-icon"></a>
                <a href="tel:123456789"><img src="{{ asset('images/icoCallUs.png') }}" alt="Call Us" class="footer-icon"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icoInstagram.png') }}" alt="Instagram" class="footer-icon"></a>
            </div>
        </div>
    </div>

    </footer>


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
