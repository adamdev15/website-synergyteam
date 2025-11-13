<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="fw-bold mb-3 text-danger">Delete Account</h4>
        <p class="text-muted mb-4">
            Once your account is deleted, all data will be permanently removed.
        </p>

        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
            Delete Account
        </button>

        {{-- Bootstrap Modal --}}
        <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            Please enter your password to permanently delete your account.
                        </p>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password') 
                                <small class="text-danger">{{ $message }}</small> 
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger">Delete Account</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
