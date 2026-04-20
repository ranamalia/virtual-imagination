<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation — Virtual Imagination</title>
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
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .logo-mark {
            width: 40px; height: 40px;
            background: var(--gold);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 600; font-style: italic;
            color: #fff;
        }

        .header-title {
            flex: 1; text-align: center;
            font-size: 10px; font-weight: 600;
            letter-spacing: 4px; text-transform: uppercase;
            color: var(--text-lo);
        }

        .header-avatar {
            width: 40px; height: 40px;
            border: 1.5px solid var(--border-hi);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold); font-size: 18px;
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

        /* ── Panel ── */
        .panel {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 22px; margin-bottom: 18px;
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
            background: #fff;
            border: 1px solid var(--border);
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
            background-repeat: no-repeat;
            background-position: right 11px center;
            background-size: 14px;
            cursor: pointer;
        }

        textarea { resize: vertical; min-height: 70px; }

        .error-msg {
            display: flex; align-items: center; gap: 5px;
            margin-top: 5px; font-size: 11px; color: var(--error);
        }
        .error-msg::before {
            content: '!'; width: 13px; height: 13px; border-radius: 50%;
            background: var(--error); color: #fff; font-size: 8px; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        /* ── Payment Method Tabs ── */
        .pm-tabs { display: flex; gap: 0; border: 1px solid var(--border); border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 20px; }
        .pm-tab {
            flex: 1; padding: 12px 10px; text-align: center; cursor: pointer;
            font-size: 12px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;
            color: var(--text-mid); background: #fff;
            border: none; transition: all var(--transition);
            display: flex; align-items: center; justify-content: center; gap: 7px;
        }
        .pm-tab:first-child { border-right: 1px solid var(--border); }
        .pm-tab.active { background: var(--gold); color: #fff; }
        .pm-tab input[type="radio"] { display: none; }

        /* ── Transfer Info ── */
        .transfer-info { display: none; }
        .transfer-info.show { display: block; }

        .bank-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 6px; }
        .bank-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 13px 16px;
            background: #fff; border: 1px solid var(--border);
            border-radius: var(--radius-sm);
        }
        .bank-left { display: flex; align-items: center; gap: 12px; }
        .bank-logo {
            width: 44px; height: 28px;
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 700; letter-spacing: .5px; color: #fff;
            flex-shrink: 0;
        }
        .bank-logo.bca  { background: #005bab; }
        .bank-logo.bni  { background: #f77f00; }
        .bank-logo.mdr  { background: #003d79; }
        .bank-logo.bri  { background: #00579b; }

        .bank-name { font-size: 13px; font-weight: 600; color: var(--text-hi); }
        .bank-holder { font-size: 11px; color: var(--text-lo); margin-top: 1px; }
        .bank-number {
            font-size: 14px; font-weight: 700; color: var(--text-hi);
            letter-spacing: .5px; font-family: monospace;
        }
        .copy-btn {
            margin-left: 10px; padding: 4px 10px;
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: 4px; font-size: 10px; font-weight: 600;
            color: var(--text-mid); cursor: pointer; transition: all var(--transition);
            white-space: nowrap;
        }
        .copy-btn:hover { background: var(--gold); color: #fff; border-color: var(--gold); }
        .copy-btn.copied { background: #4CAF50; color: #fff; border-color: #4CAF50; }

        /* ── QRIS Info ── */
        .qris-info { display: none; }
        .qris-info.show { display: block; }

        .qris-box {
            background: #fff; border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px; text-align: center; margin-bottom: 6px;
        }
        .qris-code {
            width: 180px; height: 180px; margin: 0 auto 16px;
            background: var(--surface-3);
            border-radius: 8px; position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        /* Dummy QR pattern */
        .qris-code svg { width: 160px; height: 160px; }
        .qris-label { font-size: 13px; font-weight: 600; color: var(--text-hi); margin-bottom: 4px; }
        .qris-sub { font-size: 11px; color: var(--text-lo); }

        /* ── Upload Bukti ── */
        .upload-section { margin-top: 18px; }
        .upload-box {
            border: 2px dashed var(--border);
            border-radius: var(--radius-md);
            padding: 28px 20px;
            text-align: center; cursor: pointer;
            transition: all var(--transition);
            background: var(--surface-2);
            position: relative;
        }
        .upload-box:hover { border-color: var(--gold); background: rgba(204,176,73,.03); }
        .upload-box.dragging { border-color: var(--gold); background: rgba(204,176,73,.06); }
        .upload-box input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .upload-icon { font-size: 28px; margin-bottom: 10px; display: block; }
        .upload-title { font-size: 13px; font-weight: 600; color: var(--text-hi); margin-bottom: 5px; }
        .upload-sub { font-size: 11px; color: var(--text-lo); }
        .upload-sub span { color: var(--gold); font-weight: 600; }

        .preview-wrap {
            display: none; margin-top: 12px;
            border: 1px solid var(--border); border-radius: var(--radius-sm);
            overflow: hidden; position: relative;
        }
        .preview-wrap img { width: 100%; max-height: 200px; object-fit: cover; display: block; }
        .preview-remove {
            position: absolute; top: 8px; right: 8px;
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(0,0,0,.55); color: #fff; border: none;
            font-size: 14px; cursor: pointer; display: flex;
            align-items: center; justify-content: center;
        }
        .preview-name {
            padding: 8px 12px; font-size: 11px;
            color: var(--text-mid); background: var(--surface-2);
            display: flex; align-items: center; gap: 6px;
        }
        .preview-name span { color: var(--gold); font-size: 14px; }

        /* ── Price ── */
        .price-wrap {
            display: flex; align-items: center; justify-content: space-between;
            padding: 13px 16px;
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: var(--radius-sm); margin-bottom: 18px;
            transition: border-color var(--transition);
        }
        .price-wrap.has-price { border-color: rgba(204,176,73,.4); }
        .price-label { font-size: 11px; color: var(--text-lo); letter-spacing: 1px; text-transform: uppercase; }
        #price-display {
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px; font-weight: 600; color: var(--gold);
        }

        /* ── Submit ── */
        .btn-submit {
            width: 100%; padding: 15px;
            background: var(--gold); color: #fff;
            border: none; border-radius: 50px;
            font-size: 13px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: all var(--transition);
        }
        .btn-submit:hover { background: var(--gold-dark); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(204,176,73,.3); }

        .footer-note { text-align: center; margin-top: 16px; font-size: 11px; color: var(--text-lo); }

        @media (max-width: 480px) {
            .card { padding: 28px 18px 24px; }
            .form-row { grid-template-columns: 1fr; }
            .tagline h1 { font-size: 22px; }
        }
    </style>
</head>
<body>
<div class="card">

    <div class="header">
        <div class="logo-mark">V</div>
        <div class="header-title">Reservation</div>
        <div class="header-avatar">&#x1F464;</div>
    </div>

    <div class="tagline">
        <h1>Capture The <em>Essential</em> Moment</h1>
        <p class="tagline-sub">Virtual Imagination Studio</p>
    </div>

    <div class="divider"><span>Fill in your details</span></div>

    <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Personal Info --}}
        <div class="panel">
            <div class="panel-label">Personal Information</div>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="e.g. Budi Santoso" required>
                @error('full_name')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required>
                    @error('email')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                    @error('phone')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Session Details --}}
        <div class="panel">
            <div class="panel-label">Session Details</div>
            <div class="form-group">
                <label for="package_id">Select Service</label>
                <select id="package_id" name="package_id" required onchange="handlePackageChange()">
                    <option value="">— Choose a Package —</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}"
                            data-price="{{ $package->price }}"
                            data-name="{{ $package->name }}"
                            {{ old('package_id') == $package->id ? 'selected' : '' }}>
                            {{ $package->name }} — {{ $package->getFormattedPrice() }}
                        </option>
                    @endforeach
                </select>
                @error('package_id')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="booking_date">Preferred Date</label>
                    <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" min="{{ date('Y-m-d') }}" required>
                    @error('booking_date')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="booking_time">Preferred Time</label>
                    <input type="time" id="booking_time" name="booking_time" value="{{ old('booking_time') }}" required>
                    @error('booking_time')<div class="error-msg">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label for="special_request">Special Request</label>
                <textarea id="special_request" name="special_request" placeholder="Any special requirements...">{{ old('special_request') }}</textarea>
                @error('special_request')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Payment Method --}}
        <div class="panel">
            <div class="panel-label">Payment Method</div>

            {{-- Tabs --}}
            <div class="pm-tabs">
                <label class="pm-tab active" id="tab-transfer" onclick="switchPM('transfer')">
                    <input type="radio" name="payment_method" value="transfer" {{ old('payment_method', 'transfer') === 'transfer' ? 'checked' : '' }}>
                    🏦 Transfer Bank
                </label>
                <label class="pm-tab" id="tab-qris" onclick="switchPM('qris')">
                    <input type="radio" name="payment_method" value="qris" {{ old('payment_method') === 'qris' ? 'checked' : '' }}>
                    📱 QRIS
                </label>
            </div>
            @error('payment_method')<div class="error-msg" style="margin-bottom:12px">{{ $message }}</div>@enderror

            {{-- Transfer Info --}}
            <div class="transfer-info show" id="transfer-info">
                <div class="bank-list">
                    <div class="bank-item">
                        <div class="bank-left">
                            <div class="bank-logo bca">BCA</div>
                            <div>
                                <div class="bank-name">Bank BCA</div>
                                <div class="bank-holder">Virtual Imagination Studio</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center">
                            <span class="bank-number" id="num-bca">1234567890</span>
                            <button type="button" class="copy-btn" onclick="copyNumber('1234567890', this)">Salin</button>
                        </div>
                    </div>
                    <div class="bank-item">
                        <div class="bank-left">
                            <div class="bank-logo bni">BNI</div>
                            <div>
                                <div class="bank-name">Bank BNI</div>
                                <div class="bank-holder">Virtual Imagination Studio</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center">
                            <span class="bank-number">9876543210</span>
                            <button type="button" class="copy-btn" onclick="copyNumber('9876543210', this)">Salin</button>
                        </div>
                    </div>
                    <div class="bank-item">
                        <div class="bank-left">
                            <div class="bank-logo mdr">MDR</div>
                            <div>
                                <div class="bank-name">Bank Mandiri</div>
                                <div class="bank-holder">Virtual Imagination Studio</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center">
                            <span class="bank-number">1122334455</span>
                            <button type="button" class="copy-btn" onclick="copyNumber('1122334455', this)">Salin</button>
                        </div>
                    </div>
                    <div class="bank-item">
                        <div class="bank-left">
                            <div class="bank-logo bri">BRI</div>
                            <div>
                                <div class="bank-name">Bank BRI</div>
                                <div class="bank-holder">Virtual Imagination Studio</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center">
                            <span class="bank-number">5566778899</span>
                            <button type="button" class="copy-btn" onclick="copyNumber('5566778899', this)">Salin</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- QRIS Info --}}
            <div class="qris-info" id="qris-info">
                <div class="qris-box">
                    <div class="qris-code">
                        {{-- Dummy QR SVG --}}
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" y="5" width="30" height="30" rx="3" fill="none" stroke="#1A1A1A" stroke-width="4"/>
                            <rect x="12" y="12" width="16" height="16" rx="1" fill="#1A1A1A"/>
                            <rect x="65" y="5" width="30" height="30" rx="3" fill="none" stroke="#1A1A1A" stroke-width="4"/>
                            <rect x="72" y="12" width="16" height="16" rx="1" fill="#1A1A1A"/>
                            <rect x="5" y="65" width="30" height="30" rx="3" fill="none" stroke="#1A1A1A" stroke-width="4"/>
                            <rect x="12" y="72" width="16" height="16" rx="1" fill="#1A1A1A"/>
                            <rect x="42" y="5" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="52" y="5" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="42" y="15" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="52" y="25" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="42" y="35" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="5" y="42" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="15" y="42" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="25" y="52" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="5" y="52" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="42" y="42" width="6" height="6" fill="#CCB049"/>
                            <rect x="52" y="42" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="62" y="42" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="52" y="52" width="6" height="6" fill="#CCB049"/>
                            <rect x="62" y="52" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="42" y="62" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="72" y="42" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="82" y="42" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="72" y="52" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="82" y="62" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="42" y="72" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="52" y="72" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="62" y="82" width="6" height="6" fill="#1A1A1A"/>
                            <rect x="72" y="72" width="6" height="6" fill="#CCB049"/>
                            <rect x="82" y="82" width="6" height="6" fill="#1A1A1A"/>
                        </svg>
                    </div>
                    <div class="qris-label">Virtual Imagination Studio</div>
                    <div class="qris-sub">Scan menggunakan aplikasi e-wallet atau m-banking apapun</div>
                </div>
            </div>

            {{-- Upload Bukti Pembayaran --}}
            <div class="upload-section">
                <label style="margin-bottom:10px">Upload Bukti Pembayaran</label>
                <div class="upload-box" id="upload-box">
                    <input type="file" name="payment_proof" id="payment_proof" accept="image/*" onchange="handleFileSelect(this)">
                    <span class="upload-icon">📎</span>
                    <div class="upload-title">Klik atau drag foto bukti pembayaran</div>
                    <div class="upload-sub">Format: JPG, PNG, WEBP • Maks. <span>5MB</span></div>
                </div>
                <div class="preview-wrap" id="preview-wrap">
                    <img id="preview-img" src="" alt="Preview bukti pembayaran">
                    <button type="button" class="preview-remove" onclick="removeFile()">✕</button>
                    <div class="preview-name">
                        <span>✓</span>
                        <span id="preview-name-text"></span>
                    </div>
                </div>
                @error('payment_proof')<div class="error-msg" style="margin-top:8px">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Price --}}
        <div class="price-wrap" id="price-wrap">
            <span class="price-label">Total</span>
            <span id="price-display">Rp —</span>
        </div>

        <input type="hidden" id="price"   name="price"   value="{{ old('price', 0) }}">
        <input type="hidden" id="service" name="service" value="{{ old('service', '') }}">

        <button type="submit" class="btn-submit">Confirm Reservation</button>
    </form>

    <p class="footer-note">Harga sudah termasuk semua layanan dalam paket</p>
