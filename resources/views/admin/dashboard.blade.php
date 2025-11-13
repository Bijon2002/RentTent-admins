@extends('layouts.master')

@section('title', 'RentTent Admin Dashboard')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  {{-- Stunning Responsive Dashboard --}}
  <div class="dashboard-container">
    <div class="dashboard-master-grid">
      <div class="dashboard-main-content">
        @include('includes.slideshow')
      </div>
      <div class="dashboard-sidebar">
        <div class="activities-card">
          <div class="activities-header">
            <div class="header-icon-wrapper">
              <i class="bi bi-activity"></i>
            </div>
            <h2>Recent Activities</h2>
            <div class="activity-count">{{ $recentBookings->count() + $recentUsers->count() }}</div>
          </div>
          <div class="activities-scroll">
          @forelse($recentBookings as $booking)
            <div class="activity-item">
              <div class="activity-icon">📋</div>
              <div class="activity-content">
                <strong>{{ $booking->boarding->title ?? 'Unknown Property' }}</strong>
                <p>by {{ $booking->user->name ?? 'Unknown User' }}</p>
                <div class="activity-meta">
                  <span class="badge badge-amount">${{ number_format($booking->amount, 2) }}</span>
                  <span class="badge badge-{{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</span>
                  <span class="activity-time">{{ $booking->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          @empty
            <div class="activity-item empty-state">
              <i class="bi bi-inbox" style="font-size: 2.5rem; opacity: 0.3; margin-bottom: 0.5rem;"></i>
              <p>No recent bookings found</p>
            </div>
          @endforelse
          
          @if($recentUsers->count() > 0)
            <div class="activity-section-divider">
              <span>👥 Recent Registrations</span>
            </div>
            @foreach($recentUsers as $user)
              <div class="activity-item user-item">
                <div class="activity-icon">👤</div>
                <div class="activity-content">
                  <strong>{{ $user->name }}</strong>
                  <p>Role: {{ ucfirst($user->role) }}</p>
                  <span class="activity-time">{{ $user->created_at->diffForHumans() }}</span>
                </div>
              </div>
            @endforeach
          @endif
        </div>
        <div class="live-indicator">
          <span class="pulse-dot"></span>
          <span>Live data</span>
        </div>
      </div>
    </div>
  </div>
  </div>

  <style>
    /* ========================================
       🎨 ULTRA-RESPONSIVE DASHBOARD STYLES
       ======================================== */
    
    .dashboard-container {
      width: 100%;
      max-width: 100%;
      margin: 0 auto;
      padding: 0;
    }

    .dashboard-master-grid {
      display: grid;
      grid-template-columns: minmax(0, 1fr) 420px;
      gap: 2.5rem;
      margin-top: 2rem;
      width: 100%;
      align-items: start;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .dashboard-main-content {
      min-width: 0;
      width: 100%;
    }

    .dashboard-sidebar {
      position: sticky;
      top: 1.5rem;
      max-height: calc(100vh - 3rem);
      animation: fadeInRight 0.6s ease-out 0.2s both;
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .activities-card {
      background: var(--card-bg);
      border-radius: 1.25rem;
      box-shadow: 
        0 10px 40px rgba(0,0,0,0.15),
        0 2px 8px rgba(0,0,0,0.1),
        inset 0 1px 0 rgba(255,255,255,0.1);
      border: 1px solid rgba(74,107,255,0.2);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      height: 100%;
      max-height: calc(100vh - 3rem);
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }

    .activities-card:hover {
      transform: translateY(-2px);
      box-shadow: 
        0 15px 50px rgba(0,0,0,0.2),
        0 5px 15px rgba(0,0,0,0.15);
    }

    .activities-header {
      padding: 1.5rem 2rem;
      border-bottom: 2px solid rgba(74,107,255,0.15);
      background: linear-gradient(135deg, 
        rgba(74,107,255,0.08), 
        rgba(74,107,255,0.03));
      display: flex;
      align-items: center;
      gap: 1rem;
      position: relative;
      overflow: hidden;
    }

    .activities-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, 
        transparent, 
        rgba(255,255,255,0.1), 
        transparent);
      animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
      100% { left: 100%; }
    }

    .header-icon-wrapper {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
      animation: pulse-icon 2s ease-in-out infinite;
      position: relative;
      z-index: 1;
    }

    .header-icon-wrapper i {
      color: white;
      font-size: 1.25rem;
    }

    @keyframes pulse-icon {
      0%, 100% { 
        transform: scale(1); 
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); 
      }
      50% { 
        transform: scale(1.05); 
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6); 
      }
    }

    .activities-header h2 {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--text);
      margin: 0;
      letter-spacing: -0.02em;
      flex: 1;
      background: linear-gradient(135deg, var(--text), var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      position: relative;
      z-index: 1;
    }

    .activity-count {
      min-width: 32px;
      height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-weight: 700;
      box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
      animation: pop-in 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      position: relative;
      z-index: 1;
    }

    @keyframes pop-in {
      0% { transform: scale(0); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }

    .activities-scroll {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 1.5rem;
      scroll-behavior: smooth;
    }

    .activities-scroll::-webkit-scrollbar {
      width: 8px;
    }

    .activities-scroll::-webkit-scrollbar-track {
      background: rgba(74,107,255,0.05);
      border-radius: 10px;
      margin: 8px 0;
    }

    .activities-scroll::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
      border-radius: 10px;
      transition: background 0.3s;
    }

    .activities-scroll::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #764ba2 0%, #667eea 100%);
    }

    .activity-item {
      display: flex;
      gap: 1.25rem;
      padding: 1.25rem;
      margin-bottom: 1rem;
      background: rgba(255,255,255,0.04);
      border-radius: 1rem;
      border-left: 4px solid transparent;
      background-image: linear-gradient(rgba(255,255,255,0.04), rgba(255,255,255,0.04)),
                        linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      background-origin: border-box;
      background-clip: padding-box, border-box;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      animation: slideInRight 0.5s ease backwards;
      position: relative;
      overflow: hidden;
    }

    .activity-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, 
        transparent, 
        rgba(255,255,255,0.05), 
        transparent);
      transition: left 0.5s ease;
    }

    .activity-item:hover::before {
      left: 100%;
    }

    .activity-item:hover {
      background: rgba(102,126,234,0.1);
      transform: translateX(8px) scale(1.02);
      box-shadow: 
        0 8px 25px rgba(74,107,255,0.2),
        inset 0 1px 0 rgba(255,255,255,0.1);
      border-left-width: 6px;
    }

    .activity-item:nth-child(1) { animation-delay: 0.1s; }
    .activity-item:nth-child(2) { animation-delay: 0.2s; }
    .activity-item:nth-child(3) { animation-delay: 0.3s; }
    .activity-item:nth-child(4) { animation-delay: 0.4s; }
    .activity-item:nth-child(5) { animation-delay: 0.5s; }

    .activity-item.empty-state {
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 4rem 2rem;
      border-left: none;
      text-align: center;
      background: rgba(255,255,255,0.02);
      border: 2px dashed rgba(74,107,255,0.2);
    }

    .activity-icon {
      font-size: 2rem;
      flex-shrink: 0;
      width: 52px;
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, rgba(102,126,234,0.2), rgba(118,75,162,0.1));
      border-radius: 50%;
      box-shadow: 0 4px 12px rgba(102,126,234,0.2);
      transition: all 0.3s ease;
      position: relative;
    }

    .activity-icon::after {
      content: '';
      position: absolute;
      inset: -2px;
      border-radius: 50%;
      padding: 2px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .activity-item:hover .activity-icon {
      transform: rotate(10deg) scale(1.1);
      box-shadow: 0 6px 20px rgba(102,126,234,0.4);
    }

    .activity-item:hover .activity-icon::after {
      opacity: 1;
    }

    .activity-content {
      flex: 1;
      min-width: 0;
    }

    .activity-content strong {
      display: block;
      color: var(--text);
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      transition: color 0.3s ease;
    }

    .activity-item:hover .activity-content strong {
      color: var(--primary-light);
    }

    .activity-content p {
      color: var(--text-light);
      font-size: 0.875rem;
      margin: 0.25rem 0 0.5rem;
      line-height: 1.5;
    }

    .activity-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 0.75rem;
      align-items: center;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      padding: 0.35rem 0.75rem;
      border-radius: 0.5rem;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.02em;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .badge:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .badge-amount {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
    }

    .badge-pending {
      background: linear-gradient(135deg, rgba(255,193,7,0.25), rgba(255,193,7,0.15));
      color: #f59e0b;
      border: 1px solid rgba(255,193,7,0.3);
    }

    .badge-confirmed {
      background: linear-gradient(135deg, rgba(16,185,129,0.25), rgba(16,185,129,0.15));
      color: #10b981;
      border: 1px solid rgba(16,185,129,0.3);
    }

    .badge-cancelled {
      background: linear-gradient(135deg, rgba(239,68,68,0.25), rgba(239,68,68,0.15));
      color: #ef4444;
      border: 1px solid rgba(239,68,68,0.3);
    }

    .activity-time {
      font-size: 0.75rem;
      color: var(--text-lighter);
      font-style: italic;
      opacity: 0.8;
    }

    .activity-section-divider {
      margin: 2rem 0 1.5rem;
      padding: 1rem 1.25rem;
      background: linear-gradient(135deg, rgba(102,126,234,0.15), rgba(118,75,162,0.1));
      border-radius: 0.75rem;
      text-align: center;
      font-weight: 700;
      font-size: 0.9rem;
      color: var(--primary-light);
      border: 1px solid rgba(102,126,234,0.2);
      box-shadow: 0 4px 12px rgba(102,126,234,0.15);
    }

    .user-item {
      background-image: linear-gradient(rgba(255,255,255,0.04), rgba(255,255,255,0.04)),
                        linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    }

    .live-indicator {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      padding: 1rem;
      border-top: 2px solid rgba(74,107,255,0.15);
      background: linear-gradient(135deg, 
        rgba(16,185,129,0.08), 
        rgba(16,185,129,0.03));
      font-size: 0.875rem;
      color: var(--primary-light);
      font-weight: 600;
    }

    .pulse-dot {
      width: 10px;
      height: 10px;
      background: #10b981;
      border-radius: 50%;
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
      box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
      position: relative;
    }

    .pulse-dot::after {
      content: '';
      position: absolute;
      inset: -4px;
      border-radius: 50%;
      border: 2px solid #10b981;
      animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
      0%, 100% { 
        opacity: 1; 
        transform: scale(1); 
      }
      50% { 
        opacity: 0.7; 
        transform: scale(1.15); 
      }
    }

    @keyframes pulse-ring {
      0% {
        transform: scale(0.8);
        opacity: 1;
      }
      100% {
        transform: scale(1.4);
        opacity: 0;
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* ========================================
       📱 COMPREHENSIVE RESPONSIVE BREAKPOINTS
       ======================================== */

    /* Large Desktop (1600px+) - Premium spacing */
    @media (min-width: 1600px) {
      .dashboard-container {
        max-width: 1600px;
        padding: 0 2rem;
      }
      
      .dashboard-master-grid {
        grid-template-columns: minmax(0, 1fr) 460px;
        gap: 3rem;
      }
    }

    /* Desktop (1200px - 1599px) */
    @media (max-width: 1599px) and (min-width: 1200px) {
      .dashboard-master-grid {
        grid-template-columns: minmax(0, 1fr) 400px;
        gap: 2rem;
      }
    }

    /* Laptop (992px - 1199px) */
    @media (max-width: 1199px) {
      .dashboard-master-grid {
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 1.75rem;
      }

      .activities-header {
        padding: 1.25rem 1.5rem;
      }

      .activity-item {
        padding: 1rem;
        gap: 1rem;
      }

      .activity-icon {
        width: 46px;
        height: 46px;
        font-size: 1.75rem;
      }
    }

    /* Tablet Landscape (768px - 991px) */
    @media (max-width: 991px) {
      .dashboard-container {
        padding: 0 1rem;
      }

      .dashboard-master-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-top: 1.5rem;
      }

      .dashboard-sidebar {
        position: relative;
        max-height: 650px;
      }

      .activities-card {
        max-height: 650px;
      }

      .activities-scroll {
        max-height: 480px;
      }
    }

    /* Tablet Portrait (576px - 767px) */
    @media (max-width: 767px) {
      .dashboard-master-grid {
        gap: 1.5rem;
        margin-top: 1rem;
      }

      .activities-card {
        border-radius: 1rem;
        max-height: 550px;
      }

      .activities-header {
        padding: 1rem 1.25rem;
        flex-wrap: wrap;
      }

      .activities-header h2 {
        font-size: 1.1rem;
      }

      .header-icon-wrapper {
        width: 38px;
        height: 38px;
      }

      .header-icon-wrapper i {
        font-size: 1.1rem;
      }

      .activity-count {
        min-width: 28px;
        height: 28px;
        font-size: 0.8rem;
      }

      .activities-scroll {
        padding: 1.25rem;
        max-height: 380px;
      }

      .activity-item {
        padding: 1rem;
        gap: 0.875rem;
        margin-bottom: 0.875rem;
      }

      .activity-icon {
        width: 44px;
        height: 44px;
        font-size: 1.6rem;
      }

      .activity-content strong {
        font-size: 0.95rem;
      }

      .activity-content p {
        font-size: 0.85rem;
      }

      .badge {
        font-size: 0.7rem;
        padding: 0.3rem 0.65rem;
      }

      .activity-section-divider {
        margin: 1.5rem 0 1rem;
        padding: 0.875rem 1rem;
        font-size: 0.85rem;
      }
    }

    /* Mobile (max 575px) */
    @media (max-width: 575px) {
      .dashboard-container {
        padding: 0 0.75rem;
      }

      .dashboard-master-grid {
        gap: 1.25rem;
        margin-top: 0.75rem;
      }

      .activities-card {
        border-radius: 0.875rem;
        max-height: 500px;
      }

      .activities-header {
        padding: 0.875rem 1rem;
        gap: 0.75rem;
      }

      .activities-header h2 {
        font-size: 1rem;
        flex: 1;
        min-width: 0;
      }

      .header-icon-wrapper {
        width: 36px;
        height: 36px;
      }

      .header-icon-wrapper i {
        font-size: 1rem;
      }

      .activity-count {
        min-width: 26px;
        height: 26px;
        font-size: 0.75rem;
      }

      .activities-scroll {
        padding: 1rem;
        max-height: 340px;
      }

      .activity-item {
        padding: 0.875rem;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        border-radius: 0.875rem;
      }

      .activity-item:hover {
        transform: translateX(4px) scale(1.01);
      }

      .activity-icon {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
      }

      .activity-content strong {
        font-size: 0.9rem;
      }

      .activity-content p {
        font-size: 0.8rem;
      }

      .activity-meta {
        gap: 0.4rem;
        margin-top: 0.5rem;
      }

      .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.55rem;
      }

      .activity-time {
        font-size: 0.7rem;
      }

      .activity-section-divider {
        margin: 1.25rem 0 0.875rem;
        padding: 0.75rem 0.875rem;
        font-size: 0.8rem;
        border-radius: 0.65rem;
      }

      .live-indicator {
        padding: 0.875rem;
        gap: 0.5rem;
        font-size: 0.8rem;
      }

      .pulse-dot {
        width: 8px;
        height: 8px;
      }

      /* Smaller scrollbar for mobile */
      .activities-scroll::-webkit-scrollbar {
        width: 4px;
      }
    }

    /* Extra Small Mobile (max 380px) */
    @media (max-width: 380px) {
      .activities-header {
        padding: 0.75rem 0.875rem;
      }

      .activities-header h2 {
        font-size: 0.95rem;
      }

      .header-icon-wrapper {
        width: 32px;
        height: 32px;
      }

      .header-icon-wrapper i {
        font-size: 0.95rem;
      }

      .activity-count {
        min-width: 24px;
        height: 24px;
        font-size: 0.7rem;
      }

      .activities-scroll {
        padding: 0.875rem;
      }

      .activity-item {
        padding: 0.75rem;
        gap: 0.65rem;
      }

      .activity-icon {
        width: 36px;
        height: 36px;
        font-size: 1.35rem;
      }

      .activity-content strong {
        font-size: 0.85rem;
      }

      .activity-content p {
        font-size: 0.75rem;
      }
    }

    /* Performance & Accessibility */
    @media (prefers-reduced-motion: no-preference) {
      .dashboard-master-grid,
      .dashboard-sidebar,
      .activities-card,
      .activity-item,
      .activity-icon {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    /* Dark mode enhancements */
    @media (prefers-color-scheme: dark) {
      .activities-card {
        box-shadow: 
          0 10px 40px rgba(0,0,0,0.4),
          0 2px 8px rgba(0,0,0,0.3),
          inset 0 1px 0 rgba(255,255,255,0.05);
      }

      .activity-item {
        background: rgba(255,255,255,0.02);
      }

      .activity-item:hover {
        background: rgba(102,126,234,0.08);
      }
    }
  </style>
@endsection

@push('scripts')
<script>
  // Your slideshow & modal JS here (same as original)
</script>
@endpush
