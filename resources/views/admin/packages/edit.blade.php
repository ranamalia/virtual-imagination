<x-admin-layout>
    <x-slot name="title">Edit Paket</x-slot>

    <style>
        .back-link {
            display:inline-flex; align-items:center; gap:6px;
            font-size:13px; color:var(--text-mid); text-decoration:none;
            margin-bottom:20px; transition:color var(--transition);
        }
        .back-link:hover { color:var(--gold-dark); }
        .form-card {
            background:var(--surface); border:1px solid var(--border);
            border-radius:var(--radius-md); padding:32px; max-width:680px;
        }
        .form-title {
            font-family:'Cormorant Garamond',serif; font-size:22px;
            font-weight:600; color:var(--ink); margin-bottom:24px;
        }
        .form-group { margin-bottom:20px; }
        .form-label { display:block; font-size:13px; font-weight:600; color:var(--text-hi); margin-bottom:8px; }
        .form-label span { color:var(--danger); }
        .form-input {
            width:100%; padding:10px 14px; border:1px solid var(--border);
            border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
            font-size:14px; color:var(--ink); background:var(--surface-2);
            outline:none; transition:border-color var(--transition);
        }
        .form-input:focus { border-color:var(--gold); background:var(--surface); }
        textarea.form-input { resize:vertical; min-height:100px; }
        .form-error { font-size:12px; color:var(--danger); margin-top:5px; }
        .form-hint  { font-size:12px; color:var(--text-lo); margin-top:5px; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .toggle-wrap { display:flex; align-items:center; gap:12px; }
        .toggle-label { font-size:14px; color:var(--text-mid); }
        .toggle {
            width:44px; height:24px; background:var(--border); border-radius:12px;
            position:relative; cursor:pointer; transition:background var(--transition);
            appearance:none; outline:none; border:none;
        }
        .toggle:checked { background:var(--gold); }
        .toggle::after {
            content:''; width:18px; height:18px; background:#fff;
            border-radius:50%; position:absolute; top:3px; left:3px;
            transition:transform var(--transition);
        }
        .toggle:checked::after { transform:translateX(20px); }
        .current-thumb {
            width:120px; height:80px; object-fit:cover; border-radius:var(--radius-sm);
            border:1px solid var(--border); margin-top:8px; display:block;
        }
        .form-actions { display:flex; gap:12px; margin-top:28px; }
        .btn-save {
            padding:11px 28px; background:var(--gold); color:var(--ink);
            border:none; border-radius:var(--radius-sm); font-size:14px;
            font-weight:700; cursor:pointer; font-family:'DM Sans',sans-serif;
            transition: background var(--transition);
        }
        .btn-save:hover { background:var(--gold-dark); color:#fff; }
        .btn-cancel {
            padding:11px 20px; background:transparent; border:1px solid var(--border);
            border-radius:var(--radius-sm); font-size:14px; font-weight:500;
            color:var(--text-mid); text-decoration:none; transition: all var(--transition);
        }
        .btn-cancel:hover { border-color:var(--gold); color:var(--gold-dark); }
        .section-divider { border:none; border-top:1px solid var(--border); margin:28px 0 24px; }
        .section-label {
            font-size:11px; font-weight:700; letter-spacing:1px;
            text-transform:uppercase; color:var(--gold-dark); margin-bottom:16px;
        }
    </style>

    <a href="{{ route('admin.packages.index') }}" class="back-link">← Kembali ke Paket Foto</a>

    <div class="form-card">
        <div class="form-title">Edit Paket: {{ $package->name }}</div>

        <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Nama Paket -->
            <div class="form-group">
                <label class="form-label" for="name">Nama Paket <span>*</span></label>
                <input type="text" id="name" name="name" class="form-input"
                       value="{{ old('name', $package->name) }}" required>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label class="form-label" for="category">Kategori</label>
                <input type="text" id="category" name="category" class="form-input"
                       value="{{ old('category', $package->category) }}"
                       placeholder="cth: Photography, Videography, Wedding">
                <div class="form-hint">Kategori paket untuk filter tampilan.</div>
                @error('category')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Deskripsi -->
            @php
                // Convert JSON array back to newline-separated text for textarea
                $descValue = old('description');
                if ($descValue === null) {
                    $descArray = $package->description;
                    $descValue = is_array($descArray) ? implode("\n", $descArray) : ($descArray ?? '');
                }
                $bonusValue = old('bonus');
                if ($bonusValue === null) {
                    $bonusArray = $package->bonus;
                    $bonusValue = is_array($bonusArray) ? implode("\n", $bonusArray) : ($bonusArray ?? '');
                }
            @endphp

            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Benefit Paket</label>
                <textarea id="description" name="description" class="form-input" rows="5">{{ $descValue }}</textarea>
                <div class="form-hint">💡 Tulis <strong>satu poin per baris</strong>. Setiap baris akan ditampilkan sebagai bullet point.</div>
                @error('description')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Bonus -->
            <div class="form-group">
                <label class="form-label" for="bonus">Bonus Paket</label>
                <textarea id="bonus" name="bonus" class="form-input" rows="3">{{ $bonusValue }}</textarea>
                <div class="form-hint">💡 Bonus tambahan di luar benefit utama. Tulis satu item per baris.</div>
                @error('bonus')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <hr class="section-divider">
            <div class="section-label">Detail Sesi</div>

            <!-- Harga, Durasi -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="price">Harga (Rp) <span>*</span></label>
                    <input type="number" id="price" name="price" class="form-input"
                           value="{{ old('price', (int)$package->price) }}" required min="0">
                    @error('price')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="duration_minutes">Durasi (menit) <span>*</span></label>
                    <input type="number" id="duration_minutes" name="duration_minutes" class="form-input"
                           value="{{ old('duration_minutes', $package->duration_minutes) }}" required min="1">
                    @error('duration_minutes')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Max Person -->
            <div class="form-group">
                <label class="form-label" for="max_person">Maks. Peserta</label>
                <input type="number" id="max_person" name="max_person" class="form-input"
                       value="{{ old('max_person', $package->max_person) }}" min="1" placeholder="cth: 5">
                <div class="form-hint">Jumlah orang maksimal yang bisa ikut dalam satu sesi.</div>
                @error('max_person')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <hr class="section-divider">
            <div class="section-label">Media & Status</div>

            <!-- Thumbnail -->
            <div class="form-group">
                <label class="form-label" for="thumbnail">Thumbnail</label>
                @if($package->thumbnail)
                    <img src="{{ Storage::url($package->thumbnail) }}" alt="Thumbnail" class="current-thumb">
                    <div class="form-hint" style="margin-top:8px">Upload baru untuk mengganti gambar di atas.</div>
                @endif
                <input type="file" id="thumbnail" name="thumbnail" class="form-input"
                       accept="image/*" style="margin-top:8px">
                @error('thumbnail')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="form-label">Status Paket</label>
                <div class="toggle-wrap">
                    <input type="checkbox" id="is_active" name="is_active" class="toggle"
                           value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="toggle-label">Paket Aktif (tampil di halaman Studio Rent)</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Perubahan</button>
                <a href="{{ route('admin.packages.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>
