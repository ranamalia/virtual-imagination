<x-admin-layout>
    <x-slot name="title">Detail Booking</x-slot>

    <style>
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--text-mid); text-decoration: none; font-size: 13px;
            margin-bottom: 20px; transition: color var(--transition);
        }
        .back-link:hover { color: var(--gold-dark); }
        .back-link svg { width: 16px; height: 16px; }

        .detail-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600; color: var(--ink);
        }
        .card-body { padding: 24px; }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 18px;
        }
        .info-item label {
            display: block; font-size: 11px; color: var(--text-lo);
            font-weight: 600; text-transform: uppercase; letter-spacing: .8px;
            margin-bottom: 4px;
        }
        .info-item span { font-size: 14px; color: var(--ink); font-weight: 500; }

        .badge {
            display: inline-block; padding: 4px 12px;
            border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize;
        }
        .badge-pending   { background: var(--warning-bg); color: var(--warning); }
        .badge-confirmed { background: var(--success-bg); color: var(--success); }
        .badge-rejected  { background: var(--danger-bg);  color: var(--danger);  }
        .badge-scheduled { background: var(--info-bg);    color: var(--info);    }

        /* ── Status Update Form ──────────────────────────── */
        .status-form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
            margin-bottom: 20px;
        }
        .status-form-card h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px; font-weight: 600; margin-bottom: 14px;
        }
        .status-buttons { display: flex; gap: 8px; flex-wrap: wrap; }
        .btn-status {
            padding: 8px 18px; border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 600; cursor: pointer;
            font-family: 'DM Sans', sans-serif; border: 1px solid;
            transition: all var(--transition);
        }
        .btn-pending   { background: var(--warning-bg); color: var(--warning); border-color: rgba(180,83,9,.25); }
        .btn-confirmed { background: var(--success-bg); color: var(--success); border-color: rgba(45,122,79,.25); }
        .btn-scheduled { background: var(--info-bg);    color: var(--info);    border-color: rgba(30,95,168,.25); }
        .btn-rejected  { background: var(--danger-bg);  color: var(--danger);  border-color: rgba(192,57,43,.25); }
        .btn-status:hover { filter: brightness(.92); }

        /* ── Delete ──────────────────────────────────────── */
        .danger-zone {
            background: var(--danger-bg);
            border: 1px solid rgba(192,57,43,.2);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .danger-zone p { font-size: 14px; color: var(--danger); }
        .btn-delete-confirm {
            padding: 9px 20px; background: var(--danger); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: background var(--transition);
        }
        .btn-delete-confirm:hover { background: #a93226; }

        .payment-proof-img {
            max-width: 320px; border-radius: var(--radius-sm);
            border: 1px solid var(--border); margin-top: 8px;
        }
    </style>

    <a href="{{ route('admin.bookings.index') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Kembali ke Semua Booking
    </a>

    <!-- Info Booking -->
    <div class="detail-card">
        <div class="card-header">
            <h3>Informasi Booking</h3>
            <span class="badge badge-{{ strtolower($booking->status) }}">{{ $booking->status }}</span>
        </div>
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <label>Referensi</label>
                    <span style="font-family:monospace">{{ $booking->booking_reference }}</span>
                </div>
                <div class="info-item">
                    <label>Paket</label>
                    <span>{{ $booking->package->name ?? $booking->service }}</span>
                </div>
                <div class="info-item">
                    <label>Tanggal</label>
                    <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                    <label>Waktu</label>
                    <span>{{ $booking->booking_time }}</span>
                </div>
                <div class="info-item">
                    <label>Harga</label>
                    <span style="color:var(--gold-dark);font-weight:700">
                        Rp {{ number_format($booking->price, 0, ',', '.') }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Metode Pembayaran</label>
                    <span>{{ strtoupper($booking->payment_method) }}</span>
                </div>
                <div class="info-item">
                    <label>Dibuat</label>
                    <span>{{ $booking->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info User -->
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
                    <label>No. Telepon</label>
                    <span>{{ $booking->phone }}</span>
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

    <!-- Bukti Pembayaran -->
    @if($booking->payment_proof)
        <div class="detail-card">
            <div class="card-header"><h3>Bukti Pembayaran</h3></div>
            <div class="card-body">
                <img src="{{ asset('storage/' . $booking->payment_proof) }}"
                     alt="Bukti Pembayaran"
                     class="payment-proof-img">
            </div>
        </div>
    @endif

    <!-- Update Status -->
    <div class="status-form-card">
        <h3>Ubah Status Booking</h3>
        <div class="status-buttons">
            @foreach(['pending','confirmed','scheduled','rejected'] as $s)
                <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking) }}" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="{{ $s }}">
                    <button type="submit"
                            class="btn-status btn-{{ $s }}"
                            {{ strtolower($booking->status) === $s ? 'disabled style=opacity:.5;cursor:not-allowed' : '' }}>
                        {{ ucfirst($s) }}
                    </button>
                </form>
            @endforeach
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="danger-zone">
        <p>Hapus booking ini secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
        <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}"
              onsubmit="return confirm('Yakin ingin menghapus booking {{ $booking->booking_reference }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete-confirm">Hapus Booking</button>
        </form>
    </div>
</x-admin-layout>
