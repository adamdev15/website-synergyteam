@extends('layouts.guest')

@section('title', 'Login SynergyTeam.id')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">

    <div class="card shadow-sm p-4" style="width: 400px; border-radius: 16px; border: none;">
        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team" style="width: 60px;" class="mx-auto d-block mb-2">
        <h5 class="text-center mb-2 fw-semibold" style="color: #0c54b7;">Masuk ke Synergy Team</h5>
        <p class="text-center text-muted small mb-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-decoration-none text-success">Daftar Sekarang</a>
        </p>

        <div class="d-grid mb-3">
            <button type="button" class="btn btn-outline-light border d-flex align-items-center justify-content-center gap-2"
                style="border-radius: 10px; border-color: #ddd;">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" style="width:18px">
                <span class="fw-semibold" style="color: #0c54b7;">Masuk dengan Google</span>
            </button>
        </div>

        <div class="d-flex align-items-center mb-3">
            <hr class="flex-grow-1">
            <span class="mx-2 text-muted small">atau</span>
            <hr class="flex-grow-1">
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                    placeholder="Contoh: synergyteam@mail.com" required autofocus>
            </div>

            <div class="mb-3">
                <div class=" mb-1">
                    <label for="password" class="form-label small text-muted mb-0">Password</label>
                </div>
                <div class="input-group">
                    <input id="password" class="form-control" type="password" name="password"
                        placeholder="Masukkan Password" required>
                    <span class="input-group-text bg-white border-start-0">
                        <i class="bi bi-eye-slash text-muted" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>

            <div class="form-check d-flex justify-content-between align-items-center mb-3">
                <div>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label small" for="remember_me">Ingat saya</label>
                </div>
                <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: #0c54b7;">
                    Lupa Password?
                </a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary py-2" style="border-radius: 10px;">Masuk</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.querySelector('#togglePassword').addEventListener('click', function() {
        const passwordField = document.querySelector('#password');
        const icon = this;
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
</script>
@endpush
@endsection