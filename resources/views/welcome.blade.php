<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Imagination PhotoStudio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gold:#CCB049; --gold-light:#E2C96A; --gold-dark:#A8903A;
            --gold-pale:rgba(204,176,73,0.08); --gold-shadow:rgba(204,176,73,0.2);
            --ink:#1A1A1A; --text-mid:#6B6B6B; --text-lo:#9E9E9E;
            --surface:#FFFFFF; --surface-2:#F7F6F3; --border:#E5E3DC;
            --radius-sm:6px; --radius-md:12px; --radius-lg:20px;
            --nav-h:72px; --transition:.22s cubic-bezier(.4,0,.2,1);
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{font-family:'DM Sans',sans-serif;background:#F7F6F3;color:var(--ink);overflow-x:hidden;overflow-y:auto}

        /* ── NAVBAR ── */
        .navbar{position:fixed;top:0;left:0;width:100%;height:var(--nav-h);z-index:1000;display:flex;align-items:center;justify-content:space-between;padding:0 48px;background:rgba(247,246,243,0.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);transition:box-shadow var(--transition)}
        .navbar.scrolled{box-shadow:0 2px 24px rgba(0,0,0,0.08)}
        .nav-brand{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--ink);text-decoration:none;letter-spacing:-.3px}
        .nav-brand span{color:var(--gold)}
        .nav-links{display:flex;align-items:center;gap:36px;list-style:none}
        .nav-links a{font-size:13px;font-weight:500;color:var(--text-mid);text-decoration:none;letter-spacing:.5px;text-transform:uppercase;transition:color var(--transition)}
        .nav-links a:hover{color:var(--gold-dark)}
        .nav-auth{display:flex;align-items:center;gap:12px}
        .btn-nav-login{font-size:13px;font-weight:600;color:var(--ink);text-decoration:none;padding:8px 18px;border:1.5px solid var(--border);border-radius:var(--radius-sm);transition:border-color var(--transition),background var(--transition)}
        .btn-nav-login:hover{border-color:var(--gold);background:var(--gold-pale)}
        .btn-nav-cta{font-size:13px;font-weight:600;color:#fff;background:var(--ink);text-decoration:none;padding:9px 20px;border-radius:var(--radius-sm);transition:background var(--transition),transform var(--transition)}
        .btn-nav-cta:hover{background:var(--gold-dark);transform:translateY(-1px)}

        /* ── USER DROPDOWN ── */
        .user-menu { position: relative; }
        .user-btn { display: flex; align-items: center; gap: 8px; background: transparent; border: 1.5px solid var(--border); padding: 6px 12px 6px 6px; border-radius: 40px; cursor: pointer; transition: all var(--transition); }
        .user-btn:hover, .user-btn.active { border-color: var(--gold); background: var(--gold-pale); }
        .user-avatar { width: 28px; height: 28px; border-radius: 50%; background: var(--ink); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0; }
        .user-name { font-size: 13px; font-weight: 600; color: var(--ink); max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dropdown-menu { position: absolute; top: calc(100% + 12px); right: 0; left: auto; width: 220px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: 0 12px 32px rgba(0,0,0,0.08); opacity: 0; visibility: hidden; transform: translateY(-8px); transform-origin: top right; transition: all var(--transition); z-index: 100; }
        .dropdown-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: var(--text-mid); font-size: 13px; font-weight: 500; text-decoration: none; transition: all var(--transition); }
        .dropdown-item:hover { background: var(--surface-2); color: var(--ink); }
        .dropdown-item svg { width: 16px; height: 16px; color: var(--text-lo); transition: color var(--transition); }
        .dropdown-item:hover svg { color: var(--gold-dark); }
        .dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }
        .dropdown-form { margin: 0; padding: 0; }
        .dropdown-form button { width: 100%; text-align: left; background: none; border: none; cursor: pointer; display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #DC2626; font-size: 13px; font-weight: 500; font-family: 'DM Sans', sans-serif; transition: all var(--transition); }
        .dropdown-form button:hover { background: #FEF2F2; }
        .dropdown-form button svg { width: 16px; height: 16px; color: #DC2626; }

        /* ── HERO ── */
        .hero{min-height:100vh;display:flex;flex-direction:column;justify-content:center;padding:calc(var(--nav-h) + 60px) 48px 80px;background:linear-gradient(145deg,#fff 0%,#F7F6F3 60%,#F0EDE6 100%)}
        .hero-eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:var(--gold-dark);margin-bottom:24px}
        .hero-eyebrow::before{content:'';width:24px;height:1.5px;background:var(--gold)}
        .hero-title{font-family:'Cormorant Garamond',serif;font-size:clamp(52px,7vw,96px);font-weight:600;line-height:1.05;letter-spacing:-1px;color:var(--ink);margin-bottom:24px}
        .hero-title span{color:var(--gold);font-style:italic}
        .hero-desc{font-size:17px;color:var(--text-mid);line-height:1.75;max-width:560px;margin-bottom:40px;font-weight:400}
        .hero-cta{display:flex;gap:14px;flex-wrap:wrap}
        .btn-primary{display:inline-flex;align-items:center;gap:8px;background:var(--ink);color:#fff;font-family:'DM Sans',sans-serif;font-weight:600;font-size:14px;padding:13px 28px;border-radius:var(--radius-sm);text-decoration:none;transition:background var(--transition),transform var(--transition),box-shadow var(--transition);box-shadow:0 4px 16px rgba(0,0,0,0.12)}
        .btn-primary:hover{background:var(--gold-dark);transform:translateY(-2px);box-shadow:0 8px 24px var(--gold-shadow)}
        .btn-ghost{display:inline-flex;align-items:center;gap:8px;background:transparent;color:var(--ink);font-family:'DM Sans',sans-serif;font-weight:600;font-size:14px;padding:12px 26px;border-radius:var(--radius-sm);text-decoration:none;border:1.5px solid var(--border);transition:border-color var(--transition),background var(--transition)}
        .btn-ghost:hover{border-color:var(--gold);background:var(--gold-pale)}
        .hero-stats{display:flex;gap:48px;margin-top:64px;padding-top:40px;border-top:1px solid var(--border)}
        .stat-num{font-family:'Cormorant Garamond',serif;font-size:36px;font-weight:600;color:var(--ink);line-height:1}
        .stat-num span{color:var(--gold)}
        .stat-label{font-size:12px;color:var(--text-lo);font-weight:500;letter-spacing:.5px;margin-top:4px;text-transform:uppercase}

        /* ── SECTION WRAPPER ── */
        .section{padding:96px 48px}
        .section-alt{background:var(--surface)}
        .section-header{margin-bottom:56px}
        .section-eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:var(--gold-dark);margin-bottom:12px}
        .section-eyebrow::before{content:'';width:20px;height:1.5px;background:var(--gold)}
        .section-title{font-family:'Cormorant Garamond',serif;font-size:clamp(32px,4vw,52px);font-weight:600;color:var(--ink);letter-spacing:-.5px;line-height:1.1}
        .section-subtitle{font-size:15px;color:var(--text-mid);margin-top:12px;max-width:520px;line-height:1.7}

        /* ── STUDIO RENT CARDS ── */
        .packages-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px}
        .pkg-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-md);overflow:hidden;transition:transform var(--transition),box-shadow var(--transition);display:flex;flex-direction:column}
        .pkg-card:hover{transform:translateY(-4px);box-shadow:0 16px 48px rgba(0,0,0,0.10)}
        .pkg-thumbnail{width:100%;height:200px;object-fit:cover;display:block;background:#E5E3DC}
        .pkg-thumbnail-placeholder{width:100%;height:200px;background:linear-gradient(135deg,#E5E3DC 0%,#D4C9A8 100%);display:flex;align-items:center;justify-content:center}
        .pkg-thumbnail-placeholder svg{opacity:.3}
        .pkg-body{padding:24px;flex:1;display:flex;flex-direction:column}
        .pkg-name{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--ink);margin-bottom:6px}
        .pkg-duration{font-size:12px;color:var(--text-lo);font-weight:500;letter-spacing:.4px;margin-bottom:12px}
        .pkg-desc{font-size:14px;color:var(--text-mid);line-height:1.65;margin-bottom:20px;flex:1}
        .pkg-footer{display:flex;align-items:center;justify-content:space-between;padding-top:16px;border-top:1px solid var(--border)}
        .pkg-price{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:var(--ink)}
        .pkg-price small{font-family:'DM Sans',sans-serif;font-size:11px;font-weight:500;color:var(--text-lo);display:block;margin-bottom:2px}
        .btn-book{font-size:13px;font-weight:600;color:#fff;background:var(--ink);padding:9px 20px;border-radius:var(--radius-sm);text-decoration:none;transition:background var(--transition);white-space:nowrap}
        .btn-book:hover{background:var(--gold-dark)}
        .pkg-empty{text-align:center;padding:80px 24px;color:var(--text-lo);grid-column:1/-1}
        .pkg-empty svg{opacity:.3;margin-bottom:16px}
        .pkg-empty p{font-size:15px}

        /* ── PORTFOLIO ── */
        .portfolio-grid{display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:auto;gap:16px}
        .port-item{border-radius:var(--radius-md);overflow:hidden;position:relative;cursor:pointer;background:#E5E3DC}
        .port-item:nth-child(1){grid-column:1/span 2;grid-row:1/span 2}
        .port-item img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s var(--transition);min-height:200px}
        .port-item:hover img{transform:scale(1.04)}
        .port-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.6) 0%,transparent 60%);opacity:0;transition:opacity var(--transition);display:flex;align-items:flex-end;padding:20px}
        .port-item:hover .port-overlay{opacity:1}
        .port-label{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:600;color:#fff}
        .port-placeholder{width:100%;height:220px;background:linear-gradient(135deg,#E5E3DC,#D4C9A8);display:flex;align-items:center;justify-content:center}

        /* ── FOOTER ── */
        .site-footer{background:var(--ink);color:rgba(255,255,255,0.5);text-align:center;padding:32px 48px;font-size:13px}
        .site-footer a{color:var(--gold);text-decoration:none}

        @media(max-width:768px){
            .navbar{padding:0 24px}
            .nav-links,.nav-auth{display:none}
            .hero{padding:calc(var(--nav-h)+40px) 24px 60px}
            .hero-stats{gap:28px}
            .section{padding:64px 24px}
            .portfolio-grid{grid-template-columns:1fr 1fr}
            .port-item:nth-child(1){grid-column:1;grid-row:auto}
        }

        /* ── ABOUT / COMPANY PROFILE ── */
        .about-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start}
        .about-desc{font-size:16px;color:var(--text-mid);line-height:1.8;margin-bottom:24px}
        .about-vm{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:32px}
        .vm-card{background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-md);padding:24px;border-left:3px solid var(--gold)}
        .vm-label{font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--gold-dark);margin-bottom:10px}
        .vm-text{font-size:13px;color:var(--text-mid);line-height:1.7}
        .social-links{display:flex;gap:12px;margin-top:32px;flex-wrap:wrap}
        .social-link{display:inline-flex;align-items:center;gap:8px;padding:9px 16px;border:1.5px solid var(--border);border-radius:var(--radius-sm);font-size:13px;font-weight:600;color:var(--ink);text-decoration:none;transition:all var(--transition)}
        .social-link:hover{border-color:var(--gold);background:var(--gold-pale);color:var(--gold-dark)}
        .about-visual{position:relative}
        .about-img-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .about-img-box{border-radius:var(--radius-md);overflow:hidden;background:linear-gradient(135deg,#E5E3DC,#D4C9A8);aspect-ratio:4/3;display:flex;align-items:center;justify-content:center}
        .about-img-box:first-child{grid-column:1/-1;aspect-ratio:16/7}
        .about-badge{position:absolute;bottom:-20px;left:24px;background:var(--ink);color:#fff;padding:16px 24px;border-radius:var(--radius-md);font-size:13px;box-shadow:0 8px 32px rgba(0,0,0,0.2)}
        .about-badge strong{display:block;font-family:'Cormorant Garamond',serif;font-size:28px;color:var(--gold);line-height:1}

        /* ── SERVICES ── */
        .services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
        .svc-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-md);padding:32px 28px;transition:all var(--transition);position:relative;overflow:hidden}
        .svc-card::before{content:'';position:absolute;top:0;left:0;width:100%;height:3px;background:var(--gold);transform:scaleX(0);transition:transform var(--transition);transform-origin:left}
        .svc-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(0,0,0,0.08)}
        .svc-card:hover::before{transform:scaleX(1)}
        .svc-icon{width:48px;height:48px;background:var(--gold-pale);border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;margin-bottom:20px}
        .svc-icon svg{width:22px;height:22px;color:var(--gold-dark)}
        .svc-title{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--ink);margin-bottom:10px}
        .svc-desc{font-size:14px;color:var(--text-mid);line-height:1.7}

        /* ── TESTIMONIALS ── */
        .testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
        .testi-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-md);padding:28px;transition:box-shadow var(--transition)}
        .testi-card:hover{box-shadow:0 8px 32px rgba(0,0,0,0.07)}
        .testi-stars{color:var(--gold);font-size:14px;letter-spacing:2px;margin-bottom:14px}
        .testi-text{font-size:14px;color:var(--text-mid);line-height:1.75;margin-bottom:20px;font-style:italic}
        .testi-author{display:flex;align-items:center;gap:12px}
        .testi-avatar{width:38px;height:38px;border-radius:50%;background:var(--ink);color:#fff;font-size:14px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .testi-name{font-size:14px;font-weight:600;color:var(--ink)}
        .testi-meta{font-size:12px;color:var(--text-lo)}

        /* ── CTA ── */
        .cta-section{background:var(--ink);padding:96px 48px;text-align:center;position:relative;overflow:hidden}
        .cta-section::before{content:'';position:absolute;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(204,176,73,0.15) 0%,transparent 70%);top:-200px;left:-100px;pointer-events:none}
        .cta-section::after{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(204,176,73,0.1) 0%,transparent 70%);bottom:-100px;right:-50px;pointer-events:none}
        .cta-eyebrow{font-size:11px;font-weight:600;letter-spacing:1.2px;text-transform:uppercase;color:var(--gold);margin-bottom:16px}
        .cta-title{font-family:'Cormorant Garamond',serif;font-size:clamp(36px,5vw,64px);font-weight:600;color:#fff;line-height:1.1;letter-spacing:-.5px;margin-bottom:20px}
        .cta-title em{color:var(--gold);font-style:italic}
        .cta-sub{font-size:16px;color:rgba(255,255,255,0.6);max-width:480px;margin:0 auto 40px;line-height:1.7}
        .btn-cta-gold{display:inline-flex;align-items:center;gap:8px;background:var(--gold);color:var(--ink);font-weight:700;font-size:14px;padding:14px 32px;border-radius:var(--radius-sm);text-decoration:none;transition:all var(--transition)}
        .btn-cta-gold:hover{background:var(--gold-light);transform:translateY(-2px)}
        .btn-cta-outline{display:inline-flex;align-items:center;gap:8px;background:transparent;color:#fff;font-weight:600;font-size:14px;padding:13px 28px;border-radius:var(--radius-sm);text-decoration:none;border:1.5px solid rgba(255,255,255,0.25);transition:all var(--transition);margin-left:12px}
        .btn-cta-outline:hover{border-color:var(--gold);color:var(--gold)}

        /* ── FULL FOOTER ── */
        .full-footer{background:#111;color:rgba(255,255,255,0.55);padding:64px 48px 32px}
        .footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:48px;margin-bottom:48px}
        .footer-brand{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:#fff;margin-bottom:12px}
        .footer-brand span{color:var(--gold)}
        .footer-tagline{font-size:13px;line-height:1.7;color:rgba(255,255,255,0.45);margin-bottom:20px}
        .footer-socials{display:flex;gap:10px}
        .footer-social-btn{width:36px;height:36px;border-radius:var(--radius-sm);background:rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.6);text-decoration:none;transition:all var(--transition)}
        .footer-social-btn:hover{background:var(--gold);color:var(--ink)}
        .footer-social-btn svg{width:16px;height:16px}
        .footer-col-title{font-size:12px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,0.8);margin-bottom:16px}
        .footer-links{display:flex;flex-direction:column;gap:10px}
        .footer-links a{font-size:13px;color:rgba(255,255,255,0.45);text-decoration:none;transition:color var(--transition)}
        .footer-links a:hover{color:var(--gold)}
        .footer-bottom{border-top:1px solid rgba(255,255,255,0.08);padding-top:24px;display:flex;align-items:center;justify-content:space-between;font-size:12px}

        @media(max-width:900px){
            .about-grid,.services-grid,.testi-grid,.footer-grid{grid-template-columns:1fr}
            .about-vm{grid-template-columns:1fr}
            .footer-grid{gap:32px}
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="mainNav">
    <a class="nav-brand" href="/">Virtual <span>Imagination</span></a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('home') }}#studio-rent">Studio Rent</a></li>
        <li><a href="{{ route('home') }}#portfolio">Portfolio</a></li>
        <li><a href="{{ route('home') }}#contact">Contact</a></li>
    </ul>
    <div class="nav-auth">
        @auth
            <div class="user-menu" id="userMenu">
                <button class="user-btn" id="userBtn">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Profile
                    </a>
                    <a href="{{ route('bookings.index') }}" class="dropdown-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Riwayat Booking
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-form">
                        @csrf
                        <button type="submit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
            <a href="{{ route('register') }}" class="btn-nav-cta">Daftar</a>
        @endauth
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-eyebrow">Professional Photo Studio</div>
    <h1 class="hero-title">Wujudkan <span>Imajinasi</span><br>Visual Anda</h1>
    <p class="hero-desc">Studio foto profesional dengan peralatan lengkap dan tim kreatif berpengalaman. Dari foto personal hingga produksi besar.</p>
    <div class="hero-cta">
        @auth
            <a href="{{ route('bookings.create') }}" class="btn-primary">Book Studio Sekarang →</a>
        @else
            <a href="{{ route('register') }}" class="btn-primary">Mulai Booking →</a>
            <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
        @endauth
        <a href="#studio-rent" class="btn-ghost">Lihat Paket ↓</a>
    </div>
    <div class="hero-stats">
        <div>
            <div class="stat-num">500<span>+</span></div>
            <div class="stat-label">Klien Puas</div>
        </div>
        <div>
            <div class="stat-num">5<span>★</span></div>
            <div class="stat-label">Rating</div>
        </div>
        <div>
            <div class="stat-num">{{ $packages->count() }}<span>+</span></div>
            <div class="stat-label">Paket Studio</div>
        </div>
    </div>
