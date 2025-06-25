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

document.querySelectorAll('.menu-tab').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.menu-tab').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        // TODO: Load rentals based on category here using this.dataset.category
    });
});

document.querySelectorAll('.menu-tab').forEach(tab => {
    tab.addEventListener('click', function () {
        document.querySelectorAll('.menu-tab').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
    });
});
