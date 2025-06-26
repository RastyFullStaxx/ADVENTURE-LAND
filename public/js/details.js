document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('menuOverlay');
    const menu = document.querySelector('.burger-menu');
    const close = document.querySelector('.menu-close');
    const menuItems = document.querySelectorAll('#menuOverlay .menu-item');

    // Toggle overlay
    if (menu && overlay && close) {
        menu.addEventListener('click', () => {
            if (!overlay.classList.contains('show')) {
                overlay.classList.add('show');
                menu.classList.add('disabled-click'); // add class to block further clicks
            }
        });

        close.addEventListener('click', () => {
            overlay.classList.remove('show');
            menu.classList.remove('disabled-click'); // re-enable click
        });
    }

    // Handle menu link logic
    menuItems.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const target = this.textContent.trim().toLowerCase();
            const isCategory = ['playgrounds', 'slides', 'climbs', 'ball pits', 'packages'].includes(target);

            if (isCategory) {
                const slug = target.replace(/\s+/g, '-');
                window.location.href = `/category/${slug}`;
            } else {
                let route = '';
                if (target === 'about us') route = '/aboutus';
                if (target === 'safety rules') route = '/safetyrules';
                if (target === 'faqs') route = '/faqs';
                if (target === 'contact us') route = '/contactus';

                if (route) {
                    window.location.href = route;
                }
            }

            overlay.classList.remove('show');
            menu.classList.remove('disabled-click');
        });
    });
});