</section>

<!-- ABOUT / COMPANY PROFILE -->
<section class="section section-alt" id="about">
    <div style="max-width:1200px;margin:0 auto">
        <div class="about-grid">
            <div>
                <div class="section-eyebrow">Tentang Kami</div>
                <h2 class="section-title" style="margin-bottom:24px">Virtual Imagination<br><em style="font-style:italic;color:var(--gold)">PhotoStudio</em></h2>
                <p class="about-desc">Virtual Imagination PhotoStudio adalah studio foto untuk berbagai kebutuhan produksi, mulai dari foto hingga video.</p>
                <p class="about-desc">Kami juga menyediakan layanan kreatif seperti pembuatan konten dan kebutuhan visual lainnya.</p>
                <div class="about-vm">
                    <div class="vm-card">
                        <div class="vm-label">Our Vision</div>
                        <div class="vm-text">To become a home for creative workers to express and bring their ideas to life — a perfect place where creativity is limitless.</div>
                    </div>
                    <div class="vm-card">
                        <div class="vm-label">Our Mission</div>
                        <div class="vm-text">To provide exquisite ambiance service for client satisfaction. Produce high quality audio visual output and represent uniqueness in every aspect.</div>
                    </div>
                </div>
                <div class="social-links">
                    <a href="https://instagram.com" target="_blank" class="social-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        Instagram
                    </a>
                    <a href="https://youtube.com" target="_blank" class="social-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        YouTube
                    </a>
                    <a href="https://linkedin.com" target="_blank" class="social-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                    <a href="https://tiktok.com" target="_blank" class="social-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        TikTok
                    </a>
                </div>
            </div>
            <div class="about-visual">
                <div class="about-img-grid">
                    <div class="about-img-box">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                    <div class="about-img-box">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                    <div class="about-img-box">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                </div>
                <div class="about-badge">
                    <strong>500+</strong>
                    Klien puas &amp; produksi selesai
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="section" id="services">
    <div style="max-width:1200px;margin:0 auto">
        <div class="section-header" style="text-align:center">
            <div class="section-eyebrow" style="justify-content:center">Layanan Kami</div>
            <h2 class="section-title">Apa yang Kami Tawarkan</h2>
        </div>
        <div class="services-grid">
            <div class="svc-card">
                <div class="svc-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </div>
                <div class="svc-title">Photography</div>
                <div class="svc-desc">Sesi foto profesional untuk berbagai kebutuhan — personal, produk, event, hingga foto pre-wedding dengan pencahayaan premium.</div>
            </div>
            <div class="svc-card">
                <div class="svc-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                </div>
                <div class="svc-title">Videography</div>
                <div class="svc-desc">Produksi video kreatif untuk konten media sosial, company profile, iklan, dan berbagai kebutuhan audiovisual lainnya.</div>
            </div>
            <div class="svc-card">
                <div class="svc-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                </div>
                <div class="svc-title">Creative Content</div>
                <div class="svc-desc">Pembuatan konten kreatif untuk kebutuhan digital marketing, branding visual, dan storytelling yang kuat untuk bisnis Anda.</div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="section section-alt" id="testimonials">
    <div style="max-width:1200px;margin:0 auto">
        <div class="section-header" style="text-align:center">
            <div class="section-eyebrow" style="justify-content:center">Testimoni</div>
            <h2 class="section-title">Kata Klien Kami</h2>
        </div>
        <div class="testi-grid">
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Studio sangat profesional, pencahayaan lengkap dan tim sangat membantu. Hasil foto jauh melampaui ekspektasi saya!"</p>
                <div class="testi-author">
                    <div class="testi-avatar">AR</div>
                    <div><div class="testi-name">Arya Ramadhan</div><div class="testi-meta">Photo Personal Session</div></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Tempat yang sempurna untuk foto wisuda. Background pilihan banyak, staf ramah dan hasil editing sangat memuaskan."</p>
                <div class="testi-author">
                    <div class="testi-avatar">SR</div>
                    <div><div class="testi-name">Siti Rahayu</div><div class="testi-meta">Graduation Photo</div></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-text">"Produksi video company profile kami sangat berkualitas. Virtual Imagination benar-benar paham kebutuhan brand kami."</p>
                <div class="testi-author">
                    <div class="testi-avatar">DK</div>
                    <div><div class="testi-name">Dimas Kurniawan</div><div class="testi-meta">Corporate Video Production</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STUDIO RENT -->
