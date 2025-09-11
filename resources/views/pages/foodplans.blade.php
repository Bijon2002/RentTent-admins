@extends('layout.master_entity')

@section('title', 'FoodVendor - Discover Amazing Food')

@push('styles')
<style>
:root {
    --primary: #0a174e;
    --primary-dark: #001f54; 
    --gradient-blue: linear-gradient(135deg, #0a174e, #20378a);
    --secondary: #FF9800;
    --danger: #f44336;
    --gray-light: #f5f5f5;
    --gray: #9e9e9e;
    --dark: #333;
    --shadow: 0 4px 12px rgba(0,0,0,0.1);
    --radius: 8px;
}

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
.rating-stars { color: #FF9800; font-size: 0.8rem; }
.price-range { display: flex; flex-direction: column; gap: 0.5rem; }
.price-inputs { display: flex; gap: 0.5rem; }
.price-inputs input { flex: 1; padding: 0.4rem; border: 1px solid #ddd; border-radius: var(--radius); font-size: 0.9rem; }
.filter-buttons { display: flex; gap: 0.6rem; margin-top: 1rem; }
.filter-buttons button { flex: 1; padding: 0.6rem; border-radius: var(--radius); border: none; font-weight: 600; cursor: pointer; font-size: 0.9rem; }
.btn-apply { background: var(--gradient-blue); color: white; }
.btn-reset { background: #f5f5f5; color: var(--dark); }

.main-content { flex: 1; }

.hero { 
    position: relative; height: calc(350px + 3cm); 
    background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'); 
    background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center;
    margin-top: -1cm;
}
.hero-content { max-width: 800px; padding: 2rem; color: #fff; }
.hero-content h2 { font-size: 2.2rem; margin-bottom: 1rem; }
.hero-content p { font-size: 1.1rem; margin-bottom: 2rem; }

.btn { padding: 0.6rem 1.2rem; border: none; border-radius: var(--radius); font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: all 0.3s; font-size: 0.9rem; }
.btn-darkblue { background: var(--gradient-blue); color: #fff; text-decoration: none; }
.btn-darkblue:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

.container { max-width: 1200px; margin: 0 auto; padding: 1.5rem; }
.vendors { display: grid; grid-template-columns: 1fr; gap: 1.2rem; }
@media(min-width: 768px){ .vendors { grid-template-columns: 1fr 1fr; } }
@media(min-width: 1200px){ .vendors { grid-template-columns: 1fr 1fr 1fr; } }

.vendor-card { background: #fff; padding: 1.2rem; border-radius: var(--radius); box-shadow: var(--shadow); transition: 0.3s; display: flex; flex-direction: column; height: 100%; }
.vendor-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.15); }
.vendor-image { width: 100%; height: 160px; object-fit: cover; border-radius: var(--radius); margin-bottom: 0.8rem; }
.vendor-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.6rem; }
.vendor-name { font-size: 1.1rem; font-weight: 600; color: var(--dark); margin-bottom: 0.4rem; }
.vendor-info { flex-grow: 1; margin-bottom: 1rem; }
.vendor-info p { margin-bottom: 0.4rem; font-size: 0.9rem; }
.vendor-info strong { color: var(--primary); }
.view-more-btn { margin-top: auto; width: 100%; text-align: center; }
.status-badge { display: inline-block; padding: 0.3rem 0.6rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
.status-open { background-color: #e8f5e9; color: #2e7d32; }
.status-closed { background-color: #ffebee; color: #c62828; }
.mobile-filter-btn { display: block; margin-bottom: 1rem; width: 100%; }
@media(min-width: 992px) { .mobile-filter-btn { display: none; } }
</style>
@endpush

@section('content')
<div class="hero">
    <div class="hero-content">
        <h2>Discover Amazing Food</h2>
        <p>From local favorites to gourmet experiences, delivered right to your door</p>
        <button class="btn btn-darkblue"><i class="fas fa-search"></i> Explore Now</button>
    </div>
</div>

<div class="search-container">
    <div class="search-bar">
        <input type="text" class="search-input" placeholder="Search for restaurants, cuisines, or dishes...">
        <button class="btn btn-darkblue"><i class="fas fa-search"></i></button>
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

            <!-- Filters: Ratings -->
            <div class="filter-group">
                <div class="filter-title">Rating</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="rating" value="5"> <span class="rating-stars">★★★★★</span></label>
                    <label class="filter-checkbox"><input type="checkbox" name="rating" value="4"> <span class="rating-stars">★★★★☆</span></label>
                    <label class="filter-checkbox"><input type="checkbox" name="rating" value="3"> <span class="rating-stars">★★★☆☆</span></label>
                </div>
            </div>

            <!-- Filters: Food Type -->
            <div class="filter-group">
                <div class="filter-title">Food Type</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="food_type" value="breakfast"> Breakfast</label>
                    <label class="filter-checkbox"><input type="checkbox" name="food_type" value="lunch"> Lunch</label>
                    <label class="filter-checkbox"><input type="checkbox" name="food_type" value="dinner"> Dinner</label>
                </div>
            </div>

            <!-- Filters: Price -->
            <div class="filter-group">
                <div class="filter-title">Monthly Fee (Rs.)</div>
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

        <!-- Vendors Grid -->
        <div class="main-content">
            <div class="section-header">
                <h2>Available Restaurants ({{ $foodMenus->count() }})</h2>
                <p>Discover amazing food from top-rated vendors near you</p>
            </div>

            <div class="vendors">
                @forelse($foodMenus as $menu)
                <div class="vendor-card">
                    <img src="{{ asset('storage/' . $menu->image_url) }}" alt="{{ $menu->name }}" class="vendor-image">
                    <div class="vendor-header">
                        <h3 class="vendor-name">{{ $menu->name }}</h3>
                        <span class="status-badge status-open">Open</span>
                    </div>
                    <div class="vendor-info">
                        <p><strong>Type:</strong> {{ ucfirst($menu->food_type) }}</p>
                        <p><strong>Monthly Fee:</strong> Rs. {{ number_format($menu->monthly_fee, 2) }}</p>
                    </div>
                    <div class="view-more-btn">
                        <!-- ✅ Fixed: Pass the correct ID -->
                        <a href="{{ route('vendor.details', $menu->id ?? $menu->menu_id) }}" class="btn btn-darkblue">View Details</a>
                    </div>
                </div>
                @empty
                <p>No food menus available right now. Check back later!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('filterToggle');
    const filterSidebar = document.getElementById('filterSidebar');
    const closeFilters = document.getElementById('closeFilters');

    filterToggle.addEventListener('click', function() {
        filterSidebar.style.display = filterSidebar.style.display === 'none' ? 'block' : 'none';
        closeFilters.style.display = 'block';
        filterToggle.textContent = filterSidebar.style.display === 'none' ? ' Show Filters' : ' Hide Filters';
    });

    closeFilters.addEventListener('click', function() {
        filterSidebar.style.display = 'none';
        closeFilters.style.display = 'none';
        filterToggle.textContent = ' Show Filters';
    });

    // Reset filters
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('priceMin').value = '';
        document.getElementById('priceMax').value = '';
    });

    // Apply filters alert placeholder
    document.getElementById('applyFilters').addEventListener('click', function() {
        alert('Filters applied! In real app, this will filter results via AJAX or form submit.');
    });
});
</script>
@endpush
@endsection
