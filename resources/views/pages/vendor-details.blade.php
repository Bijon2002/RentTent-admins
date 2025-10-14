@extends('layout.master_entity')

@section('title', $menu->user->name . ' - FoodVendor')

@push('styles')
{{-- Google Fonts & Font Awesome --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #0a174e;
        --secondary: #FF9800;
        --dark: #2c3e50;
        --light: #ffffff;
        --gray-light: #f8f9fa;
        --gray-dark: #6c757d;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --radius: 12px;
        --font-family: 'Poppins', sans-serif;
    }

    body {
        font-family: var(--font-family);
        background-image: url('https://images.unsplash.com/photo-1556909211-3a28de0e392b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* Hero Section */
    .hero-premium { position: relative; padding: 6rem 2rem; border-radius: var(--radius); background-size: cover; background-position: center; color: var(--light); margin-bottom: 2rem; overflow: hidden; box-shadow: var(--shadow); }
    .hero-premium::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(10,23,78,0.85), rgba(0,0,0,0.7)); z-index:1; }
    .hero-text { position: relative; z-index: 2; max-width: 600px; }
    .hero-text .vendor-tag { background-color: rgba(255,255,255,0.1); padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.9rem; display:inline-block; margin-bottom:1rem; }
    .hero-text h1 { font-size: 2.8rem; font-weight:700; }
    .hero-text p { color: rgba(255,255,255,0.9); margin-bottom: 1.5rem; line-height:1.7; }
    .hero-text .btn-primary { background: var(--secondary); color: var(--dark); border:none; padding:0.8rem 2rem; border-radius:50px; font-weight:700; cursor:pointer; transition: transform 0.2s, box-shadow 0.2s; }
    .hero-text .btn-primary:hover { transform: translateY(-3px); box-shadow:0 8px 15px rgba(0,0,0,0.2); }

    /* Vendor Card */
    .vendor-detail-card-premium { background: var(--light); border-radius: var(--radius); box-shadow: var(--shadow); padding:2.5rem; max-width:1200px; margin:0 auto 2rem auto; }
    .vendor-profile { display:flex; align-items:center; gap:1.5rem; margin-bottom:2.5rem; padding-bottom:2rem; border-bottom:1px solid #e9ecef; }
    .vendor-image { width:100px; height:100px; border-radius:50%; object-fit:cover; border:4px solid var(--secondary); }
    .vendor-info h1 { font-size:2rem; font-weight:700; color: var(--dark); }
    .vendor-info p { color: var(--gray-dark); margin:0; }
    .vendor-info p i { margin-right:0.5rem; color: var(--primary); }
    .details-section-title { font-size:1.6rem; font-weight:700; color:var(--primary); margin-bottom:1.5rem; padding-bottom:0.75rem; border-bottom:3px solid var(--secondary); display:inline-block; }
    .details-grid { display:grid; grid-template-columns:max-content 1fr; gap:1.2rem 2rem; align-items:center; }
    .details-grid .detail-item-premium { display:contents; }
    .details-grid i { color:var(--primary); font-size:1.2rem; width:30px; text-align:center; }
    .details-grid .detail-label { font-weight:600; color:var(--dark); }
    .details-grid .detail-value { color: var(--gray-dark); }
    .action-buttons { margin-top:2.5rem; display:flex; gap:1rem; }
    .btn-outline { padding:0.8rem 2rem; border:2px solid var(--primary); border-radius:50px; font-weight:600; color:var(--primary); background:transparent; cursor:pointer; transition:all 0.3s; }
    .btn-outline:hover { background:var(--primary); color:var(--light); }
    .suggestions-premium { max-width:1200px; margin:3rem auto; padding:2rem; background:rgba(255,255,255,0.9); backdrop-filter:blur(5px); border-radius:var(--radius); box-shadow:var(--shadow); }
    .suggestions-premium h2 { text-align:center; font-weight:700; color:var(--dark); margin-bottom:2rem; }
    .suggestion-list { display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:1.5rem; }
    .suggestion-card-premium { background:var(--light); border-radius:var(--radius); box-shadow:var(--shadow); text-align:left; transition:all 0.3s ease; text-decoration:none; color:inherit; overflow:hidden; }
    .suggestion-card-premium:hover { transform:translateY(-5px); }
    .suggestion-card-premium .img-wrapper { height:180px; overflow:hidden; }
    .suggestion-card-premium img { width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease; }
    .suggestion-card-premium:hover img { transform:scale(1.05); }
    .suggestion-card-premium .card-content { padding:1rem; }
    .suggestion-card-premium h4 { font-size:1.1rem; color:var(--dark); margin-bottom:0.3rem; font-weight:600; }
    .suggestion-card-premium p { font-size:0.9rem; color:var(--gray-dark); margin:0; }
    .suggestion-card-premium .location { margin-top:0.5rem; }
    .suggestion-card-premium .location i { margin-right:0.3rem; }

    /* Modal */
    .modal-content-premium { border-radius:var(--radius); border:none; overflow:hidden; }
    .modal-info-side { background:var(--primary); color:var(--light); padding:2rem; text-align:center; }
    .modal-info-side img { width:150px; height:150px; border-radius:50%; object-fit:cover; margin-bottom:1rem; border:4px solid var(--secondary); }
    .modal-info-side .price { font-size:2rem; font-weight:700; color:var(--secondary); }
    .modal-payment-side { padding:2rem; }
    .modal-payment-side .form-control { border-radius:8px; border:1px solid #ced4da; padding:0.75rem 1rem; }
    .modal-payment-side .form-control:focus { border-color:var(--primary); box-shadow:0 0 0 0.25rem rgba(10,23,78,0.25); }
    .btn-purchase { background-color:var(--primary); color:var(--light); font-weight:600; padding:0.75rem; border-radius:8px; transition: background-color 0.2s; }
    .btn-purchase:hover { background-color:#001f54; }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="hero-premium" style="background-image: url('{{ $menu->image_url ? asset('storage/' . $menu->image_url) : asset('uploads/defaults/food.png') }}');">
        <div class="hero-text">
            <div class="vendor-tag">{{ ucfirst($menu->food_type) }} • {{ ucfirst($menu->preference) }}</div>
            <h1>{{ $menu->name }}</h1>
            <p>{{ $menu->description ?? 'Delicious meals prepared fresh by ' . $menu->user->name . '. Subscribe now and enjoy quality food every day!' }}</p>
            <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
                <i class="fas fa-shopping-cart"></i> Subscribe Now
            </button>
        </div>
    </div>

    <div class="vendor-detail-card-premium">
        <div class="vendor-profile">
            <img src="{{ $menu->user && $menu->user->profile_pic ? asset('storage/' . $menu->user->profile_pic) : asset('uploads/defaults/profile.png') }}" alt="{{ $menu->user->name }}" class="vendor-image">
            <div class="vendor-info">
                <h1>{{ $menu->user->name }}</h1>
                <p><i class="fas fa-map-marker-alt"></i>{{ $menu->user->location ?? 'Location not available' }}</p>
            </div>
        </div>

        <h2 class="details-section-title">Menu Details</h2>

        <div class="details-grid">
            <div class="detail-item-premium">
                <i class="fas fa-utensils"></i>
                <span class="detail-label">Food Type</span>
                <span class="detail-value">{{ ucfirst($menu->food_type) }}</span>
            </div>
            <div class="detail-item-premium">
                <i class="fas fa-leaf"></i>
                <span class="detail-label">Preference</span>
                <span class="detail-value">{{ ucfirst($menu->preference) }}</span>
            </div>
            <div class="detail-item-premium">
                <i class="fas fa-dollar-sign"></i>
                <span class="detail-label">Monthly Fee</span>
                <span class="detail-value fw-bold">Rs. {{ number_format($menu->monthly_fee, 2) }}</span>
            </div>
            <div class="detail-item-premium">
                <i class="fas fa-calendar-check"></i>
                <span class="detail-label">Start Date</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($menu->start_date)->format('d M, Y') }}</span>
            </div>
            <div class="detail-item-premium">
                <i class="fas fa-calendar-times"></i>
                <span class="detail-label">End Date</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($menu->end_date)->format('d M, Y') }}</span>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Subscribe Now</button>
            <a href="#" class="btn-outline">Share Menu</a>
        </div>
    </div>

    <div class="suggestions-premium">
        <h2>You may also like</h2>
        <div class="suggestion-list">
            @forelse($suggestions as $s)
            <a href="{{ route('vendor.details', $s->menu_id) }}" class="suggestion-card-premium">
                <div class="img-wrapper">
                    <img src="{{ $s->image_url ? asset('storage/' . $s->image_url) : asset('uploads/defaults/food.png') }}" alt="{{ $s->name }}">
                </div>
                <div class="card-content">
                    <h4>{{ $s->name }}</h4>
                    <p>by {{ $s->user->name }}</p>
                    <p class="location"><i class="fas fa-map-marker-alt"></i>{{ $s->user->location ?? 'Unknown Location' }}</p>
                </div>
            </a>
            @empty
                <p>No other suggestions found.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <form action="{{ route('subscribe.vendor', $menu->menu_id) }}" method="POST">
                @csrf
                <div class="row g-0">
                    <div class="col-lg-5 modal-info-side d-flex flex-column justify-content-center">
                        <img src="{{ $menu->image_url ? asset('storage/' . $menu->image_url) : asset('uploads/defaults/food.png') }}" alt="{{ $menu->name }}">
                        <h5 class="fw-bold mb-2">{{ $menu->name }}</h5>
                        <p class="small text-white-50 mb-3">{{ ucfirst($menu->food_type) }} • {{ ucfirst($menu->preference) }}</p>
                        <p class="price">Rs. {{ number_format($menu->monthly_fee, 2) }}</p>
                    </div>

                    <div class="col-lg-7 modal-payment-side">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold m-0">Subscription Payment</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cardholder Name</label>
                            <input type="text" name="cardholder" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <input type="text" name="card_number" class="form-control" placeholder="4242 4242 4242 4242" required>
                            <small id="cardTypeLabel" class="text-muted mt-1 d-block">Card Type: Unknown</small>
                        </div>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label class="form-label">Expiry (MM/YY)</label>
                                <input type="text" name="expiry" class="form-control" placeholder="12/34" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label">CVC</label>
                                <input type="text" name="cvc" class="form-control" placeholder="123" required>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-between mb-4 fw-bold">
                            <span>Total Due</span>
                            <span>Rs. {{ number_format($menu->monthly_fee, 2) }}</span>
                        </div>
                        <button type="submit" class="btn btn-purchase w-100 py-2">
                            <i class="fas fa-lock"></i> Secure Purchases
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelector('input[name="card_number"]').addEventListener('input', function() {
    const val = this.value.replace(/\s+/g, '');
    const label = document.getElementById('cardTypeLabel');
    let type = 'Unknown';
    if(/^4/.test(val)) type = 'Visa';
    else if(/^5[1-5]/.test(val)) type = 'MasterCard';
    else if(/^3[47]/.test(val)) type = 'American Express';
    else if(/^6/.test(val)) type = 'Discover';
    label.textContent = 'Card Type: ' + type;
});
</script>
@endpush
@endsection
