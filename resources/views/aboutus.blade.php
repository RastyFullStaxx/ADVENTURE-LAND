<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Kael's Adventure Land</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>

<body style="background: url('{{ asset('images/bgBlueDesigned.png') }}'); background-size: cover;">

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
            <a href="/#playgrounds" class="menu-item">Playgrounds</a>
            <a href="/#slides" class="menu-item">Slides</a>
            <a href="/#climbs" class="menu-item">Climbs</a>
            <a href="/#ball-pits" class="menu-item">Ball Pits</a>
            <a href="/#packages" class="menu-item">Packages</a>
            <a href="/aboutus" class="menu-item">About Us</a>
            <a href="{{ route('login') }}" class="menu-item">Log In</a>
            <img src="{{ asset('images/btnMenuContactUs.png') }}" class="menu-contact-btn button-hover button-click" alt="Contact Us">
        </div>
    </div>

    <!-- ABOUT US SECTION -->
    <section class="about-section container text-center">

        <!-- Title and Image wrapper -->
        <div class="about-overlay-wrapper" id="aboutImageWrapper">
            <h1 class="about-title">ABOUT US</h1>
            <img src="{{ asset('images/imgAboutUs.png') }}" alt="About Us" class="img-fluid about-img">
        </div>

        <!-- Text container to slide down -->
        <div id="aboutTextContainer" class="about-slide-container">
            <div class="about-description p-4 rounded-4">
                <p>Kael’s Adventure Land was founded in 2016 with a small selection of inflatables and a passion for bringing joy to family events. The business was established by Marivic, a dedicated mother of six, and lovingly named the business after her grandson, Kael, whose energy and imagination continue to inspire everything we do.</p>
                <p>Despite the challenges brought by the pandemic, Kael’s Adventureland remained resilient and even grew during uncertain times. Through a strong commitment to customer satisfaction, safety, and quality service, we’ve continued to earn the trust of families and communities across the region.</p>
                <p>Now approaching a decade in the industry, we are proud to offer a wide range of clean, safe, and reliable inflatables for all kinds of celebrations. Whether it’s a birthday party, school event, or community gathering, we’re here to help make every occasion truly memorable.</p>
            </div>
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
                    <a href="#"><img src="{{ asset('images/icoFacebook.png') }}" alt="Facebook" class="footer-icon"></a>
                    <a href="tel:123456789"><img src="{{ asset('images/icoCallUs.png') }}" alt="Call Us" class="footer-icon"></a>
                    <a href="#"><img src="{{ asset('images/icoInstagram.png') }}" alt="Instagram" class="footer-icon"></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SLIDE ANIMATION SCRIPT -->
    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('aboutTextContainer')?.classList.add('reveal');
                document.querySelector('.about-description')?.classList.add('reveal');
                document.getElementById('aboutImageWrapper')?.classList.add('slide-up');
            }, 2000);
        });
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
