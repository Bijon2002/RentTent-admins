@extends('layouts.master')

@section('title', 'Edit Subscription - RentTent Admin')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="create-form-section">
    <div class="section-header">
        <h2>Edit Subscription</h2>
        <a href="{{ route('admin.subscriptions.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to Subscriptions
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

    <form method="POST" action="{{ route('admin.subscriptions.update', $subscription->id) }}" class="create-form">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->user_id }}" {{ old('user_id', $subscription->user_id) == $user->user_id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="vendor_id">Vendor</label>
                <select name="vendor_id" id="vendor_id" required>
                    <option value="">Select Vendor</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->menu_id }}" {{ old('vendor_id', $subscription->vendor_id) == $vendor->menu_id ? 'selected' : '' }}>
                            {{ $vendor->name }} - ${{ $vendor->monthly_fee }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="amount">Amount ($)</label>
                <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount', $subscription->amount) }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $subscription->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="cancelled" {{ old('status', $subscription->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="bi bi-check-circle"></i> Update Subscription
            </button>
            <a href="{{ route('admin.subscriptions.index') }}" class="btn-secondary">Cancel</a>
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
