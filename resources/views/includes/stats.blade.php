<div class="stat-card" data-aos="fade-up" data-aos-delay="100">
  <div class="stat-header">
    <div class="stat-icon">🏠</div>
    <div class="stat-title">Total Properties</div>
  </div>
  <div class="stat-value" data-animate="true">{{ $totalProperties ?? 0 }}</div>
  <div class="stat-change">Live data from database</div>
</div>

<div class="stat-card" data-aos="fade-up" data-aos-delay="200">
  <div class="stat-header">
    <div class="stat-icon">👥</div>
    <div class="stat-title">Total Users</div>
  </div>
  <div class="stat-value" data-animate="true">{{ $totalUsers ?? 0 }}</div>
  <div class="stat-change">Live data from database</div>
</div>

<div class="stat-card" data-aos="fade-up" data-aos-delay="300">
  <div class="stat-header">
    <div class="stat-icon">📋</div>
    <div class="stat-title">Total Bookings</div>
  </div>
  <div class="stat-value" data-animate="true">{{ $totalBookings ?? 0 }}</div>
  <div class="stat-change">Live data from database</div>
</div>

<div class="stat-card" data-aos="fade-up" data-aos-delay="400">
  <div class="stat-header">
    <div class="stat-icon">🍽️</div>
    <div class="stat-title">Food Packages</div>
  </div>
  <div class="stat-value" data-animate="true">{{ $totalVendors ?? 0 }}</div>
  <div class="stat-change">Live data from database</div>
</div>

<div class="stat-card" data-aos="fade-up" data-aos-delay="500">
  <div class="stat-header">
    <div class="stat-icon">💰</div>
    <div class="stat-title">Monthly Revenue</div>
  </div>
  <div class="stat-value" data-animate="true">${{ number_format($monthlyRevenue ?? 0, 2) }}</div>
  <div class="stat-change">This month's bookings</div>
</div>

<div class="stat-card" data-aos="fade-up" data-aos-delay="600">
  <div class="stat-header">
    <div class="stat-icon">📊</div>
    <div class="stat-title">Occupancy Rate</div>
  </div>
  <div class="stat-value" data-animate="true">{{ $occupancyRate ?? 0 }}%</div>
  <div class="stat-change">Bookings vs Properties</div>
</div>
