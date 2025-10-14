@extends('Layout.master_dash')

@section('content')
@php
    use App\Models\User;
    $userId = session('user_id');
    $user = $userId ? User::find($userId) : null;
    if (!$user) {
        $user = auth()->user();
    }
@endphp

<div class="d-flex align-items-center justify-content-center w-100 py-5" 
     style="min-height:100vh; margin-top:2cm;"
     data-aos="fade-up" data-aos-duration="1200">

    <div class="glass-card shadow-lg border-0 rounded-4 p-4"
         style="max-width:1000px; width:100%; margin: auto;">

        <!-- Profile Header -->
        <div class="d-flex flex-column align-items-center mb-4 position-relative">
            <!-- Profile Image Centered -->
            <div class="position-relative mb-3">
                <img src="{{ $user && $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/default-user.png') }}"
                     class="rounded-circle border border-4 border-white shadow squircle-img"
                     style="width:150px; height:150px; object-fit:cover;">
                <button class="btn btn-primary rounded-circle p-2 position-absolute bottom-0 end-0" 
                        data-bs-toggle="modal" data-bs-target="#profileModal"
                        style="width:40px; height:40px;">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </div>

            <!-- Text Info Left-aligned -->
            <div class="text-start w-100 ps-md-4">
                <h3 class="fw-bold mb-1 text-light">{{ $user ? $user->name : 'Unknown User' }}</h3>
                <p class="text-light mb-0">{{ $user ? ucfirst($user->role) : '' }}</p>
                <p class="text-light">Member since {{ $user ? $user->created_at->format('F Y') : '' }}</p>
            </div>

            <!-- Hamburger Icon top-right -->
            <button id="sidebarToggle" class="btn position-absolute" style="top:2rem; right:2rem; z-index:110; background:transparent; border:none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
