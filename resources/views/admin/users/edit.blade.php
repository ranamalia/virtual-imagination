<x-admin-layout>
    <x-slot name="title">Edit User</x-slot>

    <style>
        .back-link {
            display:inline-flex; align-items:center; gap:6px;
            font-size:13px; color:var(--text-mid); text-decoration:none;
            margin-bottom:20px; transition:color var(--transition);
        }
        .back-link:hover { color:var(--gold-dark); }

        .form-card {
            background: var(--surface); border:1px solid var(--border);
            border-radius: var(--radius-md); padding:32px; max-width:600px;
        }
        .form-title {
            font-family:'Cormorant Garamond',serif; font-size:22px;
            font-weight:600; color:var(--ink); margin-bottom:24px;
        }
        .form-group { margin-bottom:20px; }
        .form-label {
            display:block; font-size:13px; font-weight:600;
            color:var(--text-hi); margin-bottom:8px;
        }
        .form-label span { color:var(--danger); }
        .form-input {
            width:100%; padding:10px 14px; border:1px solid var(--border);
            border-radius:var(--radius-sm); font-family:'DM Sans',sans-serif;
            font-size:14px; color:var(--ink); background:var(--surface-2);
            outline:none; transition:border-color var(--transition);
        }
        .form-input:focus { border-color:var(--gold); background:var(--surface); }
        .form-hint { font-size:12px; color:var(--text-lo); margin-top:5px; }
        .form-error { font-size:12px; color:var(--danger); margin-top:5px; }

        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }

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
            color:var(--text-mid); text-decoration:none; cursor:pointer;
            font-family:'DM Sans',sans-serif; transition: all var(--transition);
        }
        .btn-cancel:hover { border-color:var(--gold); color:var(--gold-dark); }
    </style>

    <a href="{{ route('admin.users.show', $user) }}" class="back-link">
        ← Kembali ke Detail User
    </a>

    <div class="form-card">
        <div class="form-title">Edit User: {{ $user->name }}</div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <!-- Nama -->
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap <span>*</span></label>
                    <input type="text" id="name" name="name" class="form-input"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <!-- Role -->
                <div class="form-group">
                    <label class="form-label" for="role">Role <span>*</span></label>
                    <select id="role" name="role" class="form-input" required>
                        <option value="user"  {{ old('role', $user->role) === 'user'  ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label" for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" class="form-input"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <!-- Password -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-input"
                           placeholder="Kosongkan jika tidak ingin mengubah">
                    <div class="form-hint">Minimal 8 karakter</div>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-input" placeholder="Ulangi password baru">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Perubahan</button>
                <a href="{{ route('admin.users.show', $user) }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>
