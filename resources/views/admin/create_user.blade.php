@extends('layouts.master')

@section('title', 'Create User - RentTent Admin')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="create-form-section">
    <div class="section-header">
        <h2>Create New User</h2>
        <a href="{{ route('admin.users.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to Users
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}" class="create-form">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <label for="nic_number">NIC Number</label>
                <input type="text" name="nic_number" id="nic_number" value="{{ old('nic_number') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <small class="form-text">Minimum 8 characters</small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}">
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="">Select Role</option>
                    <option value="finder" {{ old('role') == 'finder' ? 'selected' : '' }}>Finder</option>
                    <option value="provider" {{ old('role') == 'provider' ? 'selected' : '' }}>Provider</option>
                    <option value="vendor" {{ old('role') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="verification_status">Verification Status</label>
            <select name="verification_status" id="verification_status" required>
                <option value="">Select Status</option>
                <option value="Pending" {{ old('verification_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Verified" {{ old('verification_status') == 'Verified' ? 'selected' : '' }}>Verified</option>
                <option value="Rejected" {{ old('verification_status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="bi bi-check-circle"></i> Create User
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.create-form-section {
    background: var(--card-bg);
    border-radius: 0.75rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(74, 107, 255, 0.1);
    max-width: 800px;
    margin: 0 auto;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
}

.btn-back {
    background: rgba(74, 107, 255, 0.1);
    color: var(--primary-light);
    border: 1px solid var(--primary);
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
}

.btn-back:hover {
    background: var(--primary);
    color: white;
    box-shadow: 0 0 10px rgba(74, 107, 255, 0.5);
}

.create-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    color: var(--text-light);
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.75rem;
    background: rgba(30, 30, 30, 0.5);
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    color: var(--text);
    font-family: inherit;
    transition: all 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 10px rgba(74, 107, 255, 0.3);
    outline: none;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}

.btn-primary {
    background: linear-gradient(90deg, #10b981, #059669);
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(90deg, #059669, #047857);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.5);
    transform: translateY(-2px);
}

.btn-secondary {
    background: rgba(74, 107, 255, 0.1);
    color: var(--primary-light);
    border: 1px solid var(--primary);
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
}

.btn-secondary:hover {
    background: rgba(74, 107, 255, 0.3);
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}
</style>
@endsection
