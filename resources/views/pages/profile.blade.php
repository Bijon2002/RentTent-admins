@extends('Layout.master_dash')

@section('content')
@php
    $user = session('user');
@endphp

<div class="d-flex align-items-start justify-content-center w-100" 
    style="min-height:100vh; background: linear-gradient(120deg, #0a2540, #4f8cff, #0a2540); background-size: 200% 200%; animation: gradientMove 8s ease-in-out infinite; padding-top:50px;">

    <div class="card shadow-lg border-0 rounded-4 text-center p-4"
         style="max-width:600px; width:100%; background:white;">

        <!-- Profile Image + Edit Icon -->
        <div class="mb-3 d-flex justify-content-center">
            <div class="position-relative d-inline-block" style="width:120px; height:120px;">
             <img src="{{ isset($user['profile_pic']) && $user['profile_pic'] ? asset('storage/' . $user['profile_pic']) : asset('img/default-user.png') }}"
                 class="squircle-img border-4 border-white shadow"
                 style="width:120px; height:120px; object-fit:cover; border-radius:30% / 40%;">
                <button type="button" id="mainEditBtn" class="btn btn-link p-0 position-absolute"
                    style="bottom:10px; right:10px; font-size:1.8rem; background:rgba(255,255,255,0.7); border-radius:50%; width:36px; height:36px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.12);"
                    title="Edit Profile">
                    <i class="bi bi-pencil-square text-primary"></i>
                </button>
            </div>
        </div>

        <!-- Name + username -->
    <h4 class="fw-bold mb-1">{{ $user['name'] ?? 'Unknown User' }}</h4>

        <!-- Profile Info -->
        <form method="POST" action="{{ route('profile.update') }}" id="inlineEditForm">
            @csrf
            <div class="text-start px-4 mt-4">
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <strong>Username</strong>
                    <span class="field-text" id="name-text">{{ $user['name'] ?? '' }}</span>
                    <input type="text" class="form-control field-input d-none" name="name" id="name-input" value="{{ $user['name'] ?? '' }}">
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <strong>Email</strong>
                    <span class="field-text" id="email-text">{{ $user['email'] ?? '' }}</span>
                    <input type="email" class="form-control field-input d-none" name="email" id="email-input" value="{{ $user['email'] ?? '' }}">
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <strong>Address</strong>
                    <span class="field-text" id="location-text">{{ $user['location'] ?? '' }}</span>
                    <input type="text" class="form-control field-input d-none" name="location" id="location-input" value="{{ $user['location'] ?? '' }}">
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <strong>NIC</strong>
                    <span class="field-text" id="nic_number-text">{{ $user['nic_number'] ?? '' }}</span>
                    <input type="text" class="form-control field-input d-none" name="nic_number" id="nic_number-input" value="{{ $user['nic_number'] ?? '' }}">
                </div>
            </div>
            <div class="d-flex justify-content-end px-4 mt-3">
                <button type="submit" class="btn btn-success rounded-pill px-4 py-2 fw-bold d-none" id="saveBtn">Save Changes</button>
                <button type="button" class="btn btn-secondary rounded-pill px-4 py-2 fw-bold d-none" id="cancelBtn">Cancel</button>
            </div>
        </form>
    </div>

    <!-- ...existing code... -->
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>

<style>
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
</style>
    const mainEditBtn = document.getElementById('mainEditBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const fieldTexts = document.querySelectorAll('.field-text');
    const fieldInputs = document.querySelectorAll('.field-input');

    let editing = false;
    let originalValues = {};

    mainEditBtn.addEventListener('click', function() {
        if (!editing) {
            editing = true;
            // Save original values
            fieldInputs.forEach(input => {
                originalValues[input.id] = input.value;
            });
            // Hide all texts and show all inputs
            fieldTexts.forEach(text => text.classList.add('d-none'));
            fieldInputs.forEach(input => input.classList.remove('d-none'));
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
        }
    });

    cancelBtn.addEventListener('click', function() {
        editing = false;
        // Restore original values
        fieldInputs.forEach(input => {
            input.value = originalValues[input.id];
            input.classList.add('d-none');
        });
        fieldTexts.forEach(text => text.classList.remove('d-none'));
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
    });
</script>
@endsection
