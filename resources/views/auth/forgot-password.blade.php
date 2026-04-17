<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <h1 class="auth-heading">Fill Your Email</h1>
        <div>
        <div class="form-group">
            <label for="email" class="form-label">Email*</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="your@email.com" />
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror

        <button type="submit" class="btn-continue">Continue</button>
    </form>
</x-guest-layout>
