<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h1 class="auth-heading">Reset Your Password</h1>

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label">Email*</label>
            <input
                id="email"
                type="email"
                name="email"
                class="form-input"
                value="{{ old('email') }}"
                placeholder="your@email.com"
                required
                autocomplete="username"
            >
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Password*</label>
            <div class="input-wrapper">
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-input"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
                <span class="eye-icon" onclick="togglePassword('password', this)" aria-label="Toggle password visibility">
                    <!-- Eye Open -->
                    <svg class="icon-eye-closed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <!-- Eye Closed -->
                    <svg class="icon-eye-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </span>
            </div>
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror

            <div class="password-helper">
                <span class="password-helper-left">Minimal 8 karakter</span>
            </div>
        </div>

        <!-- Confirm -->
         <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password*</label>
            <div class="input-wrapper">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-input"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
                <span class="eye-icon" onclick="togglePassword('password_confirmation', this)" aria-label="Toggle password visibility">
                    <!-- Eye Open -->
                    <svg class="icon-eye-closed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <!-- Eye Closed -->
                    <svg class="icon-eye-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </span>
            </div>
            @error('password_confirmation')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-continue">Continue</button>
    </form>
</x-guest-layout>

<style>
.input-wrapper {
    position: relative;
}

.form-input {
    width: 90%;
    padding: 12px;
    padding-right: 45px;
    border-radius: 12px;
    border: 2px solid #000;
    box-sizing: border-box;
}

/* ICON WRAPPER */
.eye-icon {
    position: absolute;
    right: 50px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    user-select: none;
}

.eye-icon svg {
    width: 20px;
    height: 20px;
    transition: opacity 0.2s ease;
}

/* Default: tampilkan icon open, sembunyikan icon closed */
.eye-icon .icon-eye-open  { display: block; }
.eye-icon .icon-eye-closed { display: none; }

/* Saat password ditampilkan: balik keduanya */
.eye-icon.is-visible .icon-eye-open  { display: none; }
.eye-icon.is-visible .icon-eye-closed { display: block; }
</style>

<script>
function togglePassword(id, el) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        el.classList.add("is-visible");
    } else {
        input.type = "password";
        el.classList.remove("is-visible");
    }
}
</script>
