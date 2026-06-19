<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Terkirim — Virtual Imagination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --gold: #CCB049; --gold-dark: #A8903A;
            --ink: #1A1A1A; --text-mid: #6B6B6B; --text-lo: #9E9E9E;
            --surface: #FFFFFF; --surface-2: #F7F6F3; --border: #E5E3DC;
            --radius-md: 12px; --radius-lg: 20px; --transition: .22s cubic-bezier(.4,0,.2,1);
        }
        html { -webkit-font-smoothing: antialiased; }
        body {
            background: #F0EDE6; font-family: 'DM Sans', sans-serif;
            color: var(--ink); min-height: 100vh;
            display: flex; flex-direction: column; align-items: center;
            padding: 40px 16px 60px;
        }

        .card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-lg); width: 100%; max-width: 520px;
            padding: 48px 40px 40px;
            box-shadow: 0 4px 32px rgba(0,0,0,.08);
            animation: fadeUp .5s both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Success animation ── */
        .success-icon {
            width: 72px; height: 72px; border-radius: 50%;
            background: linear-gradient(135deg, #25D366, #1EB858);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px; font-size: 32px;
            box-shadow: 0 8px 24px rgba(37,211,102,.3);
            animation: popIn .5s .2s both;
        }
        @keyframes popIn {
            0%   { transform: scale(0); opacity: 0; }
            70%  { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        .title {
            text-align: center; margin-bottom: 6px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px; font-weight: 600;
        }
        .subtitle {
            text-align: center; color: var(--text-mid);
            font-size: 13px; margin-bottom: 28px; line-height: 1.6;
        }

        /* ── Booking summary ── */
        .summary {
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: var(--radius-md); padding: 20px 22px;
            margin-bottom: 24px;
        }
        .summary-row {
            display: flex; justify-content: space-between; align-items: flex-start;
            gap: 12px; padding: 8px 0; border-bottom: 1px solid var(--border);
            font-size: 13px;
        }
        .summary-row:last-child { border-bottom: none; padding-bottom: 0; }
        .summary-row:first-child { padding-top: 0; }
        .summary-label { color: var(--text-lo); font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .8px; white-space: nowrap; }
        .summary-value { font-weight: 600; color: var(--ink); text-align: right; }
        .summary-ref { font-family: monospace; font-size: 13px; color: var(--gold-dark); }
        .summary-price { color: var(--gold-dark); font-size: 16px;
            font-family: 'Cormorant Garamond', serif; font-weight: 700; }

        /* ── Status badge ── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: #FEF3C7; border: 1px solid #FCD34D;
            border-radius: 20px; padding: 5px 14px;
            font-size: 12px; font-weight: 600; color: #92400E;
            margin: 0 auto 24px; width: fit-content; display: block; text-align: center;
        }

        /* ── Steps ── */
        .next-steps {
            background: #EFF6FF; border: 1px solid #BFDBFE;
            border-radius: var(--radius-md); padding: 18px 20px;
            margin-bottom: 24px;
        }
        .next-steps-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #1E40AF; margin-bottom: 12px;
        }
        .step-item {
            display: flex; align-items: flex-start; gap: 12px;
            margin-bottom: 10px; font-size: 13px; color: #1E40AF;
        }
        .step-item:last-child { margin-bottom: 0; }
        .step-num {
            width: 22px; height: 22px; border-radius: 50%;
            background: #1E40AF; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; flex-shrink: 0; margin-top: 1px;
        }
        .step-desc { line-height: 1.5; }

        /* ── WA Button ── */
        .btn-wa {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 15px;
            background: #25D366; color: #fff;
            border: none; border-radius: 50px;
            font-size: 14px; font-weight: 700; letter-spacing: .5px;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            text-decoration: none; transition: all var(--transition);
            margin-bottom: 12px;
        }
        .btn-wa:hover { background: #1EB858; transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37,211,102,.3); }
        .btn-wa svg { width: 20px; height: 20px; }

        .btn-secondary {
            display: block; text-align: center;
            padding: 12px; border: 1px solid var(--border);
            border-radius: 50px; font-size: 13px; font-weight: 500;
            color: var(--text-mid); text-decoration: none;
            transition: all var(--transition);
        }
        .btn-secondary:hover { border-color: var(--ink); color: var(--ink); }

        .footer-note { text-align: center; margin-top: 16px; font-size: 11px; color: var(--text-lo); }

        @media (max-width: 480px) {
            .card { padding: 32px 20px 28px; }
        }
    </style>
</head>
<body>
<div class="card">
    <div class="success-icon">✓</div>

    <h1 class="title">Booking Terkirim!</h1>
    <p class="subtitle">
        Data booking Anda telah tersimpan. Sekarang hubungi admin via WhatsApp untuk konfirmasi jadwal.
    </p>

    <div class="status-badge">
         Menunggu Konfirmasi Admin
    </div>

    {{-- Summary --}}
    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Referensi</span>
            <span class="summary-value summary-ref">{{ $booking->booking_reference }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Nama</span>
            <span class="summary-value">{{ $booking->full_name }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Paket</span>
            <span class="summary-value">{{ $booking->package->name ?? $booking->service }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Tanggal</span>
            <span class="summary-value">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Jam</span>
            <span class="summary-value">{{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total</span>
            <span class="summary-value summary-price">Rp {{ number_format($booking->price, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Next Steps --}}
    <div class="next-steps">
        <div class="next-steps-title"> Langkah Selanjutnya</div>
        <div class="step-item">
            <div class="step-num">1</div>
            <div class="step-desc">Klik tombol di bawah untuk menghubungi admin via WhatsApp (pesan sudah terisi otomatis).</div>
        </div>
        <div class="step-item">
            <div class="step-num">2</div>
            <div class="step-desc">Admin akan mengkonfirmasi ketersediaan jadwal Anda.</div>
        </div>
        <div class="step-item">
            <div class="step-num">3</div>
            <div class="step-desc">Setelah disetujui, lakukan pembayaran sesuai instruksi admin dan upload bukti transfer.</div>
        </div>
    </div>

    {{-- WhatsApp Button --}}
    <a href="{{ $waUrl }}" target="_blank" class="btn-wa" id="btn-wa">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
        Hubungi Admin via WhatsApp
    </a>

    <a href="{{ route('bookings.show', $booking) }}" class="btn-secondary">Cek Status Booking →</a>

    <p class="footer-note">
        Nomor referensi Anda: <strong>{{ $booking->booking_reference }}</strong><br>
        Simpan nomor ini untuk mengecek status booking.
    </p>
</div>
</body>
</html>
