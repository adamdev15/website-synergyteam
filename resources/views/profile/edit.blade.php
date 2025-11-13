@extends('layouts.landing')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: #0c54b7">
        <i class="bi bi-person-circle me-2"></i>Profil Saya
    </h2>

    <div class="row g-4">

        {{-- Profile Information --}}
        <div class="col-12">
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="col-12">
            @include('profile.partials.update-password-form')
        </div>

        {{-- Delete Account --}}
        <div class="col-12">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
@endsection
