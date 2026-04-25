<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Saya — Virtual Imagination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --gold: #CCB049; --gold-dark: #A8903A; --gold-light: #E2C96A;
            --ink: #1A1A1A; --text-mid: #6B6B6B; --text-lo: #9E9E9E;
            --surface: #FFFFFF; --surface-2: #F7F6F3; --border: #E5E3DC;
            --success: #2D7A4F; --success-bg: #E8F5EE;
            --warning: #B45309; --warning-bg: #FEF3C7;
            --danger: #C0392B; --danger-bg: #FDECEA;
            --info: #1E5FA8; --info-bg: #EBF3FB;
            --radius-md: 12px; --transition: .22s cubic-bezier(.4,0,.2,1);
        }
        html { -webkit-font-smoothing: antialiased; }
        body {
            background: #F0EDE6;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            min-height: 100vh;
            padding: 0 0 60px;
        }

        /* ── Top Nav ── */
        .topnav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0;
            margin-bottom: 0;
            position: sticky; top: 0; z-index: 50;
        }
        .topnav-inner {
            max-width: 960px; margin: 0 auto; padding: 0 24px;
            display: flex; align-items: center; justify-content: space-between;
            height: 60px;
        }
        .topnav-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px; font-weight: 600; color: var(--ink);
            text-decoration: none; letter-spacing: -.3px;
        }
        .topnav-brand span { color: var(--gold); }
        .topnav-links { display: flex; align-items: center; gap: 6px; }
        .topnav-link {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 13px; font-weight: 500; color: var(--text-mid);
            text-decoration: none; padding: 6px 12px; border-radius: 7px;
            transition: all var(--transition);
        }
        .topnav-link:hover, .topnav-link.active {
            background: var(--surface-2); color: var(--ink);
        }
        .topnav-link.active { font-weight: 600; color: var(--gold-dark); }
        .topnav-cta {
            font-size: 13px; font-weight: 600; color: #fff;
            background: var(--ink); text-decoration: none;
            padding: 8px 18px; border-radius: 8px;
            transition: background var(--transition);
        }
        .topnav-cta:hover { background: var(--gold-dark); }

        /* ── Page Body ── */
        .container { max-width: 960px; margin: 0 auto; padding: 36px 24px; }

        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 30px; font-weight: 600;
        }
        .page-title span { color: var(--gold); font-style: italic; }
        .btn-new {
            padding: 10px 22px; background: var(--gold); color: var(--ink);
            border: none; border-radius: 8px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 600; cursor: pointer;
            text-decoration: none; transition: background var(--transition);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-new:hover { background: var(--gold-dark); color: #fff; }

        /* ── Flash Message ── */
        .flash-success {
            display: flex; align-items: center; gap: 10px;
            background: var(--success-bg); border-left: 3px solid var(--success);
            border-radius: 0 8px 8px 0; padding: 12px 16px;
            margin-bottom: 20px; font-size: 13px; color: var(--success);
        }

        /* ── Cards ── */
        .booking-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            margin-bottom: 12px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 16px;
            transition: box-shadow var(--transition), border-color var(--transition);
            text-decoration: none; color: inherit;
        }
        .booking-card:hover { border-color: var(--gold); box-shadow: 0 4px 20px rgba(204,176,73,.12); }

        .booking-meta { flex: 1; min-width: 0; }
        .booking-ref { font-family: monospace; font-size: 11px; color: var(--text-lo); margin-bottom: 4px; }
        .booking-name { font-weight: 600; font-size: 15px; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .booking-detail { font-size: 13px; color: var(--text-mid); margin-top: 3px; }

        .booking-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        .booking-price { font-weight: 700; color: var(--gold-dark); font-size: 15px; white-space: nowrap; }

        .badge {
            display: inline-block; padding: 3px 11px;
            border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: capitalize;
            white-space: nowrap;
        }
        .badge-pending   { background: var(--warning-bg); color: var(--warning); }
        .badge-confirmed { background: var(--success-bg); color: var(--success); }
        .badge-rejected  { background: var(--danger-bg);  color: var(--danger);  }

        .btn-view {
            padding: 7px 14px; border: 1px solid var(--border);
            border-radius: 7px; color: var(--text-mid); font-size: 13px;
            text-decoration: none; transition: all var(--transition); white-space: nowrap;
        }
        .btn-view:hover { border-color: var(--gold); color: var(--gold-dark); }

        /* ── Empty ── */
        .empty-state {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-md); text-align: center; padding: 72px 24px;
        }
        .empty-state .icon { font-size: 52px; margin-bottom: 16px; }
        .empty-state h3 { font-family: 'Cormorant Garamond', serif; font-size: 24px; margin-bottom: 10px; }
        .empty-state p { color: var(--text-mid); font-size: 14px; margin-bottom: 24px; }

        /* ── Pagination ── */
        .pagination-wrap { margin-top: 24px; display: flex; justify-content: center; }

        @media (max-width: 600px) {
            .topnav-links { display: none; }
            .booking-card { flex-direction: column; align-items: flex-start; }
            .booking-right { width: 100%; justify-content: space-between; }
        }
    </style>
</head>
<body>
    <!-- Sticky Nav -->
    <nav class="topnav">
        <div class="topnav-inner">
            <a href="{{ route('home') }}" class="topnav-brand">Virtual <span>Imagination</span></a>
            <div class="topnav-links">
                <a href="{{ route('home') }}" class="topnav-link">Home</a>
                <a href="{{ route('home') }}#studio-rent" class="topnav-link">Studio</a>
                <a href="{{ route('home') }}#portfolio" class="topnav-link">Portfolio</a>
                <a href="{{ route('bookings.index') }}" class="topnav-link active">Riwayat</a>
            </div>
            <a href="{{ route('bookings.create') }}" class="topnav-cta">+ Booking Baru</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Riwayat <span>Booking</span></h1>
            <a href="{{ route('bookings.create') }}" class="btn-new">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Booking Baru
            </a>
        </div>

        @if(session('success'))
            <div class="flash-success">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if($bookings->isEmpty())
            <div class="empty-state">
                <div class="icon">📅</div>
                <h3>Belum ada booking</h3>
                <p>Anda belum memiliki riwayat booking. Mulai buat booking pertama Anda!</p>
                <a href="{{ route('bookings.create') }}" class="btn-new">Buat Booking Pertama</a>
            </div>
        @else
            @foreach($bookings as $booking)
                <a href="{{ route('bookings.show', $booking) }}" class="booking-card">
                    <div class="booking-meta">
                        <div class="booking-ref">{{ $booking->booking_reference }}</div>
                        <div class="booking-name">{{ $booking->package->name ?? $booking->service }}</div>
                        <div class="booking-detail">
                            📅 {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                            &nbsp;·&nbsp; ⏱ {{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }}
                        </div>
                    </div>
                    <div class="booking-right">
                        <div class="booking-price">Rp {{ number_format($booking->price, 0, ',', '.') }}</div>
                        <span class="badge badge-{{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</span>
                        <span class="btn-view">Detail →</span>
                    </div>
                </a>
            @endforeach

            @if($bookings->hasPages())
                <div class="pagination-wrap">
                    {{ $bookings->links() }}
                </div>
            @endif
        @endif
    </div>
</body>
</html>
