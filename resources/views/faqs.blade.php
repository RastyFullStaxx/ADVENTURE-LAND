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
    <link href="{{ asset('css/faqs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body style="background: url('{{ asset('images/bgBlueDesigned.png') }}')">

<!-- HEADER NAVBAR -->
<header id="headerBar" class="fixed-top d-flex justify-content-between align-items-center px-4 py-2 bg-glass-blue">
    <img src="{{ asset('images/icoNavLogo.png') }}" alt="Nav Logo" class="nav-logo button-hover button-click">
    <img src="{{ asset('images/imgMenuBurger.png') }}" alt="Menu" class="burger-menu button-hover button-click">
</header>

<!-- MENU OVERLAY -->
<div id="menuOverlay" class="menu-overlay">
    <img src="{{ asset('images/imgMenuCloud.png') }}" class="menu-cloud">
    <img src="{{ asset('images/imgMenuClose.png') }}" alt="Close Menu" class="menu-close button-hover button-click">
    <div class="menu-links">
        <a href="{{ route('home') }}" class="menu-item">Home</a>
                    @foreach($categories as $category)
                        <a href="{{ route('home') }}#{{ $category->slug }}" class="menu-item">{{ $category->name }}</a>
                    @endforeach
        <a href="/aboutus" class="menu-item">About Us</a>
        <a href="/safetyrules" class="menu-item">Safety Rules</a>
        <a href="/faqs" class="menu-item">FAQs</a>
        <a href="{{ route('login') }}" class="menu-item">Log In</a>
        <img src="{{ asset('images/btnMenuContactUs.png') }}" class="menu-contact-btn button-hover button-click" alt="Contact Us">
    </div>
</div>

<!-- INVERTED CLOUD AT TOP -->
    <img src="{{ asset('images/imgWhiteInvertedCloud.png') }}" class="cloudsss cloud-bounce-playful">


<!-- COMMON QUESTIONS SECTION -->
<section class="faqs-section container py-5 text-center">
    <div class="header-with-link mb-3">
        <img src="{{ asset('images/imgCommonQuestionsHeader.png') }}" class="img-fluid" style="max-width: 600px;">
        <a href="/contactus" class="ask-anything-link d-block mt-2">Ask us anything</a>
    </div>

    <div class="faq-box mx-auto">
        <h3>How do I book an inflatable?</h3>
        <p>To book, just head over to our Contact Us page or give us a quick call! We’ll check availability and help you confirm your reservation.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>Do you require a deposit?</h3>
        <p>We cater to Batangas, Laguna, Cavite, Quezon, Metro Manila, & Rizal Area, including surrounding towns. If you’re unsure, feel free to contact us!</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>Are your inflatables cleaned between uses?</h3>
        <p>Absolutely, we clean and sanitize every inflatable thoroughly before and after each rental.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>How long is the rental duration?</h3>
        <p>All our inflatables come with 4 hours of continuous playtime by default. If you’d like to keep the fun going, you can extend your rental for ₱1,000 per additional hour.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>Is adult supervision required?</h3>
        <p>Yes, an adult must be present to supervise children at all times while the unit is in use.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>Can adults use the inflatables?</h3>
        <p>Some inflatables are suitable for older kids and teens, but we do not recommend adults unless stated as adult-friendly.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>What happens if it rains?</h3>
        <p>No worries! You can cancel or reschedule due to weather at no extra charge — just notify us at least 24–48 hours in advance.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>What surfaces can inflatables be set up on?</h3>
        <p>We can set up on grass, turf, asphalt, or concrete. Please let us know your surface type when booking.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>What areas do you service?</h3>
        <p>We cater to Batangas, Laguna, Cavite, Quezon, Metro Manila, & Rizal Area, including surrounding towns. If you’re unsure, feel free to contact us!</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>Is there a delivery/setup fee?</h3>
        <p>Delivery and setup are already included for locations within our standard service areas. If your event is outside those areas, no worries — just send us the details, and we’ll let you know if a small additional transportation fee applies.</p>
    </div>

    <div class="faq-box mx-auto">
        <h3>How far in advance should I book?</h3>
        <p>We recommend booking at least 1–2 weeks in advance, especially for weekends and holidays.</p>
    </div>
</section>

<!-- FOOTER SECTION -->
<footer class="footer-section text-center text-dark">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <img src="{{ asset('images/imgMainLogo.png') }}" alt="Kael's Adventure Land Logo" class="footer-logo img-fluid">
            </div>
            <div class="col text-center footer-links">
                <a href="#playgrounds">Playgrounds</a>
                <a href="#slides">Slides</a>
                <a href="#climbs">Climbs</a>
                <a href="#ball-pits">Ball Pits</a>
                <a href="#packages">Packages</a>
                <a href="#about">About Us</a>
            </div>
            <div class="col-auto d-flex gap-3 footer-icons">
                <a href="#" target="_blank"><img src="{{ asset('images/icoFacebook.png') }}" alt="Facebook" class="footer-icon"></a>
                <a href="tel:123456789"><img src="{{ asset('images/icoCallUs.png') }}" alt="Call Us" class="footer-icon"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icoInstagram.png') }}" alt="Instagram" class="footer-icon"></a>
            </div>
        </div>
    </div>
</footer>

<script>
    const header = document.getElementById('headerBar');
    const overlay = document.getElementById('menuOverlay');
    const menu = document.querySelector('.burger-menu');
    const close = document.querySelector('.menu-close');
    const contactBtn = document.querySelector('.menu-contact-btn');

    menu.addEventListener('click', () => overlay.classList.add('show'));
    close.addEventListener('click', () => overlay.classList.remove('show'));

    document.querySelectorAll('#menuOverlay .menu-item').forEach(link => {
        link.addEventListener('click', function (e) {
            const text = this.textContent.trim().toLowerCase();
            const isCategory = ['playgrounds', 'slides', 'climbs', 'ball pits', 'packages'].includes(text);

            if (isCategory) {
                e.preventDefault();
                const slug = text.replace(/\s+/g, '-');
                window.location.href = '/#' + slug;
            } else if (text === 'about us') {
                window.location.href = '/aboutus';
            } else if (text === 'safety rules') {
                window.location.href = '/safetyrules';
            } else if (text === 'faqs') {
                window.location.href = '/faqs';
            }
        });
    });

    if (contactBtn) {
        contactBtn.addEventListener('click', () => {
            window.location.href = '/contactus';
        });
    }

    let timeout;
    function hideHeader() {
        header.style.transform = 'translateY(-150%)';
    }
    function showHeader() {
        header.style.transform = 'translateY(0)';
    }
    function resetIdleTimer() {
        clearTimeout(timeout);
        showHeader();
        timeout = setTimeout(() => hideHeader(), 2000);
    }
    document.addEventListener('mousemove', resetIdleTimer);
    document.addEventListener('scroll', resetIdleTimer);
    resetIdleTimer();
</script>
</body>
</html>