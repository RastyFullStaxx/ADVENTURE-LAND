let timeout;
const header = document.getElementById('headerBar');
const footer = document.getElementById('bottomBar');

/* 🚫 Slide out header/footer on idle */
function hideBars() {
    header.style.transform = 'translateY(-118%)';  // Header hides up
    footer.style.transform = 'translateY(100%)';   // Footer hides down
}

/* ✅ Slide them back in on move */
function showBars() {
    header.style.transform = 'translateY(0)';
    footer.style.transform = 'translateY(0)';
}

/* 🕐 Reset timer and re-show bars on movement */
function isNearBottom() {
    const buffer = 150; // px before hitting the bottom
    return window.innerHeight + window.scrollY >= document.body.scrollHeight - buffer;
}

function resetIdleTimer() {
    clearTimeout(timeout);

    // Always show header
    header.style.transform = 'translateY(0)';

    // Show footer only if NOT near bottom
    if (!isNearBottom()) {
        footer.style.transform = 'translateY(0)';
    } else {
        footer.style.transform = 'translateY(100%)';
    }

    timeout = setTimeout(() => {
        // Hide both only if not near bottom
        header.style.transform = 'translateY(-118%)';
        if (!isNearBottom()) {
            footer.style.transform = 'translateY(100%)';
        }
    }, 2000);
}

/* 🔁 Watch for user movement */
document.addEventListener('mousemove', resetIdleTimer);
document.addEventListener('scroll', resetIdleTimer);
resetIdleTimer(); // Initialize on page load

const menu = document.querySelector('.burger-menu');
const overlay = document.getElementById('menuOverlay');
const close = document.querySelector('.menu-close');

menu.addEventListener('click', () => {
    overlay.classList.add('show');
});

close.addEventListener('click', () => {
    overlay.classList.remove('show');
});

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.menu-tab');
    const sections = document.querySelectorAll('.category-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            // Remove active from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add active to clicked tab
            this.classList.add('active');

            // Hide all sections
            sections.forEach(section => {
                section.classList.add('d-none');
                section.classList.remove('active-category');
            });

            // Show the section corresponding to the clicked tab
            const targetId = this.getAttribute('href').substring(1); // e.g., 'slides'
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.remove('d-none');
                targetSection.classList.add('active-category');
            }
        });
    });
});


