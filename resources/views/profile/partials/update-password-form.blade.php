<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="fw-bold mb-3">Update Password</h4>
        <p class="text-muted mb-4">Ensure your account uses a strong password.</p>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success py-2">
                Password successfully updated.
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Current Password</label>
                <input type="password" name="current_password" class="form-control">
                @error('current_password') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input type="password" name="password" class="form-control">
                @error('password') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password_confirmation') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <button class="btn btn-primary">Update Password</button>
        </form>

    </div>
</div>
