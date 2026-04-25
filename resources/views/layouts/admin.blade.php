<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} – Virtual Imagination</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Design tokens (selaras dengan user UI) ────────── */
        :root {
            --gold:          #CCB049;
            --gold-light:    #E2C96A;
            --gold-dark:     #A8903A;
            --ink:           #1A1A1A;
            --text-hi:       #1A1A1A;
            --text-mid:      #6B6B6B;
            --text-lo:       #9E9E9E;
            --surface:       #FFFFFF;
            --surface-2:     #F7F6F3;
            --surface-3:     #EFEFED;
            --border:        #E5E3DC;
            --border-hi:     #CCB049;
            --success:       #2D7A4F;
            --success-bg:    #E8F5EE;
            --warning:       #B45309;
            --warning-bg:    #FEF3C7;
            --danger:        #C0392B;
            --danger-bg:     #FDECEA;
            --info:          #1E5FA8;
            --info-bg:       #EBF3FB;
            --sidebar-w:     260px;
            --radius-sm:     6px;
            --radius-md:     12px;
            --radius-lg:     20px;
            --transition:    .22s cubic-bezier(.4,0,.2,1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F0EDE6;
            color: var(--text-hi);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ───────────────────────────────────────── */
        .vi-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: -.3px;
        }

        .sidebar-brand h2 span { color: var(--gold); }

        .sidebar-brand small {
            font-size: 11px;
            color: var(--text-lo);
            font-weight: 400;
            display: block;
            margin-top: 3px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 20px 16px;
            flex: 1;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--text-lo);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 0 8px;
            margin: 16px 0 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: var(--text-mid);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all var(--transition);
            margin-bottom: 2px;
        }

        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(204, 176, 73, 0.1);
            color: var(--gold-dark);
        }

        .nav-item.active {
            border-left: 3px solid var(--gold);
            padding-left: 9px;
        }

        /* ── Sidebar Footer ────────────────────────────────── */
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border);
        }

        .admin-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: var(--surface-2);
            margin-bottom: 10px;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: var(--surface);
            flex-shrink: 0;
        }

        .admin-name  { font-size: 13px; font-weight: 600; color: var(--ink); }
        .admin-role  { font-size: 11px; color: var(--text-lo); }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 9px 12px;
            border-radius: var(--radius-sm);
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid rgba(192, 57, 43, .2);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--transition);
            font-family: 'DM Sans', sans-serif;
        }

        .btn-logout:hover { background: rgba(192, 57, 43, .18); }

        /* ── Main ──────────────────────────────────────────── */
        .vi-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ────────────────────────────────────────── */
        .vi-topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
        }

        .topbar-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 20px;
            background: rgba(204, 176, 73, .12);
            color: var(--gold-dark);
            font-size: 12px;
            font-weight: 600;
            border: 1px solid rgba(204, 176, 73, .25);
        }

        .topbar-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
            animation: pulse 2s infinite;
        }

        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .4; } }

        /* ── Content Area ──────────────────────────────────── */
        .vi-content {
            padding: 32px;
            flex: 1;
        }

        /* ── Flash Messages ────────────────────────────────── */
        .flash {
            padding: 12px 18px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1px solid;
        }

        .flash-success { background: var(--success-bg); color: var(--success); border-color: rgba(45,122,79,.25); }
        .flash-warning { background: var(--warning-bg); color: var(--warning); border-color: rgba(180,83,9,.25); }
        .flash-error   { background: var(--danger-bg);  color: var(--danger);  border-color: rgba(192,57,43,.25); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="vi-sidebar">
        <div class="sidebar-brand">
            <h2>Virtual <span>Imagination</span></h2>
            <small>Admin Panel</small>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Dashboard
            </a>

            <div class="nav-section-label">Manajemen</div>

            <a href="{{ route('admin.bookings.index') }}"
               class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                Semua Booking
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                Data User
            </a>

            <a href="{{ route('admin.packages.index') }}"
               class="nav-item {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                Paket Foto
            </a>

            <a href="{{ route('admin.portfolios.index') }}"
               class="nav-item {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                Portfolio
            </a>

        </nav>

        <div class="sidebar-footer">
            <div class="admin-card">
                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="admin-name">{{ Auth::user()->name }}</div>
                    <div class="admin-role">Administrator</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="width:16px;height:16px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="vi-main">
        <header class="vi-topbar">
            <div class="topbar-title">{{ $title ?? 'Admin Panel' }}</div>
            <div class="topbar-badge">Admin Mode Aktif</div>
        </header>

        <main class="vi-content">
            @if(session('success'))
                <div class="flash flash-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('warning'))
                <div class="flash flash-warning">⚠ {{ session('warning') }}</div>
            @endif
            @if(session('error'))
                <div class="flash flash-error">✗ {{ session('error') }}</div>
            @endif

            {{ $slot }}
        </main>
    </div>

</body>
</html>
