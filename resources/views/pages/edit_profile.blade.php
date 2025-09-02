@extends('Layout.master_dash')

@section('content')
@php
    $user = session('user');
@endphp
<div class="d-flex align-items-center justify-content-center w-100" style="min-height:100vh; background: linear-gradient(135deg, #ff4e50, #f9d423);">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width:500px; width:100%; background:white;">
        <h3 class="fw-bold mb-4 text-center">Edit Profile</h3>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="nic_number" class="form-label">NIC</label>
                <input type="text" class="form-control" id="nic_number" name="nic_number" value="{{ $user['nic_number'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $user['location'] ?? '' }}">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
