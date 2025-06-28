<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} | Kael's Adventure Land</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Lilita One -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- 💡 Define the dynamic color variables from controller -->
    <style>
        :root {
            --main-color: {{ $mainColor }} !important;
            --accent-color: {{ $secondaryColor }} !important;
        }
    </style>

    <!-- Custom CSS -->
    <link href="{{ asset('css/details.css') }}" rel="stylesheet">

<style>
    :root {
        --main-color: {{ $mainColor }};
        --accent-color: {{ $secondaryColor }};
    }
</style>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="details-page">

<div class="details-fullscreen">

    {{-- LEFT COLUMN --}}
    <div class="details-left">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
            {{-- Back Arrow --}}
            <a href="{{ $isFirst ? '#' : route('products.show', $prevProduct->id) }}"
               class="arrow-link {{ $isFirst ? 'disabled' : '' }}"
               style="color: var(--main-color);">
                &#x3C;
            </a>

            {{-- Next Arrow --}}
            <a href="{{ $isLast ? '#' : route('products.show', $nextProduct->id) }}"
               class="arrow-link {{ $isLast ? 'disabled' : '' }}"
               style="color: var(--main-color);">
                &#x3E;
            </a>
        </div>

        <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
        <a href="{{ route('home') }}" class="logo-link">
            <img src="{{ asset('images/imgViewDetailsMainLogo.png') }}" alt="Main Logo" class="details-header-logo">
        </a>
            <h1 class="details-header-title lilita mb-0">{{ $categoryName }}</h1>
        </div>

        <img src="{{ asset('images/' . $product->image_path) }}"
             class="details-product-image mx-auto" alt="{{ $product->name }}">
    </div>

    {{-- RIGHT COLUMN --}}
    <div class="details-right">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="price-badge">PHP {{ number_format($product->price) }}</div>
            <div class="burger-menu" role="button" style="cursor: pointer; z-index: 3000;">
                <img src="{{ asset('images/imgMenuBurger.png') }}" alt="Menu" class="btn-nav">
            </div>
        </div>

        {{-- Location and Delivery Fee Section --}}
        @if($product->category->slug === 'packages')
            @php
                $twoThousandPackages = [
                    'Giant Double Slide + Bounce House',
                    'Obstacle Castle + Play House',
                    'Obstacle Combo',
                    'Combo Set 1'
                ];
                $extraFee = in_array($product->name, $twoThousandPackages) ? 2000 : 1000;
            @endphp
            <div class="d-flex align-items-start mb-3">
                <img src="{{ asset('images/icoLocation.png') }}" class="details-contact-icon">
                <span>
                    Batangas Area<br>
                    Manila, Laguna, Cavite & Rizal Area<br>
                    + Additional PHP {{ number_format($extraFee) }}
                </span>
            </div>
        @else
            <div class="d-flex align-items-start mb-3">
                <img src="{{ asset('images/icoLocation.png') }}" class="details-contact-icon">
                <span>
                    Batangas, Laguna, Cavite, Quezon, Metro Manila & Rizal Area
                </span>
            </div>
        @endif

        {{-- Product name and dimensions and units --}}
        <div class="details-info-block details-info-dual">
            <div class="product-name-area">
                <h2 class="lilita mb-0">{{ $product->name }}</h2>
            </div>

            <div class="product-dimension-area">
            @if($product->category->slug === 'packages')
                <p class="fw-bold mb-1" style="font-size: 24px;">Units</p>
                <ul class="list-unstyled mb-0">
                    @foreach(explode("\n", $product->units) as $unit)
                        <li><b>✓</b> {{ ltrim($unit, '- ') }}</li>
                    @endforeach
                </ul>
            @else
                <p class="fw-bold mb-1" style="font-size: 24px;">Dimensions</p>
                <p class="mb-0">{{ $product->dimension_long }}</p>
            @endif
            </div>
        </div>


        {{-- Inclusions --}}
        <div class="details-info-block details-info-primary">
            <h4 class="fw-bold">Inclusions</h4>
            <ul class="list-unstyled mt-2 mb-0">
                @foreach($product->inclusions as $item)
                    <li><b>✓</b> {{ $item }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Contact --}}
        <div class="mt-3">
            <div class="d-flex align-items-center mb-2">
                <img src="{{ asset('images/icoWhiteFB.png') }}" class="details-contact-icon">
                <span>Kael's Adventure Land</span>
            </div>
            <div class="d-flex align-items-center mb-2">
                <img src="{{ asset('images/icoWhiteInstagram.png') }}" class="details-contact-icon">
                <span>@kaelsadventureland</span>
            </div>
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/icoWhiteCallUs.png') }}" class="details-contact-icon">
                <span>
                    0936 974 5080<br>
                    0928 480 0969
                </span>
            </div>
        </div>
    </div>

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

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/details.js') }}"></script>
</body>
</html>
