<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Diterima — Virtual Imagination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold:       #CCB049;
            --gold-dark:  #A8903A;
            --ink:        #1A1A1A;
            --text-hi:    #1A1A1A;
            --text-mid:   #6B6B6B;
            --text-lo:    #9E9E9E;
            --surface:    #FFFFFF;
            --surface-2:  #F7F6F3;
            --border:     #E5E3DC;
            --border-hi:  #CCB049;
            --success:    #2D7A4F;
            --warning:    #B45309;
            --danger:     #C0392B;
            --wa-green:   #25D366;
            --transition: .22s cubic-bezier(.4,0,.2,1);
        }

        html { -webkit-font-smoothing: antialiased; }

        body {
            background: #F0EDE6;
            font-family: 'DM Sans', sans-serif;
            color: var(--text-hi);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            width: 100%;
            max-width: 560px;
            padding: 44px 40px 40px;
            box-shadow: 0 4px 32px rgba(0,0,0,.08), 0 1px 4px rgba(0,0,0,.04);
            animation: fadeUp .4s both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Header ── */
        .header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 32px;
        }
        .logo-mark {
            width: 40px; height: 40px; background: var(--gold); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Cormorant Garamond', serif; font-size: 22px;
            font-weight: 600; font-style: italic; color: #fff;
        }
        .header-title {
            flex: 1; text-align: center; font-size: 10px; font-weight: 600;
            letter-spacing: 4px; text-transform: uppercase; color: var(--text-lo);
        }
        .header-spacer { width: 40px; }

        /* ── Check & Thank you ── */
        .check-wrap { display: flex; flex-direction: column; align-items: center; margin-bottom: 20px; }
        .check-circle {
            width: 64px; height: 64px; border-radius: 50%;
            border: 2px solid var(--gold); background: rgba(204,176,73,.08);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--gold); margin-bottom: 18px;
            animation: pop .4s .1s both;
        }
        @keyframes pop {
            0%   { transform: scale(.6); opacity: 0; }
            70%  { transform: scale(1.1); }
            100% { transform: scale(1);   opacity: 1; }
        }
        .thank-you { text-align: center; }
        .thank-you h1 {
            font-family: 'Cormorant Garamond', serif; font-size: 28px;
            font-weight: 300; font-style: italic; color: var(--text-hi);
            line-height: 1.2; margin-bottom: 10px;
        }
        .thank-you h1 em { color: var(--gold); font-style: normal; }
        .thank-you p { font-size: 13px; color: var(--text-mid); line-height: 1.65; max-width: 360px; }

        /* ── Status Banner ── */
        .status-banner {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 8px 20px; border-radius: 50px;
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
            margin: 16px auto 20px; width: fit-content;
        }
        .status-pending  { background: #FFF8E7; border: 1px solid #F5D76E; color: #8A6A00; }
        .status-confirmed{ background: #E8F5EE; border: 1px solid #81C784; color: #2E7D32; }
        .status-rejected { background: #FDECEA; border: 1px solid #EF9A9A; color: #C0392B; }
        .status-dot { width: 7px; height: 7px; border-radius: 50%; animation: pulse 2s infinite; }
        .status-pending  .status-dot  { background: #F5A623; }
        .status-confirmed .status-dot { background: #4CAF50; }
        .status-rejected  .status-dot { background: #EF5350; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

        /* ── Receipt Box ── */
        .receipt {
            background: linear-gradient(135deg, #CCB049 0%, #A8903A 100%);
            border-radius: 14px; padding: 24px;
            margin-bottom: 20px; position: relative; overflow: hidden;
        }
        .receipt::before {
            content: 'V'; position: absolute; right: -8px; top: -18px;
            font-family: 'Cormorant Garamond', serif; font-size: 110px;
            font-weight: 700; color: rgba(0,0,0,.07); line-height: 1; pointer-events: none;
        }
        .receipt-top {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 14px;
        }
        .rl { font-size: 9px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(0,0,0,.45); margin-bottom: 3px; }
        .rv { font-size: 18px; font-weight: 700; color: #0D0D0D; font-family: monospace; letter-spacing: .5px; }
        .rhr { border: none; border-top: 1px solid rgba(0,0,0,.15); margin: 12px 0; }
        .service-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
        .sn { font-size: 15px; font-weight: 700; color: #0D0D0D; }
        .sp { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 600; color: #0D0D0D; }
        .dt-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
        .dt-item .dl { font-size: 9px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(0,0,0,.45); margin-bottom: 3px; }
        .dt-item .dv { font-size: 13px; font-weight: 700; color: #0D0D0D; display: flex; align-items: center; gap: 5px; }
        .loc .dl { font-size: 9px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(0,0,0,.45); margin-bottom: 4px; }
        .loc .lv { font-size: 12px; color: #0D0D0D; font-weight: 500; line-height: 1.5; display: flex; gap: 5px; }

        /* ── WA CTA ── */
        .wa-cta {
            display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;
        }
        .btn-wa {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 15px; background: var(--wa-green); color: #fff;
            border: none; border-radius: 50px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
            cursor: pointer; text-decoration: none;
            transition: all var(--transition);
        }
        .btn-wa:hover { background: #1EB858; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,211,102,.35); }
        .btn-wa svg { width: 20px; height: 20px; flex-shrink: 0; }

        .btn-secondary {
            display: block; width: 100%; padding: 13px; border-radius: 50px;
            font-size: 12px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase;
            cursor: pointer; text-align: center; font-family: 'DM Sans', sans-serif;
            text-decoration: none; box-sizing: border-box; transition: all var(--transition);
            background: transparent; color: var(--text-hi); border: 1.5px solid var(--border);
        }
        .btn-secondary:hover { border-color: var(--gold); color: var(--gold); }

        /* ── Info notice ── */
        .info-notice {
            display: flex; gap: 10px; align-items: flex-start;
            background: #FFF8E7; border-left: 3px solid var(--gold);
            border-radius: 0 8px 8px 0; padding: 12px 14px; margin-top: 18px;
        }
        .info-notice p { font-size: 11px; color: #8A6A00; line-height: 1.6; }
        .info-notice strong { font-weight: 600; }

        @media (max-width: 480px) {
            .card { padding: 28px 18px 24px; }
            .dt-grid { grid-template-columns: 1fr; }
            .thank-you h1 { font-size: 22px; }
        }
    </style>
</head>
<body>
<div class="card">

    <div class="header">
        <div class="logo-mark">V</div>
        <div class="header-title">Booking Diterima</div>
        <div class="header-spacer"></div>
    </div>

    <div class="check-wrap">
        <div class="check-circle">✓</div>
        <div class="thank-you">
            <h1>Terima Kasih Telah<br>Memilih <em>Studio Kami!</em></h1>
            <p>Booking Anda telah tersimpan. Hubungi admin via WhatsApp untuk konfirmasi ketersediaan jadwal.</p>
        </div>
    </div>

    {{-- Status Badge --}}
    @php $statusKey = strtolower($booking->status); @endphp
    <div class="status-banner status-{{ $statusKey }}">
        <span class="status-dot"></span>
        @if($statusKey === 'pending') Menunggu Konfirmasi Admin
        @elseif($statusKey === 'confirmed') Dikonfirmasi
        @else {{ ucfirst($statusKey) }}
        @endif
    </div>

    {{-- Receipt --}}
    <div class="receipt">
        <div class="receipt-top">
            <div>
                <div class="rl">Booking Reference</div>
                <div class="rv">{{ $booking->booking_reference }}</div>
            </div>
            <div style="text-align:right">
                <div class="rl">Dibuat</div>
                <div style="font-size:12px;font-weight:600;color:#0D0D0D">{{ $booking->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div class="rhr"></div>

        <div class="service-row">
            <span class="sn">{{ $booking->package->name ?? $booking->service }}</span>
            <span class="sp">Rp{{ number_format((float)$booking->price, 0, ',', '.') }}</span>
        </div>

        <div class="rhr"></div>

        <div class="dt-grid">
            <div class="dt-item">
                <div class="dl">Tanggal</div>
                <div class="dv">📅 {{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'N/A' }}</div>
            </div>
            <div class="dt-item">
                <div class="dl">Waktu</div>
                <div class="dv">
                    ⏱
                    @if($booking->booking_time)
                        {{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }} WIB
                    @else N/A @endif
                </div>
            </div>
        </div>

        <div class="rhr"></div>

        <div class="loc">
            <div class="dl">Lokasi Studio</div>
            <div class="lv">
                <span>📍</span>
                <span>Ngorsesan, Gg. Cahaya 4 Jl. Kartika No.66,<br>Kota Surakarta, Jawa Tengah 57126</span>
            </div>
        </div>
    </div>

    {{-- WhatsApp CTA --}}
    <div class="wa-cta">
        @isset($waUrl)
            <a href="{{ $waUrl }}" target="_blank" class="btn-wa" id="wa-btn">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                Konfirmasi via WhatsApp Sekarang
            </a>
        @endisset
        <a href="{{ route('bookings.index') }}" class="btn-secondary">Lihat Semua Booking Saya</a>
        <a href="{{ route('home') }}" class="btn-secondary">Kembali ke Beranda</a>
    </div>

    <div class="info-notice">
        <span style="font-size:14px;flex-shrink:0">ℹ️</span>
        <p>Admin akan mengkonfirmasi ketersediaan jadwal setelah Anda menghubungi via WhatsApp. Simpan referensi booking Anda: <strong>{{ $booking->booking_reference }}</strong>.</p>
    </div>

</div>

@isset($waUrl)
<script>
    // Auto-open WhatsApp setelah 1.5 detik agar user sempat melihat konfirmasi
    window.addEventListener('load', function () {
        setTimeout(function () {
            window.open("{{ $waUrl }}", '_blank');
        }, 1500);
    });
</script>
@endisset
</body>
</html>
