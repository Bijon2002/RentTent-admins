@extends('layout.master_entity')

@section('title', 'RentTent - Discover Properties')

@push('styles')
<style>
:root {
    --primary: #0a174e;
    --primary-dark: #001f54;
    --gradient-blue: linear-gradient(135deg, #0a174e, #20378a);
    --secondary: #FF9800;
    --gray-light: #f5f5f5;
    --dark: #333;
    --shadow: 0 4px 12px rgba(0,0,0,0.1);
    --radius: 8px;
}
.btn-heart {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    color: #e74c3c;
    margin-left: 0.5rem;
    transition: transform 0.2s;
}
.btn-heart.liked i { color: #c0392b; transform: scale(1.2); }


body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f8f9fa;
    color: var(--dark);
    line-height: 1.6;
}

.main-container { display: flex; flex-direction: column; gap: 1.5rem; }
@media(min-width: 992px) { .main-container { flex-direction: row; align-items: flex-start; } }

.sidebar {
    background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); padding: 1.2rem; flex: 0 0 250px;
}
.sidebar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; padding-bottom: 0.8rem; border-bottom: 1px solid #eee; }
.sidebar-title { font-size: 1.1rem; font-weight: 600; color: var(--primary); }

.filter-group { margin-bottom: 1.2rem; }
.filter-title { font-weight: 600; margin-bottom: 0.6rem; display: flex; justify-content: space-between; font-size: 0.9rem; }
.filter-options { display: flex; flex-direction: column; gap: 0.5rem; }
.filter-checkbox { display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; }
.filter-checkbox input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--primary); }

