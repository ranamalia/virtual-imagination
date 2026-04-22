<div class="fs-panel-inner">
    <div class="fs-panel-header">
        <div class="fs-panel-tag fs-panel-tag-danger">Danger Zone</div>
        <h1 class="fs-panel-title fs-title-danger">Delete Account</h1>
        <p class="fs-panel-desc">Once deleted, your account and all data are permanently gone. This cannot be undone.</p>
    </div>

    <div class="fs-danger-checklist">
        <div class="fs-danger-item">
            <span class="fs-danger-dot"></span>
            All your personal data will be permanently erased
        </div>
        <div class="fs-danger-item">
            <span class="fs-danger-dot"></span>
            Your account cannot be recovered after deletion
        </div>
        <div class="fs-danger-item">
            <span class="fs-danger-dot"></span>
            You will be logged out and redirected immediately
        </div>
    </div>

    <button type="button" class="fs-btn fs-btn-danger" id="open-delete-modal">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
        Delete My Account
    </button>
</div>

{{-- ── CONFIRMATION MODAL ── --}}
<div class="fs-modal-overlay" id="delete-modal">
    <div class="fs-modal">
        <div class="fs-modal-warn-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e53935" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <h2 class="fs-modal-title">Are you sure?</h2>
        <p class="fs-modal-desc">Enter your password to permanently delete your account. This action is <strong>irreversible</strong>.</p>

        <form method="post" action="{{ route('profile.destroy') }}" class="fs-form">
            @csrf
            @method('delete')

            <div class="fs-field">
                <label for="delete_password" class="fs-label">Password</label>
                <div class="fs-input-wrap">
                    <input id="delete_password" name="password" type="password"
                        class="fs-input {{ $errors->userDeletion->has('password') ? 'fs-input-err' : '' }}"
                        placeholder="Enter your password" />
                    <button type="button" class="fs-eye" onclick="togglePwDel()" tabindex="-1">
                        <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="eye-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                @if ($errors->userDeletion->has('password'))
                    <p class="fs-err-msg">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>

            <div class="fs-modal-actions">
                <button type="button" class="fs-btn fs-btn-ghost" id="close-delete-modal">Cancel</button>
                <button type="submit" class="fs-btn fs-btn-danger">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById('delete-modal');
document.getElementById('open-delete-modal').addEventListener('click', () => {
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
});
document.getElementById('close-delete-modal').addEventListener('click', () => {
    modal.classList.remove('open');
    document.body.style.overflow = '';
});
modal.addEventListener('click', e => {
    if (e.target === modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
});
function togglePwDel() {
    const inp = document.getElementById('delete_password');
    const btn = inp.closest('.fs-input-wrap').querySelector('.fs-eye');
    const isHidden = inp.type === 'password';
    inp.type = isHidden ? 'text' : 'password';
    btn.querySelector('.eye-open').style.display = isHidden ? 'none' : '';
    btn.querySelector('.eye-off').style.display  = isHidden ? '' : 'none';
}

@if($errors->userDeletion->isNotEmpty())
    document.addEventListener('DOMContentLoaded', () => {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    });
@endif
</script>
