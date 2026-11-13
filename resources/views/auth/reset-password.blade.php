@extends('layouts.guest')

@section('title', 'Atur Ulang Kata Sandi - Synergy Team')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="card shadow-sm p-4" style="width: 420px; max-width: 95%; border-radius: 16px; border: none;" data-aos="fade-up" data-aos-duration="600">
        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team" style="width: 60px;" class="mx-auto d-block mb-2">
        <h5 class="text-center mb-1 fw-semibold" style="color: #0c54b7;">Atur Ulang Kata Sandi</h5>
        <p class="text-muted small text-center mb-4">
            Masukkan kata sandi baru untuk akun Synergy Team Anda.
        </p>

        @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" readonly style="background-color: #f8f9fa;">
            </div>

            <!-- Password Baru -->
            <div class="mb-3">
                <label for="password" class="form-label small text-muted">Kata Sandi Baru</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label small text-muted">Konfirmasi Kata Sandi Baru</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru" required autocomplete="new-password">
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary py-2 fw-semibold" style="border-radius: 10px; background-color: #0c54b7; border-color: #0c54b7;">
                    Simpan Kata Sandi Baru
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="small text-decoration-none" style="color: #0c54b7;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Masuk
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