.price-range { display: flex; flex-direction: column; gap: 0.5rem; }
.price-inputs { display: flex; gap: 0.5rem; }
.price-inputs input { flex: 1; padding: 0.4rem; border: 1px solid #ddd; border-radius: var(--radius); font-size: 0.9rem; }

.filter-buttons { display: flex; gap: 0.6rem; margin-top: 1rem; }
.filter-buttons button { flex: 1; padding: 0.6rem; border-radius: var(--radius); border: none; font-weight: 600; cursor: pointer; font-size: 0.9rem; }
.btn-apply { background: var(--gradient-blue); color: white; }
.btn-reset { background: #f5f5f5; color: var(--dark); }

.main-content { flex: 1; }

.hero {
    position: relative; height: calc(300px + 4cm); margin-top: -2cm;
        background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1560185007-cde436f6a4d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); margin-top: -2cm;
    background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center;
}
.hero-content { max-width: 800px; padding: 2rem; color: #fff; }
.hero-content h2 { font-size: 2.2rem; margin-bottom: 1rem; }
.hero-content p { font-size: 1.1rem; margin-bottom: 2rem; }

.btn { padding: 0.6rem 1.2rem; border: none; border-radius: var(--radius); font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: all 0.3s; font-size: 0.9rem; }
.btn-darkblue { background: var(--gradient-blue); color: #fff; text-decoration: none; }
.btn-darkblue:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

.container { max-width: 1200px; margin: 0 auto; padding: 1.5rem; }
.properties { display: grid; grid-template-columns: 1fr; gap: 1.2rem; }
@media(min-width: 768px){ .properties { grid-template-columns: 1fr 1fr; } }
@media(min-width: 1200px){ .properties { grid-template-columns: 1fr 1fr 1fr; } }

.property-card { background: #fff; padding: 1rem; border-radius: var(--radius); box-shadow: var(--shadow); transition: 0.3s; display: flex; flex-direction: column; height: 100%; }
.property-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.15); }
.property-image { width: 100%; height: 160px; object-fit: cover; border-radius: var(--radius); margin-bottom: 0.8rem; }
.property-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.6rem; }
.property-title { font-size: 1.1rem; font-weight: 600; color: var(--dark); margin-bottom: 0.4rem; }
.property-info { flex-grow: 1; margin-bottom: 1rem; }
.property-info p { margin-bottom: 0.4rem; font-size: 0.9rem; }
.property-info strong { color: var(--primary); }
.view-more-btn { margin-top: auto; width: 100%; text-align: center; }
.status-badge { display: inline-block; padding: 0.3rem 0.6rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
.status-available { background-color: #e8f5e9; color: #2e7d32; }
.status-unavailable { background-color: #ffebee; color: #c62828; }
.mobile-filter-btn { display: block; margin-bottom: 1rem; width: 100%; }
@media(min-width: 992px) { .mobile-filter-btn { display: none; } }
</style>
@endpush

@section('content')
<div class="hero">
    <div class="hero-content">
    <h2 style="margin-top:3cm; margin-bottom:0.2cm;">Discover Properties</h2>
    <p style="margin-top:0;">Find your perfect boarding or rental near you!</p>
        <button class="btn btn-darkblue"><i class="fas fa-search"></i> Explore Now</button>
    </div>
</div>

<div class="container">
    <button class="btn btn-darkblue mobile-filter-btn" id="filterToggle"><i class="fas fa-filter"></i> Show Filters</button>
    
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="filterSidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">Filters</h3>
                <span class="close-filters" id="closeFilters" style="display: none;"><i class="fas fa-times"></i></span>
            </div>

            <div class="filter-group">
                <div class="filter-title">Property Type</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="property_type" value="student"> Student Housing</label>
                    <label class="filter-checkbox"><input type="checkbox" name="property_type" value="professional"> Professional</label>
                    <label class="filter-checkbox"><input type="checkbox" name="property_type" value="shared" checked> Shared Living</label>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Monthly Rent (Rs.)</div>
                <div class="price-range">
                    <div class="price-inputs">
                        <input type="number" placeholder="Min" id="priceMin">
                        <input type="number" placeholder="Max" id="priceMax">
                    </div>
                </div>
            </div>

            <div class="filter-buttons">
                <button class="btn-apply" id="applyFilters">Apply Filters</button>
                <button class="btn-reset" id="resetFilters">Reset</button>
            </div>
        </aside>

        <!-- Properties Grid -->
        <div class="main-content">
            <div class="section-header">
                <h2>Available Properties</h2>
                <p>Discover amazing properties near you</p>
            </div>

<div class="properties">
    @foreach($boardings as $boarding)
        @php $mainPhoto = $boarding->photos->where('is_main', true)->first(); @endphp
        <div class="property-card">
            @if($mainPhoto)
                <img src="{{ asset('storage/'.$mainPhoto->image_url) }}" class="property-image" alt="{{ $boarding->title }}">
            @else
                <div class="bg-light text-center p-5" style="border-radius: 8px;">No Image</div>
            @endif

            <div class="property-header">
                <h3 class="property-title">{{ $boarding->title }}</h3>
                <div>
                    <span class="status-badge {{ $boarding->availability_status == 'available' ? 'status-available' : 'status-unavailable' }}">
                        {{ ucfirst($boarding->availability_status) }}
                    </span>
                    <button class="btn-heart" data-id="{{ $boarding->boarding_id }}">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>

            <div class="property-info">
                <p><strong>Location:</strong> {{ $boarding->location }}</p>
                <p><strong>Rent:</strong> Rs. {{ number_format($boarding->monthly_rent, 0) }}/month</p>
                <p><strong>Type:</strong> {{ ucfirst($boarding->room_type) }}</p>
                @if($boarding->is_food_included)
                    <p><strong>Food:</strong> Included</p>
                @endif
            </div>

            <div class="view-more-btn">
 <a href="{{ route('boarding.details', $boarding->boarding_id) }}" class="btn btn-darkblue">View Details</a>




            </div>
        </div>
    @endforeach
</div>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('filterToggle');
    const filterSidebar = document.getElementById('filterSidebar');
    const closeFilters = document.getElementById('closeFilters');

    filterToggle.addEventListener('click', function() {
        if(filterSidebar.style.display === 'block') {
            filterSidebar.style.display = 'none';
            closeFilters.style.display = 'none';
        } else {
            filterSidebar.style.display = 'block';
            closeFilters.style.display = 'block';
        }
    });

    closeFilters.addEventListener('click', function() {
        filterSidebar.style.display = 'none';
        closeFilters.style.display = 'none';
    });

    document.getElementById('resetFilters').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('priceMin').value = '';
        document.getElementById('priceMax').value = '';
    });

    document.getElementById('applyFilters').addEventListener('click', function() {
        alert('Filters applied! Replace with actual filtering logic.');
    });

    document.querySelectorAll('.btn-heart').forEach(btn => {
    btn.addEventListener('click', function() {
        this.classList.toggle('liked');
        const boardingId = this.dataset.id;
        // TODO: Send AJAX to bookmark/unbookmark the boarding
        console.log('Toggled bookmark for boarding:', boardingId);
    });
});

});
</script>
@endpush
@endsection
