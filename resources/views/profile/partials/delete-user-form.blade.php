<section>
    <div class="profile-card">
        <h3 class="profile-card-title">Delete Account</h3>
        <p class="profile-card-desc">
            Once your account is deleted, all data will be permanently removed and cannot be recovered.
            Please make sure you have backed up anything you want to keep before proceeding.
        </p>

        <div class="pf-danger-info">
            <div class="pf-danger-info-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                All your personal data will be erased
            </div>
            <div class="pf-danger-info-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                This action cannot be undone
            </div>
            <div class="pf-danger-info-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                You will be logged out immediately
            </div>
        </div>

        <button type="button" class="pf-btn pf-btn-danger" onclick="openDeleteModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
            Delete My Account
        </button>
    </div>

    {{-- Confirmation Modal --}}
    <div class="pf-modal-overlay" id="delete-modal" onclick="handleOverlayClick(event)">
        <div class="pf-modal">
            <div class="pf-modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d32f2f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <h3 class="pf-modal-title">Are you absolutely sure?</h3>
            <p class="pf-modal-desc">
                This will permanently delete your account and all associated data.
                Please enter your password to confirm this irreversible action.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="pf-form-group">
                    <label for="delete_password" class="pf-label">Your Password</label>
                    <div class="pf-password-wrapper">
                        <input
                            id="delete_password"
                            name="password"
                            type="password"
                            class="pf-input {{ $errors->userDeletion->has('password') ? 'pf-input-error' : '' }}"
                            placeholder="Enter your password to confirm"
                        />
                        <button type="button" class="pf-eye-btn" onclick="togglePassword('delete_password', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @if ($errors->userDeletion->has('password'))
                        <p class="pf-error-text">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="pf-modal-actions">
                    <button type="button" class="pf-btn pf-btn-outline" onclick="closeDeleteModal()">
                        Cancel
                    </button>
                    <button type="submit" class="pf-btn pf-btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        Yes, Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('delete-modal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.remove('open');
            document.body.style.overflow = '';
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('delete-modal')) closeDeleteModal();
        }

        @if ($errors->userDeletion->isNotEmpty())
            document.addEventListener('DOMContentLoaded', () => openDeleteModal());
        @endif
    </script>
</section>
