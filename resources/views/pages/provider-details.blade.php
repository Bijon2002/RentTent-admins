@extends('layout.master_entity')

@section('title', $boarding->title . ' - Boarding Details')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #0a174e;
    --secondary: #FF9800;
    --radius: 12px;
    --shadow: 0 10px 30px rgba(0,0,0,0.08);
}
body { font-family: 'Poppins', sans-serif; background:#f5f5f5; }

/* Hero */
.hero-boarding {
    position:relative;
    padding:6rem 2rem;
    border-radius:var(--radius);
    background-size:cover;
    background-position:center;
    color:#fff;
    margin-bottom:2rem;
    box-shadow:var(--shadow);
}
.hero-boarding::before {
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(135deg,rgba(10,23,78,0.85),rgba(0,0,0,0.7));
    z-index:1;
}
.hero-text { position:relative; z-index:2; max-width:600px; }
.hero-text h1 { font-size:2.8rem; font-weight:700; }
.hero-text p { opacity:.9; margin-bottom:1.2rem; line-height:1.6; }

/* Image Gallery */
.image-gallery {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding: 10px 0;
    scroll-snap-type: x mandatory;
}
.image-gallery::-webkit-scrollbar { height: 8px; }
.image-gallery::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
.gallery-item {
    flex: 0 0 auto;
    width: 280px;
    height: 280px; /* Square */
    border-radius: 12px;
    overflow: hidden;
    scroll-snap-align: start;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.gallery-item img { width:100%; height:100%; object-fit:cover; }

/* Boarding Info */
.boarding-detail-card {
    background:#fff;
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    padding:2.5rem;
    max-width:1000px;
    margin:0 auto 3rem;
    position: relative;
}
.details-section-title {
    font-size:1.6rem;
    font-weight:700;
    color:var(--primary);
    margin-bottom:1.5rem;
    border-bottom:3px solid var(--secondary);
    display:inline-block;
}
.details-columns { display:grid; grid-template-columns:1fr 1fr; gap:2rem; }
.detail-group { display:grid; grid-template-columns:max-content 1fr; gap:1rem 1.5rem; }
.detail-label { font-weight:600; color:#2c3e50; }
.detail-value { color:#6c757d; }
.status-badge { padding:.4rem .8rem; border-radius:20px; font-weight:600; font-size:.9rem; }
.status-available{ background:#e8f5e9; color:#2e7d32; }
.status-unavailable{ background:#ffebee; color:#c62828; }

/* Heart Icon */
.favorite-icon { position:absolute; top:20px; right:20px; font-size:1.8rem; color:#c62828; cursor:pointer; transition:0.3s; }
.favorite-icon:hover { transform: scale(1.2); }

/* Modal */
.modal-content-premium { border-radius:var(--radius); border:none; overflow:hidden; }
.modal-info-side { background:var(--primary); color:#fff; padding:2rem; text-align:center; }
.modal-info-side img { width:150px; height:150px; border-radius:50%; object-fit:cover; margin-bottom:1rem; border:4px solid var(--secondary); }
.modal-info-side .price { font-size:2rem; font-weight:700; color:var(--secondary); }
.modal-payment-side { padding:2rem; }
.modal-payment-side .form-control { border-radius:8px; border:1px solid #ced4da; padding:0.75rem 1rem; }
.modal-payment-side .form-control:focus { border-color:var(--primary); box-shadow:0 0 0 0.25rem rgba(10,23,78,0.25); }
.btn-purchase, .btn-book { font-weight:600; padding:0.75rem; border-radius:8px; transition: background-color 0.2s; width:48%; }
.btn-purchase { background-color:var(--primary); color:#fff; }
.btn-purchase:hover { background-color:#001f54; }
.btn-book { background-color:#FF9800; color:#0a174e; border:none; }
.btn-book:hover { background-color:#e68900; }
.note-text { font-size:0.9rem; color:#6c757d; margin-bottom:1rem; }
</style>
@endpush

@section('content')
<div class="container py-5">

    <!-- Hero -->
    <div class="hero-boarding" style="background-image:url('{{ optional($boarding->photos->first())->image_url ? asset('storage/'.$boarding->photos->first()->image_url) : asset('uploads/defaults/boarding.jpg') }}');">
        <div class="hero-text">
            <h1>{{ $boarding->title }}</h1>
            <p>{{ $boarding->description ?? 'Safe, affordable and comfortable boarding space available.' }}</p>
            <span class="status-badge {{ $boarding->availability_status == 'available' ? 'status-available' : 'status-unavailable' }}">
                {{ ucfirst($boarding->availability_status) }}
            </span>
        </div>
    </div>

    <!-- Square Image Gallery -->
    @if($boarding->photos->count() > 0)
    <div class="image-gallery">
        @foreach($boarding->photos as $photo)
            <div class="gallery-item">
                <img src="{{ asset('storage/'.$photo->image_url) }}" alt="Boarding Photo">
            </div>
        @endforeach
    </div>
    @endif

    <!-- Boarding Details -->
    <div class="boarding-detail-card">
        <i class="fas fa-heart favorite-icon"></i>
        <h2 class="details-section-title">Boarding Information</h2>
        <div class="details-columns">
            <!-- LEFT COLUMN -->
            <div class="detail-group">
                <div class="detail-label">📍 Location</div>
                <div class="detail-value">{{ $boarding->location }}</div>
                <div class="detail-label">💰 Monthly Rent</div>
                <div class="detail-value">Rs. {{ number_format($boarding->monthly_rent, 2) }}</div>
                <div class="detail-label">🚪 Room Type</div>
                <div class="detail-value">{{ ucfirst($boarding->room_type) }}</div>
                <div class="detail-label">📐 Room Size</div>
                <div class="detail-value">{{ $boarding->room_size ?? 'N/A' }} sq.ft</div>
                <div class="detail-label">🍴 Food Included</div>
                <div class="detail-value">{{ $boarding->is_food_included ? 'Yes' : 'No' }}</div>
                <div class="detail-label">🚻 Gender Preference</div>
                <div class="detail-value">{{ ucfirst($boarding->gender_preference) }}</div>
                <div class="detail-label">📊 Advance</div>
                <div class="detail-value">{{ $boarding->advance_percent ?? 0 }}%</div>
                <div class="detail-label">🔄 Refundable</div>
                <div class="detail-value">{{ $boarding->is_refundable ? 'Yes' : 'No' }}</div>
                <div class="detail-label">📶 WiFi</div>
                <div class="detail-value">{{ $boarding->wifi ? 'Yes' : 'No' }}</div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="detail-group">
                <div class="detail-label">🚗 Parking</div>
                <div class="detail-value">{{ $boarding->parking ? 'Yes' : 'No' }}</div>
                <div class="detail-label">🧺 Laundry</div>
                <div class="detail-value">{{ $boarding->laundry ? 'Yes' : 'No' }}</div>
                <div class="detail-label">🚿 Attached Bathroom</div>
                <div class="detail-value">{{ $boarding->attached_bathroom ? 'Yes' : 'No' }}</div>
                <div class="detail-label">🛋 Furnished</div>
                <div class="detail-value">{{ $boarding->furnished ? 'Yes' : 'No' }}</div>
                <div class="detail-label">📄 Property Document</div>
                <div class="detail-value">
                    @if($boarding->property_doc_image)
                        <a href="{{ asset('storage/'.$boarding->property_doc_image) }}" target="_blank">View</a>
                    @else N/A @endif
                </div>
                <div class="detail-label">🛡 Police Report</div>
                <div class="detail-value">
                    @if($boarding->police_report_image)
                        <a href="{{ asset('storage/'.$boarding->police_report_image) }}" target="_blank">View</a>
                    @else N/A @endif
                </div>
                <div class="detail-label">📑 Privacy Policy</div>
                <div class="detail-value">{{ $boarding->privacy_policy ?? 'N/A' }}</div>
                <div class="detail-label">📅 Posted Date</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($boarding->posted_date)->format('d M, Y') }}</div>
                <div class="detail-label">⭐ Trust Score</div>
                <div class="detail-value">{{ $boarding->trust_score ?? 0 }}</div>
                <div class="detail-label">⚡ Availability</div>
                <div class="detail-value">{{ ucfirst($boarding->availability_status) }}</div>
            </div>
        </div>

        <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#paymentModal">
            Reserve Now
        </button>
    </div>
</div>

{{-- Payment Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-premium">
            <form action="{{ route('booking.reserve', $boarding->boarding_id) }}" method="POST">
                @csrf
                <div class="row g-0">
                    <div class="col-lg-5 modal-info-side d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ optional($boarding->photos->first())->image_url ? asset('storage/'.$boarding->photos->first()->image_url) : asset('uploads/defaults/boarding.jpg') }}" alt="{{ $boarding->title }}">
                        <h5 class="fw-bold mb-2">{{ $boarding->title }}</h5>
                        <p class="small text-white-50 mb-3">{{ $boarding->location }}</p>
                        <p class="price">Rs. {{ number_format($boarding->monthly_rent,2) }}</p>
                        <p class="note-text">💡 10% of rent is a non-refundable reservation fee.<br>
                        💡 40% of the first rent paid via this app increases the trust score of this boarding.</p>
                    </div>
                    <div class="col-lg-7 modal-payment-side">
                        <h4 class="fw-bold mb-4">Enter Card Details</h4>
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
                            <span>Rs. {{ number_format($boarding->monthly_rent * 0.1,2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn-purchase">
                                <i class="fas fa-lock"></i> Pay Now
                            </button>
                            <a href="{{ route('booking.booknow', $boarding->boarding_id) }}" class="btn-book">
                                <i class="fas fa-calendar-check"></i> Book Now
                            </a>
                        </div>
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
    if(/^4/.test(val)) type='Visa';
    else if(/^5[1-5]/.test(val)) type='MasterCard';
    else if(/^3[47]/.test(val)) type='American Express';
    else if(/^6/.test(val)) type='Discover';
    label.textContent = 'Card Type: ' + type;
});
</script>
@endpush
