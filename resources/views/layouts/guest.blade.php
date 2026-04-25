<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Virtual Imagination') }}</title>

    <!-- Same fonts as admin panel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Design tokens — identical to admin panel ───────── */
        :root {
            --gold:       #CCB049;
            --gold-light: #E2C96A;
            --gold-dark:  #A8903A;
            --ink:        #1A1A1A;
            --text-hi:    #1A1A1A;
            --text-mid:   #6B6B6B;
            --text-lo:    #9E9E9E;
            --surface:    #FFFFFF;
            --surface-2:  #F7F6F3;
            --border:     #E5E3DC;
            --danger:     #C0392B;
            --danger-bg:  #FDECEA;
            --radius-sm:  6px;
            --radius-md:  12px;
            --radius-lg:  20px;
            --transition: .22s cubic-bezier(.4,0,.2,1);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F0EDE6;
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── Split layout ──────────────────────────────────── */
        .auth-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            min-height: 100vh;
        }

        /* Left: branding panel */
        .auth-logo-section {
            background: linear-gradient(145deg, #1A1A1A 0%, #2d2d2d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }
        .auth-logo-section::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(204,176,73,0.18) 0%, transparent 70%);
            top: -80px; right: -80px;
        }
        .auth-logo-section::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(204,176,73,0.12) 0%, transparent 70%);
            bottom: -60px; left: -40px;
        }
        .logo-container {
            text-align: center;
            position: relative; z-index: 2;
        }
        .logo-container img {
            height: 80px; width: auto;
            filter: brightness(0) invert(1);
            margin-bottom: 32px;
        }
        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 38px; font-weight: 600;
            color: #fff; letter-spacing: -.5px;
            line-height: 1.1; margin-bottom: 12px;
        }
        .brand-name span { color: var(--gold); }
        .brand-tagline {
            font-size: 13px; font-weight: 400;
            color: rgba(255,255,255,0.5);
            letter-spacing: .8px; text-transform: uppercase;
        }
        .brand-divider {
            width: 40px; height: 2px;
            background: var(--gold);
            margin: 20px auto;
        }

        /* Right: form panel */
        .auth-form-section {
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
        }
        .auth-form-wrapper {
            width: 100%;
            max-width: 380px;
        }

        /* ── Form elements ─────────────────────────────────── */
        .auth-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px; font-weight: 600;
            color: var(--ink); margin-bottom: 6px;
        }
        .auth-subheading {
            font-size: 14px; color: var(--text-mid);
            margin-bottom: 32px; font-weight: 400;
        }

        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 600;
            color: var(--text-mid); text-transform: uppercase;
            letter-spacing: .7px; margin-bottom: 7px;
        }
        .form-input {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: var(--ink);
            background: var(--surface-2);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(204,176,73,0.12);
            background: #fff;
        }
        .form-error {
            display: block; margin-top: 5px;
            font-size: 12px; color: var(--danger);
        }

        .password-helper {
            display: flex; justify-content: flex-end;
            margin-top: 6px;
        }
        .password-helper a {
            font-size: 12px; color: var(--gold-dark);
            text-decoration: none; font-weight: 500;
        }
        .password-helper a:hover { color: var(--gold); text-decoration: underline; }

        .btn-continue {
            width: 100%; padding: 12px;
            background: var(--ink); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            cursor: pointer; letter-spacing: .3px;
            transition: background var(--transition), transform var(--transition);
            margin-top: 8px;
        }
        .btn-continue:hover { background: var(--gold-dark); transform: translateY(-1px); }

        .auth-footer {
            text-align: center; margin-top: 24px;
            font-size: 13px; color: var(--text-mid);
        }
        .auth-footer a {
            color: var(--gold-dark); font-weight: 600;
            text-decoration: none;
        }
        .auth-footer a:hover { color: var(--gold); text-decoration: underline; }

        /* Status flash */
        .auth-status {
            padding: 10px 14px; border-radius: var(--radius-sm);
            background: #E8F5EE; color: #2D7A4F;
            border: 1px solid rgba(45,122,79,.2);
            font-size: 13px; margin-bottom: 20px;
        }

        /* ── Responsive ────────────────────────────────────── */
        @media (max-width: 768px) {
            .auth-container { grid-template-columns: 1fr; }
            .auth-logo-section { display: none; }
            .auth-form-section { padding: 40px 24px; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Branding Panel -->
        <div class="auth-logo-section">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Virtual Imagination" onerror="this.style.display='none'">
                <div class="brand-name">Virtual<br><span>Imagination</span></div>
                <div class="brand-divider"></div>
                <div class="brand-tagline">Professional Photo Studio</div>
            </div>
        </div>

        <!-- Form Panel -->
        <div class="auth-form-section">
            <div class="auth-form-wrapper">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
