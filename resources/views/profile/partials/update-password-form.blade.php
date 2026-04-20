<section>
    <div class="profile-card">
        <h3 class="profile-card-title">Update Password</h3>
        <p class="profile-card-desc">Make sure your password is strong and unique to keep your account secure.</p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="pf-form-group">
                <label for="current_password" class="pf-label">Current Password</label>
                <div class="pf-password-wrapper">
                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        class="pf-input {{ $errors->updatePassword->has('current_password') ? 'pf-input-error' : '' }}"
                        placeholder="Enter your current password"
                        autocomplete="current-password"
                    />
                    <button type="button" class="pf-eye-btn" onclick="togglePassword('current_password', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @if ($errors->updatePassword->has('current_password'))
                    <p class="pf-error-text">{{ $errors->updatePassword->first('current_password') }}</p>
                @endif
            </div>

            <div class="pf-grid-2">
                <div class="pf-form-group">
                    <label for="password" class="pf-label">New Password</label>
                    <div class="pf-password-wrapper">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="pf-input {{ $errors->updatePassword->has('password') ? 'pf-input-error' : '' }}"
                            placeholder="Enter new password"
                            autocomplete="new-password"
                        />
                        <button type="button" class="pf-eye-btn" onclick="togglePassword('password', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @if ($errors->updatePassword->has('password'))
                        <p class="pf-error-text">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div class="pf-form-group">
                    <label for="password_confirmation" class="pf-label">Confirm New Password</label>
                    <div class="pf-password-wrapper">
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="pf-input {{ $errors->updatePassword->has('password_confirmation') ? 'pf-input-error' : '' }}"
                            placeholder="Confirm new password"
                            autocomplete="new-password"
                        />
                        <button type="button" class="pf-eye-btn" onclick="togglePassword('password_confirmation', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <p class="pf-error-text">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>

            <div class="pf-strength-bar-wrap" id="strength-wrap" style="display:none;">
                <div class="pf-strength-header">
                    <span class="pf-label" style="margin:0;">Password Strength</span>
                    <span class="pf-strength-label-text" id="strength-label"></span>
                </div>
                <div class="pf-strength-track">
                    <div class="pf-strength-fill" id="strength-fill"></div>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-top:8px;">
                <button type="submit" class="pf-btn pf-btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <span class="pf-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Password updated successfully!
                    </span>
                @endif
            </div>
        </form>
    </div>

    <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const eyeOpen = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
            const eyeOff  = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = eyeOff;
            } else {
                input.type = 'password';
                btn.innerHTML = eyeOpen;
            }
        }

        document.getElementById('password')?.addEventListener('input', function () {
            const val = this.value;
            const wrap  = document.getElementById('strength-wrap');
            const fill  = document.getElementById('strength-fill');
            const label = document.getElementById('strength-label');

            if (!val) { wrap.style.display = 'none'; return; }
            wrap.style.display = 'block';

            let score = 0;
            if (val.length >= 8)          score++;
            if (/[A-Z]/.test(val))        score++;
            if (/[0-9]/.test(val))        score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [
                { pct: '25%', color: '#d32f2f', text: 'Weak' },
                { pct: '50%', color: '#f57c00', text: 'Fair' },
                { pct: '75%', color: '#f9a825', text: 'Good' },
                { pct: '100%', color: '#388e3c', text: 'Strong' },
            ];
            const level = levels[score - 1] || levels[0];
            fill.style.width      = level.pct;
            fill.style.background = level.color;
            label.textContent     = level.text;
            label.style.color     = level.color;
        });
    </script>
</section>
