@extends('layouts.master')

@section('title', 'RentTent Admin Dashboard')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  @include('includes.slideshow')

  <div style="display: flex; gap: 3rem; margin-top: 3rem;">
    {{-- Recent Activities --}}
    <div style="flex: 1; background: var(--card-bg); padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid rgba(74,107,255,0.1); overflow-y: auto; max-height: 400px;">
      <div class="section-header">
        <h2>Recent Activities</h2>
      </div>
      <div class="activities-list">
        <div class="activity">
          <div class="activity-content">New booking for Koramangala Premium by Priya Sharma</div>
          <div class="activity-time">2 minutes ago</div>
        </div>
        <div class="activity">
          <div class="activity-content">Property verification completed for HSR Layout Studio</div>
          <div class="activity-time">15 minutes ago</div>
        </div>
        <div class="activity">
          <div class="activity-content">Payment received ₹18,000 from Arjun Patel</div>
          <div class="activity-time">1 hour ago</div>
        </div>
        <div class="activity">
          <div class="activity-content">Maintenance request reported for Whitefield Co-living</div>
          <div class="activity-time">2 hours ago</div>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div style="flex: 1; background: var(--card-bg); padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border: 1px solid rgba(74,107,255,0.1);">
      <div class="section-header">
        <h2>Quick Actions</h2>
      </div>
      <div class="action-buttons" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <button class="action-btn" onclick="openModal('add-property')">
          <span>🏠</span> Add Property
        </button>
        <button class="action-btn" onclick="openModal('verify-user')">
          <span>👤</span> Verify User
        </button>
        <button class="action-btn" onclick="openModal('schedule-inspection')">
          <span>📅</span> Schedule Inspection
        </button>
        <button class="action-btn" onclick="openModal('send-announcement')">
          <span>📢</span> Send Announcement
        </button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Your slideshow & modal JS here (same as original)
</script>
@endpush
