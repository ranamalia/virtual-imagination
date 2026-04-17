<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="register-form">
        @csrf

        <!-- Heading -->
        <h1 class="auth-heading">Create An Account</h1>

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">Name*</label>
            <input
                id="name"
                type="text"
                name="name"
                class="form-input"
                value="{{ old('name') }}"
                placeholder="Your full name"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

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
            <input
                id="password"
                type="password"
                name="password"
                class="form-input"
                placeholder="••••••••"
                required
                autocomplete="new-password"
            >
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror

            <div class="password-helper">
                <span class="password-helper-left">Minimal 8 karakter</span>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password*</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-input"
                placeholder="••••••••"
                required
                autocomplete="new-password"
            >
            @error('password_confirmation')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-continue">
            Continue
        </button>

        <!-- Footer -->
        <div class="auth-footer">
            Have an account?
            <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </form>
</x-guest-layout>
