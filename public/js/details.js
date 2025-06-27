document.addEventListener('DOMContentLoaded', function () {

    const overlay = document.getElementById('menuOverlay');
    const menu = document.querySelector('.burger-menu');
    const close = document.querySelector('.menu-close');
    const menuItems = document.querySelectorAll('#menuOverlay .menu-item');
    const tabs = document.querySelectorAll('.menu-tab');
    const sections = document.querySelectorAll('.category-section');

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

            if (target === 'home') {
                window.location.href = "/";
                return;
            }            

            const isCategory = ['playgrounds', 'slides', 'climbs', 'ball pits', 'packages'].includes(target);

            if (isCategory) {
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
            } else {
                let routeName = '';
                if (target === 'about us') routeName = '/aboutus';
                if (target === 'safety rules') routeName = '/safetyrules';
                if (target === 'faqs') routeName = '/faqs';

                if (routeName) {
                    window.location.href = routeName;
                }
            }
        });
    });

});
