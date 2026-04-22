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
            padding: 40px 16px;
        }

        .container { max-width: 900px; margin: 0 auto; }

        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
        .page-title { font-family: 'Cormorant Garamond', serif; font-size: 28px; font-weight: 600; }
        .btn-new {
            padding: 10px 22px; background: var(--gold); color: var(--ink);
            border: none; border-radius: 8px; font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600; cursor: pointer;
            text-decoration: none; transition: background var(--transition);
        }
        .btn-new:hover { background: var(--gold-dark); color: #fff; }

        .booking-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            margin-bottom: 14px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 16px;
            transition: box-shadow var(--transition), border-color var(--transition);
        }
        .booking-card:hover { border-color: var(--gold); box-shadow: 0 4px 16px rgba(204,176,73,.12); }

        .booking-meta { flex: 1; }
        .booking-ref { font-family: monospace; font-size: 12px; color: var(--text-lo); margin-bottom: 4px; }
        .booking-name { font-weight: 600; font-size: 15px; color: var(--ink); }
        .booking-detail { font-size: 13px; color: var(--text-mid); margin-top: 3px; }

        .booking-right { display: flex; align-items: center; gap: 12px; }
        .booking-price { font-weight: 700; color: var(--gold-dark); font-size: 15px; }

        .badge {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: capitalize;
        }
        .badge-pending   { background: var(--warning-bg); color: var(--warning); }
        .badge-confirmed { background: var(--success-bg); color: var(--success); }
        .badge-rejected  { background: var(--danger-bg);  color: var(--danger);  }
        .badge-scheduled { background: var(--info-bg);    color: var(--info);    }

        .btn-view {
            padding: 7px 14px; border: 1px solid var(--border);
            border-radius: 7px; color: var(--text-mid); font-size: 13px;
            text-decoration: none; transition: all var(--transition);
        }
        .btn-view:hover { border-color: var(--gold); color: var(--gold-dark); }

        .empty-state {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-md); text-align: center; padding: 64px 24px;
        }
        .empty-state .icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state h3 { font-family: 'Cormorant Garamond', serif; font-size: 22px; margin-bottom: 8px; }
        .empty-state p { color: var(--text-mid); font-size: 14px; margin-bottom: 20px; }

        .pagination-wrap { margin-top: 20px; display: flex; justify-content: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Booking Saya</h1>
            <a href="{{ route('bookings.create') }}" class="btn-new">+ Booking Baru</a>
        </div>

        @if($bookings->isEmpty())
            <div class="empty-state">
                <div class="icon">📅</div>
                <h3>Belum ada booking</h3>
                <p>Anda belum memiliki riwayat booking. Mulai buat booking pertama Anda!</p>
                <a href="{{ route('bookings.create') }}" class="btn-new">Buat Booking</a>
            </div>
        @else
            @foreach($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-meta">
                        <div class="booking-ref">{{ $booking->booking_reference }}</div>
                        <div class="booking-name">{{ $booking->package->name ?? $booking->service }}</div>
                        <div class="booking-detail">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                            · {{ $booking->booking_time }}
                        </div>
                    </div>
                    <div class="booking-right">
                        <div class="booking-price">Rp {{ number_format($booking->price, 0, ',', '.') }}</div>
                        <span class="badge badge-{{ strtolower($booking->status) }}">{{ $booking->status }}</span>
                        <a href="{{ route('bookings.show', $booking) }}" class="btn-view">Detail →</a>
                    </div>
                </div>
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
