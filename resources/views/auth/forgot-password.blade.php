@extends('layouts.guest')

@section('title', 'Reset Password - Synergy Team')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="card shadow-sm p-4" style="width: 400px; border-radius: 16px; border: none;">
        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team" style="width: 60px;" class="mx-auto d-block mb-2">
        <h5 class="text-center mb-3 fw-semibold" style="color: #0c54b7;">Lupa Password?</h5>
        <p class="text-muted small text-center mb-4">
            Masukkan email Anda untuk menerima link reset password.
        </p>

        @if (session('status'))
            <div class="alert alert-success small">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="border-radius: 10px;">Kirim Link Reset</button>
            </div>
        </form>
    </div>
</div>
@endsection
