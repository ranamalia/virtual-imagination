<x-admin-layout>
    <x-slot name="title">Detail Booking</x-slot>

    <style>
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--text-mid); text-decoration: none; font-size: 13px;
            margin-bottom: 20px; transition: color var(--transition);
        }
        .back-link:hover { color: var(--gold-dark); }

        .detail-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-md); overflow: hidden; margin-bottom: 20px;
        }
        .card-header {
            padding: 18px 24px; border-bottom: 1px solid var(--border);
            background: var(--surface-2);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h3 { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 600; color: var(--ink); }
        .card-body { padding: 24px; }

        .info-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 18px; }
        .info-item label { display: block; font-size: 11px; color: var(--text-lo); font-weight: 600; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 4px; }
        .info-item span { font-size: 14px; color: var(--ink); font-weight: 500; }

        /* ── Badges ── */
        .badge { display: inline-block; padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-warning  { background: var(--warning-bg);  color: var(--warning); }
        .badge-danger   { background: var(--danger-bg);   color: var(--danger); }
        .badge-info     { background: var(--info-bg);     color: var(--info); }
        .badge-purple   { background: #EDE9FE; color: #6D28D9; }
        .badge-success  { background: var(--success-bg);  color: var(--success); }

        /* ── Action Zone ── */
        .action-zone {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-md); padding: 24px; margin-bottom: 20px;
        }
        .action-zone h3 { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 600; margin-bottom: 6px; }
        .action-zone p  { font-size: 13px; color: var(--text-mid); margin-bottom: 18px; }

        .action-buttons { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn-action {
            padding: 10px 22px; border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 600; cursor: pointer;
            font-family: 'DM Sans', sans-serif; border: none;
            transition: all var(--transition);
        }
        .btn-approve { background: var(--success-bg); color: var(--success); border: 1px solid rgba(45,122,79,.25); }
        .btn-approve:hover { background: var(--success); color: #fff; }
        .btn-reject  { background: var(--danger-bg);  color: var(--danger);  border: 1px solid rgba(192,57,43,.25); }
        .btn-reject:hover  { background: var(--danger);  color: #fff; }
        .btn-verify  { background: var(--success-bg); color: var(--success); border: 1px solid rgba(45,122,79,.25); }
        .btn-verify:hover  { background: var(--success); color: #fff; }
        .btn-reject-pay { background: var(--danger-bg); color: var(--danger); border: 1px solid rgba(192,57,43,.25); }
        .btn-reject-pay:hover { background: var(--danger); color: #fff; }

        /* ── Payment proof ── */
        .proof-section { margin-top: 16px; }
        .proof-img { max-width: 480px; width: 100%; border-radius: var(--radius-sm); border: 1px solid var(--border); margin-top: 10px; }
        .proof-pdf-link { display: inline-flex; align-items: center; gap: 8px; margin-top: 10px; padding: 10px 16px; background: var(--info-bg); color: var(--info); border-radius: var(--radius-sm); font-size: 13px; font-weight: 600; text-decoration: none; }
        .proof-pdf-link:hover { background: #d0e4f7; }

        /* ── Danger Zone ── */
        .danger-zone { background: var(--danger-bg); border: 1px solid rgba(192,57,43,.2); border-radius: var(--radius-md); padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; }
        .danger-zone p { font-size: 14px; color: var(--danger); }
        .btn-delete { padding: 9px 20px; background: var(--danger); color: #fff; border: none; border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600; cursor: pointer; transition: background var(--transition); }
        .btn-delete:hover { background: #a93226; }

        /* ── Flash ── */
        .flash-success { background: var(--success-bg); border-left: 3px solid var(--success); border-radius: 0 8px 8px 0; padding: 12px 16px; margin-bottom: 16px; font-size: 13px; color: var(--success); }
        .flash-error   { background: var(--danger-bg);  border-left: 3px solid var(--danger);  border-radius: 0 8px 8px 0; padding: 12px 16px; margin-bottom: 16px; font-size: 13px; color: var(--danger); }
    </style>

    @php
        $colorMap = [
            'menunggu_konfirmasi' => 'warning',
            'ditolak'             => 'danger',
            'menunggu_pembayaran' => 'info',
            'menunggu_verifikasi' => 'purple',
            'pembayaran_ditolak'  => 'danger',
            'terkonfirmasi'       => 'success',
        ];
        $color = $colorMap[$booking->status] ?? 'warning';
    @endphp

    <a href="{{ route('admin.bookings.index') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
        Kembali ke Semua Booking
    </a>


    @if($errors->any())
        <div class="flash-error">{{ $errors->first() }}</div>
    @endif

    {{-- ── Info Booking ── --}}
    <div class="detail-card">
        <div class="card-header">
            <h3>Informasi Booking</h3>
            <span class="badge badge-{{ $color }}">{{ $booking->statusLabel() }}</span>
        </div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Referensi</label>
                    <span style="font-family:monospace;color:var(--gold-dark)">{{ $booking->booking_reference }}</span>
                </div>
                <div class="info-item">
                    <label>Paket</label>
                    <span>{{ $booking->package->name ?? $booking->service }}</span>
                </div>
                <div class="info-item">
                    <label>Tanggal Sesi</label>
                    <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                    <label>Jam Mulai</label>
                    <span>{{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }} WIB</span>
                </div>
                <div class="info-item">
                    <label>Harga</label>
                    <span style="color:var(--gold-dark);font-weight:700">
                        Rp {{ number_format($booking->price, 0, ',', '.') }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Dibuat</label>
                    <span>{{ $booking->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Info Pelanggan ── --}}
    <div class="detail-card">
        <div class="card-header"><h3>Informasi Pelanggan</h3></div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Lengkap</label>
                    <span>{{ $booking->full_name }}</span>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <span>{{ $booking->email }}</span>
                </div>
                <div class="info-item">
                    <label>WhatsApp</label>
                    <span>
                        <a href="https://wa.me/{{ $booking->whatsapp }}" target="_blank"
                           style="color:var(--info);text-decoration:none">
                            {{ $booking->whatsapp }}
                        </a>
                    </span>
                </div>
                @if($booking->special_request)
                    <div class="info-item" style="grid-column: 1 / -1">
                        <label>Permintaan Khusus</label>
                        <span>{{ $booking->special_request }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════ --}}
    {{-- AKSI KONTEKSTUAL BERDASARKAN STATUS                         --}}
    {{-- ════════════════════════════════════════════════════════════ --}}

    @if($booking->status === 'menunggu_konfirmasi')

        {{-- Setujui / Tolak Jadwal --}}
        <div class="action-zone">
            <h3>🗓 Konfirmasi Jadwal</h3>
            <p>Tinjau jadwal yang diminta pelanggan, lalu setujui atau tolak.</p>
            <div class="action-buttons">
                <form method="POST" action="{{ route('admin.bookings.approve', $booking) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-action btn-approve"
                            onclick="return confirm('Setujui jadwal booking ini?')">
                        ✓ Setujui Jadwal
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-action btn-reject"
                            onclick="return confirm('Tolak jadwal booking ini?')">
                        ✕ Tolak Jadwal
                    </button>
                </form>
            </div>
        </div>

    @elseif($booking->status === 'menunggu_verifikasi')

        {{-- Lihat Bukti Transfer + Verifikasi / Tolak --}}
        @if($booking->payment_proof)
            <div class="detail-card">
                <div class="card-header"><h3>Bukti Transfer</h3></div>
                <div class="card-body">
                    @php $ext = strtolower(pathinfo($booking->payment_proof, PATHINFO_EXTENSION)); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                             alt="Bukti Transfer" class="proof-img">
                    @else
                        <a href="{{ asset('storage/' . $booking->payment_proof) }}"
                           target="_blank" class="proof-pdf-link">
                            📄 Buka File PDF
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <div class="action-zone">
            <h3>💳 Verifikasi Pembayaran</h3>
            <p>Periksa bukti transfer di atas. Jika valid, verifikasi pembayaran. Jika tidak valid, tolak dan minta pelanggan upload ulang.</p>
            <div class="action-buttons">
                <form method="POST" action="{{ route('admin.bookings.verifyPayment', $booking) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-action btn-verify"
                            onclick="return confirm('Verifikasi pembayaran ini? Booking akan terkonfirmasi.')">
                        ✓ Verifikasi Pembayaran
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.bookings.rejectPayment', $booking) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-action btn-reject-pay"
                            onclick="return confirm('Tolak pembayaran ini? User akan diminta upload ulang bukti transfer.')">
                        ✕ Tolak Pembayaran
                    </button>
                </form>
            </div>
        </div>

    @elseif($booking->status === 'pembayaran_ditolak')

        <div class="action-zone" style="background:#FFF5F5;border-color:rgba(192,57,43,.2)">
            <h3 style="color:var(--danger)">⚠ Pembayaran Ditolak</h3>
            <p>Pembayaran telah ditolak. Pelanggan akan diminta untuk mengunggah ulang bukti transfer yang valid.</p>
        </div>

    @elseif($booking->status === 'terkonfirmasi')

        <div class="action-zone" style="background:#F0FDF4;border-color:rgba(45,122,79,.2)">
            <h3 style="color:var(--success)">✓ Booking Terkonfirmasi</h3>
            <p style="color:var(--success)">Pembayaran telah terverifikasi dan booking sudah dikonfirmasi. Sesi foto terjadwal.</p>
        </div>

    @elseif($booking->status === 'ditolak')

        <div class="action-zone" style="background:var(--danger-bg);border-color:rgba(192,57,43,.2)">
            <h3 style="color:var(--danger)">✕ Jadwal Ditolak</h3>
            <p>Jadwal booking ini telah ditolak.</p>
        </div>

    @elseif($booking->status === 'menunggu_pembayaran')

        <div class="action-zone" style="background:var(--info-bg);border-color:rgba(30,95,168,.2)">
            <h3 style="color:var(--info)">💳 Menunggu Pembayaran</h3>
            <p>Jadwal telah disetujui. Menunggu pelanggan melakukan pembayaran dan mengupload bukti transfer.</p>
        </div>

    @endif

    {{-- ── Danger Zone ── --}}
    <div class="danger-zone">
        <p>Hapus booking ini secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
        <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}"
              onsubmit="return confirm('Yakin ingin menghapus booking {{ $booking->booking_reference }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Hapus Booking</button>
        </form>
    </div>

</x-admin-layout>
