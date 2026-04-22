<div class="fs-panel-inner">

    {{-- ══════════════════════════════════
         SECTION 1 — PROFILE INFO
    ══════════════════════════════════ --}}
    <div class="fs-section">
        <div class="fs-panel-header">
            <h1 class="fs-panel-title">Profile & Password</h1>
            <p class="fs-panel-desc">Manage your personal information and keep your account secure.</p>
        </div>

        @if ($user->hasVerifiedEmail() === false && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
            <div class="fs-alert fs-alert-warn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>
                    Your email is unverified.
                    <a href="{{ route('verification.send') }}" onclick="event.preventDefault(); document.getElementById('send-verification').submit();">Resend verification email.</a>
                    @if (session('status') === 'verification-link-sent')
                        <strong> Sent!</strong>
                    @endif
                </span>
            </div>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>
        @endif

        <div class="fs-section-label">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Personal Information
        </div>

        <form method="post" action="{{ route('profile.update') }}" class="fs-form">
            @csrf
            @method('patch')

            <div class="fs-field-row">
                <div class="fs-field">
                    <label for="name" class="fs-label">Full Name</label>
                    <input id="name" name="name" type="text"
                        class="fs-input {{ $errors->has('name') ? 'fs-input-err' : '' }}"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Your full name"
                        required autofocus autocomplete="name" />
                    @error('name')<p class="fs-err-msg">{{ $message }}</p>@enderror
                </div>

                <div class="fs-field">
                    <label for="email" class="fs-label">Email Address</label>
                    <input id="email" name="email" type="email"
                        class="fs-input {{ $errors->has('email') ? 'fs-input-err' : '' }}"
                        value="{{ old('email', $user->email) }}"
                        placeholder="your@email.com"
                        required autocomplete="username" />
                    @error('email')<p class="fs-err-msg">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="fs-form-footer">
                <button type="submit" class="fs-btn fs-btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Profile
                </button>
                @if (session('status') === 'profile-updated')
                    <span class="fs-saved">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Saved!
                    </span>
                @endif
            </div>
        </form>
    </div>

    {{-- ── DIVIDER ── --}}
    <div class="fs-divider">
    </div>

    {{-- ══════════════════════════════════
         SECTION 2 — PASSWORD
    ══════════════════════════════════ --}}
    <div class="fs-section">

        <div class="fs-section-label">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Change Password
        </div>

        <p class="fs-section-desc">Use a strong, unique password you don't use on other sites.</p>

        <form method="post" action="{{ route('password.update') }}" class="fs-form">
            @csrf
            @method('put')

            <div class="fs-field">
                <label for="current_password" class="fs-label">Current Password</label>
                <div class="fs-input-wrap">
                    <input id="current_password" name="current_password" type="password"
                        class="fs-input {{ $errors->updatePassword->has('current_password') ? 'fs-input-err' : '' }}"
                        placeholder="Enter current password"
                        autocomplete="current-password" />
                    <button type="button" class="fs-eye" onclick="togglePw('current_password',this)" tabindex="-1">
                        <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="eye-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                @if ($errors->updatePassword->has('current_password'))
                    <p class="fs-err-msg">{{ $errors->updatePassword->first('current_password') }}</p>
                @endif
            </div>

            <div class="fs-field-row">
                <div class="fs-field">
                    <label for="password" class="fs-label">New Password</label>
                    <div class="fs-input-wrap">
                        <input id="password" name="password" type="password"
                            class="fs-input {{ $errors->updatePassword->has('password') ? 'fs-input-err' : '' }}"
                            placeholder="Enter new password"
                            autocomplete="new-password" />
                        <button type="button" class="fs-eye" onclick="togglePw('password',this)" tabindex="-1">
                            <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg class="eye-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                    @if ($errors->updatePassword->has('password'))
                        <p class="fs-err-msg">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div class="fs-field">
                    <label for="password_confirmation" class="fs-label">Confirm New Password</label>
                    <div class="fs-input-wrap">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="fs-input {{ $errors->updatePassword->has('password_confirmation') ? 'fs-input-err' : '' }}"
                            placeholder="Confirm new password"
                            autocomplete="new-password" />
                        <button type="button" class="fs-eye" onclick="togglePw('password_confirmation',this)" tabindex="-1">
                            <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg class="eye-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <p class="fs-err-msg">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>

            {{-- Strength meter --}}
            <div class="fs-strength-wrap" id="strength-wrap">
                <div class="fs-strength-header">
                    <span class="fs-label" style="margin:0">Password Strength</span>
                    <span id="strength-label" class="fs-strength-text"></span>
                </div>
                <div class="fs-strength-track">
                    <div class="fs-strength-bar" id="strength-bar"></div>
                </div>
            </div>

            <div class="fs-form-footer">
                <button type="submit" class="fs-btn fs-btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Update Password
                </button>
                @if (session('status') === 'password-updated')
                    <span class="fs-saved">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Updated!
                    </span>
                @endif
            </div>
        </form>
    </div>

</div>

<script>
function togglePw(id, btn) {
    const inp = document.getElementById(id);
    const isHidden = inp.type === 'password';
    inp.type = isHidden ? 'text' : 'password';
    btn.querySelector('.eye-open').style.display = isHidden ? 'none' : '';
    btn.querySelector('.eye-off').style.display  = isHidden ? ''     : 'none';
}

document.getElementById('password')?.addEventListener('input', function () {
    const v     = this.value;
    const wrap  = document.getElementById('strength-wrap');
    const bar   = document.getElementById('strength-bar');
    const label = document.getElementById('strength-label');
    if (!v) { wrap.classList.remove('visible'); return; }
    wrap.classList.add('visible');
    let s = 0;
    if (v.length >= 8)          s++;
    if (/[A-Z]/.test(v))        s++;
    if (/[0-9]/.test(v))        s++;
    if (/[^A-Za-z0-9]/.test(v)) s++;
    const lvl = [
        { w: '25%',  c: '#e53935', t: 'Weak'   },
        { w: '50%',  c: '#fb8c00', t: 'Fair'   },
        { w: '75%',  c: '#fdd835', t: 'Good'   },
        { w: '100%', c: '#43a047', t: 'Strong' },
    ][s - 1] || { w: '10%', c: '#e53935', t: 'Too short' };
    bar.style.width      = lvl.w;
    bar.style.background = lvl.c;
    label.textContent    = lvl.t;
    label.style.color    = lvl.c;
});
</script>