<section class="section section-alt" id="studio-rent">
    <div class="section-header">
        <div class="section-eyebrow">Studio Rent</div>
        <h2 class="section-title">Paket Studio Kami</h2>
        <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan sesi foto Anda. Semua paket sudah termasuk peralatan lighting profesional.</p>
    </div>

    <div class="packages-grid">
        @forelse($packages as $pkg)
            <div class="pkg-card">
                @if($pkg->thumbnail)
                    <img class="pkg-thumbnail" src="{{ asset('storage/'.$pkg->thumbnail) }}" alt="{{ $pkg->name }}">
                @else
                    <div class="pkg-thumbnail-placeholder">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                @endif
                <div class="pkg-body">
                    <div class="pkg-name">{{ $pkg->name }}</div>
                    <div class="pkg-duration">
                        @php
                            $mins = $pkg->duration_minutes;
                            $dur  = $mins >= 60
                                ? floor($mins/60).' jam'.($mins%60 ? ' '.($mins%60).' mnt' : '')
                                : $mins.' menit';
                        @endphp
                        {{ $dur }}
                    </div>
                    <div class="pkg-desc">{{ $pkg->description ?: 'Paket studio profesional dengan peralatan lengkap dan pencahayaan premium.' }}</div>
                    <div class="pkg-footer">
                        <div class="pkg-price">
                            <small>Mulai dari</small>
                            {{ $pkg->getFormattedPrice() }}
                        </div>
                        @auth
                            <a href="{{ route('bookings.create', ['package' => $pkg->id]) }}" class="btn-book">Book Now</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-book">Book Now</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="pkg-empty">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                <p>Paket studio belum tersedia. Hubungi kami untuk informasi lebih lanjut.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- PORTFOLIO — dynamic from DB -->
