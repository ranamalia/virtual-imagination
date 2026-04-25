<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Virtual Imagination PhotoStudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            overflow-y: auto;
            background:
                radial-gradient(ellipse 70% 60% at 20% 30%, rgba(233,203,91,0.6) 0%, transparent 55%),
                radial-gradient(ellipse 60% 55% at 80% 20%, rgba(204,176,73,0.55) 0%, transparent 55%),
                radial-gradient(ellipse 50% 50% at 60% 85%, rgba(233,203,91,0.4) 0%, transparent 55%),
                linear-gradient(160deg, #ffffff 0%, #fff8dc 45%, #ffffff 100%);
            background-attachment: fixed;
            color: var(--ink);
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
            transition: height 0.4s var(--ease-out-expo), background 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
            will-change: height, background;
            animation: navSlideDown 0.6s var(--ease-out-expo) both;
        }
        .navbar.scrolled {
            height: var(--nav-h-sm);
            background: rgba(255,255,255,0.98);
            border-bottom-color: var(--border);
            box-shadow: 0 2px 32px rgba(0,0,0,0.06);
        }
        @keyframes navSlideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        /* ===== LOGO ===== */
        .navbar-logo a { display: flex; align-items: center; text-decoration: none; outline: none; }
        .navbar-logo img {
            height: 54px; width: auto; display: block;
            transition: height 0.4s var(--ease-out-expo), filter 0.3s ease;
            filter: drop-shadow(0 2px 8px var(--gold-shadow));
            animation: logoPulse 1.2s 0.6s ease-in-out both;
        }
        .navbar.scrolled .navbar-logo img { height: 38px; }
        .navbar-logo img:hover { filter: drop-shadow(0 4px 16px var(--gold-glow)); }
        @keyframes logoPulse {
            0%   { filter: drop-shadow(0 0 0px transparent); }
            50%  { filter: drop-shadow(0 0 20px rgba(233,203,91,0.5)); }
            100% { filter: drop-shadow(0 2px 8px var(--gold-shadow)); }
        }

        /* ===== MENU ===== */
        .navbar-menu {
            display: flex; align-items: center; gap: 70px;
            list-style: none; margin-left: 80px;
        }
        .navbar-menu > li { position: relative; }
        .navbar-menu > li > a,
        .navbar-menu > li > .nav-link {
            font-weight: 600; font-size: 17px; letter-spacing: 0.14em;
            color: var(--ink-soft); text-decoration: none;
            padding: 10px 20px; display: flex; align-items: center; gap: 6px;
            cursor: pointer; text-transform: uppercase; position: relative;
            border: none; background: none;
            transition: color 0.25s ease; white-space: nowrap; user-select: none;
        }
        .navbar-menu > li > a::after,
        .navbar-menu > li > .nav-link::after {
            content: ''; position: absolute; bottom: 2px; left: 20px; right: 20px;
            height: 1.5px; background: linear-gradient(90deg, var(--gold), var(--gold-light));
            transform: scaleX(0); transform-origin: left;
            transition: transform 0.35s var(--ease-out-expo); border-radius: 2px;
        }
        .navbar-menu > li:hover > a,
        .navbar-menu > li:hover > .nav-link { color: var(--gold); }
        .navbar-menu > li:hover > a::after,
        .navbar-menu > li:hover > .nav-link::after { transform: scaleX(1); }
        .nav-arrow { font-size: 9px; opacity: 0.6; transition: transform 0.3s var(--ease-spring), opacity 0.3s ease; display: inline-block; }
        .navbar-menu > li:hover > .nav-link .nav-arrow { transform: rotate(180deg); opacity: 1; }

        /* ===== DROPDOWN ===== */
        .dropdown-menu {
            position: absolute; top: calc(100% + 12px); left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: var(--surface); min-width: 200px; border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04), 0 12px 40px -4px rgba(0,0,0,0.10);
            padding: 8px; opacity: 0; visibility: hidden; pointer-events: none;
            transition: opacity 0.3s var(--ease-out-expo), transform 0.35s var(--ease-out-expo), visibility 0.3s;
        }
        .navbar-menu > li:hover > .dropdown-menu {
            opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); pointer-events: auto;
        }
        .dropdown-menu a {
            display: flex; align-items: center; gap: 10px; padding: 9px 14px;
            font-size: 13px; font-weight: 500; color: var(--ink-soft);
            text-decoration: none; border-radius: 8px;
            transition: background 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
        }
        .dropdown-menu a:hover { background: var(--gold-pale); color: var(--gold); padding-left: 20px; }

        /* ===== AUTH AREA ===== */
        .navbar-auth { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }

        /* LOGIN BUTTON */
        .btn-login {
            position: relative; display: inline-flex; align-items: center; gap: 8px;
            background: var(--gold); color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 11.5px;
            letter-spacing: 0.12em; text-transform: uppercase; padding: 11px 22px;
            border-radius: 50px; text-decoration: none; border: none; cursor: pointer;
            overflow: hidden; transition: transform 0.25s var(--ease-spring), box-shadow 0.3s ease;
            box-shadow: 0 4px 18px var(--gold-shadow);
        }
        .btn-login:hover { transform: translateY(-2px) scale(1.03); box-shadow: 0 8px 28px rgba(201,169,74,0.35); }
        .btn-login:active { transform: translateY(0) scale(0.98); }

        /* ===== PROFILE SECTION ===== */
        .profile-dropdown {
            position: relative; display: flex; align-items: center; gap: 10px; cursor: pointer;
            padding: 6px 14px 6px 6px; border-radius: 50px;
            border: 1px solid var(--border); background: var(--surface-2);
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s; user-select: none;
        }
        .profile-dropdown:hover { border-color: var(--gold); background: var(--gold-pale); box-shadow: 0 4px 16px var(--gold-shadow); }
        .profile-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 13px; flex-shrink: 0;
            box-shadow: 0 2px 8px var(--gold-shadow); overflow: hidden; transition: box-shadow 0.3s;
        }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .profile-dropdown:hover .profile-avatar { box-shadow: 0 4px 14px rgba(201,169,74,0.4); }
        .profile-name { font-size: 13px; font-weight: 600; color: var(--ink); max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .profile-arrow { font-size: 9px; color: var(--ink-muted); transition: transform 0.3s var(--ease-spring); }
        .profile-dropdown:hover .profile-arrow { transform: rotate(180deg); color: var(--gold); }

        /* Profile dropdown menu */
        .profile-dropdown-menu {
            position: absolute; top: calc(100% + 10px); right: 0;
            background: var(--surface); min-width: 220px; border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04), 0 16px 48px -4px rgba(0,0,0,0.12);
            padding: 10px; opacity: 0; visibility: hidden; pointer-events: none;
            transform: translateY(12px) scale(0.97); transform-origin: top right;
            transition: opacity 0.3s var(--ease-out-expo), transform 0.35s var(--ease-spring), visibility 0.3s;
        }
        .profile-dropdown:hover .profile-dropdown-menu {
            opacity: 1; visibility: visible; pointer-events: auto; transform: translateY(0) scale(1);
        }
        .profile-menu-header {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 10px 12px; border-bottom: 1px solid rgba(201,169,74,0.12); margin-bottom: 6px;
        }
        .profile-menu-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px; flex-shrink: 0;
        }
        .profile-menu-info { display: flex; flex-direction: column; gap: 1px; }
        .profile-menu-name { font-size: 13.5px; font-weight: 700; color: var(--ink); }
        .profile-menu-role { font-size: 11px; color: var(--ink-muted); font-weight: 400; }
        .profile-dropdown-menu a {
            display: flex; align-items: center; gap: 10px; padding: 9px 12px;
            font-size: 13px; font-weight: 500; color: var(--ink-soft);
            text-decoration: none; border-radius: 8px; transition: background 0.2s, color 0.2s;
        }
        .profile-dropdown-menu a:hover { background: var(--gold-pale); color: var(--gold); }
        .menu-icon { width: 16px; height: 16px; opacity: 0.5; transition: opacity 0.2s; flex-shrink: 0; }
        .profile-dropdown-menu a:hover .menu-icon { opacity: 1; }
        .divider { height: 1px; background: rgba(201,169,74,0.12); margin: 6px 0; }
        .logout { color: #c0392b !important; font-weight: 600 !important; }
        .logout:hover { background: #fff5f5 !important; color: #a93226 !important; }

        /* ===== MOBILE HAMBURGER ===== */
        .hamburger {
            display: none; flex-direction: column; gap: 5px; cursor: pointer;
            padding: 8px; border-radius: 8px; transition: background 0.2s; border: none; background: none;
        }
        .hamburger:hover { background: var(--gold-pale); }
        .hamburger span { display: block; width: 24px; height: 2px; background: var(--ink); border-radius: 2px; transition: all 0.35s var(--ease-spring); }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); background: var(--gold); }
        .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); background: var(--gold); }

        /* ===== MOBILE DRAWER ===== */
        .mobile-drawer {
            position: fixed; top: 0; right: 0;
            width: 300px; height: 100vh; background: var(--surface);
            border-left: 1px solid var(--border); box-shadow: -20px 0 60px rgba(0,0,0,0.12);
            z-index: 1100; padding: 100px 24px 40px;
            transform: translateX(100%); transition: transform 0.45s var(--ease-out-expo); overflow-y: auto;
        }
        .mobile-drawer.open { transform: translateX(0); }
        .drawer-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.3);
            backdrop-filter: blur(4px); z-index: 1099;
            opacity: 0; visibility: hidden; transition: opacity 0.3s, visibility 0.3s;
        }
        .drawer-overlay.open { opacity: 1; visibility: visible; }
        .drawer-item {
            padding: 14px 0; border-bottom: 1px solid rgba(201,169,74,0.08);
            font-weight: 600; font-size: 20px; letter-spacing: 0.25em; text-transform: uppercase;
            color: var(--ink-soft); cursor: pointer; display: flex; justify-content: space-between; align-items: center;
        }
        .drawer-sub { padding: 6px 0 6px 16px; display: none; }
        .drawer-sub a { display: block; padding: 8px 0; font-size: 13px; font-weight: 500; color: var(--ink-muted); text-decoration: none; }
        .drawer-sub a:hover { color: var(--gold); }
        .drawer-sub.open { display: block; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) { .navbar { padding: 0 28px; } .navbar-menu { display: none; } .hamburger { display: flex; } }
        @media (max-width: 640px) { .navbar-logo img { height: 40px; } }

        /* Ripple */
        @keyframes ripple { to { transform: scale(2.5); opacity: 0; } }

        /* ===== HERO ===== */
        .hero {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .hero-bg { display: none; }
        .hero-overlay {
            position: absolute; inset: 0;
            background: transparent; z-index: 1;
        }
        .hero-content {
            top: 110px; position: relative; z-index: 2;
            padding: 140px 60px 0 60px;
        }
        .hero-title-vi {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700; font-size: 125px; line-height: 1.25;
            background: linear-gradient(90deg, #E9CB5B 100%, #FFFFFF 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; letter-spacing: -2px;
        }
        .hero-title-ps {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700; font-size: 125px; line-height: 1;
            color: #111; letter-spacing: -2px; margin-bottom: 30px;
        }
        .hero-desc {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400; font-size: 20px; color: #111;
            max-width: 1000px; line-height: 1.6; margin-bottom: 10px;
        }
        .hero-desc b { font-weight: 700; }

        /* Social Bar */
        .social-bar {
            margin-top: 300px; padding: 70px 0 40px 0;
            position: relative; z-index: 2;
            display: flex; justify-content: center; align-items: center;
        }
        .social-bar-inner {
            display: flex; align-items: center;
            background: rgba(50,50,50,0.82);
            border-radius: 40px; padding: 12px 32px; gap: 8px;
        }
        .social-bar-inner a {
            display: flex; align-items: center; gap: 7px;
            color: #fff; font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600; font-size: 12px; letter-spacing: 0.12em;
            text-decoration: none; padding: 6px 16px; border-radius: 30px;
            text-transform: uppercase; transition: background 0.2s;
        }
        .social-bar-inner a:hover { background: rgba(255,255,255,0.13); }
        .social-icon { width: 16px; height: 16px; fill: #fff; }

        /* ===== VISION & MISSION ===== */
        .vm-section { padding: 300px 0; background: transparent; }
        .vm-inner {
            max-width: 1500px; margin: 0 auto;
            display: grid; grid-template-columns: 1.2fr 1fr;
            gap: 60px; align-items: start;
            opacity: 0; transform: translateY(40px);
            animation: fadeUp 1s ease forwards;
        }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
        .vm-left { padding-top: 10px; }
        .vm-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600; font-size: 95px; line-height: 1.05;
            color: #111; letter-spacing: -2px; margin-bottom: 28px; position: relative;
        }
        .vm-heading::after {
            content: ''; display: block; width: 80px; height: 4px;
            background: #111; margin-top: 16px;
        }
        .vm-divider { width: 100%; height: 1.5px; background: #ddd; margin-bottom: 28px; }
        .vm-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 400; font-size: 16px; color: #444;
            line-height: 1.8; margin-bottom: 20px;
        }
        .vm-body b { font-weight: 700; color: #000; }
        .vm-divider-bottom { width: 100%; height: 1.5px; background: #ddd; margin-top: 32px; }
        .vm-photos {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 18px; align-items: start;
        }
        .vm-photo-top-left { grid-column: 1; grid-row: 1; }
        .vm-photo-top-right { grid-column: 2; grid-row: 1; }
        .vm-photo-bottom-center {
            grid-column: 1 / span 2; display: flex; justify-content: center;
        }
        .vm-photo-bottom-center img { width: 55%; }
        .vm-photos img {
            width: 100%; height: 210px; object-fit: cover;
            border-radius: 10px; display: block;
            transition: all 0.4s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .vm-photos img:hover { transform: scale(1.05); box-shadow: 0 15px 40px rgba(0,0,0,0.15); }

        /* ===== CATEGORY SECTION ===== */
        .cat-section { padding: 80px 60px 100px; background: transparent; position: relative; }
        .cat-header { text-align: center; margin-bottom: 48px; }
        .cat-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600; font-size: 42px; color: #111;
            letter-spacing: -1px; margin-bottom: 14px;
        }
        .cat-title-line {
            width: 60px; height: 3px;
            background: linear-gradient(90deg, #C9A94A, #E9CB5B);
            margin: 0 auto; border-radius: 2px;
        }
        .cat-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 16px; max-width: 780px; margin: 0 auto;
        }
        .cat-card {
            position: relative; display: block; border-radius: 14px;
            overflow: hidden; cursor: pointer; text-decoration: none;
            aspect-ratio: 3 / 2; min-height: 180px;
            background: #d4c07a;
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        .cat-card.in-view { opacity: 1; transform: translateY(0); }
        .cat-card--wide { grid-column: 1 / span 2; aspect-ratio: 16 / 6; min-height: 160px; }
        .cat-card img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; display: block;
            transition: transform 0.5s cubic-bezier(0.16,1,0.3,1), filter 0.4s ease;
            filter: brightness(0.82);
        }
        .cat-card:hover img { transform: scale(1.06); filter: brightness(0.65); }
        .cat-card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.72) 0%, rgba(0,0,0,0.10) 55%, transparent 100%);
        }
        .cat-card-info {
            position: absolute; bottom: 0; left: 0; right: 0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 22px;
        }
        .cat-card-label {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 18px; font-weight: 600; color: #fff;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4); letter-spacing: -0.3px;
        }
        .cat-card-arrow {
            font-size: 18px; color: #fff;
            background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.3);
            border-radius: 50%; width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: background 0.3s, transform 0.3s;
            backdrop-filter: blur(4px);
        }
        .cat-card:hover .cat-card-arrow { background: #C9A94A; border-color: #C9A94A; transform: translateX(4px); }
        .cat-card:nth-child(1) { transition-delay: 0.05s; }
        .cat-card:nth-child(2) { transition-delay: 0.13s; }
        .cat-card:nth-child(3) { transition-delay: 0.21s; }
        .cat-card:nth-child(4) { transition-delay: 0.29s; }
        .cat-card:nth-child(5) { transition-delay: 0.37s; }

        /* ===== DRAWER ===== */
        .cat-drawer-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.45);
            backdrop-filter: blur(4px); z-index: 1200;
            opacity: 0; visibility: hidden;
            transition: opacity 0.35s ease, visibility 0.35s;
        }
        .cat-drawer-overlay.open { opacity: 1; visibility: visible; }
        .cat-drawer {
            position: fixed; top: 0; right: 0;
            width: min(860px, 100vw); height: 100vh; background: #fff;
            z-index: 1300; display: flex; flex-direction: column;
            box-shadow: -24px 0 80px rgba(0,0,0,0.14);
            transform: translateX(100%);
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            border-radius: 20px 0 0 20px; overflow: hidden;
        }
        .cat-drawer.open { transform: translateX(0); }
        .cat-drawer-topbar {
            display: flex; align-items: center; gap: 16px;
            padding: 16px 28px; border-bottom: 1px solid rgba(201,169,74,0.15);
            background: #fff; flex-shrink: 0;
        }
        .cat-drawer-back {
            display: flex; align-items: center; gap: 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px; font-weight: 600; color: #444;
            background: none; border: none; cursor: pointer;
            padding: 7px 14px; border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .cat-drawer-back:hover { background: #f5f0e0; color: #C9A94A; }
        .cat-drawer-topbar-title { font-size: 15px; font-weight: 700; color: #111; }
        .cat-drawer-body { flex: 1; overflow-y: auto; scroll-behavior: smooth; overscroll-behavior: contain; }
        .cat-detail { display: none; }
        .cat-detail.active { display: block; }
        .cat-detail-hero { position: relative; width: 100%; height: 200px; overflow: hidden; background: #111; }
        .cat-detail-hero img { width: 100%; height: 100%; object-fit: cover; opacity: 0.7; display: block; }
        .cat-detail-hero-overlay {
            position: absolute; inset: 0; display: flex; align-items: center; justify-content: center;
            background: linear-gradient(to bottom, transparent 20%, rgba(0,0,0,0.45) 100%);
        }
        .cat-detail-hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 42px; font-weight: 700; color: #fff;
            letter-spacing: -1px; text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        }
        .cat-detail-content { padding: 36px 40px 60px; }
        .cat-slider-wrap { position: relative; margin-bottom: 40px; padding: 0 24px; }
        .cat-slider { display: flex; overflow: hidden; gap: 12px; border-radius: 12px; }
        .cat-slide {
            min-width: calc(33.33% - 8px); flex-shrink: 0; border-radius: 12px;
            overflow: hidden; aspect-ratio: 4/3; background: #e8e0cc;
            transition: transform 0.5s cubic-bezier(0.16,1,0.3,1);
        }
        .cat-slide img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .cat-slider-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 40px; height: 40px; background: rgba(255,255,255,0.92);
            border: 1px solid rgba(201,169,74,0.3); border-radius: 50%;
            font-size: 18px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            z-index: 5; color: #333;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            transition: background 0.2s, color 0.2s;
        }
        .cat-slider-btn:hover { background: #C9A94A; color: #fff; border-color: #C9A94A; }
        .cat-slider-prev { left: 0; }
        .cat-slider-next { right: 0; }
        .cat-slider-dots { display: flex; justify-content: center; gap: 8px; margin-top: 16px; }
        .cat-dot {
            width: 8px; height: 8px; border-radius: 50%; background: #ddd;
            cursor: pointer; transition: background 0.25s, transform 0.25s;
        }
        .cat-dot.active { background: #C9A94A; transform: scale(1.3); }
        .cat-detail-info {
            display: grid; grid-template-columns: 1fr 2fr;
            gap: 40px; border-top: 1px solid #eee; padding-top: 32px;
        }
        .cat-detail-left { display: flex; flex-direction: column; gap: 24px; }
        .cat-info-heading { font-size: 14px; font-weight: 700; color: #111; margin-bottom: 6px; }
        .cat-pricelist p, .cat-hours p { font-size: 14px; color: #444; line-height: 1.9; }
        .cat-cta { display: flex; align-items: center; gap: 12px; margin-top: 8px; }
        .btn-wa {
            display: flex; align-items: center; justify-content: center;
            width: 44px; height: 44px; background: #25D366; color: #fff;
            border-radius: 50%; text-decoration: none;
            box-shadow: 0 4px 14px rgba(37,211,102,0.35);
            transition: transform 0.2s, box-shadow 0.2s; flex-shrink: 0;
        }
        .btn-wa:hover { transform: scale(1.08); box-shadow: 0 6px 20px rgba(37,211,102,0.45); }
        .btn-booking {
            display: inline-flex; align-items: center; padding: 11px 26px;
            background: #111; color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px; font-weight: 700; border-radius: 50px;
            text-decoration: none; letter-spacing: 0.05em;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.14);
        }
        .btn-booking:hover { background: #C9A94A; transform: translateY(-2px); box-shadow: 0 8px 22px rgba(201,169,74,0.35); }
        .cat-equip-grid { display: flex; flex-direction: column; gap: 28px; }
        .cat-equip-desc { font-size: 13.5px; color: #555; line-height: 1.7; }
        .cat-equip-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
        .cat-equip-list li { font-size: 13.5px; color: #444; line-height: 1.7; padding-left: 16px; position: relative; }
        .cat-equip-list li::before { content: '•'; position: absolute; left: 0; color: #C9A94A; }
        .cat-equip-price {
            display: inline-block; margin-top: 10px; font-size: 13px; font-weight: 700;
            color: #C9A94A; background: rgba(201,169,74,0.1); padding: 4px 12px; border-radius: 50px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #111; color: #ccc; text-align: center;
            padding: 32px 40px; font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .footer a { color: #e9cb5b; text-decoration: none; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero-title-vi, .hero-title-ps { font-size: 60px; }
            .vm-heading { font-size: 56px; }
            .vm-inner { grid-template-columns: 1fr; }
            .hero-content { padding: 120px 20px 0 20px; }
            .vm-section { padding: 50px 20px 60px 20px; }
        }
        @media (max-width: 700px) {
            .cat-section { padding: 60px 20px 80px; }
            .cat-grid { grid-template-columns: 1fr; gap: 12px; }
            .cat-card--wide { grid-column: 1; aspect-ratio: 3/2; }
            .cat-drawer { width: 100vw; border-radius: 0; }
            .cat-detail-info { grid-template-columns: 1fr; }
            .cat-detail-hero-title { font-size: 28px; }
            .cat-slide { min-width: 80%; }
            .cat-detail-content { padding: 24px 20px 48px; }
        }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <!-- ===== HERO ===== -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="hero-title-vi">Virtual Imagination</div>
            <div class="hero-title-ps">PhotoStudio</div>
            <p class="hero-desc">
                <b>Virtual Imagination</b> adalah studio foto untuk berbagai kebutuhan produksi, mulai dari foto hingga video.
            </p>
            <p class="hero-desc">
                Kami juga menyediakan layanan kreatif seperti pembuatan konten dan kebutuhan visual lainnya.
            </p>
        </div>

        <div class="social-bar">
            <div class="social-bar-inner">
                <a href="#" target="_blank">
                    <!-- Instagram -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    INSTAGRAM
                </a>
                <a href="#" target="_blank">
                    <!-- YouTube -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/>
                    </svg>
                    YOUTUBE
                </a>
                <a href="#" target="_blank">
                    <!-- LinkedIn -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    LINKEDIN
                </a>
                <a href="#" target="_blank">
                    <!-- TikTok -->
                    <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                    </svg>
                    TIK TOK
                </a>
            </div>
        </div>
    </section>

    <!-- ===== VISION & MISSION ===== -->
    <section class="vm-section">
        <div class="vm-inner">
            <div class="vm-left">
                <h2 class="vm-heading">Vision &<br>Mission</h2>
                <div class="vm-divider"></div>
                <p class="vm-body">
                    <b>Our vision</b> is to become a home for creative workers to express and bring their ideas to life. We aim to be a perfect place where people can create and fulfill the needs in the community of creative industry.
                </p>
                <p class="vm-body">
                    <b>Our mission</b> is to provide exquisite ambiance service for the sake of client's satisfaction towards the works of Belinsky Studio. Based on our name, Be Line To The Sky, which implies taking off to the sky, where creativity is limitless. Our job is to produce high quality audio visual output and represent uniqueness in every aspect.
                </p>
                <div class="vm-divider-bottom"></div>
            </div>

            <div class="vm-photos">
                <div class="vm-photo-top-left">
                    <img src="/images/vm1.png" alt="Vision Mission Photo 1">
                </div>
                <div class="vm-photo-top-right">
                    <img src="/images/vm2.png" alt="Vision Mission Photo 2">
                </div>
                <div class="vm-photo-bottom-center">
                    <img src="/images/vm3.png" alt="Vision Mission Photo 3" style="height:210px; object-fit:cover; border-radius:4px;">
                </div>
            </div>
        </div>
    </section>

     <!-- ===== CATEGORY SECTION ===== -->
    <section class="cat-section" id="category">
        <div class="cat-header">
            <h2 class="cat-title">Category</h2>
            <div class="cat-title-line"></div>
        </div>

        <div class="cat-grid">

            <!-- Card 1 -->
            <a class="cat-card" href="#cat-events" onclick="openCategory('cat-events', event)">
                <img src="{{ asset('images/cat-events.jpg') }}" alt="Photo Events" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Events</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 2 -->
            <a class="cat-card" href="#cat-graduation" onclick="openCategory('cat-graduation', event)">
                <img src="{{ asset('images/cat-graduation.jpg') }}" alt="Photo Graduation" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Graduation</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 3 -->
            <a class="cat-card" href="#cat-group" onclick="openCategory('cat-group', event)">
                <img src="{{ asset('images/cat-group.jpg') }}" alt="Photo Group" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Group</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 4 -->
            <a class="cat-card" href="#cat-prewedding" onclick="openCategory('cat-prewedding', event)">
                <img src="{{ asset('images/cat-prewedding.jpg') }}" alt="Photo Prewedding" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Prewedding</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

            <!-- Card 5 (wide) -->
            <a class="cat-card cat-card--wide" href="#cat-personal" onclick="openCategory('cat-personal', event)">
                <img src="{{ asset('images/cat-personal.jpg') }}" alt="Photo Personal" loading="lazy">
                <div class="cat-card-overlay"></div>
                <div class="cat-card-info">
                    <span class="cat-card-label">Photo Personal</span>
                    <span class="cat-card-arrow">→</span>
                </div>
            </a>

        </div>
    </section>

    <!-- ===== CATEGORY DETAIL DRAWER ===== -->
    <div class="cat-drawer-overlay" id="catDrawerOverlay" onclick="closeCategory()"></div>

    <div class="cat-drawer" id="catDrawer">

        <!-- Sticky top bar -->
        <div class="cat-drawer-topbar">
            <button class="cat-drawer-back" onclick="closeCategory()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </button>
            <span class="cat-drawer-topbar-title" id="drawerTopTitle"></span>
        </div>

        <!-- Scrollable content -->
        <div class="cat-drawer-body" id="catDrawerBody">

            <!-- ======= DETAIL: PHOTO EVENTS ======= -->
            <div class="cat-detail" id="cat-events">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-events.jpg') }}" alt="Photo Events">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Events</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('events', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-events">
                            <div class="cat-slide"><img src="{{ asset('images/events-1.jpg') }}" alt="Events 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/events-2.jpg') }}" alt="Events 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/events-3.jpg') }}" alt="Events 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('events', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-events">
                            <span class="cat-dot active" onclick="slideTo('events', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('events', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('events', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>6 hrs &nbsp;: Rp 2.300.000</p>
                                <p>8 hrs &nbsp;: Rp 3.000.000</p>
                                <p>10 hrs : Rp 3.700.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 400.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281514191380?text={{ urlencode('Halo, saya ingin booking paket foto di Virtual Imagination Photo Studio.') }}"
                                    target="_blank"
                                    class="btn-wa">
                                  <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="/bookings/create" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Korean Mood Studio</h3>
                                    <p class="cat-equip-desc">3 thematic Korean backgrounds, inspired by the setup of Korean Drama Series</p>
                                    <p class="cat-equip-desc" style="margin-top:6px;">Our Beloved Summer</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Translucent Umbrella 101cm</li>
                                        <li>Light Stand (2pcs)</li>
                                        <li>Boom Stand with Weight Bag</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional lighting for video:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Godox SL 150W</li>
                                        <li>Light Stand</li>
                                        <li>Softbox with Grid</li>
                                    </ul>
                                    <p class="cat-equip-price">200k/lighting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO GRADUATION ======= -->
            <div class="cat-detail" id="cat-graduation">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-graduation.jpg') }}" alt="Photo Graduation">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Graduation</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('graduation', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-graduation">
                            <div class="cat-slide"><img src="{{ asset('images/graduation-1.jpg') }}" alt="Graduation 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/graduation-2.jpg') }}" alt="Graduation 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/graduation-3.jpg') }}" alt="Graduation 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('graduation', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-graduation">
                            <span class="cat-dot active" onclick="slideTo('graduation', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('graduation', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('graduation', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>2 hrs &nbsp;: Rp 800.000</p>
                                <p>4 hrs &nbsp;: Rp 1.400.000</p>
                                <p>6 hrs &nbsp;: Rp 1.900.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 300.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Graduation Studio</h3>
                                    <p class="cat-equip-desc">Studio khusus sesi wisuda dengan backdrop elegan dan profesional.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Reflector Board</li>
                                        <li>Light Stand (2pcs)</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional props:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Graduation backdrop</li>
                                        <li>Flower stand</li>
                                        <li>Chair set</li>
                                    </ul>
                                    <p class="cat-equip-price">100k/props</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO GROUP ======= -->
            <div class="cat-detail" id="cat-group">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-group.jpg') }}" alt="Photo Group">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Group</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('group', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-group">
                            <div class="cat-slide"><img src="{{ asset('images/group-1.jpg') }}" alt="Group 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/group-2.jpg') }}" alt="Group 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/group-3.jpg') }}" alt="Group 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('group', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-group">
                            <span class="cat-dot active" onclick="slideTo('group', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('group', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('group', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>4 hrs &nbsp;: Rp 1.500.000</p>
                                <p>6 hrs &nbsp;: Rp 2.000.000</p>
                                <p>8 hrs &nbsp;: Rp 2.500.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 350.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Group Studio</h3>
                                    <p class="cat-equip-desc">Ruang luas ideal untuk sesi foto grup, keluarga, atau tim dengan kapasitas hingga 20 orang.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (3 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (3pcs)</li>
                                        <li>Translucent Umbrella 101cm</li>
                                        <li>Light Stand (3pcs)</li>
                                        <li>Boom Stand with Weight Bag</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional for video:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Godox SL 150W</li>
                                        <li>Light Stand</li>
                                        <li>Softbox with Grid</li>
                                    </ul>
                                    <p class="cat-equip-price">200k/lighting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO PREWEDDING ======= -->
            <div class="cat-detail" id="cat-prewedding">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-prewedding.jpg') }}" alt="Photo Prewedding">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Prewedding</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('prewedding', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-prewedding">
                            <div class="cat-slide"><img src="{{ asset('images/prewedding-1.jpg') }}" alt="Prewedding 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/prewedding-2.jpg') }}" alt="Prewedding 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/prewedding-3.jpg') }}" alt="Prewedding 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('prewedding', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-prewedding">
                            <span class="cat-dot active" onclick="slideTo('prewedding', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('prewedding', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('prewedding', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>4 hrs &nbsp;: Rp 1.800.000</p>
                                <p>6 hrs &nbsp;: Rp 2.500.000</p>
                                <p>8 hrs &nbsp;: Rp 3.200.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 450.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Romantic Studio</h3>
                                    <p class="cat-equip-desc">Setting romantis dengan dekorasi premium untuk sesi prewedding yang tak terlupakan.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Translucent Umbrella 101cm</li>
                                        <li>Light Stand (2pcs)</li>
                                        <li>Boom Stand with Weight Bag</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Decoration package:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Flower arch</li>
                                        <li>Neon sign</li>
                                        <li>Candle set</li>
                                    </ul>
                                    <p class="cat-equip-price">350k/package</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======= DETAIL: PHOTO PERSONAL ======= -->
            <div class="cat-detail" id="cat-personal">
                <div class="cat-detail-hero">
                    <img src="{{ asset('images/cat-personal.jpg') }}" alt="Photo Personal">
                    <div class="cat-detail-hero-overlay">
                        <h1 class="cat-detail-hero-title">Photo Personal</h1>
                    </div>
                </div>

                <div class="cat-detail-content">
                    <div class="cat-slider-wrap">
                        <button class="cat-slider-btn cat-slider-prev" onclick="slideMove('personal', -1)">&#8592;</button>
                        <div class="cat-slider" id="slider-personal">
                            <div class="cat-slide"><img src="{{ asset('images/personal-1.jpg') }}" alt="Personal 1"></div>
                            <div class="cat-slide"><img src="{{ asset('images/personal-2.jpg') }}" alt="Personal 2"></div>
                            <div class="cat-slide"><img src="{{ asset('images/personal-3.jpg') }}" alt="Personal 3"></div>
                        </div>
                        <button class="cat-slider-btn cat-slider-next" onclick="slideMove('personal', 1)">&#8594;</button>
                        <div class="cat-slider-dots" id="dots-personal">
                            <span class="cat-dot active" onclick="slideTo('personal', 0)"></span>
                            <span class="cat-dot" onclick="slideTo('personal', 1)"></span>
                            <span class="cat-dot" onclick="slideTo('personal', 2)"></span>
                        </div>
                    </div>

                    <div class="cat-detail-info">
                        <div class="cat-detail-left">
                            <div class="cat-pricelist">
                                <h3 class="cat-info-heading">Pricelist</h3>
                                <p>2 hrs &nbsp;: Rp 700.000</p>
                                <p>4 hrs &nbsp;: Rp 1.200.000</p>
                                <p>6 hrs &nbsp;: Rp 1.700.000</p>
                            </div>
                            <div class="cat-hours">
                                <h3 class="cat-info-heading">Hours in studio</h3>
                                <p>Rp 300.000/hour</p>
                            </div>
                            <div class="cat-cta">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn-wa">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </a>
                                <a href="#booking" class="btn-booking">Booking</a>
                            </div>
                        </div>

                        <div class="cat-detail-right">
                            <div class="cat-equip-grid">
                                <div>
                                    <h3 class="cat-info-heading">Personal Studio</h3>
                                    <p class="cat-equip-desc">Studio compact ideal untuk sesi foto personal, headshot profesional, atau konten media sosial.</p>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Equipment list</h3>
                                    <ul class="cat-equip-list">
                                        <li>Lighting Godox DP400III (2 pcs)</li>
                                        <li>Trigger Wireless Flash</li>
                                        <li>Softbox with Grid (2pcs)</li>
                                        <li>Reflector Board</li>
                                        <li>Light Stand (2pcs)</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="cat-info-heading">Additional for video:</h3>
                                    <ul class="cat-equip-list">
                                        <li>Godox SL 150W</li>
                                        <li>Ring Light</li>
                                        <li>Softbox with Grid</li>
                                    </ul>
                                    <p class="cat-equip-price">150k/lighting</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /catDrawerBody --}}
    </div>{{-- /catDrawer --}}

    <!-- ===== STUDIO RENT ===== -->
    <section id="studio-rent" style="padding:96px 60px;background:#fff;">
        <div style="max-width:1200px;margin:0 auto">
            <div style="margin-bottom:48px">
                <div style="display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:#A8903A;margin-bottom:12px">
                    <span style="width:20px;height:1.5px;background:#CCB049;display:inline-block"></span> Studio Rent
                </div>
                <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:clamp(32px,4vw,48px);font-weight:800;color:#111;letter-spacing:-1px;line-height:1.1;margin-bottom:10px">Paket Studio Kami</h2>
                <p style="font-size:15px;color:#6B6B6B;max-width:520px;line-height:1.7">Pilih paket yang sesuai dengan kebutuhan sesi foto Anda. Harga langsung dari admin, selalu update.</p>
            </div>

            @if(isset($packages) && $packages->isNotEmpty())
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px">
                    @foreach($packages as $pkg)
                        <div style="background:#FAFAF8;border:1px solid rgba(201,169,74,0.15);border-radius:16px;overflow:hidden;transition:transform .3s,box-shadow .3s;display:flex;flex-direction:column" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 48px rgba(0,0,0,0.10)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                            @if($pkg->thumbnail)
                                <img src="{{ asset('storage/'.$pkg->thumbnail) }}" alt="{{ $pkg->name }}" style="width:100%;height:200px;object-fit:cover;display:block">
                            @else
                                <div style="width:100%;height:200px;background:linear-gradient(135deg,#E5E3DC,#D4C9A8);display:flex;align-items:center;justify-content:center">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                                </div>
                            @endif
                            <div style="padding:22px;flex:1;display:flex;flex-direction:column">
                                <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:20px;font-weight:700;color:#111;margin-bottom:4px">{{ $pkg->name }}</div>
                                <div style="font-size:12px;color:#9E9E9E;margin-bottom:12px">
                                    {{ $pkg->duration_minutes >= 60 ? floor($pkg->duration_minutes/60).' jam' : $pkg->duration_minutes.' menit' }}
                                </div>
                                <div style="font-size:14px;color:#6B6B6B;line-height:1.6;flex:1;margin-bottom:20px">{{ $pkg->description ?: 'Studio profesional dengan peralatan lighting premium.' }}</div>
                                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:16px;border-top:1px solid rgba(201,169,74,0.12)">
                                    <div>
                                        <div style="font-size:11px;color:#9E9E9E;font-weight:500">Mulai dari</div>
                                        <div style="font-size:22px;font-weight:700;color:#111">{{ $pkg->getFormattedPrice() }}</div>
                                    </div>
                                    <a href="{{ route('bookings.create', ['package' => $pkg->id]) }}" style="font-size:13px;font-weight:600;color:#fff;background:#111;padding:10px 20px;border-radius:50px;text-decoration:none;transition:background .2s" onmouseover="this.style.background='#CCB049'" onmouseout="this.style.background='#111'">Book Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align:center;padding:80px 24px;color:#9E9E9E;background:#FAFAF8;border:1px solid rgba(201,169,74,0.15);border-radius:16px">
                    <p style="font-size:15px">Paket studio belum tersedia. Hubungi kami untuk informasi lebih lanjut.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ===== PORTFOLIO ===== -->
    <section id="portfolio" style="padding:96px 60px;background:#F7F6F3">
        <div style="max-width:1200px;margin:0 auto">
            <div style="margin-bottom:48px">
                <div style="display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:#A8903A;margin-bottom:12px">
                    <span style="width:20px;height:1.5px;background:#CCB049;display:inline-block"></span> Portfolio
                </div>
                <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:clamp(32px,4vw,48px);font-weight:800;color:#111;letter-spacing:-1px;line-height:1.1;margin-bottom:10px">Hasil Karya Studio</h2>
                <p style="font-size:15px;color:#6B6B6B;max-width:520px;line-height:1.7">Setiap frame adalah cerita. Lihat koleksi hasil sesi foto terbaik dari studio kami.</p>
            </div>

            @if(isset($portfolios) && $portfolios->isNotEmpty())
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">
                    @foreach($portfolios as $i => $item)
                        <div style="{{ $i===0 ? 'grid-column:1/span 2;' : '' }}position:relative;border-radius:14px;overflow:hidden;cursor:pointer;background:#E5E3DC;aspect-ratio:{{ $i===0 ? '3/2' : '1/1' }}" onmouseover="this.querySelector('.pov').style.opacity='1'" onmouseout="this.querySelector('.pov').style.opacity='0'">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s" onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform=''">
                            <div class="pov" style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.65) 0%,transparent 60%);opacity:0;transition:opacity .3s;display:flex;align-items:flex-end;padding:20px">
                                <div>
                                    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:700;color:#fff">{{ $item->title }}</div>
                                    @if($item->client)<div style="font-size:12px;color:rgba(255,255,255,.7);margin-top:3px">{{ $item->client }}</div>@endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align:center;padding:80px 24px;color:#9E9E9E;background:#fff;border:1px solid rgba(201,169,74,0.15);border-radius:16px">
                    <p style="font-size:15px">Portfolio sedang disiapkan. Kunjungi kami kembali segera!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ===== CONTACT (WhatsApp) ===== -->
    <section id="contact" style="padding:96px 60px;background:#fff">
        <div style="max-width:600px;margin:0 auto">
            <div style="text-align:center;margin-bottom:40px">
                <div style="display:inline-flex;align-items:center;justify-content:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:#A8903A;margin-bottom:12px">
                    <span style="width:20px;height:1.5px;background:#CCB049;display:inline-block"></span> Hubungi Kami
                </div>
                <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:38px;font-weight:800;color:#111;letter-spacing:-1px;margin-bottom:10px">Booking & Pertanyaan</h2>
                <p style="font-size:15px;color:#6B6B6B;line-height:1.7">Isi form di bawah dan kami akan merespons melalui WhatsApp segera.</p>
            </div>

            <div style="background:#FAFAF8;border:1px solid rgba(201,169,74,0.15);border-radius:16px;padding:36px">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px">Nama Lengkap *</label>
                        <input type="text" id="wa_name" placeholder="John Doe" value="{{ auth()->user()->name ?? '' }}" style="width:100%;padding:11px 14px;border:1.5px solid rgba(201,169,74,0.2);border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;color:#111;background:#fff;outline:none">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px">No. WhatsApp *</label>
                        <input type="tel" id="wa_phone" placeholder="08xxxxxxxxxx" style="width:100%;padding:11px 14px;border:1.5px solid rgba(201,169,74,0.2);border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;color:#111;background:#fff;outline:none">
                    </div>
                </div>
                <div style="margin-bottom:16px">
                    <label style="display:block;font-size:12px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px">Paket yang Diminati</label>
                    <select id="wa_package" style="width:100%;padding:11px 14px;border:1.5px solid rgba(201,169,74,0.2);border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;color:#111;background:#fff;outline:none">
                        <option value="">-- Pilih Paket (opsional) --</option>
                        @if(isset($packages))
                            @foreach($packages as $pkg)
                                <option value="{{ $pkg->name }}">{{ $pkg->name }} — {{ $pkg->getFormattedPrice() }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div style="margin-bottom:16px">
                    <label style="display:block;font-size:12px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px">Tanggal yang Diinginkan</label>
                    <input type="date" id="wa_date" min="{{ date('Y-m-d') }}" style="width:100%;padding:11px 14px;border:1.5px solid rgba(201,169,74,0.2);border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;color:#111;background:#fff;outline:none">
                </div>
                <div style="margin-bottom:20px">
                    <label style="display:block;font-size:12px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px">Pesan</label>
                    <textarea id="wa_message" placeholder="Ceritakan kebutuhan foto Anda…" style="width:100%;padding:11px 14px;border:1.5px solid rgba(201,169,74,0.2);border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;color:#111;background:#fff;outline:none;resize:vertical;min-height:90px"></textarea>
                </div>
                <button onclick="dashboardWA()" style="width:100%;padding:14px;background:#25D366;color:#fff;border:none;border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:background .2s" onmouseover="this.style.background='#1EB858'" onmouseout="this.style.background='#25D366'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    Kirim via WhatsApp
                </button>
                <p style="text-align:center;font-size:12px;color:#9E9E9E;margin-top:10px">Anda akan diarahkan ke WhatsApp dengan pesan yang sudah terisi otomatis.</p>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Virtual Imagination PhotoStudio. All rights reserved.</p>
    </footer>

    <a name="contact-anchor"></a>


    <script>
        /* =====================================================
           SCROLL: navbar shadow
           ===================================================== */
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;
            navbar.style.boxShadow = window.scrollY > 10
                ? '0 2px 18px rgba(0,0,0,0.13)'
                : '0 1px 8px rgba(0,0,0,0.07)';
        });

        /* =====================================================
           CATEGORY DRAWER
           ===================================================== */
        const sliderState = {};

        function openCategory(id, e) {
            if (e) e.preventDefault();
            const drawer   = document.getElementById('catDrawer');
            const overlay  = document.getElementById('catDrawerOverlay');
            const body     = document.getElementById('catDrawerBody');
            const topTitle = document.getElementById('drawerTopTitle');

            document.querySelectorAll('.cat-detail').forEach(d => d.classList.remove('active'));
            const target = document.getElementById(id);
            if (!target) return;
            target.classList.add('active');

            topTitle.textContent = target.querySelector('.cat-detail-hero-title')?.textContent || '';
            drawer.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
            body.scrollTop = 0;
        }

        function closeCategory() {
            document.getElementById('catDrawer').classList.remove('open');
            document.getElementById('catDrawerOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCategory(); });

        /* =====================================================
           SLIDER ENGINE
           ===================================================== */
        function getSlider(key) {
            if (!sliderState[key]) sliderState[key] = { idx: 0, total: 3 };
            return sliderState[key];
        }

        function slideTo(key, idx) {
            const state  = getSlider(key);
            const track  = document.getElementById('slider-' + key);
            if (!track) return;
            const slides = track.querySelectorAll('.cat-slide');
            state.total  = slides.length;
            state.idx    = Math.max(0, Math.min(idx, state.total - 1));

            slides.forEach((s, i) => {
                const offset = (i - state.idx) * (100 / 3 + 1.5);
                s.style.transform  = `translateX(${offset}%)`;
                s.style.opacity    = Math.abs(i - state.idx) <= 1 ? '1' : '0.4';
                s.style.transition = 'transform 0.5s cubic-bezier(0.16,1,0.3,1), opacity 0.4s ease';
            });

            document.querySelectorAll('#dots-' + key + ' .cat-dot')
                .forEach((d, i) => d.classList.toggle('active', i === state.idx));
        }

        function slideMove(key, dir) {
            slideTo(key, getSlider(key).idx + dir);
        }

        /* =====================================================
           DOM READY
           ===================================================== */
        document.addEventListener('DOMContentLoaded', function () {

            /* Init sliders */
            ['events','graduation','group','prewedding','personal'].forEach(key => {
                sliderState[key] = { idx: 0, total: 3 };
            });

            /* ---- SCROLL REVEAL untuk category cards ----
               Pakai threshold: 0 supaya langsung trigger
               begitu 1px card masuk viewport,
               tanpa tergantung apakah gambar sudah load atau belum */
            const cards = document.querySelectorAll('.cat-card');

            if ('IntersectionObserver' in window) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('in-view');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0, rootMargin: '0px 0px -40px 0px' });

                cards.forEach(c => io.observe(c));
            } else {
                /* Fallback untuk browser lama */
                cards.forEach(c => c.classList.add('in-view'));
            }

            /* ---- Deep link via hash ---- */
            const hash = window.location.hash.replace('#', '');
            const validCats = ['cat-events','cat-graduation','cat-group','cat-prewedding','cat-personal'];
            if (validCats.includes(hash)) openCategory(hash, null);
        });

        /* =====================================================
           WHATSAPP CONTACT FORM
           ===================================================== */
        function dashboardWA() {
            const name    = document.getElementById('wa_name').value.trim();
            const phone   = document.getElementById('wa_phone').value.trim();
            const pkg     = document.getElementById('wa_package').value;
            const date    = document.getElementById('wa_date').value;
            const message = document.getElementById('wa_message').value.trim();

            if (!name || !phone) {
                alert('Nama dan nomor WhatsApp wajib diisi.');
                return;
            }

            let text = 'Halo Virtual Imagination! 👋\n\n';
            text += 'Nama  : ' + name + '\n';
            text += 'No. HP: ' + phone + '\n';
            if (pkg)     text += 'Paket : ' + pkg + '\n';
            if (date)    text += 'Tanggal: ' + date + '\n';
            if (message) text += '\nPesan :\n' + message + '\n';
            text += '\nMohon informasinya. Terima kasih!';

            window.open('https://wa.me/6281514191380?text=' + encodeURIComponent(text), '_blank');
        }
    </script>
</body>
</html>
