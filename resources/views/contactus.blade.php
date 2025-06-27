<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Kael's Adventure Land</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Lilita One -->
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/contactus.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background: url('{{ asset('images/bgContactUs.png') }}') no-repeat center center/cover;">

<!-- HEADER -->
<header id="headerBar" class="fixed-top d-flex justify-content-between align-items-center px-4 py-2 bg-glass-blue">
    <img src="{{ asset('images/icoNavLogo.png') }}" alt="Nav Logo" class="nav-logo button-hover button-click">
    <img src="{{ asset('images/imgMenuBurger.png') }}" alt="Menu" class="burger-menu button-hover button-click">
</header>

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
        <a href="/aboutus" class="menu-item">About Us</a>
        <a href="/safetyrules" class="menu-item">Safety Rules</a>
        <a href="/faqs" class="menu-item">FAQs</a>
        <a href="{{ route('login') }}" class="menu-item">Log In</a>
        <img src="{{ asset('images/btnMenuContactUs.png') }}" class="menu-contact-btn button-hover button-click" alt="Contact Us">
    </div>
</div>

<!-- MAIN CONTACT SECTION -->
<main class="contact-section d-flex flex-column align-items-center justify-content-center text-center" style="padding-top: 100px; min-height: 100vh;">
    <img src="{{ asset('images/imgContactUsHeader.png') }}" alt="Contact Us Header" class="img-fluid mb-4" style="max-width: 600px;">

    <!-- Contact Info Blocks -->
    <div class="d-flex flex-wrap justify-content-center gap-4 mb-4">
        <img src="{{ asset('images/imgPhoneNum1.png') }}" alt="Phone 1" class="img-fluid contact-box" data-copy="09369745080">
        <img src="{{ asset('images/imgPhoneNum2.png') }}" alt="Phone 2" class="img-fluid contact-box" data-copy="09284800969">
        <img src="{{ asset('images/imgGmail.png') }}" alt="Gmail" class="img-fluid contact-box" data-copy="kaelsadventureland@gmail.com">
    </div>

    <!-- Social Links Row -->
    <div class="d-flex justify-content-center gap-5">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/icoFacebook.png') }}" alt="Facebook" class="social-icon">
            <span class="lilita" style="color: #0066CC; font-size: 1.2rem;">Kael's Adventure Land</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('images/icoInstagram.png') }}" alt="Instagram" class="social-icon">
            <span class="lilita" style="color: #0066CC; font-size: 1.2rem;">@kaelsadventureland</span>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const overlay = document.getElementById('menuOverlay');
    const menu = document.querySelector('.burger-menu');
    const close = document.querySelector('.menu-close');
    const contactBtn = document.querySelector('.menu-contact-btn');

    menu.addEventListener('click', () => overlay.classList.add('show'));
    close.addEventListener('click', () => overlay.classList.remove('show'));

    if (contactBtn) {
        contactBtn.addEventListener('click', () => {
            window.location.href = '/contactus';
        });
    }

    document.querySelectorAll('.contact-box').forEach(box => {
        box.addEventListener('click', () => {
            const content = box.getAttribute('data-copy');
            navigator.clipboard.writeText(content).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: `${content} has been copied to clipboard`,
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        });
    });
</script>
</body>
</html>
