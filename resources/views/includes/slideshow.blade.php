{{-- Dynamic Data Visualization Section --}}
<div class="data-visualization-section">
  <div class="section-header">
    <h2>📊 Analytics Dashboard</h2>
    <div style="display: flex; gap: 0.5rem; align-items: center;">
      <div class="refresh-btn" onclick="refreshCharts()">
        <i class="bi bi-arrow-clockwise"></i> Refresh Data
      </div>
      <button class="export-btn" onclick="exportDashboardCSV()" style="background: #007bff; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1.1rem; font-size: 0.95rem; font-weight: 500; cursor: pointer; transition: background 0.2s;">Export CSV</button>
    </div>
  </div>
  
  <div class="charts-container">
    {{-- Revenue Chart --}}
    <div class="chart-card animate-on-load">
      <div class="chart-header">
        <h3>💰 Monthly Revenue Trend</h3>
        <span class="chart-value">${{ number_format($monthlyRevenue ?? 0, 2) }}</span>
      </div>
      <div class="chart-content">
        <canvas id="revenueChart" width="400" height="200"></canvas>
      </div>
    </div>

    {{-- Bookings vs Properties Chart --}}
    <div class="chart-card animate-on-load">
      <div class="chart-header">
        <h3>📊 Bookings vs Properties</h3>
        <span class="chart-value">{{ $occupancyRate ?? 0 }}% Occupancy</span>
      </div>
      <div class="chart-content">
        <canvas id="occupancyChart" width="400" height="200"></canvas>
      </div>
    </div>

    {{-- User Growth Chart --}}
    <div class="chart-card animate-on-load">
      <div class="chart-header">
        <h3>👥 User Growth</h3>
        <span class="chart-value">{{ $totalUsers ?? 0 }} Total Users</span>
      </div>
      <div class="chart-content">
        <canvas id="userGrowthChart" width="400" height="200"></canvas>
      </div>
    </div>

    {{-- Property Status Distribution --}}
    <div class="chart-card animate-on-load">
      <div class="chart-header">
        <h3>🏠 Property Status</h3>
        <span class="chart-value">{{ $totalProperties ?? 0 }} Properties</span>
      </div>
      <div class="chart-content">
        <canvas id="propertyStatusChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>

  {{-- Quick Stats Cards with Animation --}}
  <div class="quick-stats-grid">
    <div class="stat-card-mini animate-bounce" data-delay="100">
      <div class="stat-icon">📈</div>
      <div class="stat-info">
        <div class="stat-number" data-count="{{ $totalBookings ?? 0 }}">0</div>
        <div class="stat-label">Total Bookings</div>
      </div>
    </div>
    
    <div class="stat-card-mini animate-bounce" data-delay="200">
      <div class="stat-icon">🍽️</div>
      <div class="stat-info">
        <div class="stat-number" data-count="{{ $totalVendors ?? 0 }}">0</div>
        <div class="stat-label">Food Packages</div>
      </div>
    </div>
    
    <div class="stat-card-mini animate-bounce" data-delay="300">
      <div class="stat-icon">💼</div>
      <div class="stat-info">
        <div class="stat-number" data-count="{{ $approvedProperties ?? 0 }}">0</div>
        <div class="stat-label">Approved Properties</div>
      </div>
    </div>
    
    <div class="stat-card-mini animate-bounce" data-delay="400">
      <div class="stat-icon">⭐</div>
      <div class="stat-info">
        <div class="stat-number" data-count="{{ $verifiedUsers ?? 0 }}">0</div>
        <div class="stat-label">Verified Users</div>
      </div>
    </div>
  </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* REFACTORED FOR A CLEAN, WHITE UI */

/* Using system fonts for performance and a modern feel */

:root {
  --primary-color: #007bff;
  --text-dark: #212529;
  --text-muted: #6c757d;
  --bg-light: #f8f9fa;
  --border-color: #dee2e6;
  --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
  --card-shadow-hover: 0 6px 16px rgba(0, 0, 0, 0.1);
}

body.dark-mode {
  --primary-color: #4a90e2;
  --text-dark: #f1f1f1;
  --text-muted: #b0b0b0;
  --bg-light: #181c24;
  --border-color: #23283a;
  --card-shadow: 0 4px 12px rgba(0,0,0,0.5);
  --card-shadow-hover: 0 6px 16px rgba(0,0,0,0.7);
}

