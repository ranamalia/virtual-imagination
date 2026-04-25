<x-admin-layout>
    <x-slot name="title">Manajemen Testimoni</x-slot>

    <style>
        .page-header {
            display:flex; align-items:center; justify-content:space-between;
            margin-bottom:24px;
        }
        .page-title {
            font-family:'Cormorant Garamond',serif; font-size:24px;
            font-weight:600; color:var(--ink);
        }
        .badge {
            display:inline-flex; align-items:center; gap:4px;
            padding:3px 10px; border-radius:20px; font-size:11px; font-weight:700;
            letter-spacing:.4px; text-transform:uppercase;
        }
        .badge-active   { background:rgba(16,185,129,.12); color:#059669; }
        .badge-inactive { background:rgba(107,114,128,.1);  color:#6B7280; }

        .testi-table-wrap {
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); overflow:hidden;
        }
        .data-table { width:100%; border-collapse:collapse; }
        .data-table thead { background:var(--surface-2); }
        .data-table th {
            padding:12px 16px; text-align:left; font-size:11px; font-weight:700;
            letter-spacing:.8px; text-transform:uppercase; color:var(--text-lo);
            border-bottom:1px solid var(--border);
        }
        .data-table td {
            padding:16px; font-size:14px; color:var(--ink);
            border-bottom:1px solid var(--border); vertical-align:top;
        }
        .data-table tbody tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:var(--surface-2); }

        .stars { color:var(--gold); font-size:14px; letter-spacing:1px; }

        .user-cell { display:flex; align-items:center; gap:10px; }
        .user-avatar-sm {
            width:32px; height:32px; border-radius:50%; background:var(--ink);
            color:#fff; font-size:12px; font-weight:700;
            display:flex; align-items:center; justify-content:center; flex-shrink:0;
        }
        .user-name-sm  { font-size:14px; font-weight:600; color:var(--ink); }
        .user-email-sm { font-size:12px; color:var(--text-lo); }

        .comment-cell { max-width:360px; }
        .comment-text {
            font-size:13px; color:var(--text-mid); line-height:1.6;
            display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical;
            overflow:hidden;
        }

        .action-btns { display:flex; gap:8px; align-items:center; }
        .btn-toggle {
            padding:6px 12px; border-radius:var(--radius-sm); font-size:12px;
            font-weight:600; cursor:pointer; border:none; font-family:'DM Sans',sans-serif;
            transition:all var(--transition);
        }
        .btn-toggle-hide { background:rgba(107,114,128,.1); color:#6B7280; }
        .btn-toggle-hide:hover { background:rgba(107,114,128,.2); }
        .btn-toggle-show { background:rgba(16,185,129,.12); color:#059669; }
        .btn-toggle-show:hover { background:rgba(16,185,129,.24); }
        .btn-del {
            padding:6px 12px; border-radius:var(--radius-sm); font-size:12px;
            font-weight:600; cursor:pointer; border:none; font-family:'DM Sans',sans-serif;
            background:rgba(220,38,38,.08); color:#DC2626;
            transition:background var(--transition);
        }
        .btn-del:hover { background:rgba(220,38,38,.18); }

        .empty-state {
            text-align:center; padding:64px 24px; color:var(--text-lo);
        }
        .empty-state p { font-size:15px; margin-top:12px; }

        .alert-success {
            background:rgba(16,185,129,.08); border:1px solid rgba(16,185,129,.25);
            border-radius:var(--radius-sm); padding:12px 16px; font-size:14px;
            color:#059669; margin-bottom:20px;
        }
    </style>

    <div class="page-header">
        <div class="page-title">Manajemen Testimoni</div>
    </div>
<!-- 
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif -->

    <div class="testi-table-wrap">
        @if($testimonials->isEmpty())
            <div class="empty-state">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.3">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <p>Belum ada testimoni yang masuk.</p>
            </div>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $t)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        {{ strtoupper(substr($t->user?->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="user-name-sm">{{ $t->user?->name ?? 'User Dihapus' }}</div>
                                        <div class="user-email-sm">{{ $t->user?->email ?? '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="stars">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div>
                                <div style="font-size:11px;color:var(--text-lo);margin-top:2px">{{ $t->rating }}/5</div>
                            </td>
                            <td class="comment-cell">
                                <div class="comment-text">"{{ $t->comment }}"</div>
                            </td>
                            <td>
                                @if($t->is_active)
                                    <span class="badge badge-active">Aktif</span>
                                @else
                                    <span class="badge badge-inactive">Disembunyikan</span>
                                @endif
                            </td>
                            <td style="white-space:nowrap;color:var(--text-lo);font-size:13px">
                                {{ $t->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="action-btns">
                                    <!-- Toggle Active -->
                                    <form method="POST" action="{{ route('admin.testimonials.toggle', $t) }}">
                                        @csrf @method('PATCH')
                                        @if($t->is_active)
                                            <button type="submit" class="btn-toggle btn-toggle-hide">Sembunyikan</button>
                                        @else
                                            <button type="submit" class="btn-toggle btn-toggle-show">Aktifkan</button>
                                        @endif
                                    </form>
                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}"
                                          onsubmit="return confirm('Hapus testimoni ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-del">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($testimonials->hasPages())
                <div style="padding:16px 20px;border-top:1px solid var(--border)">
                    {{ $testimonials->links() }}
                </div>
            @endif
        @endif
    </div>
</x-admin-layout>
