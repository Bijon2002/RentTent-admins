@extends('Layout.master_dash')

@section('content')

{{-- Card hover effect --}}
<style>
    .booking-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
</style>

<div class="container-fluid p-3 p-md-4">

    {{-- Page Title --}}
    <div class="d-flex justify-content-center">
        <div class="mx-auto p-4 bg-white rounded-3 shadow-sm" style="max-width:880px; margin-top:3cm; color:#0b1720;">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <h2 class="fw-bold mb-1 text-dark">My Booked Boardings</h2>
                    <p class="mb-0 text-dark" style="opacity:0.8;">Review, manage, or cancel your active boarding bookings here.</p>
                </div>
                <div>
                    <button id="sidebarToggle" type="button" class="btn btn-link p-0" style="color: #0b1720; border:none; text-decoration:none;" aria-label="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div style="height:0.5cm;"></div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Booking Cards --}}
    <div class="row g-4">
        @forelse($bookings as $booking)
            @if($booking->boarding)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="glass-card d-flex flex-column p-3 h-100 booking-card">

                        {{-- Boarding Image with fallback --}}
                        @php
                            $imagePath = $booking->boarding->image_url;
                            $storageFile = public_path('storage/'.$imagePath);
                        @endphp

                        <img src="{{ $imagePath && file_exists($storageFile) 
                                    ? asset('storage/'.$imagePath) 
                                    : 'https://via.placeholder.com/300x160?text=No+Image' }}" 
                             class="rounded-3 mb-3" 
                             style="width:100%; height:160px; object-fit:cover;"
                             alt="{{ $booking->boarding->title }}">

                        <div class="d-flex flex-column flex-grow-1">
                            {{-- Title & Location --}}
                            <div class="mb-2">
                                <h5 class="fw-bold mb-0">{{ $booking->boarding->title }}</h5>
                                <small class="text-muted">{{ $booking->boarding->location }}</small>
                            </div>

                            {{-- Status Badge --}}
                            @php
                                $status = strtolower($booking->status ?? 'pending');
                                $badgeClass = match($status) {
                                    'confirmed', 'active' => 'success',
                                    'pending' => 'warning',
                                    default => 'secondary',
                                };
                            @endphp
                            <div>
                                <span class="badge rounded-pill bg-{{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </div>
                            
                            <hr class="my-3">

                            {{-- Booking Details --}}
                            <div class="mb-3 small">
                                <p class="mb-1"><strong>Status:</strong> {{ ucfirst($status) }}</p>
                                <p class="mb-0"><strong>Booked On:</strong> {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</p>
                            </div>

                            {{-- Cancel Button --}}
                            <div class="mt-auto">
                                @if($status === 'confirmed' || $status === 'active')
                                    <button type="button" class="btn btn-danger w-100" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#cancelBookingModal" 
                                            data-action="{{ route('booking.cancel', $booking->id) }}">
                                        Cancel Booking
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-12 text-center p-5">
                <div class="glass-card p-4">
                    <img src="https://img.icons8.com/ios/100/000000/nothing-found.png" alt="No Bookings" class="mb-3"/>
                    <h4 class="fw-bold">No Bookings Found!</h4>
                    <p class="text-muted">It looks like you haven't booked any boardings yet.<br>Ready to find a great place?</p>
                    <a href="{{ route('boardings.index') }}" class="btn btn-primary mt-3">✨ Explore Boardings</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- Cancel Booking Modal --}}
<div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="cancelBookingForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Cancel Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Are you sure you want to cancel this booking? Please select a reason below.</p>
                    <select name="cancellation_reason" class="form-select" required>
                        <option value="" disabled selected>-- Select a reason --</option>
                        <option value="change_of_plans">My plans have changed</option>
                        <option value="found_another_place">I found a different place</option>
                        <option value="not_satisfied">I'm not satisfied with the details</option>
                        <option value="other">Other</option>
                    </select>
                    <textarea name="other_reason_details" class="form-control mt-2" placeholder="Please provide more details (optional)"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Booking</button>
                    <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cancelModal = document.getElementById('cancelBookingModal');
    const cancelForm = document.getElementById('cancelBookingForm');

    cancelModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');
        cancelForm.action = action;
    });
});
</script>
@endpush
