<x-admin-layout>
    <x-slot name="title">Paket Foto</x-slot>

    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title  { font-family:'Cormorant Garamond',serif; font-size:24px; font-weight:600; color:var(--ink); }

        .btn-add {
            padding:10px 20px; background:var(--gold); color:var(--ink);
            border:none; border-radius:var(--radius-sm); font-size:14px;
            font-weight:700; text-decoration:none; cursor:pointer;
            font-family:'DM Sans',sans-serif; transition: background var(--transition);
            display:inline-flex; align-items:center; gap:6px;
        }
        .btn-add:hover { background:var(--gold-dark); color:#fff; }

        /* ── Filter ─────────────────────────────────────── */
        .filter-bar {
            display:flex; gap:10px; flex-wrap:wrap;
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); padding:16px 20px; margin-bottom:20px;
        }
        .filter-bar input, .filter-bar select {
            padding:8px 12px; border:1px solid var(--border);
            border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
            font-size:14px; color:var(--ink); background:var(--surface-2);
            outline:none; transition:border-color var(--transition);
        }
        .filter-bar input:focus, .filter-bar select:focus { border-color:var(--gold); }
        .filter-bar input { flex:1; min-width:180px; }
        .btn-filter {
            padding:8px 18px; background:var(--gold); color:var(--ink);
            border:none; border-radius:var(--radius-sm); font-size:14px;
            font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif;
        }
        .btn-reset {
            padding:8px 14px; background:transparent; color:var(--text-mid);
            border:1px solid var(--border); border-radius:var(--radius-sm);
            font-size:13px; font-weight:500; cursor:pointer; text-decoration:none;
        }
        .btn-reset:hover { border-color:var(--gold); color:var(--gold-dark); }

        /* ── Package Grid ────────────────────────────────── */
        .packages-grid {
            display:grid; grid-template-columns:repeat(auto-fill, minmax(300px,1fr)); gap:16px;
        }
        .package-card {
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); overflow:hidden;
            transition: box-shadow var(--transition), border-color var(--transition);
        }
        .package-card:hover { border-color:var(--gold); box-shadow:0 4px 20px rgba(204,176,73,.12); }

        .package-thumb {
            height:140px; background:var(--surface-2); overflow:hidden; position:relative;
        }
        .package-thumb img { width:100%; height:100%; object-fit:cover; }
        .package-thumb .no-thumb {
            width:100%; height:100%; display:flex; align-items:center;
            justify-content:center; font-size:48px; color:var(--border);
        }
        .pkg-status-badge {
            position:absolute; top:10px; right:10px;
            padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;
        }
        .pkg-active   { background:var(--success-bg); color:var(--success); }
        .pkg-inactive { background:var(--danger-bg);  color:var(--danger);  }

        .package-body { padding:18px 20px; }
        .package-name { font-size:16px; font-weight:700; color:var(--ink); margin-bottom:4px; }
        .package-desc { font-size:13px; color:var(--text-mid); margin-bottom:10px; line-height:1.5;
                        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        .package-meta { display:flex; align-items:center; justify-content:space-between; }
        .package-price { font-size:18px; font-weight:700; color:var(--gold-dark); }
        .package-duration { font-size:12px; color:var(--text-lo); }

        .package-actions {
            display:flex; gap:8px; padding:12px 20px; border-top:1px solid var(--border);
        }
        .btn-edit {
            flex:1; padding:8px; border:1px solid rgba(30,95,168,.3); color:var(--info);
            border-radius:var(--radius-sm); font-size:13px; font-weight:500;
            text-align:center; text-decoration:none; transition:all var(--transition);
        }
        .btn-edit:hover { background:var(--info-bg); }
        .btn-delete {
            flex:1; padding:8px; border:1px solid rgba(192,57,43,.3); color:var(--danger);
            border-radius:var(--radius-sm); font-size:13px; font-weight:500;
            text-align:center; background:none; cursor:pointer;
            font-family:'DM Sans',sans-serif; transition:all var(--transition);
        }
        .btn-delete:hover { background:var(--danger-bg); }

        .empty-state {
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); text-align:center; padding:56px;
        }
        .empty-state .icon { font-size:48px; margin-bottom:12px; }
        .empty-state p { color:var(--text-mid); margin-bottom:20px; }

        .pagination-wrap { margin-top:20px; display:flex; justify-content:center; }
    </style>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Paket Foto</h1>
        <a href="{{ route('admin.packages.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:16px;height:16px">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
            Tambah Paket
        </a>
    </div>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.packages.index') }}" class="filter-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama paket…">
        <select name="status">
            <option value="">Semua Status</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Non-aktif</option>
        </select>
        <button type="submit" class="btn-filter">Cari</button>
        <a href="{{ route('admin.packages.index') }}" class="btn-reset">Reset</a>
    </form>

    <!-- Grid or Empty -->
    @if($packages->isEmpty())
        <div class="empty-state">
            <div class="icon">📦</div>
            <p>Belum ada paket foto. Mulai tambahkan paket pertama Anda!</p>
            <a href="{{ route('admin.packages.create') }}" class="btn-add">Tambah Paket</a>
        </div>
    @else
        <div class="packages-grid">
            @foreach($packages as $package)
                <div class="package-card">
                    <div class="package-thumb">
                        @if($package->thumbnail)
                            <img src="{{ Storage::url($package->thumbnail) }}" alt="{{ $package->name }}">
                        @else
                            <div class="no-thumb">📷</div>
                        @endif
                        <span class="pkg-status-badge {{ $package->is_active ? 'pkg-active' : 'pkg-inactive' }}">
                            {{ $package->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </div>
                    <div class="package-body">
                        <div class="package-name">{{ $package->name }}</div>
                        @php
                            $desc = $package->description;
                            $descPreview = is_array($desc) && !empty($desc)
                                ? implode(' · ', array_slice($desc, 0, 2))
                                : (is_string($desc) && $desc ? $desc : '—');
                        @endphp
                        <div class="package-desc">{{ $descPreview }}</div>
                        <div class="package-meta">
                            <div class="package-price">Rp {{ number_format($package->price,0,',','.') }}</div>
                            <div class="package-duration">{{ $package->duration_minutes }} menit · {{ $package->bookings_count }} booking</div>
                        </div>
                    </div>
                    <div class="package-actions">
                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn-edit">Edit</a>
                        <form method="POST" action="{{ route('admin.packages.destroy', $package) }}"
                              onsubmit="return confirm('Hapus paket «{{ addslashes($package->name) }}»?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($packages->hasPages())
            <div class="pagination-wrap">{{ $packages->links() }}</div>
        @endif
    @endif
</x-admin-layout>
