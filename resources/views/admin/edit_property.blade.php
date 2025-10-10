@extends('layouts.master')

@section('title', 'Edit Property - RentTent Admin')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="create-form-section">
    <div class="section-header">
        <h2>Edit Property</h2>
        <a href="{{ route('admin.properties') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to Properties
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

    <form method="POST" action="{{ route('admin.properties.update', $property->boarding_id) }}" class="create-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Property Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $property->location) }}" required>
            </div>

            <div class="form-group">
                <label for="monthly_rent">Monthly Rent ($)</label>
                <input type="number" name="monthly_rent" id="monthly_rent" step="0.01" min="0" value="{{ old('monthly_rent', $property->monthly_rent) }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="room_type">Room Type</label>
                <select name="room_type" id="room_type" required>
                    <option value="">Select Room Type</option>
                    <option value="single" {{ old('room_type', $property->room_type) == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="double" {{ old('room_type', $property->room_type) == 'double' ? 'selected' : '' }}>Double</option>
                    <option value="shared" {{ old('room_type', $property->room_type) == 'shared' ? 'selected' : '' }}>Shared</option>
                    <option value="studio" {{ old('room_type', $property->room_type) == 'studio' ? 'selected' : '' }}>Studio</option>
                </select>
            </div>

            <div class="form-group">
                <label for="police_zone_rating">Police Zone Rating</label>
                <select name="police_zone_rating" id="police_zone_rating" required>
                    <option value="">Select Rating</option>
                    <option value="1" {{ old('police_zone_rating', $property->police_zone_rating) == '1' ? 'selected' : '' }}>1 Star</option>
                    <option value="2" {{ old('police_zone_rating', $property->police_zone_rating) == '2' ? 'selected' : '' }}>2 Stars</option>
                    <option value="3" {{ old('police_zone_rating', $property->police_zone_rating) == '3' ? 'selected' : '' }}>3 Stars</option>
                    <option value="4" {{ old('police_zone_rating', $property->police_zone_rating) == '4' ? 'selected' : '' }}>4 Stars</option>
                    <option value="5" {{ old('police_zone_rating', $property->police_zone_rating) == '5' ? 'selected' : '' }}>5 Stars</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="posted_date">Posted Date</label>
                <input type="date" name="posted_date" id="posted_date" value="{{ old('posted_date', $property->posted_date) }}" required>
            </div>

            <div class="form-group">
                <label for="is_food_included">Food Included</label>
                <select name="is_food_included" id="is_food_included">
                    <option value="0" {{ old('is_food_included', $property->is_food_included) == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_food_included', $property->is_food_included) == '1' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="photos">Add New Property Photos</label>
            <input type="file" name="photos[]" id="photos" accept="image/*" multiple>
            <small class="form-text">Upload additional photos for the property (optional)</small>
        </div>

        @if($property->photos->count() > 0)
            <div class="current-photos">
                <h4>Current Photos:</h4>
                <div class="photos-grid">
                    @foreach($property->photos as $photo)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $photo->image_url) }}" alt="Property Photo" style="width: 150px; height: 150px; object-fit: cover; border-radius: 0.5rem;">
                            @if($photo->is_main)
                                <span class="main-badge">Main Photo</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="form-group">
            <label for="is_approved">Approval Status</label>
            <select name="is_approved" id="is_approved">
                <option value="0" {{ old('is_approved', $property->is_approved) == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ old('is_approved', $property->is_approved) == '1' ? 'selected' : '' }}>Approved</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="bi bi-check-circle"></i> Update Property
            </button>
            <a href="{{ route('admin.properties') }}" class="btn-secondary">Cancel</a>
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

.current-photos {
    margin-top: 1rem;
    padding: 1rem;
    background: rgba(30, 30, 30, 0.3);
    border-radius: 0.5rem;
    border: 1px solid var(--border);
}

.current-photos h4 {
    color: var(--text-light);
    margin-bottom: 1rem;
    font-weight: 500;
}

.photos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1rem;
}

.photo-item {
    position: relative;
}

.main-badge {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background: var(--primary);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
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
    
    .photos-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
}
</style>
@endsection
