<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Received — Virtual Imagination</title>
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
            --surface-3:  #EFEFED;
            --border:     #E5E3DC;
            --border-hi:  #CCB049;
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
            max-width: 540px;
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
        .header-avatar {
            width: 40px; height: 40px; border: 1.5px solid var(--border-hi);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            color: var(--gold); font-size: 18px;
        }

        /* ── Check & Thank you ── */
        .check-wrap { display: flex; flex-direction: column; align-items: center; margin-bottom: 24px; }
        .check-circle {
            width: 60px; height: 60px; border-radius: 50%;
            border: 2px solid var(--gold); background: rgba(204,176,73,.08);
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; color: var(--gold); margin-bottom: 16px;
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
        .thank-you p { font-size: 13px; color: var(--text-mid); line-height: 1.65; max-width: 340px; }

        /* ── Status Banner ── */
        .status-banner {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 10px 18px; border-radius: 50px;
            font-size: 12px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase;
            margin: 0 auto 20px; width: fit-content;
        }
        .status-banner.pending {
            background: #FFF8E7; border: 1px solid #F5D76E; color: #8A6A00;
        }
        .status-banner.scheduled {
            background: #E8F5E9; border: 1px solid #81C784; color: #2E7D32;
        }
        .status-dot {
            width: 7px; height: 7px; border-radius: 50%;
            animation: pulse 2s infinite;
        }
        .pending .status-dot  { background: #F5A623; }
        .scheduled .status-dot { background: #4CAF50; }
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
            margin-bottom: 16px;
        }
        .rl { font-size: 9px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(0,0,0,.45); margin-bottom: 3px; }
        .rv { font-size: 18px; font-weight: 700; color: #0D0D0D; }

        .pm-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(0,0,0,.12); border-radius: 50px;
            padding: 4px 12px; font-size: 10px; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase; color: #0D0D0D;
        }

        .rhr { border: none; border-top: 1px solid rgba(0,0,0,.15); margin: 14px 0; }

        .service-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
        .sn { font-size: 14px; font-weight: 600; color: #0D0D0D; }
        .sp { font-family: 'Cormorant Garamond', serif; font-size: 20px; font-weight: 600; color: #0D0D0D; }

        .dt-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px; }
        .dt-item .dl { font-size: 9px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(0,0,0,.45); margin-bottom: 3px; }
        .dt-item .dv { font-size: 13px; font-weight: 700; color: #0D0D0D; display: flex; align-items: center; gap: 5px; }

        .loc .dl { font-size: 9px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: rgba(0,0,0,.45); margin-bottom: 3px; }
        .loc .lv { font-size: 11px; color: #0D0D0D; font-weight: 500; line-height: 1.5; display: flex; gap: 5px; }

        /* ── Bukti Pembayaran ── */
        .proof-section {
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: 12px; padding: 20px; margin-bottom: 20px;
        }
        .proof-title {
            font-size: 10px; font-weight: 600; letter-spacing: 2px;
            text-transform: uppercase; color: var(--text-lo); margin-bottom: 14px;
        }
        .proof-img-wrap { border-radius: 8px; overflow: hidden; border: 1px solid var(--border); }
        .proof-img-wrap img { width: 100%; max-height: 260px; object-fit: cover; display: block; }
        .proof-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 14px; background: #fff; border-top: 1px solid var(--border);
        }
        .proof-status {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; font-weight: 600; color: #8A6A00;
        }
        .proof-status .dot { width: 6px; height: 6px; border-radius: 50%; background: #F5A623; }
        .proof-note { font-size: 10px; color: var(--text-lo); }

        /* ── Buttons ── */
        .btns { display: flex; flex-direction: column; gap: 10px; }
        .bn, .bh {
            display: block; width: 100%; padding: 14px; border-radius: 50px;
            font-size: 12px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;
            cursor: pointer; text-align: center; font-family: 'DM Sans', sans-serif;
            text-decoration: none; box-sizing: border-box; transition: all var(--transition);
        }
        .bn { background: var(--gold); color: #fff; border: none; }
        .bn:hover { background: var(--gold-dark); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(204,176,73,.3); }
        .bh { background: transparent; color: var(--text-hi); border: 1.5px solid var(--border); }
        .bh:hover { border-color: var(--gold); color: var(--gold); }

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
        <div class="header-title">Booking Received</div>
        <div class="header-avatar">&#x1F464;</div>
    </div>

    <div class="check-wrap">
        <div class="check-circle">✓</div>
        <div class="thank-you">
            <h1>Thankyou For<br>Choosing Our <em>Lens!</em></h1>
            <p>Booking kamu sudah kami terima. Admin akan memverifikasi bukti pembayaranmu dan mengkonfirmasi jadwal sesegera mungkin.</p>
        </div>
    </div>

    {{-- Status Badge --}}
    <div class="status-banner {{ strtolower($booking->status) === 'scheduled' ? 'scheduled' : 'pending' }}">
        <span class="status-dot"></span>
        {{ $booking->status === 'Pending' ? 'Menunggu Verifikasi' : ucfirst($booking->status) }}
    </div>

    {{-- Receipt --}}
    <div class="receipt">
        <div class="receipt-top">
            <div>
                <div class="rl">Booking Reference</div>
                <div class="rv">{{ $booking->booking_reference }}</div>
            </div>
            <div class="pm-badge">
                @if($booking->payment_method === 'transfer')
                    🏦 Transfer
                @else
                    📱 QRIS
                @endif
            </div>
        </div>

        <div class="rhr"></div>

        <div class="service-row">
            <span class="sn">{{ $booking->service }}</span>
            <span class="sp">Rp{{ number_format((float)$booking->price, 0, ',', '.') }}</span>
        </div>

        <div class="rhr"></div>

        <div class="dt-grid">
            <div class="dt-item">
                <div class="dl">Date</div>
                <div class="dv">📅 {{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'N/A' }}</div>
            </div>
            <div class="dt-item">
                <div class="dl">Time</div>
                <div class="dv">
                    ⏱
                    @if($booking->booking_time)
                        {{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('h:i A') }}
                    @else
                        N/A
                    @endif
                </div>
            </div>
        </div>

        <div class="rhr"></div>

        <div class="loc">
            <div class="dl">Location</div>
            <div class="lv">
                <span>📍</span>
                <span>Ngorsesan, Gg. Cahaya 4 Jl. Kartika No.66,<br>Kota Surakarta, Jawa Tengah 57126</span>
            </div>
        </div>
    </div>

    {{-- Bukti Pembayaran --}}
    @if($booking->payment_proof)
    <div class="proof-section">
        <div class="proof-title">Bukti Pembayaran</div>
        <div class="proof-img-wrap">
            <img src="{{ asset('storage/' . $booking->payment_proof) }}" alt="Bukti pembayaran">
            <div class="proof-footer">
                <div class="proof-status">
                    <span class="dot"></span>
                    Menunggu verifikasi admin
                </div>
                <span class="proof-note">Diupload {{ $booking->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
    @endif

    {{-- Buttons --}}
    <div class="btns">
        <a href="{{ route('bookings.create') }}" class="bn">Buat Booking Baru</a>
        <a href="/" class="bh">Kembali ke Beranda</a>
    </div>

    <div class="info-notice">
        <span style="font-size:14px;flex-shrink:0">ℹ️</span>
        <p>Booking kamu akan dikonfirmasi setelah admin memverifikasi pembayaran. Referensi: <strong>{{ $booking->booking_reference }}</strong>. Untuk pertanyaan, hubungi admin kami.</p>
    </div>

</div>
</body>
</html>
