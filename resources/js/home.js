let timeout;
const header = document.getElementById('headerBar');
const footer = document.getElementById('bottomBar');

function hideBars() {
    header.style.transform = 'translateY(-100%)';
    footer.style.transform = 'translateY(100%)';
}

function showBars() {
    header.style.transform = 'translateY(0)';
    footer.style.transform = 'translateY(0)';
}

function resetIdleTimer() {
    clearTimeout(timeout);
    showBars();
    timeout = setTimeout(hideBars, 2000);
}

document.addEventListener('mousemove', resetIdleTimer);
document.addEventListener('scroll', resetIdleTimer);
resetIdleTimer();

