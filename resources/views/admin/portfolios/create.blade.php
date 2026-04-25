<x-admin-layout>
    <x-slot name="title">Tambah Portfolio</x-slot>

    <style>
        .form-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-md); padding:32px; max-width:700px; }
        .form-title { font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:600; color:var(--ink); margin-bottom:28px; }
        .form-row { margin-bottom:20px; }
        .form-row label { display:block; font-size:12px; font-weight:600; color:var(--text-mid); text-transform:uppercase; letter-spacing:.7px; margin-bottom:7px; }
        .form-row input[type=text],
        .form-row select,
        .form-row textarea {
            width:100%; padding:10px 14px; border:1.5px solid var(--border);
            border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
            font-size:14px; color:var(--ink); background:var(--surface-2); outline:none;
            transition:border-color var(--transition), box-shadow var(--transition);
        }
        .form-row input:focus, .form-row select:focus, .form-row textarea:focus {
            border-color:var(--gold); box-shadow:0 0 0 3px rgba(204,176,73,.1);
        }
        .form-row textarea { resize:vertical; min-height:100px; }
        .form-row .error { font-size:12px; color:var(--danger); margin-top:5px; }

        .form-row-check { display:flex; align-items:center; gap:10px; margin-bottom:16px; }
        .form-row-check input[type=checkbox] { width:16px; height:16px; accent-color:var(--gold); }
        .form-row-check label { font-size:14px; color:var(--ink); font-weight:500; margin:0; }

        .preview-box { width:100%; height:200px; border:2px dashed var(--border); border-radius:var(--radius-sm); display:flex; align-items:center; justify-content:center; margin-top:8px; overflow:hidden; background:var(--surface-2); }
        .preview-box img { width:100%; height:100%; object-fit:cover; }
        .preview-hint { font-size:13px; color:var(--text-lo); text-align:center; }

        .form-actions { display:flex; gap:12px; margin-top:28px; padding-top:20px; border-top:1px solid var(--border); }
        .btn-save { padding:11px 28px; background:var(--gold); color:var(--ink); border:none; border-radius:var(--radius-sm); font-size:14px; font-weight:700; cursor:pointer; font-family:'DM Sans',sans-serif; transition:background var(--transition); }
        .btn-save:hover { background:var(--gold-dark); color:#fff; }
        .btn-cancel { padding:11px 24px; background:transparent; color:var(--text-mid); border:1px solid var(--border); border-radius:var(--radius-sm); font-size:14px; font-weight:500; text-decoration:none; transition:border-color var(--transition); }
        .btn-cancel:hover { border-color:var(--gold); color:var(--gold-dark); }

        .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    </style>

    <div class="form-card">
        <div class="form-title">Tambah Portfolio Baru</div>

        <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid-2">
                <div class="form-row">
                    <label for="title">Judul *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Misal: Sesi Foto Wisuda ITB 2024" required>
                    @error('title') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-row">
                    <label for="category">Kategori *</label>
                    <select id="category" name="category" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <label for="client">Nama Klien</label>
                <input type="text" id="client" name="client" value="{{ old('client') }}" placeholder="Nama klien / perusahaan (opsional)">
                @error('client') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" placeholder="Ceritakan tentang sesi foto ini…">{{ old('description') }}</textarea>
                @error('description') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <label for="image">Foto Portfolio * <small style="color:var(--text-lo);font-weight:400">(maks. 4MB, jpg/png/webp)</small></label>
                <input type="file" id="image" name="image" accept="image/*" required onchange="previewImg(this)">
                <div class="preview-box" id="previewBox">
                    <div class="preview-hint">📷 Preview foto akan muncul di sini</div>
                </div>
                @error('image') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="grid-2">
                <div class="form-row">
                    <label for="sort_order">Urutan Tampil</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                </div>
            </div>

            <div class="form-row-check">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <label for="is_featured">Tampilkan sebagai Featured (ditampilkan pertama)</label>
            </div>
            <div class="form-row-check">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">Aktif (tampil di halaman publik)</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Portfolio</button>
                <a href="{{ route('admin.portfolios.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

    <script>
    function previewImg(input) {
        const box = document.getElementById('previewBox');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                box.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</x-admin-layout>
