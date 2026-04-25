<x-guest-layout>
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <h1 class="auth-heading">Welcome Back</h1>
        <p class="auth-subheading">Masuk ke akun Virtual Imagination Anda</p>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input" type="email" name="email"
                   value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="your@email.com" />
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-input" type="password" name="password"
                   required autocomplete="current-password" placeholder="••••••••" />
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror

            <div class="password-helper">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>
        </div>

        <button type="submit" class="btn-continue">Masuk</button>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>
