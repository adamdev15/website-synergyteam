@extends('layouts.guest')

@section('title', 'Daftar SynergyTeam.id')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="card shadow-sm p-4" style="width: 400px; border-radius: 16px; border: none;">
        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team" style="width: 60px;" class="mx-auto d-block mb-2">
        <h5 class="text-center mb-2 fw-semibold" style="color: #0c54b7;">Buat Akun Synergy Team</h5>
        <p class="text-center text-muted small mb-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none text-success">Masuk</a>
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label small text-muted">Nama Lengkap</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small text-muted">Password</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label small text-muted">Konfirmasi Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="border-radius: 10px;">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
