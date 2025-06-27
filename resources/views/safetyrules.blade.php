<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Safety Rules - Kael's Adventure Land</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/safetyrules.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background: url('{{ asset('images/bgBlueDesigned.png') }}') no-repeat center center/cover;">

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
        <a href="#" class="menu-item">Playgrounds</a>
        <a href="#" class="menu-item">Slides</a>
        <a href="#" class="menu-item">Climbs</a>
        <a href="#" class="menu-item">Ball Pits</a>
        <a href="#" class="menu-item">Packages</a>
        <a href="/aboutus" class="menu-item">About Us</a>
        <a href="/safetyrules" class="menu-item">Safety Rules</a>
        <a href="/faqs" class="menu-item">FAQs</a>
        <a href="{{ route('login') }}" class="menu-item">Log In</a>
        <img src="{{ asset('images/btnMenuContactUs.png') }}" class="menu-contact-btn button-hover button-click" alt="Contact Us">
    </div>
</div>

<!-- MAIN SECTION -->
<main class="rules-section d-flex flex-column align-items-center justify-content-center text-center">
    <img src="{{ asset('images/imgVerticalCloud.png') }}" class="vertical-cloud-bg verticalFloat" alt="Vertical Cloud">

    <div class="content-wrapper">
        <img src="{{ asset('images/imgSafetyRulesHeader.png') }}" alt="Safety Rules Header" class="img-fluid mb-4 header-img">
        <img src="{{ asset('images/imgRules.png') }}" alt="Rules" class="img-fluid rules-img">
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

    // Idle hide/show header
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