.data-visualization-section {
  background: var(--bg-light);
  border-radius: 1rem;
  padding: 2rem;
  border: 1px solid var(--border-color);
  transition: background 0.3s, color 0.3s;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.section-header h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--text-dark);
}

.charts-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
  margin-bottom: 2rem;
}

@media (max-width: 992px) {
  .charts-container {
    grid-template-columns: 1fr;
  }
}

.chart-card {
  background: #ffffff;
  border-radius: 0.75rem;
  padding: 1.5rem;
  border: 1px solid var(--border-color);
  box-shadow: var(--card-shadow);
  transition: all 0.3s ease;
  opacity: 0;
  transform: translateY(20px);
}
body.dark-mode .chart-card {
  background: #23283a;
  color: #f1f1f1;
}

.chart-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--card-shadow-hover);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid #f1f1f1;
}

.chart-header h3 {
  font-size: 1rem;
  font-weight: 500;
  color: var(--text-dark);
  margin: 0;
}

.chart-value {
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--primary-color);
}

.chart-content {
  height: 220px;
}

.refresh-btn {
  background: #ffffff;
  color: var(--text-muted);
  border: 1px solid var(--border-color);
  border-radius: 0.5rem;
  padding: 0.5rem 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  font-weight: 500;
}

.refresh-btn:hover {
  background: var(--primary-color);
  color: white;
  border-color: var(--primary-color);
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
}

.refresh-btn i {
  transition: transform 0.4s ease;
}

.refresh-btn:hover i {
  transform: rotate(180deg);
}

.quick-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.5rem;
}

.stat-card-mini {
  background: #ffffff;
  border-radius: 0.75rem;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1.25rem;
  border: 1px solid var(--border-color);
  box-shadow: var(--card-shadow);
  transition: all 0.3s ease;
  opacity: 0;
  transform: translateY(20px) scale(0.95);
}
body.dark-mode .stat-card-mini {
  background: #23283a;
  color: #f1f1f1;
}

.stat-card-mini:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: var(--card-shadow-hover);
}

.stat-icon {
  font-size: 1.75rem;
  background: #e7f3ff;
  color: var(--primary-color);
  width: 55px;
  height: 55px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
body.dark-mode .stat-icon {
  background: #2c3142;
  color: #4a90e2;
}

.stat-info {
  flex: 1;
}

.stat-number {
  font-size: 2rem;
  font-weight: 700;
  color: var(--primary-color);
  line-height: 1;
}

.stat-label {
  font-size: 0.9rem;
  color: var(--text-muted);
  margin-top: 0.25rem;
}

/* Animations */
.animate-on-load, .animate-bounce {
  animation-duration: 0.6s;
  animation-timing-function: ease-out;
  animation-fill-mode: forwards;
}

.animate-on-load {
  animation-name: slideInUp;
}

.animate-bounce {
  animation-name: bounceIn;
}

@keyframes slideInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes bounceIn {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
</style>

<script>
function exportDashboardCSV() {
  // Gather quick stats
  const stats = [
    ['Total Bookings', document.querySelector('[data-count="{{ $totalBookings ?? 0 }}"]')?.getAttribute('data-count') || '0'],
    ['Food Packages', document.querySelector('[data-count="{{ $totalVendors ?? 0 }}"]')?.getAttribute('data-count') || '0'],
    ['Approved Properties', document.querySelector('[data-count="{{ $approvedProperties ?? 0 }}"]')?.getAttribute('data-count') || '0'],
    ['Verified Users', document.querySelector('[data-count="{{ $verifiedUsers ?? 0 }}"]')?.getAttribute('data-count') || '0']
  ];

  // Chart summary data (from PHP variables)
  const chartData = [
    ['Monthly Revenue', "${{ number_format($monthlyRevenue ?? 0, 2) }}"],
    ['Occupancy Rate', "{{ $occupancyRate ?? 0 }}%"],
    ['Total Users', "{{ $totalUsers ?? 0 }}"],
    ['Total Properties', "{{ $totalProperties ?? 0 }}"],
    ['Approved Properties', "{{ $approvedProperties ?? 0 }}"]
  ];

  let csv = 'Metric,Value\n';
  stats.forEach(row => { csv += row.join(',') + '\n'; });
  csv += '\n';
  chartData.forEach(row => { csv += row.join(',') + '\n'; });

  // Download CSV
  const blob = new Blob([csv], { type: 'text/csv' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'analytics_dashboard.csv';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Animate elements on load
  document.querySelectorAll('.animate-on-load, .animate-bounce').forEach((el, index) => {
    const delay = el.getAttribute('data-delay') || (index * 100);
    setTimeout(() => {
      el.style.animationPlayState = 'running';
    }, delay);
  });

  // Animate counting numbers
  animateNumbers();
  
  // Initialize charts
  initializeCharts();
});

function animateNumbers() {
  document.querySelectorAll('.stat-number').forEach(element => {
    const target = parseInt(element.getAttribute('data-count'));
    const duration = 1500; // slightly faster
    const increment = target / (duration / 16);
    let current = 0;

    if (isNaN(target) || target === 0) {
      element.textContent = 0;
      return;
    }

    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        element.textContent = target.toLocaleString();
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(current).toLocaleString();
      }
    }, 16);
  });
}

