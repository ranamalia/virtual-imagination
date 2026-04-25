<x-admin-layout>
    <x-slot name="title">Tambah Paket Foto</x-slot>

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

        /* Toggle Switch */
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

        .section-divider {
            border:none; border-top:1px solid var(--border);
            margin:28px 0 24px;
        }
        .section-label {
            font-size:11px; font-weight:700; letter-spacing:1px;
            text-transform:uppercase; color:var(--gold-dark); margin-bottom:16px;
        }
    </style>

    <a href="{{ route('admin.packages.index') }}" class="back-link">← Kembali ke Paket Foto</a>

    <div class="form-card">
        <div class="form-title">Tambah Paket Foto Baru</div>

        <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nama Paket -->
            <div class="form-group">
                <label class="form-label" for="name">Nama Paket <span>*</span></label>
                <input type="text" id="name" name="name" class="form-input"
                       value="{{ old('name') }}" required placeholder="cth: Premium Wedding">
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label class="form-label" for="category">Kategori</label>
                <input type="text" id="category" name="category" class="form-input"
                       value="{{ old('category') }}" placeholder="cth: Photography, Videography, Wedding">
                <div class="form-hint">Kategori paket untuk filter tampilan.</div>
                @error('category')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Benefit Paket</label>
                <textarea id="description" name="description" class="form-input" rows="5"
                          placeholder="Tulis satu poin per baris, contoh:&#10;Sesi foto 1 jam&#10;Akses 3 background&#10;Editing 10 foto">{{ old('description') }}</textarea>
                <div class="form-hint">💡 Tulis <strong>satu poin per baris</strong>. Setiap baris akan ditampilkan sebagai bullet point.</div>
                @error('description')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Bonus -->
            <div class="form-group">
                <label class="form-label" for="bonus">Bonus Paket</label>
                <textarea id="bonus" name="bonus" class="form-input" rows="3"
                          placeholder="Tulis satu bonus per baris, contoh:&#10;5 lembar cetak 4R&#10;Frame digital&#10;Softcopy high-res">{{ old('bonus') }}</textarea>
                <div class="form-hint">💡 Bonus tambahan di luar benefit utama. Tulis satu item per baris.</div>
                @error('bonus')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <hr class="section-divider">
            <div class="section-label">Detail Sesi</div>

            <!-- Harga, Durasi, Max Person -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="price">Harga (Rp) <span>*</span></label>
                    <input type="number" id="price" name="price" class="form-input"
                           value="{{ old('price') }}" required min="0" placeholder="500000">
                    @error('price')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="duration_minutes">Durasi (menit) <span>*</span></label>
                    <input type="number" id="duration_minutes" name="duration_minutes" class="form-input"
                           value="{{ old('duration_minutes', 60) }}" required min="1">
                    @error('duration_minutes')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="max_person">Maks. Peserta</label>
                <input type="number" id="max_person" name="max_person" class="form-input"
                       value="{{ old('max_person') }}" min="1" placeholder="cth: 5">
                <div class="form-hint">Jumlah orang maksimal yang bisa ikut dalam satu sesi.</div>
                @error('max_person')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <hr class="section-divider">
            <div class="section-label">Media & Status</div>

            <!-- Thumbnail -->
            <div class="form-group">
                <label class="form-label" for="thumbnail">Thumbnail (opsional)</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-input" accept="image/*">
                <div class="form-hint">Format JPG, PNG, WEBP. Maks 2MB.</div>
                @error('thumbnail')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="form-label">Status Paket</label>
                <div class="toggle-wrap">
                    <input type="checkbox" id="is_active" name="is_active" class="toggle"
                           value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="toggle-label">Paket Aktif (tampil di halaman Studio Rent)</label>
                </div>
                @error('is_active')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Paket</button>
                <a href="{{ route('admin.packages.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>
