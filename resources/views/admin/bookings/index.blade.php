<x-admin-layout>
    <x-slot name="title">Semua Booking</x-slot>

    <style>
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-weight: 600; color: var(--ink);
        }
        .page-sub { font-size: 13px; color: var(--text-mid); margin-top: 2px; }

        /* ── Filter Bar ──────────────────────────────────── */
        .filter-bar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px 20px;
            display: flex; gap: 12px; align-items: flex-end;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .filter-group { display: flex; flex-direction: column; gap: 4px; }
        .filter-label { font-size: 11px; color: var(--text-lo); font-weight: 600; text-transform: uppercase; letter-spacing: .8px; }
        .filter-input, .filter-select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            background: var(--surface);
            min-width: 160px;
            outline: none;
            transition: border-color var(--transition);
        }
        .filter-input:focus, .filter-select:focus { border-color: var(--gold); }
        .btn-filter {
            padding: 8px 18px;
            background: var(--gold);
            color: var(--ink);
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--transition);
        }
        .btn-filter:hover { background: var(--gold-dark); color: #fff; }
        .btn-reset {
            padding: 8px 14px;
            background: transparent;
            color: var(--text-mid);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: all var(--transition);
        }
        .btn-reset:hover { border-color: var(--ink); color: var(--ink); }

        /* ── Table Card ──────────────────────────────────── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--surface-2); }
        th {
            padding: 13px 16px; text-align: left;
            font-size: 11px; font-weight: 600; color: var(--text-lo);
            text-transform: uppercase; letter-spacing: .9px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        td { padding: 13px 16px; font-size: 14px; border-bottom: 1px solid var(--surface-3); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--surface-2); }

        /* ── Badges ──────────────────────────────────────── */
        .badge {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: capitalize;
        }
        .badge-pending   { background: var(--warning-bg); color: var(--warning); }
        .badge-confirmed { background: var(--success-bg); color: var(--success); }
        .badge-rejected  { background: var(--danger-bg);  color: var(--danger);  }
        .badge-scheduled { background: var(--info-bg);    color: var(--info);    }

        /* ── Action Buttons ──────────────────────────────── */
        .actions { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .btn-action {
            padding: 5px 10px; border-radius: var(--radius-sm);
            font-size: 12px; font-weight: 500; cursor: pointer;
            font-family: 'DM Sans', sans-serif; border: 1px solid; text-decoration: none;
            transition: all var(--transition); white-space: nowrap;
        }
        .btn-view     { background: var(--info-bg);    color: var(--info);    border-color: rgba(30,95,168,.2); }
        .btn-view:hover { background: #d0e4f7; }
        .btn-delete   { background: var(--danger-bg);  color: var(--danger);  border-color: rgba(192,57,43,.2); }
        .btn-delete:hover { background: #f5c6c2; }

        /* ── Status dropdown ──────────────────────────────── */
        .status-form { display: flex; align-items: center; gap: 6px; }
        .status-select {
            padding: 4px 8px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            background: var(--surface);
            color: var(--ink);
            cursor: pointer;
        }
        .btn-save {
            padding: 4px 10px; background: var(--gold); color: var(--ink);
            border: none; border-radius: var(--radius-sm);
            font-size: 12px; font-weight: 600; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background var(--transition);
        }
        .btn-save:hover { background: var(--gold-dark); color: #fff; }

        /* ── Pagination ──────────────────────────────────── */
        .pagination-wrap { padding: 16px 20px; border-top: 1px solid var(--border); }
        .pagination-wrap .pagination { display: flex; gap: 6px; }
        .empty-state { text-align: center; padding: 60px 24px; color: var(--text-lo); }
    </style>

    <div class="page-header">
        <div>
            <div class="page-title">Semua Booking</div>
            <div class="page-sub">Total {{ $bookings->total() }} booking ditemukan</div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="filter-bar">
        <div class="filter-group">
            <label class="filter-label">Cari</label>
            <input type="text" name="search" class="filter-input"
                   placeholder="Nama, email, atau referensi…"
                   value="{{ request('search') }}">
        </div>
        <div class="filter-group">
            <label class="filter-label">Status</label>
            <select name="status" class="filter-select">
                <option value="">Semua Status</option>
                @foreach(['pending','confirmed','scheduled','rejected'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-filter">Filter</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn-reset">Reset</a>
    </form>

    <!-- Table -->
    <div class="table-card">
        @if($bookings->isEmpty())
            <div class="empty-state">Belum ada booking yang ditemukan.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Referensi</th>
                        <th>User</th>
                        <th>Paket</th>
                        <th>Tanggal Booking</th>
                        <th>Status</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>
                                <span style="font-family:monospace;font-size:12px;color:var(--text-mid)">
                                    {{ $booking->booking_reference }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight:600">{{ $booking->full_name }}</div>
                                <div style="font-size:12px;color:var(--text-mid)">{{ $booking->email }}</div>
                            </td>
                            <td>{{ $booking->package->name ?? $booking->service }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                <div style="font-size:12px;color:var(--text-lo)">{{ $booking->booking_time }}</div>
                            </td>
                            <td>
                                {{-- Update Status Form --}}
                                <form method="POST"
                                      action="{{ route('admin.bookings.updateStatus', $booking) }}"
                                      class="status-form">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="status-select"
                                            onchange="this.form.submit()"
                                            title="Ubah status">
                                        @foreach(['pending','confirmed','scheduled','rejected'] as $s)
                                            <option value="{{ $s }}"
                                                {{ strtolower($booking->status) === $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td style="font-weight:600;color:var(--gold-dark)">
                                Rp {{ number_format($booking->price, 0, ',', '.') }}
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.bookings.show', $booking) }}"
                                       class="btn-action btn-view">Detail</a>

                                    <form method="POST"
                                          action="{{ route('admin.bookings.destroy', $booking) }}"
                                          onsubmit="return confirm('Hapus booking {{ $booking->booking_reference }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($bookings->hasPages())
                <div class="pagination-wrap">
                    {{ $bookings->links() }}
                </div>
            @endif
        @endif
    </div>
</x-admin-layout>
