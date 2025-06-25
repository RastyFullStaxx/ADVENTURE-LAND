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
function resetIdleTimer() {
    clearTimeout(timeout);
    showBars();
    timeout = setTimeout(hideBars, 2000);
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