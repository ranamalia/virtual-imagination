<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <style>
        /* ── Welcome Banner ──────────────────────────────── */
        .welcome-banner {
            background: linear-gradient(135deg, rgba(204,176,73,.12), rgba(226,201,106,.06));
            border: 1px solid rgba(204,176,73,.3);
            border-radius: var(--radius-md);
            padding: 24px 28px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .welcome-banner h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .welcome-banner p { color: var(--text-mid); font-size: 14px; }
        .welcome-banner .icon { font-size: 40px; }

        /* ── Stats Grid ──────────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: transform var(--transition), border-color var(--transition), box-shadow var(--transition);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--gold);
            box-shadow: 0 4px 20px rgba(204,176,73,.12);
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-icon.gold   { background: rgba(204,176,73,.12); color: var(--gold-dark); }
        .stat-icon.green  { background: rgba(45,122,79,.1);   color: var(--success);   }
        .stat-icon.orange { background: rgba(180,83,9,.1);    color: var(--warning);   }
        .stat-value {
            font-size: 28px; font-weight: 700; line-height: 1;
            margin-bottom: 4px; color: var(--ink);
        }
        .stat-label { font-size: 13px; color: var(--text-mid); font-weight: 500; }

        /* ── Table Section ───────────────────────────────── */
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 16px;
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px; font-weight: 600; color: var(--ink);
        }
        .section-link {
            font-size: 13px; color: var(--gold-dark);
            text-decoration: none; font-weight: 500;
            transition: color var(--transition);
        }
        .section-link:hover { color: var(--gold); }

        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--surface-2); }
        th {
            padding: 13px 20px; text-align: left;
            font-size: 11px; font-weight: 600; color: var(--text-lo);
            text-transform: uppercase; letter-spacing: .9px;
            border-bottom: 1px solid var(--border);
        }
        td {
            padding: 14px 20px; font-size: 14px;
            border-bottom: 1px solid var(--surface-3);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--surface-2); }

        /* ── Status Badges ───────────────────────────────── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }
        .badge-pending   { background: var(--warning-bg); color: var(--warning); }
        .badge-confirmed { background: var(--success-bg); color: var(--success); }
        .badge-rejected  { background: var(--danger-bg);  color: var(--danger);  }

        /* ── Pending Alert ───────────────────────────────── */
        .pending-alert {
            background: #FEF3C7;
            border: 1px solid #F5D76E;
            border-radius: var(--radius-md);
            padding: 20px 24px;
            margin-bottom: 28px;
        }
        .pending-alert-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 14px;
        }
        .pending-alert-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px; font-weight: 600; color: #92400E;
            display: flex; align-items: center; gap: 8px;
        }
        .pending-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 14px; background: rgba(255,255,255,.7);
            border-radius: 8px; margin-bottom: 8px;
            text-decoration: none; color: inherit;
            transition: background var(--transition);
        }
        .pending-item:hover { background: #fff; }
        .pending-item:last-child { margin-bottom: 0; }
        .pending-name { font-weight: 600; font-size: 14px; color: #92400E; }
        .pending-sub  { font-size: 12px; color: #B45309; margin-top: 2px; }
        .btn-action-sm {
            padding: 5px 14px; background: var(--ink); color: #fff;
            border-radius: 6px; font-size: 12px; font-weight: 600;
            text-decoration: none; white-space: nowrap; flex-shrink: 0;
            transition: background var(--transition);
        }
        .btn-action-sm:hover { background: var(--gold-dark); }

        .empty-state { text-align: center; padding: 48px 24px; color: var(--text-lo); }
    </style>

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div>
            <h3>Selamat datang, {{ Auth::user()->name }}</h3>
            <p>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }} — Berikut ringkasan aktivitas.</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>
            <div>
                <div class="stat-value">{{ $totalBookings }}</div>
                <div class="stat-label">Total Booking</div>
            </div>
        </div>

        <a href="{{ route('admin.bookings.index', ['status'=>'pending']) }}" class="stat-card" style="text-decoration:none">
            <div class="stat-icon orange">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <div class="stat-value" style="color:var(--warning)">{{ $pendingBookings }}</div>
                <div class="stat-label">Perlu Konfirmasi</div>
            </div>
        </a>

        <a href="{{ route('admin.bookings.index', ['status'=>'confirmed']) }}" class="stat-card" style="text-decoration:none">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <div class="stat-value" style="color:var(--success)">{{ $confirmedBookings }}</div>
                <div class="stat-label">Dikonfirmasi</div>
            </div>
        </a>

        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(192,57,43,.1);color:var(--danger)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
            <div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">User Terdaftar</div>
            </div>
        </div>
    </div>

    {{-- ── Pending yang perlu tindakan ── --}}
    @if($pendingList->isNotEmpty())
    <div class="pending-alert">
        <div class="pending-alert-header">
            <div class="pending-alert-title">
                ⚡ {{ $pendingBookings }} Booking Menunggu Konfirmasi
            </div>
            <a href="{{ route('admin.bookings.index', ['status'=>'pending']) }}" class="section-link">Lihat semua →</a>
        </div>
        @foreach($pendingList as $pb)
            <a href="{{ route('admin.bookings.show', $pb) }}" class="pending-item">
                <div>
                    <div class="pending-name">{{ $pb->full_name }}</div>
                    <div class="pending-sub">
                        {{ $pb->package->name ?? $pb->service }}
                        · {{ \Carbon\Carbon::parse($pb->booking_date)->format('d M Y') }}
                        · {{ \Carbon\Carbon::createFromTimeString($pb->booking_time)->format('H:i') }}
                    </div>
                </div>
                <span class="btn-action-sm">Tinjau →</span>
            </a>
        @endforeach
    </div>
    @endif

    <!-- Recent Bookings -->
    <div class="section-header">
        <div class="section-title">Booking Terbaru</div>
        <a href="{{ route('admin.bookings.index') }}" class="section-link">Lihat semua →</a>
    </div>

    <div class="table-card">
        @if($recentBookings->isEmpty())
            <div class="empty-state">
                <p>Belum ada data booking.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama / Email</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $i => $booking)
                        <tr style="cursor:pointer" onclick="window.location='{{ route('admin.bookings.show', $booking) }}'">
                            <td style="color:var(--text-lo)">{{ $i + 1 }}</td>
                            <td>
                                <div style="font-weight:600">{{ $booking->full_name }}</div>
                                <div style="font-size:12px;color:var(--text-mid)">{{ $booking->email }}</div>
                            </td>
                            <td>{{ $booking->package->name ?? $booking->service }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>
                                <span class="badge badge-{{ strtolower($booking->status) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td style="font-weight:600;color:var(--gold-dark)">
                                Rp {{ number_format($booking->price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