</div>

<script>
    // Package price map
    const packageData = {
        @foreach($packages as $package)
        "{{ $package->id }}": { price: {{ (int)$package->price }}, name: "{{ addslashes($package->name) }}" },
        @endforeach
    };

    function formatRupiah(n) {
        return 'Rp' + n.toLocaleString('id-ID');
    }

    function handlePackageChange() {
        const sel = document.getElementById('package_id');
        const id  = sel.value;
        const priceDisp  = document.getElementById('price-display');
        const priceInput = document.getElementById('price');
        const svcInput   = document.getElementById('service');
        const wrap       = document.getElementById('price-wrap');

        if (id && packageData[id]) {
            const { price, name } = packageData[id];
            priceDisp.textContent = formatRupiah(price);
            priceInput.value      = price;
            svcInput.value        = name;
            wrap.classList.add('has-price');
        } else {
            priceDisp.textContent = 'Rp —';
            priceInput.value      = 0;
            svcInput.value        = '';
            wrap.classList.remove('has-price');
        }
    }

    // Payment method switch
    function switchPM(method) {
        const transferInfo = document.getElementById('transfer-info');
        const qrisInfo     = document.getElementById('qris-info');
        const tabTransfer  = document.getElementById('tab-transfer');
        const tabQris      = document.getElementById('tab-qris');

        if (method === 'transfer') {
            transferInfo.classList.add('show');
            qrisInfo.classList.remove('show');
            tabTransfer.classList.add('active');
            tabQris.classList.remove('active');
            tabTransfer.querySelector('input').checked = true;
        } else {
            qrisInfo.classList.add('show');
            transferInfo.classList.remove('show');
            tabQris.classList.add('active');
            tabTransfer.classList.remove('active');
            tabQris.querySelector('input').checked = true;
        }
    }

    // Copy rekening
    function copyNumber(number, btn) {
        navigator.clipboard.writeText(number).then(() => {
            btn.textContent = '✓ Disalin';
            btn.classList.add('copied');
            setTimeout(() => {
                btn.textContent = 'Salin';
                btn.classList.remove('copied');
            }, 2000);
        });
    }

    // File upload preview
    function handleFileSelect(input) {
        const file = input.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-name-text').textContent = file.name;
            document.getElementById('preview-wrap').style.display = 'block';
            document.getElementById('upload-box').style.opacity = '.5';
        };
        reader.readAsDataURL(file);
    }

    function removeFile() {
        document.getElementById('payment_proof').value = '';
        document.getElementById('preview-wrap').style.display = 'none';
        document.getElementById('upload-box').style.opacity = '1';
    }

    // Drag & drop
    const uploadBox = document.getElementById('upload-box');
    uploadBox.addEventListener('dragover', (e) => { e.preventDefault(); uploadBox.classList.add('dragging'); });
    uploadBox.addEventListener('dragleave', () => uploadBox.classList.remove('dragging'));
    uploadBox.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadBox.classList.remove('dragging');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const input = document.getElementById('payment_proof');
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            handleFileSelect(input);
        }
    });

    // Init on page load
    window.addEventListener('DOMContentLoaded', () => {
        const sel = document.getElementById('package_id');
        if (sel.value) handlePackageChange();

        const oldPM = "{{ old('payment_method', 'transfer') }}";
        switchPM(oldPM);
    });
</script>
</body>
</html>
