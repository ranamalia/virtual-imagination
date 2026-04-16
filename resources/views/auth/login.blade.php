<x-guest-layout>
    @if (session('status'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <h1 class="auth-heading">Welcome Back!</h1>

        <div class="form-group">
            <label for="email" class="form-label">Email*</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="your@email.com" />
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password*</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror

            <div class="password-helper">
                <span class="password-helper-left"></span>
                @if (Route::has('password.request'))
                    <span class="password-helper-right">
                        <a href="{{ route('password.request') }}">forget password?</a>
                    </span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn-continue">Continue</button>

        <div class="auth-footer">
            Don&apos;t have an account? <a href="{{ route('register') }}">Sign up here</a>
        </div>
    </form>
</x-guest-layout>
