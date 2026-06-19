<x-admin-layout>
    <x-slot name="title">Portfolio</x-slot>

    <style>
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
        .page-title  { font-family:'Cormorant Garamond',serif; font-size:24px; font-weight:600; color:var(--ink); }

        .btn-add {
            padding:10px 20px; background:var(--gold); color:var(--ink);
            border:none; border-radius:var(--radius-sm); font-size:14px;
            font-weight:700; text-decoration:none; cursor:pointer;
            font-family:'DM Sans',sans-serif; transition:background var(--transition);
            display:inline-flex; align-items:center; gap:6px;
        }
        .btn-add:hover { background:var(--gold-dark); color:#fff; }

        .filter-bar {
            display:flex; gap:10px; flex-wrap:wrap;
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); padding:16px 20px; margin-bottom:20px;
        }
        .filter-bar input, .filter-bar select {
            padding:8px 12px; border:1px solid var(--border);
            border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
            font-size:14px; color:var(--ink); background:var(--surface-2); outline:none;
            transition:border-color var(--transition);
        }
        .filter-bar input:focus, .filter-bar select:focus { border-color:var(--gold); }
        .filter-bar input { flex:1; min-width:180px; }
        .btn-filter { padding:8px 18px; background:var(--gold); color:var(--ink); border:none; border-radius:var(--radius-sm); font-size:14px; font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif; }
        .btn-reset  { padding:8px 14px; background:transparent; color:var(--text-mid); border:1px solid var(--border); border-radius:var(--radius-sm); font-size:13px; font-weight:500; cursor:pointer; text-decoration:none; }
        .btn-reset:hover { border-color:var(--gold); color:var(--gold-dark); }

        .port-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:16px; }

        .port-card {
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); overflow:hidden;
            transition:box-shadow var(--transition), border-color var(--transition);
        }
        .port-card:hover { border-color:var(--gold); box-shadow:0 4px 20px rgba(204,176,73,.12); }
        .port-thumb { height:180px; overflow:hidden; position:relative; background:var(--surface-2); }
        .port-thumb img { width:100%; height:100%; object-fit:cover; }
        .badge {
            position:absolute; top:10px; right:10px;
            padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;
        }
        .badge-active   { background:var(--success-bg); color:var(--success); }
        .badge-inactive { background:var(--danger-bg);  color:var(--danger);  }
        .badge-featured { position:absolute; top:10px; left:10px; background:rgba(204,176,73,.9); color:#1a1a1a; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:700; }

        .port-body { padding:16px 18px; }
        .port-title { font-size:15px; font-weight:700; color:var(--ink); margin-bottom:3px; }
        .port-cat   { font-size:12px; color:var(--gold-dark); font-weight:600; text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px; }
        .port-client{ font-size:13px; color:var(--text-mid); }

        .port-actions { display:flex; gap:8px; padding:12px 18px; border-top:1px solid var(--border); }
        .btn-edit { flex:1; padding:8px; border:1px solid rgba(30,95,168,.3); color:var(--info); border-radius:var(--radius-sm); font-size:13px; font-weight:500; text-align:center; text-decoration:none; transition:all var(--transition); }
        .btn-edit:hover { background:var(--info-bg); }
        .btn-delete { flex:1; padding:8px; border:1px solid rgba(192,57,43,.3); color:var(--danger); border-radius:var(--radius-sm); font-size:13px; font-weight:500; text-align:center; background:none; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all var(--transition); }
        .btn-delete:hover { background:var(--danger-bg); }

        .empty-state { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-md); text-align:center; padding:56px; }
        .empty-state .icon { font-size:48px; margin-bottom:12px; }
        .empty-state p { color:var(--text-mid); margin-bottom:20px; }
        .pagination-wrap { margin-top:20px; display:flex; justify-content:center; }
    </style>

    <div class="page-header">
        <h1 class="page-title">Portfolio</h1>
        <a href="{{ route('admin.portfolios.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:16px;height:16px">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/>
            </svg>
            Tambah Portfolio
        </a>
    </div>

    <form method="GET" action="{{ route('admin.portfolios.index') }}" class="filter-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul…">
        <select name="category">
            <option value="">Semua Kategori</option>
            @foreach($categories as $key => $label)
                <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <select name="status">
            <option value="">Semua Status</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Non-aktif</option>
        </select>
        <button type="submit" class="btn-filter">Cari</button>
        <a href="{{ route('admin.portfolios.index') }}" class="btn-reset">Reset</a>
    </form>

    @if($portfolios->isEmpty())
        <div class="empty-state">
            <div class="icon">🖼️</div>
            <p>Belum ada portfolio. Tambahkan hasil karya pertama Anda!</p>
            <a href="{{ route('admin.portfolios.create') }}" class="btn-add">Tambah Portfolio</a>
        </div>
    @else
        <div class="port-grid">
            @foreach($portfolios as $item)
                <div class="port-card">
                    <div class="port-thumb">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                        @if($item->is_featured)
                            <span class="badge-featured">⭐ Featured</span>
                        @endif
                        <span class="badge {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $item->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </div>
                    <div class="port-body">
                        <div class="port-title">{{ $item->title }}</div>
                        <div class="port-cat">{{ $categories[$item->category] ?? $item->category }}</div>
                        @if($item->client)
                            <div class="port-client">Klien: {{ $item->client }}</div>
                        @endif
                    </div>
                    <div class="port-actions">
                        <a href="{{ route('admin.portfolios.edit', $item) }}" class="btn-edit">Edit</a>
                        <form method="POST" action="{{ route('admin.portfolios.destroy', $item) }}"
                              onsubmit="return confirm('Hapus portfolio «{{ addslashes($item->title) }}»?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($portfolios->hasPages())
            <div class="pagination-wrap">{{ $portfolios->links() }}</div>
        @endif
    @endif
</x-admin-layout>
