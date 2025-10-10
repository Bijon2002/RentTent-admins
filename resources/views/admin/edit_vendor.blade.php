@extends('layouts.master')

@section('title', 'Edit Food Package - RentTent Admin')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="create-form-section">
    <div class="section-header">
        <h2>Edit Food Package</h2>
        <a href="{{ route('admin.vendors') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to Vendors
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

    <form method="POST" action="{{ route('admin.vendors.update', $foodMenu->menu_id) }}" class="create-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Package Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $foodMenu->name) }}" required>
            </div>

            <div class="form-group">
                <label for="food_type">Food Type</label>
                <select name="food_type" id="food_type" required>
                    <option value="">Select Food Type</option>
                    <option value="breakfast" {{ old('food_type', $foodMenu->food_type) == 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                    <option value="lunch" {{ old('food_type', $foodMenu->food_type) == 'lunch' ? 'selected' : '' }}>Lunch</option>
                    <option value="dinner" {{ old('food_type', $foodMenu->food_type) == 'dinner' ? 'selected' : '' }}>Dinner</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="preference">Preference</label>
                <select name="preference" id="preference" required>
                    <option value="">Select Preference</option>
                    <option value="veg" {{ old('preference', $foodMenu->preference) == 'veg' ? 'selected' : '' }}>Vegetarian</option>
                    <option value="non_veg" {{ old('preference', $foodMenu->preference) == 'non_veg' ? 'selected' : '' }}>Non-Vegetarian</option>
                    <option value="both" {{ old('preference', $foodMenu->preference) == 'both' ? 'selected' : '' }}>Both</option>
                </select>
            </div>

            <div class="form-group">
                <label for="monthly_fee">Monthly Fee ($)</label>
                <input type="number" name="monthly_fee" id="monthly_fee" step="0.01" min="0" value="{{ old('monthly_fee', $foodMenu->monthly_fee) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $foodMenu->start_date) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $foodMenu->end_date) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="image_url">Package Image</label>
            <input type="file" name="image_url" id="image_url" accept="image/*">
            <small class="form-text">Upload a new image for the food package (optional)</small>
            @if($foodMenu->image_url)
                <div class="current-image">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $foodMenu->image_url) }}" alt="Current Package Image" style="max-width: 200px; height: auto; border-radius: 0.5rem;">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="approved">Approval Status</label>
            <select name="approved" id="approved">
                <option value="0" {{ old('approved', $foodMenu->approved) == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ old('approved', $foodMenu->approved) == '1' ? 'selected' : '' }}>Approved</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="bi bi-check-circle"></i> Update Package
            </button>
            <a href="{{ route('admin.vendors') }}" class="btn-secondary">Cancel</a>
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

.form-text {
    color: var(--text-lighter);
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

.current-image {
    margin-top: 1rem;
    padding: 1rem;
    background: rgba(30, 30, 30, 0.3);
    border-radius: 0.5rem;
    border: 1px solid var(--border);
}

.current-image p {
    color: var(--text-light);
    margin-bottom: 0.5rem;
    font-weight: 500;
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
