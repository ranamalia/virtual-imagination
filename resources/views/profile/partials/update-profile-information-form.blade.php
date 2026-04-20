<section>
    <div class="profile-card">
        <h3 class="profile-card-title">Profile Information</h3>
        <p class="profile-card-desc">Update your account's profile information and email address.</p>

        @if ($user->hasVerifiedEmail() === false && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
            <div class="pf-verify-banner">
                ⚠️ Your email address is unverified.
                <a href="{{ route('verification.send') }}" onclick="event.preventDefault(); document.getElementById('send-verification').submit();">
                    Click here to re-send the verification email.
                </a>
                @if (session('status') === 'verification-link-sent')
                    <br><strong>A new verification link has been sent to your email address.</strong>
                @endif
            </div>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
        @endif

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="pf-form-group">
                <label for="name" class="pf-label">Name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="pf-input {{ $errors->has('name') ? 'pf-input-error' : '' }}"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                />
                @error('name')
                    <p class="pf-error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="pf-form-group">
                <label for="email" class="pf-label">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="pf-input {{ $errors->has('email') ? 'pf-input-error' : '' }}"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                />
                @error('email')
                    <p class="pf-error-text">{{ $message }}</p>
                @enderror
            </div>

            <div style="display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-top:8px;">
                <button type="submit" class="pf-btn pf-btn-primary">
                    Save
                </button>

                @if (session('status') === 'profile-updated')
                    <span class="pf-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Your profile has been updated successfully.
                    </span>
                @endif
            </div>
        </form>
    </div>
</section>
