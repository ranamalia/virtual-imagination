<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Imagination PhotoStudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    @verbatim
    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --gold:        #C9A94A;
            --gold-light:  #E9CB5B;
            --gold-pale:   #F5E9C0;
            --gold-glow:   rgba(201,169,74,0.25);
            --gold-shadow: rgba(201,169,74,0.18);
            --ink:         #111111;
            --ink-soft:    #3a3a3a;
            --ink-muted:   #888;
            --surface:     #FFFFFF;
            --surface-2:   #FAFAF8;
            --border:      rgba(201,169,74,0.15);
            --nav-h:       88px;
            --nav-h-sm:    64px;
            --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-spring:   cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* ===== RESET ===== */
        *, *::before, *::after {
            margin: 0; padding: 0;
            box-sizing: border-box;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fff;
            color: var(--ink);
            overflow-x: hidden;
            min-height: 200vh;
        }

        /* ===== NAVBAR SHELL ===== */
        .navbar {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: var(--nav-h);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 56px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border-bottom: 1px solid transparent;
            transition:
                height 0.4s var(--ease-out-expo),
                background 0.4s ease,
                border-color 0.4s ease,
                box-shadow 0.4s ease;
            will-change: height, background;
        }

        .navbar.scrolled {
            height: var(--nav-h-sm);
            background: rgba(255,255,255,0.98);
            border-bottom-color: var(--border);
            box-shadow: 0 2px 32px rgba(0,0,0,0.06);
        }

        /* ===== LOGO ===== */
        .navbar-logo a {
            display: flex;
            align-items: center;
            text-decoration: none;
            outline: none;
        }

        .navbar-logo img {
            height: 54px;
            width: auto;
            display: block;
            transition: height 0.4s var(--ease-out-expo), filter 0.3s ease;
            filter: drop-shadow(0 2px 8px var(--gold-shadow));
        }

        .navbar.scrolled .navbar-logo img {
            height: 38px;
        }

        .navbar-logo img:hover {
            filter: drop-shadow(0 4px 16px var(--gold-glow));
        }

        /* ===== MENU ===== */
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 70px;
            list-style: none;
            margin-left: 80px; /* naikkan untuk geser ke kanan, turunkan untuk ke kiri */
        }

        .navbar-menu > li {
            position: relative;
        }

        .navbar-menu > li > a,
        .navbar-menu > li > .nav-link {
            font-weight: 600;
            font-size: 17px;
            letter-spacing: 0.14em;
            color: var(--ink-soft);
            text-decoration: none;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            text-transform: uppercase;
            position: relative;
            border: none;
            background: none;
            transition: color 0.25s ease;
            white-space: nowrap;
            user-select: none;
        }

        /* Gold underline swipe */
        .navbar-menu > li > a::after,
        .navbar-menu > li > .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 20px;
            right: 20px;
            height: 1.5px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s var(--ease-out-expo);
            border-radius: 2px;
        }

        .navbar-menu > li:hover > a,
        .navbar-menu > li:hover > .nav-link,
        .navbar-menu > li.active > a,
        .navbar-menu > li.active > .nav-link {
            color: var(--gold);
        }

        .navbar-menu > li:hover > a::after,
        .navbar-menu > li:hover > .nav-link::after,
        .navbar-menu > li.active > a::after,
        .navbar-menu > li.active > .nav-link::after {
            transform: scaleX(1);
        }

        /* Arrow */
        .nav-arrow {
            font-size: 9px;
            opacity: 0.6;
            transition: transform 0.3s var(--ease-spring), opacity 0.3s ease;
            display: inline-block;
        }

        .navbar-menu > li:hover > .nav-link .nav-arrow,
        .navbar-menu > li:hover > a .nav-arrow {
            transform: rotate(180deg);
            opacity: 1;
        }

        /* ===== DROPDOWN ===== */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: var(--surface);
            min-width: 200px;
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow:
                0 4px 6px -1px rgba(0,0,0,0.04),
                0 12px 40px -4px rgba(0,0,0,0.10),
                0 0 0 1px rgba(255,255,255,0.8) inset;
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition:
                opacity 0.3s var(--ease-out-expo),
                transform 0.35s var(--ease-out-expo),
                visibility 0.3s;
        }

        /* little notch/arrow at top */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 12px; height: 12px;
            background: var(--surface);
            border-left: 1px solid var(--border);
            border-top: 1px solid var(--border);
            rotate: 45deg;
            border-radius: 2px 0 0 0;
        }

        .navbar-menu > li:hover > .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-soft);
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .dropdown-menu a::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, var(--gold), var(--gold-light));
            border-radius: 0 2px 2px 0;
            transform: scaleY(0);
            transition: transform 0.2s var(--ease-spring);
        }

        .dropdown-menu a:hover {
            background: var(--gold-pale);
            color: var(--gold);
            padding-left: 20px;
        }

        .dropdown-menu a:hover::before {
            transform: scaleY(1);
        }

        /* Stagger dropdown items */
        .dropdown-menu a:nth-child(1) { transition-delay: 0.02s; }
        .dropdown-menu a:nth-child(2) { transition-delay: 0.04s; }
        .dropdown-menu a:nth-child(3) { transition-delay: 0.06s; }
        .dropdown-menu a:nth-child(4) { transition-delay: 0.08s; }

        /* ===== AUTH AREA ===== */
        .navbar-auth {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        /* LOGIN BUTTON */
        .btn-login {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 11.5px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 11px 22px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            overflow: hidden;
            transition: transform 0.25s var(--ease-spring), box-shadow 0.3s ease;
            box-shadow: 0 4px 18px var(--gold-shadow);
        }

        /* Shimmer sweep on hover */
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -80%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
            transform: skewX(-20deg);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 8px 28px rgba(201,169,74,0.35);
        }

        .btn-login:hover::before {
            left: 140%;
        }

        .btn-login:active {
            transform: translateY(0) scale(0.98);
        }

        /* ===== PROFILE SECTION ===== */
        .profile-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 6px 14px 6px 6px;
            border-radius: 50px;
            border: 1px solid var(--border);
            background: var(--surface-2);
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
            user-select: none;
        }

        .profile-dropdown:hover {
            border-color: var(--gold);
            background: var(--gold-pale);
            box-shadow: 0 4px 16px var(--gold-shadow);
        }

        .profile-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 0;
            flex-shrink: 0;
            box-shadow: 0 2px 8px var(--gold-shadow);
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .profile-avatar img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .profile-dropdown:hover .profile-avatar {
            box-shadow: 0 4px 14px rgba(201,169,74,0.4);
        }

        .profile-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-arrow {
            font-size: 9px;
            color: var(--ink-muted);
            transition: transform 0.3s var(--ease-spring);
        }

        .profile-dropdown:hover .profile-arrow {
            transform: rotate(180deg);
            color: var(--gold);
        }

        /* Profile dropdown menu */
        .profile-dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--surface);
            min-width: 220px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow:
                0 4px 6px -1px rgba(0,0,0,0.04),
                0 16px 48px -4px rgba(0,0,0,0.12);
            padding: 10px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(12px) scale(0.97);
            transform-origin: top right;
            transition:
                opacity 0.3s var(--ease-out-expo),
                transform 0.35s var(--ease-spring),
                visibility 0.3s;
        }

        .profile-dropdown:hover .profile-dropdown-menu {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0) scale(1);
        }

        /* Profile menu header */
        .profile-menu-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px 12px;
            border-bottom: 1px solid rgba(201,169,74,0.12);
            margin-bottom: 6px;
        }

        .profile-menu-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            flex-shrink: 0;
        }

        .profile-menu-info {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .profile-menu-name {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--ink);
        }

        .profile-menu-role {
            font-size: 11px;
            color: var(--ink-muted);
            font-weight: 400;
        }

        .profile-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-soft);
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .profile-dropdown-menu a:hover {
            background: var(--gold-pale);
            color: var(--gold);
        }

        .menu-icon {
            width: 16px; height: 16px;
            opacity: 0.5;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .profile-dropdown-menu a:hover .menu-icon {
            opacity: 1;
        }

        .divider {
            height: 1px;
            background: rgba(201,169,74,0.12);
            margin: 6px 0;
        }

        .logout {
            color: #c0392b !important;
            font-weight: 600 !important;
        }

        .logout:hover {
            background: #fff5f5 !important;
            color: #a93226 !important;
        }

        /* ===== MOBILE HAMBURGER ===== */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s;
            border: none;
            background: none;
        }

        .hamburger:hover { background: var(--gold-pale); }

        .hamburger span {
            display: block;
            width: 24px; height: 2px;
            background: var(--ink);
            border-radius: 2px;
            transition: all 0.35s var(--ease-spring);
        }

        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
            background: var(--gold);
        }
        .hamburger.open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }
        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
            background: var(--gold);
        }

        /* ===== MOBILE DRAWER ===== */
        .mobile-drawer {
            position: fixed;
            top: 0; right: 0;
            width: 300px; height: 100vh;
            background: var(--surface);
            border-left: 1px solid var(--border);
            box-shadow: -20px 0 60px rgba(0,0,0,0.12);
            z-index: 1100;
            padding: 100px 24px 40px;
            transform: translateX(100%);
            transition: transform 0.45s var(--ease-out-expo);
            overflow-y: auto;
        }

        .mobile-drawer.open {
            transform: translateX(0);
        }

        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(4px);
            z-index: 1099;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .drawer-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .drawer-item {
            padding: 14px 0;
            border-bottom: 1px solid rgba(201,169,74,0.08);
            font-weight: 600;
            font-size: 20px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--ink-soft);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .drawer-sub {
            padding: 6px 0 6px 16px;
            display: none;
        }

        .drawer-sub a {
            display: block;
            padding: 8px 0;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-muted);
            text-decoration: none;
        }

        .drawer-sub a:hover { color: var(--gold); }
        .drawer-sub.open { display: block; }

        /* ===== DEMO PAGE CONTENT ===== */
        .page-hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
            background: linear-gradient(150deg, #fffbe6 0%, #fff9dd 40%, #fff 100%);
            text-align: center;
            padding: 40px;
        }

        .page-hero h1 {
            font-size: clamp(48px, 8vw, 110px);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -3px;
        }

        .page-hero h1 span {
            background: linear-gradient(90deg, #E9CB5B, #C9A94A);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-hero p {
            font-size: 18px;
            color: var(--ink-muted);
            max-width: 480px;
            font-weight: 400;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .navbar { padding: 0 28px; }
            .navbar-menu { display: none; }
            .hamburger { display: flex; }
        }

        @media (max-width: 640px) {
            .navbar-logo img { height: 40px; }
            .navbar.scrolled .navbar-logo img { height: 80px; }
        }

        /* ===== ENTRANCE ANIMATION ===== */
        @keyframes navSlideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        .navbar {
            animation: navSlideDown 0.6s var(--ease-out-expo) both;
        }

        /* Gold pulse on logo load */
        @keyframes logoPulse {
            0%   { filter: drop-shadow(0 0 0px transparent); }
            50%  { filter: drop-shadow(0 0 20px rgba(233,203,91,0.5)); }
            100% { filter: drop-shadow(0 2px 8px var(--gold-shadow)); }
        }

        .navbar-logo img {
            animation: logoPulse 1.2s 0.6s ease-in-out both;
        }
    </style>
    @endverbatim

</head>
<body>

<!-- ===== MOBILE OVERLAY ===== -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

<!-- ===== MOBILE DRAWER ===== -->
<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-item" onclick="toggleSub('sub-home')">
        HOME <span class="nav-arrow">▾</span>
    </div>
    <div class="drawer-sub" id="sub-home">
        <a href="#">About Us</a>
        <a href="#">Our Team</a>
    </div>

    <div class="drawer-item" onclick="toggleSub('sub-studio')">
        STUDIO RENT <span class="nav-arrow">▾</span>
    </div>
    <div class="drawer-sub" id="sub-studio">
        <a href="#">Studio A</a>
        <a href="#">Studio B</a>
        <a href="#">Podcast Room</a>
        <a href="#">Book Now</a>
    </div>

    <div class="drawer-item" onclick="toggleSub('sub-port')">
        PORTOFOLIO <span class="nav-arrow">▾</span>
    </div>
    <div class="drawer-sub" id="sub-port">
        <a href="#">Photography</a>
        <a href="#">Videography</a>
        <a href="#">Social Media</a>
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
                    <a href="/profile" style="font-size:12px;color:#C9A94A;text-decoration:none;">View Profile →</a>
                </div>
            </div>
            <div style="margin-top:12px;display:flex;flex-direction:column;gap:4px;">
                <a href="/bookings" style="padding:10px 14px;font-size:13px;font-weight:500;color:#3a3a3a;text-decoration:none;border-radius:8px;display:block;">My Bookings</a>
                <a href="/settings" style="padding:10px 14px;font-size:13px;font-weight:500;color:#3a3a3a;text-decoration:none;border-radius:8px;display:block;">Settings</a>
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

<!-- ===== NAVBAR ===== -->
<nav class="navbar" id="mainNavbar">

    <!-- Logo -->
    <div class="navbar-logo">
        <a href="/">
            <img src="{{ asset('images/tanpa_teks.png') }}" alt="Virtual Imagination Logo">
        </a>
    </div>

    <!-- Desktop Menu -->
    <ul class="navbar-menu">
        <li class="dropdown">
            <span class="nav-link">
                HOME <span class="nav-arrow">▾</span>
            </span>
            <div class="dropdown-menu">
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    About Us
                </a>
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    Our Team
                </a>
            </div>
        </li>

        <li class="dropdown">
            <span class="nav-link">
                STUDIO RENT <span class="nav-arrow">▾</span>
            </span>
            <div class="dropdown-menu">
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    Studio A
                </a>
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M15 21V9"/></svg>
                    Studio B
                </a>
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    Podcast Room
                </a>
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Book Now
                </a>
            </div>
        </li>

        <li class="dropdown">
            <span class="nav-link">
                PORTOFOLIO <span class="nav-arrow">▾</span>
            </span>
            <div class="dropdown-menu">
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Photography
                </a>
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                    Videography
                </a>
                <a href="#">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                    Social Media
                </a>
            </div>
        </li>

        <li>
            <a href="#">CONTACT</a>
        </li>
    </ul>

    <!-- Auth -->
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
                    <!-- Header -->
                    <div class="profile-menu-header">
                        <div class="profile-menu-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="profile-menu-info">
                            <span class="profile-menu-name">{{ Auth::user()->name }}</span>
                            <span class="profile-menu-role">Studio Member</span>
                        </div>
                    </div>

                    <a href="/profile">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        My Profile
                    </a>
                    <a href="/bookings">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        My Bookings
                    </a>
                    <a href="/settings">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                        Settings
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

        <!-- Hamburger (mobile) -->
        <button class="hamburger" id="hamburgerBtn" onclick="toggleDrawer()" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>


<!-- ===== SCRIPTS ===== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar   = document.getElementById('mainNavbar');
    const hamburger = document.getElementById('hamburgerBtn');
    const drawer   = document.getElementById('mobileDrawer');
    const overlay  = document.getElementById('drawerOverlay');

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

    /* 2. ACTIVE LINK — highlight current nav item */
    document.querySelectorAll('.navbar-menu > li > a').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelectorAll('.navbar-menu > li > a').forEach(l => l.removeAttribute('style'));
            this.style.color = '#C9A94A';
        });
    });

    /* 3. DROPDOWN — animate individual items on open */
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
    sub.classList.toggle('open');
}
</script>

@verbatim
<style>
    /* Ripple keyframe */
    @keyframes ripple {
        to { transform: scale(2.5); opacity: 0; }
    }
</style>
@endverbatim

</body>
</html>
