{{-- ===== MOBILE OVERLAY ===== --}}
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

{{-- ===== MOBILE DRAWER ===== --}}
<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-item" onclick="toggleSub('sub-home')">
        HOME <span class="nav-arrow">▾</span>
    </div>

    <div class="drawer-item" onclick="toggleSub('sub-studio')">
        <a href="#studio-rent" style="color:inherit;text-decoration:none;">STUDIO RENT</a>
    </div>

    <div class="drawer-item" onclick="toggleSub('sub-port')">
        <a href="#portfolio" style="color:inherit;text-decoration:none;">PORTOFOLIO</a>
    </div>

    <div class="drawer-item"><a href="#" style="color:inherit;text-decoration:none;">CONTACT</a></div>

    <div style="margin-top:32px;">
        @guest
            <a href="/login" class="btn-login" style="display:block;text-align:center;">LOGIN / REGISTER</a>
        @endguest
        @auth
            <div style="display:flex;align-items:center;gap:10px;padding:12px;background:#faf9f5;border-radius:12px;border:1px solid rgba(201,169,74,0.15);">
                <div class="profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div style="font-size:13px;font-weight:700;">{{ Auth::user()->name }}</div>
                    <a href="{{ route('profile.edit') }}" style="font-size:12px;color:#C9A94A;text-decoration:none;">View Profile →</a>
                </div>
            </div>
            <div style="margin-top:12px;display:flex;flex-direction:column;gap:4px;">
                <a href="{{ route('bookings.index') }}" style="padding:10px 14px;font-size:13px;font-weight:500;color:#3a3a3a;text-decoration:none;border-radius:8px;display:block;">My Bookings</a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                    @csrf
                    <a onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                       style="padding:10px 14px;font-size:13px;font-weight:600;color:#c0392b;text-decoration:none;border-radius:8px;display:block;cursor:pointer;">
                       Logout
                    </a>
                </form>
            </div>
        @endauth
    </div>
</div>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar" id="mainNavbar">

    {{-- Logo --}}
    <div class="navbar-logo">
        <a href="/">
            <img src="{{ asset('images/tanpa_teks.png') }}" alt="Virtual Imagination Logo">
        </a>
    </div>

    {{-- Desktop Menu --}}
    <ul class="navbar-menu">
        <li>
            <a href="/" class="nav-link">HOME</a>
        </li>

        <li>
            <a href="#studio-rent" class="nav-link">STUDIO RENT</a>
        </li>

        <li>
            <a href="#portfolio" class="nav-link">PORTOFOLIO</a>
        </li>

        <li>
            <a href="#contact" class="nav-link">CONTACT</a>
        </li>
    </ul>

    {{-- Auth --}}
    <div class="navbar-auth">
        @guest
            <a href="/login" class="btn-login">LOGIN / REGISTER</a>
        @endguest

        @auth
            <div class="profile-dropdown">
                <div class="profile-avatar">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    @endif
                </div>
                <span class="profile-name">{{ explode(' ', Auth::user()->name)[0] }}</span>
                <span class="profile-arrow">▾</span>

                <div class="profile-dropdown-menu">
                    {{-- Header --}}
                    <div class="profile-menu-header">
                        <div class="profile-menu-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="profile-menu-info">
                            <span class="profile-menu-name">{{ Auth::user()->name }}</span>
                            <span class="profile-menu-role">Studio Member</span>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        My Profile
                    </a>
                    <a href="{{ route('bookings.index') }}">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        My Bookings
                    </a>
                    <a href="{{ route('dashboard') }}">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        Dashboard
                    </a>

                    <div class="divider"></div>

                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a class="logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           style="cursor:pointer;">
                            <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        @endauth

        {{-- Hamburger (mobile) --}}
        <button class="hamburger" id="hamburgerBtn" onclick="toggleDrawer()" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

{{-- ===== SCRIPTS ===== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar   = document.getElementById('mainNavbar');
    const hamburger = document.getElementById('hamburgerBtn');

    /* 1. SCROLL — shrink navbar */
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const sy = window.scrollY;
        if (sy > 60) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        lastScroll = sy;
    }, { passive: true });

    /* 2. ACTIVE LINK */
    document.querySelectorAll('.navbar-menu > li > a').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelectorAll('.navbar-menu > li > a').forEach(l => l.removeAttribute('style'));
            this.style.color = '#C9A94A';
        });
    });

    /* 3. DROPDOWN — animate items on open */
    document.querySelectorAll('.dropdown').forEach(dd => {
        dd.addEventListener('mouseenter', () => {
            const items = dd.querySelectorAll('.dropdown-menu a');
            items.forEach((item, i) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(8px)';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.25s ease, transform 0.3s ease, background 0.2s, color 0.2s, padding-left 0.2s';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, i * 55);
            });
        });
    });

    /* 4. RIPPLE on login button */
    const loginBtn = document.querySelector('.btn-login');
    if (loginBtn) {
        loginBtn.addEventListener('click', function (e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            const size = Math.max(rect.width, rect.height);
            ripple.style.cssText = `
                position:absolute; border-radius:50%;
                width:${size}px; height:${size}px;
                top:${e.clientY - rect.top - size/2}px;
                left:${e.clientX - rect.left - size/2}px;
                background:rgba(255,255,255,0.4);
                transform:scale(0); pointer-events:none;
                animation:ripple 0.5s ease-out forwards;
            `;
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    }

    /* 5. PROFILE dropdown — stagger items */
    const profileDd = document.querySelector('.profile-dropdown');
    if (profileDd) {
        profileDd.addEventListener('mouseenter', () => {
            const items = profileDd.querySelectorAll('.profile-dropdown-menu a');
            items.forEach((item, i) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-6px)';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.25s ease, transform 0.3s ease, background 0.2s, color 0.2s';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, i * 45);
            });
        });
    }

    /* 6. MOBILE — close drawer on resize */
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) closeDrawer();
    });
});

/* MOBILE DRAWER */
function toggleDrawer() {
    const hamburger = document.getElementById('hamburgerBtn');
    const drawer    = document.getElementById('mobileDrawer');
    const overlay   = document.getElementById('drawerOverlay');
    const isOpen    = drawer.classList.contains('open');
    if (isOpen) {
        closeDrawer();
    } else {
        hamburger.classList.add('open');
        drawer.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

function closeDrawer() {
    document.getElementById('hamburgerBtn').classList.remove('open');
    document.getElementById('mobileDrawer').classList.remove('open');
    document.getElementById('drawerOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function toggleSub(id) {
    const sub = document.getElementById(id);
    if (sub) sub.classList.toggle('open');
}
</script>