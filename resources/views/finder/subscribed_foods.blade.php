@extends('Layout.master_dash')

@section('content')

{{-- sidebar toggle will be placed next to the heading below --}}

<style>
    /* Subtle hover effect for subscription cards */
    .subscription-card:hover {
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
                    <h2 class="fw-bold mb-1 text-dark">Manage Your Subscriptions</h2>
                    <p class="mb-0 text-dark" style="opacity:0.8;">Review, manage, or cancel your active food plans here.</p>
                </div>

                <!-- Sidebar toggle placed at header top-right -->
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
    <!-- small spacer between header and content -->
    <div style="height:0.5cm;"></div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $hasVisibleSubscriptions = $subscriptions->contains(fn($sub) => !is_null($sub->vendor));
    @endphp

    <div class="row g-4">
        @if($hasVisibleSubscriptions)
            @foreach($subscriptions as $sub)
                @if($sub->vendor)
                    {{-- UI CHANGE: Added col-xl-3 to make cards smaller on extra-large screens --}}
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="glass-card d-flex flex-column p-3 h-100 subscription-card">

                            {{-- Vendor Image - UI CHANGE: Reduced height for a more compact card --}}
                            <img src="{{ asset('storage/'.$sub->vendor->image_url) }}" 
                                 class="rounded-3 mb-3" 
                                 style="width:100%; height:160px; object-fit:cover;"
                                 alt="{{ $sub->vendor->name }}">

                            <div class="d-flex flex-column flex-grow-1">
                                {{-- Vendor Name & Type --}}
                                <div class="mb-2">
                                    <h5 class="fw-bold mb-0">{{ $sub->vendor->name }}</h5>
                                    <small class="text-muted">{{ $sub->vendor->food_type }}</small>
                                </div>

                                {{-- Status Badge --}}
                                @php
                                    $status = strtolower($sub->status);
                                    $badgeClass = match($status) {
                                        'active' => 'success',
                                        'pending' => 'warning',
                                        default => 'secondary',
                                    };
                                @endphp
                                <div>
                                    <span class="badge rounded-pill bg-{{ $badgeClass }}">{{ ucfirst($sub->status) }}</span>
                                </div>
                                
                                <hr class="my-3">

                                {{-- Subscription Details --}}
                                <div class="mb-3 small">
                                    <p class="mb-1"><strong>Plan:</strong> {{ $sub->plan->name ?? 'Standard Plan' }}</p>
                                    <p class="mb-0"><strong>Subscribed On:</strong> {{ \Carbon\Carbon::parse($sub->created_at)->format('M d, Y') }}</p>
                                </div>

                                {{-- Cancel Button --}}
                                <div class="mt-auto">
                                    @if($status === 'active')
                                        <button type="button" class="btn btn-danger w-100 cancel-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cancelSubscriptionModal" 
                                                data-action="{{ route('subscription.cancel', $sub->id) }}">
                                            Cancel Subscription
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            {{-- Empty State --}}
            <div class="col-12 text-center p-5">
                <div class="glass-card p-4">
                    <img src="https://img.icons8.com/ios/100/000000/nothing-found.png" alt="No Subscriptions" class="mb-3"/>
                    <h4 class="fw-bold">No Subscriptions Found!</h4>
                    <p class="text-muted">It looks like you haven't subscribed to any food plans yet.<br>Ready to find your next favorite meal?</p>
                    <a href="{{ route('foodplans.index') }}" class="btn btn-primary mt-3">✨ Explore Food Plans</a>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Modal for Canceling Subscription --}}
<div class="modal fade" id="cancelSubscriptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="cancelSubscriptionForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Cancel Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Are you sure you want to cancel? Please select a reason below.</p>
                    <select name="cancellation_reason" class="form-select" required>
                        <option value="" disabled selected>-- Select a reason --</option>
                        <option value="too_expensive">It's too expensive</option>
                        <option value="not_satisfied">I'm not satisfied with the food</option>
                        <option value="change_of_plans">My plans have changed</option>
                        <option value="other">Other</option>
                    </select>
                    <textarea name="other_reason_details" class="form-control mt-2" placeholder="Please provide more details (optional)"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Subscription</button>
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
    const cancelModal = document.getElementById('cancelSubscriptionModal');
    const cancelForm = document.getElementById('cancelSubscriptionForm');

    // ✅ Dynamically set DELETE route on modal show
    cancelModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');
        cancelForm.action = action;
        console.log('Cancel form action set to:', cancelForm.action);
    });
});
</script>
@endpush