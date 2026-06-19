<x-admin-layout>
    <x-slot name="title">Pengaturan Pembayaran</x-slot>

    <style>
        .page-header { margin-bottom: 28px; }
        .page-title  { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 600; color: var(--ink); }
        .page-sub    { font-size: 13px; color: var(--text-mid); margin-top: 2px; }

        .settings-grid {
            display: grid; grid-template-columns: 1fr 380px; gap: 24px;
            align-items: flex-start;
        }

        /* ── Form Card ── */
        .form-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-md); overflow: hidden;
        }
        .card-header {
            padding: 18px 24px; border-bottom: 1px solid var(--border);
            background: var(--surface-2);
        }
        .card-header h3 { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 600; }
        .card-body { padding: 24px; }

        .form-group { margin-bottom: 18px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-label {
            display: block; font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--text-mid); margin-bottom: 7px;
        }
        .form-input {
            width: 100%; padding: 11px 13px;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--ink); font-size: 14px;
            font-family: 'DM Sans', sans-serif; outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(204,176,73,.12);
        }
        .form-hint { font-size: 11px; color: var(--text-lo); margin-top: 5px; }
        .error-msg { font-size: 11px; color: var(--danger); margin-top: 5px; }

        .btn-save {
            width: 100%; padding: 13px;
            background: var(--gold); color: var(--ink);
            border: none; border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
            cursor: pointer; transition: all var(--transition);
            margin-top: 22px;
        }
        .btn-save:hover { background: var(--gold-dark); color: #fff; }

        /* ── Preview Card ── */
        .preview-card {
            background: linear-gradient(135deg, #1A1A1A, #2D2D2D);
            border-radius: var(--radius-md); padding: 28px;
            color: #fff; position: sticky; top: 24px;
        }
        .preview-label {
            font-size: 10px; font-weight: 600; letter-spacing: 3px;
            text-transform: uppercase; color: var(--gold); margin-bottom: 18px;
        }
        .preview-bank {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px; font-weight: 600; color: #fff; margin-bottom: 4px;
        }
        .preview-number {
            font-family: monospace; font-size: 22px; font-weight: 700;
            color: var(--gold); letter-spacing: 2px; margin-bottom: 4px;
        }
        .preview-holder { font-size: 13px; color: rgba(255,255,255,.7); margin-bottom: 20px; }
        .preview-wa {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.08); border-radius: 8px;
            padding: 10px 14px; font-size: 13px; color: rgba(255,255,255,.9);
        }
        .preview-wa span { color: #25D366; font-weight: 700; }

        /* ── Info Notice ── */
        .info-notice {
            background: #EFF6FF; border: 1px solid #BFDBFE;
            border-radius: var(--radius-md); padding: 14px 16px;
            margin-top: 20px; font-size: 12px; color: #1E40AF; line-height: 1.6;
        }
        .info-notice strong { display: block; margin-bottom: 4px; }

        /* ── Flash ── */
        .flash-success { background: var(--success-bg); border-left: 3px solid var(--success); border-radius: 0 8px 8px 0; padding: 12px 16px; margin-bottom: 16px; font-size: 13px; color: var(--success); }

        @media (max-width: 760px) {
            .settings-grid { grid-template-columns: 1fr; }
            .preview-card { position: static; }
        }
    </style>

    <div class="page-header">
        <div class="page-title">Pengaturan Pembayaran</div>
        <div class="page-sub">Kelola informasi rekening bank dan nomor WhatsApp admin</div>
    </div>


    <div class="settings-grid">

        {{-- ── Form ── --}}
        <div class="form-card">
            <div class="card-header">
                <h3>Informasi Rekening Bank</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.payment-settings.update') }}" id="settings-form">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="nama_bank">Nama Bank</label>
                        <input type="text" id="nama_bank" name="nama_bank" class="form-input"
                               value="{{ old('nama_bank', $setting->nama_bank) }}"
                               placeholder="cth. BCA, BRI, Mandiri, BNI…"
                               oninput="updatePreview()">
                        @error('nama_bank')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="nomor_rekening">Nomor Rekening</label>
                        <input type="text" id="nomor_rekening" name="nomor_rekening" class="form-input"
                               value="{{ old('nomor_rekening', $setting->nomor_rekening) }}"
                               placeholder="cth. 6600666022"
                               oninput="updatePreview()">
                        @error('nomor_rekening')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="nama_pemilik">Nama Pemilik Rekening</label>
                        <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-input"
                               value="{{ old('nama_pemilik', $setting->nama_pemilik) }}"
                               placeholder="cth. Virtual Imagination Studio"
                               oninput="updatePreview()">
                        @error('nama_pemilik')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="whatsapp_number">Nomor WhatsApp Admin</label>
                        <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-input"
                               value="{{ old('whatsapp_number', $setting->whatsapp_number) }}"
                               placeholder="cth. 6281234567890"
                               oninput="updatePreview()">
                        <div class="form-hint">Format internasional tanpa +, contoh: 6281234567890</div>
                        @error('whatsapp_number')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn-save"> Simpan Pengaturan</button>
                </form>

                <div class="info-notice">
                    <strong>Informasi</strong>
                    Data rekening ini akan ditampilkan kepada pelanggan saat melakukan pembayaran setelah admin menyetujui jadwal booking. Nomor WhatsApp digunakan untuk pesan otomatis dari form booking.
                </div>
            </div>
        </div>

        {{-- ── Preview ── --}}
        <div class="preview-card" id="preview-card">
            <div class="preview-label">Preview Tampilan Pembayaran</div>
            <div class="preview-bank" id="prev-bank">{{ $setting->nama_bank ?: 'Nama Bank' }}</div>
            <div class="preview-number" id="prev-number">{{ $setting->nomor_rekening ?: '0000000000' }}</div>
            <div class="preview-holder" id="prev-holder">A/N {{ $setting->nama_pemilik ?: 'Nama Pemilik' }}</div>
            <div class="preview-wa">
                WA Admin: <span id="prev-wa">{{ $setting->whatsapp_number ?: '62...' }}</span>
            </div>
        </div>

    </div>

<script>
    function updatePreview() {
        document.getElementById('prev-bank').textContent   = document.getElementById('nama_bank').value     || 'Nama Bank';
        document.getElementById('prev-number').textContent = document.getElementById('nomor_rekening').value || '0000000000';
        document.getElementById('prev-holder').textContent = 'A/N ' + (document.getElementById('nama_pemilik').value || 'Nama Pemilik');
        document.getElementById('prev-wa').textContent     = document.getElementById('whatsapp_number').value || '62...';
    }
</script>
</x-admin-layout>
