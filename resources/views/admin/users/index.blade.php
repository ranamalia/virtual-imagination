<x-admin-layout>
    <x-slot name="title">Data User</x-slot>

    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title  { font-family:'Cormorant Garamond',serif; font-size:24px; font-weight:600; color:var(--ink); }

        /* ── Filter bar ─────────────────────────────────── */
        .filter-bar {
            display: flex; gap: 10px; flex-wrap: wrap;
            background: var(--surface); border:1px solid var(--border);
            border-radius: var(--radius-md); padding: 16px 20px;
            margin-bottom: 20px;
        }
        .filter-bar input, .filter-bar select {
            padding: 8px 12px; border:1px solid var(--border);
            border-radius: var(--radius-sm); font-family:'DM Sans',sans-serif;
            font-size: 14px; color: var(--ink); background: var(--surface-2);
            outline: none; transition: border-color var(--transition);
        }
        .filter-bar input:focus, .filter-bar select:focus { border-color: var(--gold); }
        .filter-bar input { flex:1; min-width:180px; }
        .btn-filter {
            padding: 8px 18px; background: var(--gold); color: var(--ink);
            border:none; border-radius: var(--radius-sm); font-size:14px;
            font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif;
            transition: background var(--transition);
        }
        .btn-filter:hover { background: var(--gold-dark); color:#fff; }
        .btn-reset {
            padding: 8px 14px; background: transparent; color: var(--text-mid);
            border:1px solid var(--border); border-radius: var(--radius-sm);
            font-size:13px; font-weight:500; cursor:pointer;
            font-family:'DM Sans',sans-serif; text-decoration:none;
            transition: all var(--transition);
        }
        .btn-reset:hover { border-color:var(--gold); color:var(--gold-dark); }

        /* ── Table ──────────────────────────────────────── */
        .table-card {
            background: var(--surface); border:1px solid var(--border);
            border-radius: var(--radius-md); overflow: hidden;
        }
        table { width:100%; border-collapse:collapse; }
        thead { background: var(--surface-2); }
        th {
            padding:13px 20px; text-align:left;
            font-size:11px; font-weight:600; color:var(--text-lo);
            text-transform:uppercase; letter-spacing:.9px;
            border-bottom:1px solid var(--border);
        }
        td { padding:14px 20px; font-size:14px; border-bottom:1px solid var(--surface-3); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background: var(--surface-2); }

        /* ── Avatar ─────────────────────────────────────── */
        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; color: #fff; flex-shrink: 0;
        }
        .user-cell { display:flex; align-items:center; gap:12px; }
        .user-name { font-weight:600; color:var(--ink); }
        .user-email { font-size:12px; color:var(--text-mid); margin-top:2px; }

        /* ── Badges ─────────────────────────────────────── */
        .badge {
            display:inline-block; padding:3px 10px; border-radius:20px;
            font-size:11px; font-weight:600;
        }
        .badge-admin { background:rgba(204,176,73,.15); color:var(--gold-dark); }
        .badge-user  { background: var(--info-bg); color: var(--info); }

        /* ── Actions ─────────────────────────────────────── */
        .actions { display:flex; gap:8px; align-items:center; }
        .btn-view {
            padding:6px 12px; border:1px solid var(--border);
            border-radius:var(--radius-sm); color:var(--text-mid);
            font-size:12px; font-weight:500; text-decoration:none;
            transition: all var(--transition);
        }
        .btn-view:hover { border-color:var(--gold); color:var(--gold-dark); }
        .btn-edit {
            padding:6px 12px; border:1px solid var(--border);
            border-radius:var(--radius-sm); color:var(--info);
            border-color: rgba(30,95,168,.3);
            font-size:12px; font-weight:500; text-decoration:none;
            transition: all var(--transition);
        }
        .btn-edit:hover { background:var(--info-bg); }
        .btn-delete {
            padding:6px 12px; border:1px solid rgba(192,57,43,.3);
            border-radius:var(--radius-sm); color:var(--danger);
            font-size:12px; font-weight:500; background:none; cursor:pointer;
            font-family:'DM Sans',sans-serif;
            transition: all var(--transition);
        }
        .btn-delete:hover { background:var(--danger-bg); }

        /* ── Empty ──────────────────────────────────────── */
        .empty-state { text-align:center; padding:56px 24px; color:var(--text-lo); }
        .empty-state .icon { font-size:40px; margin-bottom:12px; }

        /* ── Pagination ─────────────────────────────────── */
        .pagination-wrap { padding:16px 20px; border-top:1px solid var(--border); }
    </style>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Data User</h1>
        <div style="font-size:13px;color:var(--text-mid)">Total: {{ $users->total() }} user</div>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="filter-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email…">
        <select name="role">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user"  {{ request('role') === 'user'  ? 'selected' : '' }}>User</option>
        </select>
        <button type="submit" class="btn-filter">Cari</button>
        <a href="{{ route('admin.users.index') }}" class="btn-reset">Reset</a>
    </form>

    <!-- Table -->
    <div class="table-card">
        @if($users->isEmpty())
            <div class="empty-state">
                <div class="icon">👤</div>
                <p>Tidak ada user ditemukan.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Jumlah Booking</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                        <tr>
                            <td style="color:var(--text-lo)">{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">{{ strtoupper(substr($user->name,0,1)) }}</div>
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td style="font-weight:600">{{ $user->bookings_count }}</td>
                            <td style="color:var(--text-mid)">{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn-view">Detail</a>
                                    <a href="{{ route('admin.users.edit', $user) }}"  class="btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirmDelete('{{ addslashes($user->name) }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination-wrap">{{ $users->links() }}</div>
            @endif
        @endif
    </div>

    <script>
        function confirmDelete(name) {
            return confirm(`Hapus user "${name}"? Semua booking miliknya akan ikut terhapus.`);
        }
    </script>
</x-admin-layout>
