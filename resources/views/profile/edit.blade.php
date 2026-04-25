<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Profile Settings — Virtual Imagination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Design tokens ── */
        :root {
            --gold: #CCB049; --gold-light: #E2C96A; --gold-dark: #A8903A;
            --ink: #1A1A1A; --text-mid: #6B6B6B; --text-lo: #9E9E9E;
            --surface: #FFFFFF; --surface-2: #F7F6F3; --surface-3: #EFEFED;
            --border: #E5E3DC; --radius-sm: 6px; --radius-md: 12px; --radius-lg: 20px;
            --danger: #C0392B; --danger-bg: #FDECEA;
            --success: #2D7A4F; --success-bg: #E8F5EE;
            --transition: .22s cubic-bezier(.4,0,.2,1);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { -webkit-font-smoothing: antialiased; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F0EDE6;
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── Shell ── */
        .fs-shell {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .fs-sidebar {
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 32px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .fs-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: var(--radius-sm);
            transition: all var(--transition);
            margin-bottom: 28px;
        }
        .fs-back-btn:hover { background: var(--surface-2); color: var(--ink); }

        .fs-sidebar-identity {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px 16px 24px;
            background: linear-gradient(135deg, rgba(204,176,73,.08), rgba(226,201,106,.04));
            border: 1px solid rgba(204,176,73,.2);
            border-radius: var(--radius-md);
            margin-bottom: 24px;
        }

        .fs-avatar {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; font-weight: 700;
            margin-bottom: 12px;
            box-shadow: 0 4px 16px rgba(204,176,73,.3);
        }

        .fs-sidebar-name { font-size: 15px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
        .fs-sidebar-email { font-size: 12px; color: var(--text-lo); }

        .fs-nav { display: flex; flex-direction: column; gap: 4px; }

        .fs-nav-btn {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 11px 14px;
            background: none; border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 500;
            color: var(--text-mid);
            cursor: pointer;
            transition: all var(--transition);
            text-align: left;
        }
        .fs-nav-btn:hover { background: var(--surface-2); color: var(--ink); }
        .fs-nav-btn.active { background: rgba(204,176,73,.1); color: var(--gold-dark); font-weight: 600; border-left: 3px solid var(--gold); padding-left: 11px; }
        .fs-nav-btn.fs-nav-danger { color: var(--danger); }
        .fs-nav-btn.fs-nav-danger:hover { background: var(--danger-bg); }
        .fs-nav-btn.fs-nav-danger.active { background: var(--danger-bg); border-color: var(--danger); }

        .fs-nav-icon { display: flex; align-items: center; flex-shrink: 0; }
        .fs-nav-arrow { margin-left: auto; opacity: .4; }

        /* ── Main ── */
        .fs-main {
            padding: 40px;
            overflow-y: auto;
        }

        .fs-topbar { display: none; }
        .fs-mobile-tabs { display: none; }

        /* ── Panel ── */
        .fs-panel { display: none; }
        .fs-panel.active { display: block; }

        .fs-panel-inner { max-width: 680px; }

        .fs-panel-header { margin-bottom: 28px; }
        .fs-panel-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px; font-weight: 600; color: var(--ink);
            margin-bottom: 6px;
        }
        .fs-panel-desc { font-size: 14px; color: var(--text-mid); }

        /* ── Section ── */
        .fs-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 28px;
            margin-bottom: 16px;
        }

        .fs-section-label {
            display: flex; align-items: center; gap: 7px;
            font-size: 11px; font-weight: 700;
            color: var(--text-lo); text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .fs-section-desc { font-size: 13px; color: var(--text-mid); margin-bottom: 20px; margin-top: -10px; }

        .fs-divider { height: 1px; background: var(--border); margin: 0 0 16px; }

        /* ── Form ── */
        .fs-form { display: flex; flex-direction: column; gap: 16px; }

        .fs-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .fs-field { display: flex; flex-direction: column; gap: 5px; }

        .fs-label {
            font-size: 12px; font-weight: 600;
            color: var(--text-mid); text-transform: uppercase; letter-spacing: .6px;
        }

        .fs-input {
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: var(--ink);
            background: var(--surface-2);
            transition: border-color var(--transition), box-shadow var(--transition);
            outline: none;
            width: 100%;
        }
        .fs-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(204,176,73,.12); background: #fff; }
        .fs-input-err { border-color: var(--danger); }
        .fs-input-wrap { position: relative; }
        .fs-input-wrap .fs-input { padding-right: 44px; }

        .fs-eye {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: var(--text-lo); padding: 0; display: flex; align-items: center;
            transition: color var(--transition);
        }
        .fs-eye:hover { color: var(--ink); }

        .fs-err-msg { font-size: 12px; color: var(--danger); margin-top: 2px; }

        /* Strength meter */
        .fs-strength-wrap { display: none; }
        .fs-strength-wrap.visible { display: block; margin-top: 4px; }
        .fs-strength-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
        .fs-strength-text { font-size: 12px; font-weight: 600; }
        .fs-strength-track { height: 5px; background: var(--surface-3); border-radius: 10px; overflow: hidden; }
        .fs-strength-bar { height: 100%; width: 0; border-radius: 10px; transition: width .4s ease, background .4s ease; }

        /* Footer */
        .fs-form-footer {
            display: flex; align-items: center; gap: 12px;
            padding-top: 8px;
        }

        .fs-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 600;
            cursor: pointer; border: none;
            transition: all var(--transition);
        }
        .fs-btn-primary { background: var(--gold); color: var(--ink); }
        .fs-btn-primary:hover { background: var(--gold-dark); color: #fff; }

        .fs-saved {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 13px; font-weight: 500; color: var(--success);
        }

        /* ── Alert ── */
        .fs-alert {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px; border-radius: var(--radius-sm);
            font-size: 13px; margin-bottom: 20px;
        }
        .fs-alert-warn { background: #FEF3C7; color: #B45309; border: 1px solid rgba(180,83,9,.2); }
        .fs-alert a { color: inherit; font-weight: 600; }

        /* ── Delete panel ── */
        .fs-delete-warn {
            background: var(--danger-bg);
            border: 1px solid rgba(192,57,43,.2);
            border-radius: var(--radius-md);
            padding: 28px;
        }
        .fs-delete-warn h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 600; color: var(--danger);
            margin-bottom: 8px;
        }
        .fs-delete-warn p { font-size: 14px; color: var(--text-mid); margin-bottom: 20px; line-height: 1.6; }
        .fs-btn-danger { background: var(--danger); color: #fff; }
        .fs-btn-danger:hover { background: #a93226; }

        /* ── Sidebar deco ── */
        .fs-sidebar-deco {
            margin-top: auto;
            height: 120px;
            background: linear-gradient(135deg, rgba(204,176,73,.07), rgba(226,201,106,.04));
            border-radius: var(--radius-md);
            border: 1px dashed rgba(204,176,73,.25);
        }

        /* ── Panel Tag ── */
        .fs-panel-tag {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .8px;
            margin-bottom: 10px;
        }
        .fs-panel-tag-danger { background: var(--danger-bg); color: var(--danger); }
        .fs-title-danger { color: var(--danger) !important; }

        /* ── Danger checklist ── */
        .fs-danger-checklist {
            background: var(--danger-bg);
            border: 1px solid rgba(192,57,43,.15);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            display: flex; flex-direction: column; gap: 10px;
            margin-bottom: 24px;
        }
        .fs-danger-item {
            display: flex; align-items: center; gap: 10px;
            font-size: 14px; color: #7b2121;
        }
        .fs-danger-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--danger); flex-shrink: 0;
        }

        /* ── Modal ── */
        .fs-modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4); backdrop-filter: blur(4px);
            z-index: 9000; display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: opacity .25s, visibility .25s;
        }
        .fs-modal-overlay.open { opacity: 1; visibility: visible; }
        .fs-modal {
            background: var(--surface); border-radius: var(--radius-lg);
            padding: 32px; width: min(480px, 90vw);
            box-shadow: 0 24px 80px rgba(0,0,0,.18);
        }
        .fs-modal-warn-icon {
            width: 56px; height: 56px; border-radius: 50%;
            background: var(--danger-bg);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .fs-modal-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 600; color: var(--ink);
            margin-bottom: 8px;
        }
        .fs-modal-desc { font-size: 14px; color: var(--text-mid); margin-bottom: 24px; line-height: 1.6; }
        .fs-modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .fs-btn-ghost {
            background: var(--surface-2); color: var(--text-mid);
            border: 1px solid var(--border);
        }
        .fs-btn-ghost:hover { background: var(--surface-3); color: var(--ink); }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .fs-shell { grid-template-columns: 1fr; }

            .fs-sidebar { display: none; }

            .fs-main { padding: 0 0 40px; }

            .fs-topbar {
                display: flex; align-items: center; justify-content: space-between;
                padding: 16px 20px;
                background: var(--surface);
                border-bottom: 1px solid var(--border);
                position: sticky; top: 0; z-index: 10;
            }
            .fs-back-btn-mobile {
                display: flex; align-items: center; justify-content: center;
                width: 36px; height: 36px;
                border-radius: var(--radius-sm);
                color: var(--text-mid); text-decoration: none;
                transition: background var(--transition);
            }
            .fs-back-btn-mobile:hover { background: var(--surface-2); }
            .fs-topbar-title { font-size: 14px; font-weight: 600; }
            .fs-avatar-sm {
                width: 32px; height: 32px; border-radius: 50%;
                background: linear-gradient(135deg, var(--gold), var(--gold-dark));
                color: #fff; display: flex; align-items: center; justify-content: center;
                font-size: 12px; font-weight: 700;
            }

            .fs-mobile-tabs {
                display: flex;
                border-bottom: 1px solid var(--border);
                background: var(--surface);
            }
            .fs-mob-tab {
                flex: 1; padding: 12px 8px;
                background: none; border: none;
                font-family: 'DM Sans', sans-serif;
                font-size: 13px; font-weight: 500; color: var(--text-mid);
                cursor: pointer; border-bottom: 2px solid transparent;
                transition: all var(--transition);
            }
            .fs-mob-tab.active { color: var(--gold-dark); border-bottom-color: var(--gold); font-weight: 600; }
            .fs-mob-tab.fs-mob-danger { color: var(--danger); }

            .fs-panel-inner { padding: 20px; }

            .fs-field-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="fs-shell">

    {{-- ── LEFT SIDEBAR ── --}}
    <aside class="fs-sidebar">
        <a href="{{ route('home') }}" class="fs-back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke Beranda
        </a>

        <div class="fs-sidebar-identity">
            <div class="fs-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="fs-sidebar-name">{{ Auth::user()->name }}</div>
            <div class="fs-sidebar-email">{{ Auth::user()->email }}</div>
        </div>

        <nav class="fs-nav">
            <button class="fs-nav-btn active" data-tab="profile">
                <span class="fs-nav-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </span>
                Profile &amp; Password
                <span class="fs-nav-arrow">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </button>
            <button class="fs-nav-btn fs-nav-danger" data-tab="delete">
                <span class="fs-nav-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                </span>
                Delete Account
                <span class="fs-nav-arrow">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </span>
            </button>
        </nav>

        <div class="fs-sidebar-deco"></div>
    </aside>

    {{-- ── RIGHT CONTENT ── --}}
    <main class="fs-main">

        {{-- Mobile top bar --}}
        <div class="fs-topbar">
            <a href="{{ route('home') }}" class="fs-back-btn-mobile">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
            <span class="fs-topbar-title" id="mobile-title">Profile &amp; Password</span>
            <div class="fs-avatar-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        </div>

        {{-- Mobile nav tabs --}}
        <div class="fs-mobile-tabs">
            <button class="fs-mob-tab active" data-tab="profile">Profile &amp; Password</button>
            <button class="fs-mob-tab fs-mob-danger" data-tab="delete">Delete Account</button>
        </div>

        {{-- Panel: Profile + Password (merged) --}}
        <div class="fs-panel active" id="panel-profile">
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Panel: Delete Account --}}
        <div class="fs-panel" id="panel-delete">
            @include('profile.partials.delete-user-form')
        </div>

    </main>
</div>

<script>
    const tabs   = ['profile', 'delete'];
    const titles = { profile: 'Profile & Password', delete: 'Delete Account' };

    function activateTab(tab) {
        document.querySelectorAll('.fs-nav-btn').forEach(b => b.classList.toggle('active', b.dataset.tab === tab));
        document.querySelectorAll('.fs-mob-tab').forEach(b => b.classList.toggle('active', b.dataset.tab === tab));
        tabs.forEach(t => {
            const el = document.getElementById('panel-' + t);
            if (el) el.classList.toggle('active', t === tab);
        });
        const mt = document.getElementById('mobile-title');
        if (mt) mt.textContent = titles[tab];
    }

    document.querySelectorAll('.fs-nav-btn, .fs-mob-tab').forEach(btn => {
        btn.addEventListener('click', () => activateTab(btn.dataset.tab));
    });

    @if($errors->userDeletion->isNotEmpty())
        document.addEventListener('DOMContentLoaded', () => activateTab('delete'));
    @endif
</script>

</body>
</html>
