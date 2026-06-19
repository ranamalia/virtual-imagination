<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking — Virtual Imagination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --gold: #CCB049; --gold-dark: #A8903A;
            --ink: #1A1A1A; --text-mid: #6B6B6B; --text-lo: #9E9E9E;
            --surface: #FFFFFF; --surface-2: #F7F6F3; --border: #E5E3DC;
            --success: #2D7A4F; --success-bg: #E8F5EE;
            --warning: #92400E; --warning-bg: #FEF3C7;
            --danger: #C0392B; --danger-bg: #FDECEA;
            --info: #1E5FA8; --info-bg: #EBF3FB;
            --purple: #6D28D9; --purple-bg: #EDE9FE;
            --radius-sm: 6px; --radius-md: 12px; --radius-lg: 20px;
            --transition: .22s cubic-bezier(.4,0,.2,1);
        }
        html { -webkit-font-smoothing: antialiased; }
        body {
            background: #F0EDE6; font-family: 'DM Sans', sans-serif;
            color: var(--ink); min-height: 100vh;
            display: flex; flex-direction: column; align-items: center;
            padding: 32px 16px 60px;
        }

        .back-wrap { width: 100%; max-width: 600px; margin-bottom: 16px; }
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 600; color: var(--text-mid);
            text-decoration: none; transition: color var(--transition);
        }
        .back-link:hover { color: var(--ink); }

        .container { width: 100%; max-width: 600px; }

        /* ── Card ── */
        .card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-lg); overflow: hidden;
            margin-bottom: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
            animation: fadeUp .4s both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-header {
            padding: 18px 24px; border-bottom: 1px solid var(--border);
            background: var(--surface-2);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px; font-weight: 600;
        }
        .card-body { padding: 24px; }

        /* ── Status Badge ── */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 13px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .badge-warning  { background: var(--warning-bg);  color: var(--warning); }
        .badge-danger   { background: var(--danger-bg);   color: var(--danger); }
        .badge-info     { background: var(--info-bg);     color: var(--info); }
        .badge-purple   { background: var(--purple-bg);   color: var(--purple); }
        .badge-success  { background: var(--success-bg);  color: var(--success); }

        /* ── Info Grid ── */
        .info-grid {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;
        }
        .info-item label {
            display: block; font-size: 10px; color: var(--text-lo);
            font-weight: 600; text-transform: uppercase; letter-spacing: .8px;
            margin-bottom: 4px;
        }
        .info-item span { font-size: 14px; color: var(--ink); font-weight: 500; }
        .info-full { grid-column: 1 / -1; }

        /* ── Status Banner ── */
        .status-banner {
            padding: 20px 24px; border-radius: var(--radius-md);
            margin-bottom: 16px; display: flex; align-items: flex-start; gap: 14px;
        }
        .status-banner.warning { background: #FFFBEB; border: 1px solid #FCD34D; }
        .status-banner.danger  { background: #FFF5F5; border: 1px solid #FCA5A5; }
        .status-banner.info    { background: #EFF6FF; border: 1px solid #93C5FD; }
        .status-banner.purple  { background: #F5F3FF; border: 1px solid #C4B5FD; }
        .status-banner.success { background: #F0FDF4; border: 1px solid #86EFAC; }
        .banner-icon { font-size: 28px; flex-shrink: 0; }
        .banner-title {
            font-size: 15px; font-weight: 700; margin-bottom: 5px;
        }
        .banner-desc { font-size: 13px; color: var(--text-mid); line-height: 1.6; }
        .banner-warning  .banner-title { color: #92400E; }
        .banner-danger   .banner-title { color: var(--danger); }
        .banner-info     .banner-title { color: var(--info); }
        .banner-purple   .banner-title { color: var(--purple); }
        .banner-success  .banner-title { color: var(--success); }

        /* ── Payment Info ── */
        .payment-box {
            background: linear-gradient(135deg, #1A1A1A, #2D2D2D);
            border-radius: var(--radius-md); padding: 24px;
            margin-bottom: 16px; color: #fff;
        }
        .payment-box-label {
            font-size: 10px; font-weight: 600; letter-spacing: 3px;
            text-transform: uppercase; color: var(--gold); margin-bottom: 16px;
        }
        .bank-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px; font-weight: 600; color: #fff; margin-bottom: 4px;
        }
        .account-number {
            font-family: monospace; font-size: 22px; font-weight: 700;
            color: var(--gold); letter-spacing: 2px; margin-bottom: 4px;
        }
        .account-name { font-size: 13px; color: rgba(255,255,255,.7); margin-bottom: 16px; }
        .payment-total {
            border-top: 1px solid rgba(255,255,255,.15); padding-top: 14px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .total-label { font-size: 11px; color: rgba(255,255,255,.6); }
        .total-amount {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 700; color: var(--gold);
        }

        /* ── Upload Form ── */
        .upload-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-lg); padding: 28px;
            margin-bottom: 16px;
        }
        .upload-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px; font-weight: 600; margin-bottom: 6px;
        }
        .upload-sub { font-size: 13px; color: var(--text-mid); margin-bottom: 20px; }

        .file-drop {
            border: 2px dashed var(--border); border-radius: var(--radius-md);
            padding: 36px 24px; text-align: center; cursor: pointer;
            transition: all var(--transition); position: relative;
        }
        .file-drop:hover, .file-drop.drag-over {
            border-color: var(--gold); background: rgba(204,176,73,.04);
        }
        .file-drop input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .file-drop-icon { font-size: 36px; margin-bottom: 12px; }
        .file-drop-text { font-size: 13px; color: var(--text-mid); }
        .file-drop-text strong { color: var(--gold-dark); }
        .file-drop-hint { font-size: 11px; color: var(--text-lo); margin-top: 6px; }
        .file-preview {
            display: none; align-items: center; gap: 12px;
            background: var(--surface-2); border-radius: var(--radius-sm);
            padding: 12px 14px; margin-top: 12px; font-size: 13px;
        }
        .file-preview.visible { display: flex; }
        .file-preview-name { font-weight: 600; flex: 1; }
        .file-preview-size { color: var(--text-lo); }

        .error-msg {
            display: flex; align-items: center; gap: 5px;
            margin-top: 8px; font-size: 11px; color: var(--danger);
        }

        .btn-upload {
            width: 100%; padding: 14px;
            background: var(--gold); color: var(--ink);
            border: none; border-radius: 50px;
            font-size: 13px; font-weight: 700; letter-spacing: 1px;
            text-transform: uppercase; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all var(--transition); margin-top: 16px;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-upload:hover { background: var(--gold-dark); color: #fff; transform: translateY(-1px); }

        /* ── Uploaded Proof Preview ── */
        .proof-preview {
            background: var(--surface-2); border: 1px solid var(--border);
            border-radius: var(--radius-md); padding: 16px 20px;
        }
        .proof-preview img {
            max-width: 100%; border-radius: var(--radius-sm); margin-top: 10px;
            border: 1px solid var(--border);
        }
        .proof-pdf {
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; color: var(--info); margin-top: 10px;
        }

        /* ── Confirmed ── */
        .confirmed-icon {
            width: 60px; height: 60px; border-radius: 50%;
            background: linear-gradient(135deg, #2D7A4F, #22c55e);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; margin-bottom: 16px;
            box-shadow: 0 6px 20px rgba(45,122,79,.3);
        }

        .btn-back {
            display: block; text-align: center;
            padding: 12px; border: 1px solid var(--border);
            border-radius: 50px; font-size: 13px; font-weight: 500;
            color: var(--text-mid); text-decoration: none;
            transition: all var(--transition); margin-top: 8px;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        @media (max-width: 480px) {
            .info-grid { grid-template-columns: 1fr; }
            .card-body { padding: 18px; }
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

    <div class="container">

        {{-- ═══════════════════════════════════════════════════════════ --}}
        {{-- STATUS BANNER                                               --}}
        {{-- ═══════════════════════════════════════════════════════════ --}}

        @php
            $statusMap = [
                'menunggu_konfirmasi' => ['class' => 'warning', 'icon' => '···', 'title' => 'Menunggu Konfirmasi Admin',
                    'desc' => 'Booking Anda telah diterima. Admin sedang meninjau ketersediaan jadwal dan akan segera memberikan konfirmasi.'],
                'ditolak'             => ['class' => 'danger',  'icon' => '✕',   'title' => 'Jadwal Ditolak',
                    'desc' => 'Mohon maaf, admin tidak dapat mengkonfirmasi jadwal yang Anda pilih. Silakan buat booking baru dengan tanggal/waktu yang berbeda.'],
                'menunggu_pembayaran' => ['class' => 'info',    'icon' => '→',   'title' => 'Jadwal Disetujui — Lakukan Pembayaran',
                    'desc' => 'Jadwal Anda telah dikonfirmasi oleh admin. Silakan lakukan transfer sesuai informasi rekening di bawah, kemudian upload bukti transfer.'],
                'menunggu_verifikasi' => ['class' => 'purple',  'icon' => '···', 'title' => 'Menunggu Verifikasi Pembayaran',
                    'desc' => 'Bukti transfer Anda telah diterima. Admin sedang memverifikasi pembayaran Anda. Mohon tunggu konfirmasi selanjutnya.'],
                'pembayaran_ditolak'  => ['class' => 'danger',  'icon' => '✕',   'title' => 'Pembayaran Ditolak — Upload Ulang',
                    'desc' => 'Bukti transfer Anda tidak dapat diverifikasi. Mohon upload ulang bukti transfer yang valid di bawah ini.'],
                'terkonfirmasi'       => ['class' => 'success', 'icon' => '✓',   'title' => 'Booking Terkonfirmasi',
                    'desc' => 'Pembayaran Anda telah terverifikasi. Booking sesi foto Anda sudah dikonfirmasi. Kami menantikan kedatangan Anda!'],
            ];
            $info = $statusMap[$booking->status] ?? ['class' => 'warning', 'icon' => '?', 'title' => $booking->statusLabel(), 'desc' => ''];
        @endphp

        <div class="status-banner {{ $info['class'] }} banner-{{ $info['class'] }}">
            <div class="banner-icon">{{ $info['icon'] }}</div>
            <div>
                <div class="banner-title">{{ $info['title'] }}</div>
                <div class="banner-desc">{{ $info['desc'] }}</div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════ --}}
        {{-- BOOKING DETAIL CARD                                         --}}
        {{-- ═══════════════════════════════════════════════════════════ --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Detail Booking</span>
                <span class="badge badge-{{ $info['class'] }}">{{ $booking->statusLabel() }}</span>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <label>No. Referensi</label>
                        <span style="font-family:monospace;color:var(--gold-dark)">{{ $booking->booking_reference }}</span>
                    </div>
                    <div class="info-item">
                        <label>Paket</label>
                        <span>{{ $booking->package->name ?? $booking->service }}</span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Sesi</label>
                        <span>{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Jam Mulai</label>
                        <span>{{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }} WIB</span>
                    </div>
                    <div class="info-item">
                        <label>Total Harga</label>
                        <span style="color:var(--gold-dark);font-weight:700;font-size:16px;font-family:'Cormorant Garamond',serif">
                            Rp {{ number_format($booking->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Booking</label>
                        <span>{{ $booking->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    @if($booking->special_request)
                        <div class="info-item info-full">
                            <label>Permintaan Khusus</label>
                            <span>{{ $booking->special_request }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════ --}}
        {{-- CONDITIONAL CONTENT PER STATUS                              --}}
        {{-- ═══════════════════════════════════════════════════════════ --}}

        @if(in_array($booking->status, ['menunggu_pembayaran', 'pembayaran_ditolak']))

            {{-- ── Info Rekening Pembayaran ── --}}
            @if($paymentSetting)
            <div class="payment-box">
                <div class="payment-box-label"> Informasi Pembayaran</div>
                <div class="bank-name"> {{ $paymentSetting->nama_bank }}</div>
                <div class="account-number">{{ $paymentSetting->nomor_rekening }}</div>
                <div class="account-name">A/N {{ $paymentSetting->nama_pemilik }}</div>
                <div class="payment-total">
                    <span class="total-label">Total yang harus dibayar</span>
                    <span class="total-amount">Rp {{ number_format($booking->price, 0, ',', '.') }}</span>
                </div>
            </div>
            @endif

            {{-- ── Upload Bukti Transfer ── --}}
            <div class="upload-card">
                <h2 class="upload-title">
                    @if($booking->status === 'pembayaran_ditolak')
                        Upload Ulang Bukti Transfer
                    @else
                        Upload Bukti Transfer
                    @endif
                </h2>
                <p class="upload-sub">
                    @if($booking->status === 'pembayaran_ditolak')
                        Bukti transfer sebelumnya ditolak. Pastikan file yang Anda upload adalah bukti transfer yang valid dan jelas terbaca.
                    @else
                        Setelah melakukan transfer, upload bukti pembayaran Anda di bawah ini.
                    @endif
                </p>

                @if(session('success'))
                    <div style="background:#E8F5EE;border:1px solid #86EFAC;border-radius:8px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#2D7A4F">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('bookings.uploadProof', $booking) }}" method="POST"
                      enctype="multipart/form-data" id="upload-form">
                    @csrf

                    <div class="file-drop" id="file-drop">
                        <input type="file" name="payment_proof" id="payment_proof"
                               accept=".jpg,.jpeg,.png,.pdf" onchange="handleFileChange(this)">
                        <div class="file-drop-icon">📎</div>
                        <div class="file-drop-text">
                            <strong>Klik untuk memilih file</strong> atau seret ke sini
                        </div>
                        <div class="file-drop-hint">JPG, PNG, atau PDF — Maks. 5 MB</div>
                    </div>

                    <div class="file-preview" id="file-preview">
                        <span>📄</span>
                        <span class="file-preview-name" id="file-name"></span>
                        <span class="file-preview-size" id="file-size"></span>
                    </div>

                    @error('payment_proof')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn-upload" id="btn-upload">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload Bukti Transfer
                    </button>
                </form>
            </div>

        @elseif($booking->status === 'menunggu_verifikasi')

            {{-- ── Preview Bukti yang Sudah Diupload ── --}}
            @if($booking->payment_proof)
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Bukti Transfer</span>
                    <span class="badge badge-purple">Menunggu Verifikasi</span>
                </div>
                <div class="card-body">
                    @php $ext = strtolower(pathinfo($booking->payment_proof, PATHINFO_EXTENSION)); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                             alt="Bukti Transfer" style="max-width:100%;border-radius:8px;border:1px solid var(--border)">
                    @else
                        <div class="proof-pdf">
                            <span style="font-size:28px">📄</span>
                            <div>
                                <div style="font-weight:600">File PDF</div>
                                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank"
                                   style="color:var(--info);font-size:12px">Buka / Unduh File</a>
                            </div>
                        </div>
                    @endif
                    <p style="font-size:12px;color:var(--text-lo);margin-top:12px">
                        Admin sedang memverifikasi pembayaran Anda. Biasanya membutuhkan 1×24 jam.
                    </p>
                </div>
            </div>
            @endif

        @elseif($booking->status === 'terkonfirmasi')

            {{-- ── Booking Confirmed ── --}}
            <div class="card">
                <div class="card-body" style="text-align:center;padding:36px">
                    <div class="confirmed-icon" style="margin:0 auto">✓</div>
                    <h2 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;margin-bottom:8px">
                        Booking Anda Terkonfirmasi!
                    </h2>
                    <p style="font-size:13px;color:var(--text-mid);line-height:1.7">
                        Pembayaran telah terverifikasi. Sesi foto Anda sudah terjadwal.<br>
                        Harap datang 10–15 menit sebelum waktu sesi dimulai.
                    </p>
                    <div style="background:var(--surface-2);border-radius:10px;padding:16px;margin-top:20px;display:inline-block">
                        <div style="font-size:11px;color:var(--text-lo);margin-bottom:4px">Waktu Sesi</div>
                        <div style="font-size:16px;font-weight:700">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                            pukul {{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }} WIB
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <a href="{{ route('home') }}" class="btn-back">← Kembali ke Beranda</a>
    </div>

<script>
    function handleFileChange(input) {
        const file    = input.files[0];
        const preview = document.getElementById('file-preview');
        const name    = document.getElementById('file-name');
        const size    = document.getElementById('file-size');

        if (file) {
            name.textContent = file.name;
            size.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            preview.classList.add('visible');
        } else {
            preview.classList.remove('visible');
        }
    }

    // Drag & drop styling
    const drop = document.getElementById('file-drop');
    if (drop) {
        drop.addEventListener('dragover',  e => { e.preventDefault(); drop.classList.add('drag-over'); });
        drop.addEventListener('dragleave', () => drop.classList.remove('drag-over'));
        drop.addEventListener('drop',      e => { e.preventDefault(); drop.classList.remove('drag-over'); });
    }
</script>
</body>
</html>
