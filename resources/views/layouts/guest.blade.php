<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Virtual Imagination') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="auth-container">
            <!-- Logo Section (Left) -->
            <div class="auth-logo-section">
                <div class="logo-container">
                    <!-- Logo Image will go here -->
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="Virtual Imagination" class="logo-icon" />
                    </div>
                </div>
            </div>

            <!-- Form Section (Right) -->
            <div class="auth-form-section">
                <div class="auth-form-wrapper">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
