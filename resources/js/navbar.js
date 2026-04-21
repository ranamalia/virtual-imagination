document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('mainNavbar');
    const drawer = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const hamburger = document.getElementById('hamburgerBtn');

    // 1. Scroll Effect
    window.addEventListener('scroll', () => {
        if (window.scrollY > 60) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, { passive: true });

    // 2. Mobile Drawer Functions
    window.toggleDrawer = function() {
        drawer.classList.toggle('open');
        overlay.classList.toggle('open');
        hamburger.classList.toggle('open');
        document.body.style.overflow = drawer.classList.contains('open') ? 'hidden' : '';
    };

    window.closeDrawer = function() {
        drawer.classList.remove('open');
        overlay.classList.remove('open');
        hamburger.classList.remove('open');
        document.body.style.overflow = '';
    };

    window.toggleSub = function(id) {
        const sub = document.getElementById(id);
        const allSubs = document.querySelectorAll('.drawer-sub');

        // Close others
        allSubs.forEach(s => {
            if(s.id !== id) s.classList.remove('open');
        });

        // Toggle current
        sub.classList.toggle('open');
    };
});
