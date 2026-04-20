<x-app-layout>
    <x-slot name="header">
        <h2 class="profile-page-title">{{ __('Profile Settings') }}</h2>
    </x-slot>

    <div class="profile-page-container">

        {{-- Sidebar --}}
        <div class="profile-sidebar">
            <div class="profile-avatar-block">
                <div class="profile-avatar-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="profile-avatar-name">{{ Auth::user()->name }}</div>
                <div class="profile-avatar-email">{{ Auth::user()->email }}</div>
            </div>

            <nav class="profile-nav">
                <button class="profile-nav-item active" onclick="switchTab('profile', this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Edit Profile
                </button>
                <button class="profile-nav-item" onclick="switchTab('password', this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Update Password
                </button>
                <button class="profile-nav-item profile-nav-danger" onclick="switchTab('delete', this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                    Delete Account
                </button>
            </nav>
        </div>

        {{-- Tab Panels --}}
        <div class="profile-content">

            <div id="tab-profile" class="profile-tab-panel active">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div id="tab-password" class="profile-tab-panel">
                @include('profile.partials.update-password-form')
            </div>

            <div id="tab-delete" class="profile-tab-panel">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>

    <script>
        function switchTab(tab, btn) {
            document.querySelectorAll('.profile-tab-panel').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.profile-nav-item').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
            btn.classList.add('active');
        }

        @if (session('status') === 'password-updated')
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelector('[onclick="switchTab(\'password\', this)"]').click();
            });
        @endif
    </script>
</x-app-layout>
