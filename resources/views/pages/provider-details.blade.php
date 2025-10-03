@extends('layout.master_entity')

@section('title', $boarding->title . ' - Boarding Details')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

<style>
:root {
    --primary: #0a174e;
    --secondary: #FF9800;
    --radius: 12px;
    --shadow: 0 10px 30px rgba(0,0,0,0.08);
}
body { font-family: 'Poppins', sans-serif; background:#f5f5f5; }

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
.btn-primary {
    background:var(--secondary);
    color:#0a174e;
    border:none;
    padding:.8rem 2rem;
    border-radius:50px;
    font-weight:700;
    cursor:pointer;
    margin-top:1rem;
}

.boarding-detail-card {
    background:#fff;
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    padding:2.5rem;
    max-width:1000px;
    margin:0 auto 3rem;
}
.details-section-title {
    font-size:1.6rem;
    font-weight:700;
    color:var(--primary);
    margin-bottom:1.5rem;
    border-bottom:3px solid var(--secondary);
    display:inline-block;
}
.details-grid { display:grid; grid-template-columns:max-content 1fr; gap:1.2rem 2rem; align-items:center; }
.details-grid .detail-label { font-weight:600; color:#2c3e50; }
.details-grid .detail-value { color:#6c757d; }
.status-badge { padding:.4rem .8rem; border-radius:20px; font-weight:600; font-size:.9rem; }
.status-available{ background:#e8f5e9; color:#2e7d32; }
.status-unavailable{ background:#ffebee; color:#c62828; }

.slider img { width:100%; height:400px; object-fit:cover; border-radius:var(--radius); }
.slider { margin-bottom:2rem; }
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

    <!-- Image Slider -->
    @if($boarding->photos->count() > 0)
    <div class="slider">
        @foreach($boarding->photos as $photo)
            <div><img src="{{ asset('storage/'.$photo->image_url) }}" alt="Boarding Photo"></div>
        @endforeach
    </div>
    @endif

    <!-- Boarding Details -->
    <div class="boarding-detail-card">
        <h2 class="details-section-title">Boarding Information</h2>
        <div class="details-grid">
            <div class="detail-label"><i class="fas fa-map-marker-alt"></i> Location</div>
            <div class="detail-value">{{ $boarding->location }}</div>

            <div class="detail-label"><i class="fas fa-tag"></i> Monthly Rent</div>
            <div class="detail-value">Rs. {{ number_format($boarding->monthly_rent, 2) }}</div>

            <div class="detail-label"><i class="fas fa-door-closed"></i> Room Type</div>
            <div class="detail-value">{{ ucfirst($boarding->room_type) }}</div>

            <div class="detail-label"><i class="fas fa-ruler-combined"></i> Room Size</div>
            <div class="detail-value">{{ $boarding->room_size ?? 'N/A' }} sq.ft</div>

            <div class="detail-label"><i class="fas fa-utensils"></i> Food Included</div>
            <div class="detail-value">{{ $boarding->is_food_included ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-venus-mars"></i> Gender Preference</div>
            <div class="detail-value">{{ ucfirst($boarding->gender_preference) }}</div>

            <div class="detail-label"><i class="fas fa-percent"></i> Advance</div>
            <div class="detail-value">{{ $boarding->advance_percent ?? 0 }}%</div>

            <div class="detail-label"><i class="fas fa-undo"></i> Refundable</div>
            <div class="detail-value">{{ $boarding->is_refundable ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-wifi"></i> WiFi</div>
            <div class="detail-value">{{ $boarding->wifi ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-car"></i> Parking</div>
            <div class="detail-value">{{ $boarding->parking ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-bath"></i> Laundry</div>
            <div class="detail-value">{{ $boarding->laundry ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-bath"></i> Attached Bathroom</div>
            <div class="detail-value">{{ $boarding->attached_bathroom ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-couch"></i> Furnished</div>
            <div class="detail-value">{{ $boarding->furnished ? 'Yes' : 'No' }}</div>

            <div class="detail-label"><i class="fas fa-file-alt"></i> Property Document</div>
            <div class="detail-value">
                @if($boarding->property_doc_image)
                    <a href="{{ asset('storage/'.$boarding->property_doc_image) }}" target="_blank">View</a>
                @else N/A @endif
            </div>

            <div class="detail-label"><i class="fas fa-shield-alt"></i> Police Report</div>
            <div class="detail-value">
                @if($boarding->police_report_image)
                    <a href="{{ asset('storage/'.$boarding->police_report_image) }}" target="_blank">View</a>
                @else N/A @endif
            </div>

            <div class="detail-label"><i class="fas fa-file-contract"></i> Privacy Policy</div>
            <div class="detail-value">{{ $boarding->privacy_policy ?? 'N/A' }}</div>

            <div class="detail-label"><i class="fas fa-calendar-plus"></i> Posted Date</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($boarding->posted_date)->format('d M, Y') }}</div>

            <div class="detail-label"><i class="fas fa-star"></i> Trust Score</div>
            <div class="detail-value">{{ $boarding->trust_score ?? 0 }}</div>

            <div class="detail-label"><i class="fas fa-bolt"></i> Availability</div>
            <div class="detail-value">{{ ucfirst($boarding->availability_status) }}</div>
        </div>

        <form action="{{ route('booking.reserve', $boarding->boarding_id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Reserve Now</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
$(document).ready(function(){
    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        adaptiveHeight: true
    });
});
</script>
@endpush