function refreshCharts() {
  const refreshIcon = document.querySelector('.refresh-btn i');
  refreshIcon.style.transition = 'transform 0.5s ease';
  refreshIcon.style.transform = 'rotate(360deg)';
  
  setTimeout(() => {
    refreshIcon.style.transition = 'none';
    refreshIcon.style.transform = 'rotate(0deg)';
  }, 500);
  
  // You would typically fetch new data here via AJAX/Fetch API
  // For this demo, we'll just re-run the animations
  console.log('Refreshing data...');
  animateNumbers();
  // If you had a function to update chart instances with new data, you would call it here.
}

function initializeCharts() {
  const primaryColor = '#007bff';
  const gridColor = 'rgba(0, 0, 0, 0.05)';
  const tickColor = '#6c757d';
  const legendColor = '#343a40';

  // Universal Chart Options
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          color: legendColor,
          boxWidth: 12,
          padding: 20
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: { color: gridColor },
        ticks: { color: tickColor }
      },
      x: {
        grid: { display: false },
        ticks: { color: tickColor }
      }
    }
  };

  // Revenue Chart (Line)
  const revenueCtx = document.getElementById('revenueChart').getContext('2d');
  new Chart(revenueCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Revenue',
        data: [1200, 1900, 3000, 5000, 4000, {{ $monthlyRevenue ?? 0 }}],
        borderColor: primaryColor,
        backgroundColor: 'rgba(0, 123, 255, 0.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4,
        pointBackgroundColor: primaryColor,
        pointRadius: 4,
        pointHoverRadius: 6
      }]
    },
    options: { ...chartOptions, plugins: { legend: { display: false } } }
  });

  // Occupancy Chart (Doughnut)
  const occupancyCtx = document.getElementById('occupancyChart').getContext('2d');
  new Chart(occupancyCtx, {
    type: 'doughnut',
    data: {
      labels: ['Occupied', 'Available'],
      datasets: [{
        data: [{{ $totalBookings ?? 0 }}, {{ ($totalProperties ?? 1) - ($totalBookings ?? 0) }}],
        backgroundColor: [primaryColor, '#e9ecef'],
        borderColor: ['#ffffff', '#ffffff'],
        borderWidth: 4,
        hoverOffset: 8
      }]
    },
    options: { ...chartOptions, scales: { x: { display: false }, y: { display: false } }, plugins: { legend: { position: 'bottom' } } }
  });

  // User Growth Chart (Bar)
  const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
  new Chart(userGrowthCtx, {
    type: 'bar',
    data: {
      labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
      datasets: [{
        label: 'New Users',
        data: [12, 19, 8, {{ floor(($totalUsers ?? 0) / 4) }}],
        backgroundColor: 'rgba(0, 123, 255, 0.7)',
        borderColor: primaryColor,
        borderWidth: 1,
        borderRadius: 4
      }]
    },
    options: { ...chartOptions, plugins: { legend: { display: false } } }
  });

  // Property Status Chart (Pie)
  const propertyStatusCtx = document.getElementById('propertyStatusChart').getContext('2d');
  new Chart(propertyStatusCtx, {
    type: 'pie',
    data: {
      labels: ['Approved', 'Pending'],
      datasets: [{
        data: [{{ $approvedProperties ?? 0 }}, {{ ($totalProperties ?? 0) - ($approvedProperties ?? 0) }}],
        backgroundColor: ['#28a745', '#ffc107'], // Green for Approved, Yellow for Pending
        borderColor: ['#ffffff', '#ffffff'],
        borderWidth: 4,
        hoverOffset: 8
      }]
    },
    options: { ...chartOptions, scales: { x: { display: false }, y: { display: false } }, plugins: { legend: { position: 'bottom' } } }
  });
}
</script>