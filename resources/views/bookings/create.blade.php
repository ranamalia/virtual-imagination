<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Studio — Virtual Imagination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

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
            --surface-3:  #EFEFED;
            --border:     #E5E3DC;
            --border-hi:  #CCB049;
            --error:      #D65A5A;
            --radius-sm:  6px;
            --radius-md:  12px;
            --radius-lg:  20px;
            --transition: .22s cubic-bezier(.4,0,.2,1);
        }

        html { font-size: 16px; -webkit-font-smoothing: antialiased; }

        body {
            background: #F0EDE6;
            font-family: 'DM Sans', sans-serif;
            color: var(--text-hi);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px 60px;
        }

        /* ── Back link ── */
        .back-wrap { width: 100%; max-width: 560px; margin-bottom: 16px; }
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 600; color: var(--text-mid);
            text-decoration: none; transition: color var(--transition);
        }
        .back-link:hover { color: var(--ink); }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            width: 100%; max-width: 560px;
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
            width: 40px; height: 40px; background: var(--gold);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 600; font-style: italic; color: #fff;
        }
        .header-title {
            flex: 1; text-align: center;
            font-size: 10px; font-weight: 600; letter-spacing: 4px; text-transform: uppercase;
            color: var(--text-lo);
        }
        .header-user {
            display: flex; align-items: center; gap: 7px;
            font-size: 12px; font-weight: 600; color: var(--text-mid);
        }
        .header-user .avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--gold); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
        }

        /* ── Tagline ── */
        .tagline { text-align: center; margin-bottom: 28px; }
        .tagline h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px; font-weight: 300; font-style: italic;
            color: var(--text-hi); line-height: 1.25;
        }
        .tagline h1 em { color: var(--gold); font-style: normal; }
        .tagline-sub {
            margin-top: 6px; font-size: 11px;
            color: var(--text-lo); letter-spacing: 2px; text-transform: uppercase;
        }

        /* ── Divider ── */
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 24px; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .divider span { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: var(--text-lo); }

        /* ── Steps indicator ── */
        .steps {
            display: flex; align-items: center; justify-content: center;
            gap: 0; margin-bottom: 28px;
        }
        .step {
            display: flex; flex-direction: column; align-items: center; gap: 4px;
            flex: 1;
        }
        .step-circle {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700;
            background: var(--surface-3); color: var(--text-lo);
        }
        .step.active .step-circle {
            background: var(--gold); color: var(--ink);
        }
        .step-label { font-size: 9px; color: var(--text-lo); text-align: center; letter-spacing: .5px; }
        .step.active .step-label { color: var(--gold-dark); font-weight: 600; }
        .step-line { flex: 1; height: 1px; background: var(--border); margin: 0 -1px; }

        /* ── Panel ── */
        .panel {
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: var(--radius-md); padding: 22px; margin-bottom: 18px;
        }
        .panel-label {
            font-size: 9px; font-weight: 600; letter-spacing: 3px;
            text-transform: uppercase; color: var(--text-lo); margin-bottom: 16px;
        }

        /* ── Form ── */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .form-group { margin-bottom: 14px; }
        .form-group:last-child { margin-bottom: 0; }

        label {
            display: block; font-size: 10px; font-weight: 500;
            letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--text-mid); margin-bottom: 7px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        select, textarea {
            width: 100%; padding: 11px 13px;
            background: #fff; border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-hi); font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
            -webkit-appearance: none; appearance: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(204,176,73,.12);
        }

        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            cursor: pointer; opacity: .5;
        }

        input::placeholder, textarea::placeholder { color: var(--text-lo); }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='%23CCB049' d='M4 6l4 4 4-4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 11px center;
            background-size: 14px; cursor: pointer;
        }

        textarea { resize: vertical; min-height: 80px; }

        .error-msg {
            display: flex; align-items: center; gap: 5px;
            margin-top: 5px; font-size: 11px; color: var(--error);
        }
        .error-msg::before {
            content: '!'; width: 13px; height: 13px; border-radius: 50%;
            background: var(--error); color: #fff; font-size: 8px; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        /* ── Selected Package Preview ── */
        .package-preview {
            display: none; background: rgba(204,176,73,.06);
            border: 1px solid rgba(204,176,73,.3);
            border-radius: var(--radius-sm); padding: 12px 14px;
            margin-top: 10px;
        }
        .package-preview.visible { display: flex; align-items: center; justify-content: space-between; }
        .pkg-name { font-size: 13px; font-weight: 600; color: var(--ink); }
        .pkg-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 600; color: var(--gold);
        }

        /* ── Notice ── */
        .notice {
            display: flex; align-items: flex-start; gap: 12px;
            background: #F0FDF4; border: 1px solid #86EFAC;
            border-radius: var(--radius-md); padding: 14px 16px; margin-bottom: 20px;
        }
        .notice-icon { font-size: 20px; flex-shrink: 0; margin-top: 1px; }
        .notice-text { font-size: 12px; color: #15803D; line-height: 1.6; }
        .notice-text strong { display: block; margin-bottom: 3px; font-size: 13px; }

        /* ── Submit ── */
        .btn-submit {
            width: 100%; padding: 15px;
            background: #25D366; color: #fff;
            border: none; border-radius: 50px;
            font-size: 13px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: all var(--transition);
        }
        .btn-submit:hover { background: #1EB858; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,211,102,.3); }
        .btn-submit svg { width: 18px; height: 18px; }

        .footer-note { text-align: center; margin-top: 14px; font-size: 11px; color: var(--text-lo); }

        @media (max-width: 480px) {
            .card { padding: 28px 18px 24px; }
            .form-row { grid-template-columns: 1fr; }
            .tagline h1 { font-size: 22px; }
            .steps { display: none; }
        }
    </style>
</head>
<body>

    <div class="back-wrap">
        <a href="{{ route('home') }}" class="back-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke Beranda
        </a>
    </div>

<div class="card">

    <div class="header">
        <div class="logo-mark">V</div>
        <div class="header-title">Studio Reservation</div>
        <div class="header-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
        </div>
    </div>

    <div class="tagline">
        <h1>Capture The <em>Essential</em> Moment</h1>
        <p class="tagline-sub">Virtual Imagination Studio</p>
    </div>

    {{-- Step Indicator --}}
    <div class="steps">
        <div class="step active">
            <div class="step-circle">1</div>
            <div class="step-label">Pilih Paket</div>
        </div>
        <div class="step-line"></div>
        <div class="step active">
            <div class="step-circle">2</div>
            <div class="step-label">Isi Form</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-label">Konfirmasi WA</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">4</div>
            <div class="step-label">Bayar</div>
        </div>
    </div>

    <div class="divider"><span>Isi data booking Anda</span></div>

    <form action="{{ route('bookings.store') }}" method="POST" novalidate>
        @csrf

        {{-- Pilih Paket --}}
        <div class="panel">
            <div class="panel-label">1 · Pilih Paket Studio</div>
            <div class="form-group">
                <label for="package_id">Paket Foto Studio</label>
                <select id="package_id" name="package_id" required onchange="handlePackageChange()">
                    <option value="">— Pilih Paket —</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}"
                            data-price="{{ $package->price }}"
                            data-name="{{ addslashes($package->name) }}"
                            {{ old('package_id', request('package')) == $package->id ? 'selected' : '' }}>
                            {{ $package->name }} — {{ $package->getFormattedPrice() }}
                        </option>
                    @endforeach
                </select>
                @error('package_id')<div class="error-msg">{{ $message }}</div>@enderror

                <div class="package-preview" id="pkg-preview">
                    <span class="pkg-name" id="pkg-name"></span>
                    <span class="pkg-price" id="pkg-price"></span>
                </div>
            </div>
        </div>

        {{-- Personal Info --}}
        <div class="panel">
            <div class="panel-label">2 · Informasi Pribadi</div>
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" id="full_name" name="full_name"
                       value="{{ old('full_name', auth()->user()->name ?? '') }}"
                       placeholder="cth. Budi Santoso" required>
                @error('full_name')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', auth()->user()->email ?? '') }}"
                           placeholder="kamu@email.com" required>
                    @error('email')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="whatsapp">Nomor WhatsApp</label>
                    <input type="tel" id="whatsapp" name="whatsapp"
                           value="{{ old('whatsapp') }}"
                           placeholder="628xxxxxxxxxx" required>
                    @error('whatsapp')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Session Details --}}
        <div class="panel">
            <div class="panel-label">3 · Detail Sesi</div>
            <div class="form-row">
                <div class="form-group">
                    <label for="booking_date">Tanggal Sesi</label>
                    <input type="date" id="booking_date" name="booking_date"
                           value="{{ old('booking_date') }}"
                           min="{{ date('Y-m-d') }}" required>
                    @error('booking_date')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="booking_time">Jam Mulai</label>
                    <input type="time" id="booking_time" name="booking_time"
                           value="{{ old('booking_time') }}" required>
                    @error('booking_time')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label for="special_request">Permintaan Khusus <span style="font-size:9px;color:var(--text-lo)">(opsional)</span></label>
                <textarea id="special_request" name="special_request"
                          placeholder="Ceritakan kebutuhan atau permintaan khusus sesi Anda…">{{ old('special_request') }}</textarea>
                @error('special_request')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Notice --}}
        <div class="notice">
            <div class="notice-icon">💬</div>
            <div class="notice-text">
                <strong>Alur Booking via WhatsApp</strong>
                Setelah submit, data booking akan tersimpan dan Anda akan diarahkan ke WhatsApp untuk mengirim pesan ke admin. Admin akan mengkonfirmasi ketersediaan jadwal, lalu Anda akan mendapat instruksi pembayaran.
            </div>
        </div>

        <input type="hidden" id="price"   name="price"   value="{{ old('price', 0) }}">
        <input type="hidden" id="service" name="service" value="{{ old('service', '') }}">

        <button type="submit" class="btn-submit" id="submit-btn">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            Booking &amp; Hubungi via WhatsApp
        </button>
    </form>

    <p class="footer-note">Harga sudah termasuk semua layanan dalam paket yang dipilih</p>
</div>

<script>
    const packageData = {
        @foreach($packages as $package)
        "{{ $package->id }}": {
            price: {{ (int)$package->price }},
            name: "{{ addslashes($package->name) }}"
        },
        @endforeach
    };

    function formatRupiah(n) {
        return 'Rp' + n.toLocaleString('id-ID');
    }

    function handlePackageChange() {
        const sel     = document.getElementById('package_id');
        const id      = sel.value;
        const preview = document.getElementById('pkg-preview');
        const pkgName = document.getElementById('pkg-name');
        const pkgPrice= document.getElementById('pkg-price');
        const priceInp= document.getElementById('price');
        const svcInp  = document.getElementById('service');

        if (id && packageData[id]) {
            const { price, name } = packageData[id];
            pkgName.textContent   = name;
            pkgPrice.textContent  = formatRupiah(price);
            priceInp.value        = price;
            svcInp.value          = name;
            preview.classList.add('visible');
        } else {
            preview.classList.remove('visible');
            priceInp.value = 0;
            svcInp.value   = '';
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        const sel = document.getElementById('package_id');
        if (sel.value) handlePackageChange();
    });
</script>
</body>
</html>
