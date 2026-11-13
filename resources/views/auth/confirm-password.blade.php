@extends('layouts.guest')

@section('title', 'Konfirmasi Kata Sandi - Synergy Team')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="card shadow-sm p-4" style="width: 400px; max-width: 95%; border-radius: 16px; border: none;">
        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team" style="width: 60px;" class="mx-auto d-block mb-2">
        <h5 class="text-center mb-2 fw-semibold" style="color: #0c54b7;">Konfirmasi Kata Sandi</h5>
        <p class="text-muted small text-center mb-4">
            Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.
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

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label small text-muted">Kata Sandi</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="Masukkan kata sandi Anda" required autocomplete="current-password">
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary py-2 fw-semibold" style="border-radius: 10px; background-color: #0c54b7; border-color: #0c54b7;">
                    Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
