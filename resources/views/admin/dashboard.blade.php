@extends('layouts.master')

@section('title', 'RentTent Admin Dashboard')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  <div class="dashboard-flex-wrap">
    <div class="dashboard-graphs-col">
      @include('includes.slideshow')
    </div>
    <div class="dashboard-activities-col">
      <div class="section-header" style="margin-bottom: 1rem;">
        <h2 style="font-size: 1.15rem; letter-spacing: 0.5px;">Recent Activities</h2>
      </div>
  <marquee behavior="scroll" direction="up" scrollamount="3" style="height: 320px; display: block; padding: 0 0.5rem; color: red;">
        @forelse($recentBookings as $booking)
          <span style="display: block; margin-bottom: 1.2rem;">
            <strong>New booking for {{ $booking->boarding->title ?? 'Unknown Property' }}</strong> by {{ $booking->user->name ?? 'Unknown User' }}<br>
            <small>Amount: ${{ number_format($booking->amount, 2) }} | Status: {{ ucfirst($booking->status) }} | {{ $booking->created_at->diffForHumans() }}</small>
          </span>
        @empty
          <span style="display: block; margin-bottom: 1.2rem;">No recent bookings found</span>
        @endforelse
        @if($recentUsers->count() > 0)
          <span style="display: block; margin-bottom: 1.2rem;">
            <strong>Recent User Registrations:</strong>
            @foreach($recentUsers as $user)
              <br><small>{{ $user->name }} ({{ $user->role }}) - {{ $user->created_at->diffForHumans() }}</small>
            @endforeach
            <br><span style="color: #4a6bff; font-size: 0.95em;">Live data</span>
          </span>
        @endif
      </marquee>
    </div>
  </div>

  <style>
    .dashboard-flex-wrap {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 2.5rem;
      margin-top: 2.5rem;
      flex-wrap: wrap;
    }
    .dashboard-graphs-col {
      flex: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 320px;
      max-width: 900px;
      width: 100%;
    }
    .dashboard-activities-col {
      flex: 1;
      min-width: 320px;
      max-width: 400px;
      background: var(--card-bg);
      border-radius: 0.75rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      border: 1px solid rgba(74,107,255,0.1);
      padding: 1.5rem;
      margin-top: 0;
    }
    @media (max-width: 1024px) {
      .dashboard-flex-wrap {
        flex-direction: column;
        align-items: stretch;
        gap: 2rem;
      }
      .dashboard-graphs-col, .dashboard-activities-col {
        max-width: 100%;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
      }
      .dashboard-activities-col {
        margin-top: 0;
      }
      /* The .charts-container and .quick-stats-grid are now self-responsive */
    }
    @media (max-width: 700px) {
      .dashboard-flex-wrap {
        gap: 1.2rem;
        margin-top: 1.2rem;
      }
      .dashboard-activities-col {
        padding: 1rem;
      }
    }
  </style>
@endsection

@push('scripts')
<script>
  // Your slideshow & modal JS here (same as original)
</script>
@endpush
