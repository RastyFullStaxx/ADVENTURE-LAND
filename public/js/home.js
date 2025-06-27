let timeout;

const header = document.getElementById('headerBar');
const footer = document.getElementById('bottomBar');
const overlay = document.getElementById('menuOverlay');
const menu = document.querySelector('.burger-menu');
const close = document.querySelector('.menu-close');

// Hide header/footer on idle
function hideBars() {
    header.style.transform = 'translateY(-118%)';
    footer.style.transform = 'translateY(100%)';
}

// Show header/footer when active
function showBars() {
    header.style.transform = 'translateY(0)';
    footer.style.transform = 'translateY(0)';
}

// Check if user is near the bottom
function isNearBottom() {
    const buffer = 150;
    return window.innerHeight + window.scrollY >= document.body.scrollHeight - buffer;
}

// Reset idle timer
function resetIdleTimer() {
    clearTimeout(timeout);

    header.style.transform = 'translateY(0)';
    if (!isNearBottom()) {
        footer.style.transform = 'translateY(0)';
    } else {
        footer.style.transform = 'translateY(100%)';
    }

    timeout = setTimeout(() => {
        header.style.transform = 'translateY(-118%)';
        if (!isNearBottom()) {
            footer.style.transform = 'translateY(100%)';
        }
    }, 2000);
}

document.addEventListener('mousemove', resetIdleTimer);
document.addEventListener('scroll', resetIdleTimer);
resetIdleTimer();

// Menu overlay toggle
menu.addEventListener('click', () => {
    overlay.classList.add('show');
});
close.addEventListener('click', () => {
    overlay.classList.remove('show');
});

// Menu link logic
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.menu-tab');
    const sections = document.querySelectorAll('.category-section');
    const menuItems = document.querySelectorAll('#menuOverlay .menu-item');
    const contactBtn = document.querySelector('.menu-contact-btn');

    menuItems.forEach(link => {
        link.addEventListener('click', function (e) {
            const target = this.textContent.trim().toLowerCase();
            const isCategory = ['playgrounds', 'slides', 'climbs', 'ball pits', 'packages'].includes(target);
    
            if (isCategory) {
                e.preventDefault();
    
                const slug = target.replace(/\s+/g, '-');
                const tab = document.querySelector(`.menu-tab[href="#${slug}"]`);
                const section = document.getElementById(slug);
    
                if (tab) {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                }
    
                if (section) {
                    sections.forEach(sec => {
                        sec.classList.add('d-none');
                        sec.classList.remove('active-category');
                    });
                    section.classList.remove('d-none');
                    section.classList.add('active-category');
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
    
                overlay.classList.remove('show');
    
            } else if (target === 'about us') {
                e.preventDefault();
                window.location.href = '/aboutus';
            } else if (target === 'safety rules') {
                e.preventDefault();
                window.location.href = '/safetyrules';
            } else if (target === 'faqs') {
                e.preventDefault();
                window.location.href = '/faqs';
            } else if (target === 'log in') {
                // Do NOT prevent default – allow real <a href="{{ route('login') }}"> to work
                overlay.classList.remove('show'); // optional: close menu
            }
        });
    });    

    if (contactBtn) {
        contactBtn.addEventListener('click', () => {
            window.location.href = '/contactus';
        });
    }

    // Allow tab selection on scroll mode too
    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                sections.forEach(sec => {
                    sec.classList.add('d-none');
                    sec.classList.remove('active-category');
                });
                targetSection.classList.remove('d-none');
                targetSection.classList.add('active-category');
                targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const hash = window.location.hash;
    if (hash) {
        const slug = hash.substring(1); // remove #
        const tab = document.querySelector(`.menu-tab[href="#${slug}"]`);
        const section = document.getElementById(slug);
        const tabs = document.querySelectorAll('.menu-tab');
        const sections = document.querySelectorAll('.category-section');

        if (tab && section) {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            sections.forEach(sec => {
                sec.classList.add('d-none');
                sec.classList.remove('active-category');
            });
            section.classList.remove('d-none');
            section.classList.add('active-category');
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
});

