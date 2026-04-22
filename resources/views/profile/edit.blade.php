<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Settings</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="fs-shell">

    {{-- ── LEFT SIDEBAR ── --}}
    <aside class="fs-sidebar">
        <a href="{{ route('dashboard') }}" class="fs-back-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back
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
                Profile & Password
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
            <a href="{{ route('dashboard') }}" class="fs-back-btn-mobile">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
            <span class="fs-topbar-title" id="mobile-title">Profile & Password</span>
            <div class="fs-avatar-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        </div>

        {{-- Mobile nav tabs --}}
        <div class="fs-mobile-tabs">
            <button class="fs-mob-tab active" data-tab="profile">Profile & Password</button>
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
