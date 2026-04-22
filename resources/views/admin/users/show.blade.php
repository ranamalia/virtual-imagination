<x-admin-layout>
    <x-slot name="title">Detail User</x-slot>

    <style>
        .back-link {
            display:inline-flex; align-items:center; gap:6px;
            font-size:13px; color:var(--text-mid); text-decoration:none;
            margin-bottom:20px; transition:color var(--transition);
        }
        .back-link:hover { color:var(--gold-dark); }

        /* ── User Info Card ─────────────────────────────── */
        .profile-card {
            background: var(--surface); border:1px solid var(--border);
            border-radius: var(--radius-md); padding:28px; margin-bottom:24px;
            display:flex; align-items:center; gap:20px;
        }
        .profile-avatar {
            width:72px; height:72px; border-radius:50%; flex-shrink:0;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display:flex; align-items:center; justify-content:center;
            font-size:28px; font-weight:700; color:#fff;
        }
        .profile-name { font-size:20px; font-weight:700; color:var(--ink); margin-bottom:4px; }
        .profile-email { font-size:14px; color:var(--text-mid); margin-bottom:10px; }
        .profile-meta { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }

        .badge {
            display:inline-block; padding:4px 12px; border-radius:20px;
            font-size:12px; font-weight:600;
        }
        .badge-admin { background:rgba(204,176,73,.15); color:var(--gold-dark); }
        .badge-user  { background: var(--info-bg); color: var(--info); }

        .profile-actions { margin-left:auto; display:flex; gap:10px; }
        .btn-edit-profile {
            padding:9px 18px; border:1px solid var(--border);
            border-radius:var(--radius-sm); color:var(--info); border-color:rgba(30,95,168,.4);
            font-size:13px; font-weight:600; text-decoration:none;
            transition: all var(--transition);
        }
        .btn-edit-profile:hover { background:var(--info-bg); }

        /* ── Section Header ─────────────────────────────── */
        .section-title {
            font-family:'Cormorant Garamond',serif;
            font-size:18px; font-weight:600; color:var(--ink);
            margin-bottom:16px;
        }

        /* ── Booking Table ──────────────────────────────── */
        .table-card {
            background: var(--surface); border:1px solid var(--border);
            border-radius: var(--radius-md); overflow:hidden;
        }
        table { width:100%; border-collapse:collapse; }
        thead { background: var(--surface-2); }
        th {
            padding:12px 20px; text-align:left;
            font-size:11px; font-weight:600; color:var(--text-lo);
            text-transform:uppercase; letter-spacing:.9px;
            border-bottom:1px solid var(--border);
        }
        td { padding:13px 20px; font-size:14px; border-bottom:1px solid var(--surface-3); }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background: var(--surface-2); }

        .badge-booking {
            display:inline-block; padding:3px 10px; border-radius:20px;
            font-size:11px; font-weight:600; text-transform:capitalize;
        }
        .badge-pending   { background: var(--warning-bg); color: var(--warning); }
        .badge-confirmed { background: var(--success-bg); color: var(--success); }
        .badge-rejected  { background: var(--danger-bg);  color: var(--danger);  }
        .badge-scheduled { background: var(--info-bg);    color: var(--info);    }

        .empty-state { text-align:center; padding:40px 24px; color:var(--text-lo); }

        /* ── Stats Row ──────────────────────────────────── */
        .stats-row { display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap; }
        .stat-pill {
            padding:10px 18px; background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-sm); font-size:13px;
        }
        .stat-pill strong { color:var(--ink); font-size:16px; display:block; }
        .stat-pill span { color:var(--text-mid); }
    </style>

    <a href="{{ route('admin.users.index') }}" class="back-link">
        ← Kembali ke Data User
    </a>

    <!-- Profile Card -->
    <div class="profile-card">
        <div class="profile-avatar">{{ strtoupper(substr($user->name,0,1)) }}</div>
        <div>
            <div class="profile-name">{{ $user->name }}</div>
            <div class="profile-email">{{ $user->email }}</div>
            <div class="profile-meta">
                <span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                <span style="font-size:12px;color:var(--text-lo)">Bergabung {{ $user->created_at->format('d M Y') }}</span>
            </div>
        </div>
        <div class="profile-actions">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit-profile">Edit User</a>
        </div>
    </div>

    <!-- Booking Stats -->
    <div class="stats-row">
        <div class="stat-pill">
            <strong>{{ $bookings->count() }}</strong>
            <span>Total Booking</span>
        </div>
        <div class="stat-pill">
            <strong>{{ $bookings->where('status','pending')->count() }}</strong>
            <span>Pending</span>
        </div>
        <div class="stat-pill">
            <strong>{{ $bookings->where('status','confirmed')->count() }}</strong>
            <span>Confirmed</span>
        </div>
        <div class="stat-pill">
            <strong>Rp {{ number_format($bookings->sum('price'),0,',','.') }}</strong>
            <span>Total Nilai</span>
        </div>
    </div>

    <!-- Booking History -->
    <div class="section-title">Riwayat Booking</div>

    <div class="table-card">
        @if($bookings->isEmpty())
            <div class="empty-state">
                <p>User ini belum pernah melakukan booking.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Referensi</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td style="font-family:monospace;font-size:12px;color:var(--text-lo)">
                                {{ $booking->booking_reference }}
                            </td>
                            <td>{{ $booking->package->name ?? $booking->service }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td style="font-weight:600;color:var(--gold-dark)">
                                Rp {{ number_format($booking->price,0,',','.') }}
                            </td>
                            <td>
                                <span class="badge-booking badge-{{ strtolower($booking->status) }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                   style="font-size:13px;color:var(--gold-dark);text-decoration:none">
                                    Detail →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
