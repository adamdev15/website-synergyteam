<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="fw-bold mb-3">Profile Information</h4>
        <p class="text-muted mb-4">Update your name and email address.</p>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success py-2">
                Profile successfully updated.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $user->name) }}" required>
                @error('name') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
                @error('email') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            {{-- Verification notice --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3">
                    Your email address is unverified.
                    <button form="send-verification" class="btn btn-link p-0">
                        Click here to re-send the verification email.
                    </button>
                </div>
            @endif

            <button class="btn btn-primary mt-2">Save Changes</button>
        </form>

        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

    </div>
</div>