<section class="section" id="portfolio">
    <div class="section-header">
        <div class="section-eyebrow">Portfolio</div>
        <h2 class="section-title">Hasil Karya Studio</h2>
        <p class="section-subtitle">Setiap frame adalah cerita. Lihat koleksi hasil sesi foto terbaik dari studio kami.</p>
    </div>

    @if($portfolios->isEmpty())
        <div style="text-align:center;padding:60px 24px;color:var(--text-lo)">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.3;margin-bottom:16px"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
            <p style="font-size:15px">Portfolio sedang disiapkan. Kunjungi kami kembali segera!</p>
        </div>
    @else
        <div class="portfolio-grid">
            @foreach($portfolios as $i => $item)
                <div class="port-item {{ $i === 0 ? 'port-item--wide' : '' }}">
                    <img src="{{ asset('storage/'.$item->image) }}"
                         alt="{{ $item->title }}"
                         loading="lazy">
                    <div class="port-overlay">
                        <div>
                            <div class="port-label">{{ $item->title }}</div>
                            @if($item->client)
                                <div style="font-size:12px;color:rgba(255,255,255,.7);margin-top:3px">{{ $item->client }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

<!-- CONTACT — WhatsApp Form -->
<section class="section section-alt" id="contact">
    <div style="max-width:600px;margin:0 auto">
        <div class="section-header" style="text-align:center">
            <div class="section-eyebrow" style="justify-content:center">Hubungi Kami</div>
            <h2 class="section-title">Booking & Pertanyaan</h2>
            <p class="section-subtitle" style="margin:0 auto">Isi form di bawah dan kami akan menghubungi Anda melalui WhatsApp dalam waktu singkat.</p>
        </div>

        <style>
            .contact-form { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-md); padding:36px; }
            .cf-row { margin-bottom:18px; }
            .cf-row label { display:block; font-size:12px; font-weight:600; color:var(--text-mid); text-transform:uppercase; letter-spacing:.7px; margin-bottom:7px; }
            .cf-row input, .cf-row select, .cf-row textarea {
                width:100%; padding:11px 14px; border:1.5px solid var(--border);
                border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
                font-size:14px; color:var(--ink); background:var(--surface-2); outline:none;
                transition:border-color var(--transition);
            }
            .cf-row input:focus, .cf-row select:focus, .cf-row textarea:focus { border-color:var(--gold); }
            .cf-row textarea { resize:vertical; min-height:100px; }
            .cf-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
            .btn-wa {
                width:100%; padding:14px; background:#25D366; color:#fff;
                border:none; border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
                font-size:15px; font-weight:700; cursor:pointer; display:flex;
                align-items:center; justify-content:center; gap:10px;
                transition:background var(--transition), transform var(--transition);
                margin-top:8px;
            }
            .btn-wa:hover { background:#1EB858; transform:translateY(-1px); }
            .wa-note { text-align:center; font-size:12px; color:var(--text-lo); margin-top:10px; }
        </style>

        <div class="contact-form">
            <div class="cf-grid">
                <div class="cf-row">
                    <label for="cf_name">Nama Lengkap *</label>
                    <input type="text" id="cf_name" placeholder="John Doe" required>
                </div>
                <div class="cf-row">
                    <label for="cf_phone">No. WhatsApp *</label>
                    <input type="tel" id="cf_phone" placeholder="08xxxxxxxxxx" required>
                </div>
            </div>
            <div class="cf-row">
                <label for="cf_package">Paket yang Diminati</label>
                <select id="cf_package">
                    <option value="">-- Pilih Paket (opsional) --</option>
                    @foreach($packages as $pkg)
                        <option value="{{ $pkg->name }}">{{ $pkg->name }} — {{ $pkg->getFormattedPrice() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="cf-row">
                <label for="cf_date">Tanggal yang Diinginkan</label>
                <input type="date" id="cf_date" min="{{ date('Y-m-d') }}">
            </div>
            <div class="cf-row">
                <label for="cf_message">Pesan / Pertanyaan</label>
                <textarea id="cf_message" placeholder="Ceritakan kebutuhan foto Anda…"></textarea>
            </div>

            <button type="button" class="btn-wa" onclick="sendToWhatsApp()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                Kirim via WhatsApp
            </button>
            <div class="wa-note">Anda akan diarahkan ke WhatsApp dengan pesan yang sudah terisi otomatis.</div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div style="position:relative;z-index:2">
        <div class="cta-eyebrow">Mulai Sekarang</div>
        <h2 class="cta-title">Let's Create Something<br><em>Together</em></h2>
        <p class="cta-sub">Wujudkan ide visual Anda bersama tim kreatif kami. Studio siap, peralatan lengkap, hasil premium.</p>
        <div>
            @auth
                <a href="{{ route('bookings.create') }}" class="btn-cta-gold">Book Studio Sekarang →</a>
            @else
                <a href="{{ route('register') }}" class="btn-cta-gold">Mulai Booking →</a>
                <a href="#contact" class="btn-cta-outline">Hubungi Kami</a>
            @endauth
        </div>
    </div>
</section>

<!-- FULL FOOTER -->
<footer class="full-footer">
    <div class="footer-grid">
        <div>
            <div class="footer-brand">Virtual <span>Imagination</span></div>
            <p class="footer-tagline">Studio foto profesional untuk berbagai kebutuhan produksi — foto, video, dan konten kreatif.</p>
            <div class="footer-socials">
                <a href="https://instagram.com" target="_blank" class="footer-social-btn" title="Instagram">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="https://youtube.com" target="_blank" class="footer-social-btn" title="YouTube">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                </a>
                <a href="https://linkedin.com" target="_blank" class="footer-social-btn" title="LinkedIn">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                <a href="https://tiktok.com" target="_blank" class="footer-social-btn" title="TikTok">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                </a>
                <a href="https://wa.me/6281514191380" target="_blank" class="footer-social-btn" title="WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                </a>
            </div>
        </div>
        <div>
            <div class="footer-col-title">Navigasi</div>
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#about">Tentang Kami</a>
                <a href="{{ route('studiorent') }}">Studio Rent</a>
                <a href="{{ route('portfolio') }}">Portfolio</a>
                <a href="{{ route('contact') }}">Kontak</a>
            </div>
        </div>
        <div>
            <div class="footer-col-title">Layanan</div>
            <div class="footer-links">
                <a href="#services">Photography</a>
                <a href="#services">Videography</a>
                <a href="#services">Creative Content</a>
                <a href="#studio-rent">Studio Rental</a>
            </div>
        </div>
        <div>
            <div class="footer-col-title">Kontak</div>
            <div class="footer-links">
                <a href="https://wa.me/6281514191380">+62 815-1419-1380</a>
                <a href="mailto:info@virtualimagination.id">info@virtualimagination.id</a>
                <a href="#">Jakarta, Indonesia</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <span>&copy; {{ date('Y') }} Virtual Imagination PhotoStudio. All rights reserved.</span>
        <span>Made with ♥ in Indonesia</span>
    </div>
</footer>

<script>
@if(isset($section) && $section)
// Auto-scroll to section when arriving from a named section route
window.addEventListener('load', function () {
    var el = document.getElementById('{{ $section }}');
    if (el) {
        setTimeout(function () {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 200);
    }
});
@endif

window.addEventListener('scroll', () => {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 40);
});

// Dropdown Interaction
const userBtn = document.getElementById('userBtn');
const dropdownMenu = document.getElementById('dropdownMenu');

if (userBtn && dropdownMenu) {
    userBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('show');
        userBtn.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!dropdownMenu.contains(e.target) && !userBtn.contains(e.target)) {
            dropdownMenu.classList.remove('show');
            userBtn.classList.remove('active');
        }
    });
}

function sendToWhatsApp() {
    const name    = document.getElementById('cf_name').value.trim();
    const phone   = document.getElementById('cf_phone').value.trim();
    const pkg     = document.getElementById('cf_package').value;
    const date    = document.getElementById('cf_date').value;
    const message = document.getElementById('cf_message').value.trim();

    if (!name || !phone) {
        alert('Nama dan nomor WhatsApp wajib diisi.');
        return;
    }

    let text = `Halo Virtual Imagination! 👋\n\n`;
    text += `Nama  : ${name}\n`;
    text += `No. HP: ${phone}\n`;
    if (pkg)     text += `Paket : ${pkg}\n`;
    if (date)    text += `Tanggal: ${date}\n`;
    if (message) text += `\nPesan :\n${message}\n`;
    text += `\nMohon informasinya. Terima kasih!`;

    const waNumber = '6281514191380';
    const url = `https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}
</script>
</body>
</html>
