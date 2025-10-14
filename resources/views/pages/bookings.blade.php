@extends('layouts.master')

@section('stats')
@endsection

@section('content')

{{-- ===== BOOKINGS TABLE ===== --}}
<div class="booking-management-section">
  <div class="section-header">
    <h2>Bookings</h2>
    <div class="header-actions">
  
      <div class="search-container">
        <input type="text" placeholder="Search bookings..." class="search-input" id="bookingSearch">
        <i class="bi bi-search"></i>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="booking-table" id="bookingTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Property</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Reserved At</th>
          <th>Booked At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($bookings as $booking)
        <tr>
          <td>{{ $booking->id }}</td>
          <td>{{ $booking->user->name ?? 'N/A' }}</td>
          <td>{{ $booking->boarding->name ?? 'N/A' }}</td>
          <td>{{ $booking->amount }}</td>
          <td>{{ ucfirst($booking->status) }}</td>
          <td>{{ $booking->reserved_at }}</td>
          <td>{{ $booking->booked_at }}</td>
          <td>
            <div class="action-buttons">
           
              <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">
                  <i class="bi bi-trash"></i> Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8">No bookings found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ===== SUBSCRIPTIONS TABLE ===== --}}
<div class="booking-management-section mt-5">
  <div class="section-header">
    <h2>Subscriptions</h2>
    <div class="header-actions">
  
      <div class="search-container">
        <input type="text" placeholder="Search subscriptions..." class="search-input" id="subscriptionSearch">
        <i class="bi bi-search"></i>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="booking-table" id="subscriptionTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Vendor / Menu</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Subscribed At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($subscriptions as $sub)
        <tr>
          <td>{{ $sub->id }}</td>
          <td>{{ $sub->user->name ?? 'N/A' }}</td>
          <td>{{ $sub->vendor->name ?? 'N/A' }}</td>
          <td>{{ $sub->amount }}</td>
          <td>{{ ucfirst($sub->status) }}</td>
          <td>{{ $sub->created_at->format('Y-m-d H:i') }}</td>
          <td>
            <div class="action-buttons">
            
              <form action="{{ route('admin.subscriptions.destroy', $sub->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">
                  <i class="bi bi-trash"></i> Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7">No subscriptions found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<style>
.booking-management-section { 
  padding:1.5rem; 
  background: var(--card-bg); 
  border-radius:.75rem; 
  margin-bottom:2rem; 
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  border: 1px solid rgba(74, 107, 255, 0.1);
}

.section-header { 
  display:flex; 
  justify-content:space-between; 
  align-items:center; 
  margin-bottom:1.5rem; 
}

.header-actions {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.btn-create {
  background: linear-gradient(90deg, #10b981, #059669);
  color: white;
  border: none;
  border-radius: 0.5rem;
  padding: 0.5rem 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.btn-create:hover {
  background: linear-gradient(90deg, #059669, #047857);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.5);
  transform: translateY(-2px);
}

.search-container { position:relative; }
.search-input { 
  padding:0.5rem 1rem; 
  width:250px; 
  border-radius:.5rem; 
  border:1px solid var(--border);
  background: rgba(30, 30, 30, 0.5);
  color: var(--text);
}

.table-responsive { overflow-x:auto; }
.booking-table { 
  width:100%; 
  border-collapse:collapse; 
  margin-bottom:1.5rem; 
  background: var(--card-bg);
}

.booking-table th, .booking-table td { 
  padding:0.75rem; 
  border-bottom:1px solid var(--border); 
  text-align:left; 
}

.booking-table th {
  background: rgba(74, 107, 255, 0.1);
  color: var(--primary-light);
  font-weight: 600;
}

.action-buttons {
  display: flex;
  gap: 0.5rem;
  align-items: center;
}

.btn-edit { 
  background: linear-gradient(90deg, #3b82f6, #2563eb);
  color: white; 
  padding:.35rem .75rem; 
  border-radius:.5rem; 
  border:none; 
  cursor:pointer;
  transition: all 0.3s;
  display: flex;
  align-items: center;
  gap: 0.25rem;
  font-size: 0.85rem;
  text-decoration: none;
}

.btn-edit:hover {
  background: linear-gradient(90deg, #2563eb, #1d4ed8);
  box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);
  transform: translateY(-1px);
}

.btn-delete { 
  background: linear-gradient(90deg, #ef4444, #dc2626);
  color:white; 
  padding:.35rem .75rem; 
  border-radius:.5rem; 
  border:none; 
  cursor:pointer;
  transition: all 0.3s;
  display: flex;
  align-items: center;
  gap: 0.25rem;
  font-size: 0.85rem;
}

.btn-delete:hover {
  background: linear-gradient(90deg, #dc2626, #b91c1c);
  box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
  transform: translateY(-1px);
}

.alert-success {
  background: rgba(16, 185, 129, 0.1);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.3);
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  margin-bottom: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const bookingSearch = document.getElementById('bookingSearch');
  bookingSearch.addEventListener('keyup', function() {
    const filter = bookingSearch.value.toLowerCase();
    document.querySelectorAll('#bookingTable tbody tr').forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
  });

  const subscriptionSearch = document.getElementById('subscriptionSearch');
  subscriptionSearch.addEventListener('keyup', function() {
    const filter = subscriptionSearch.value.toLowerCase();
    document.querySelectorAll('#subscriptionTable tbody tr').forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
  });
});

function openCreateModal(type) {
  if (type === 'booking') {
    window.location.href = "{{ route('admin.bookings.create') }}";
  } else if (type === 'subscription') {
    window.location.href = "{{ route('admin.subscriptions.create') }}";
  }
}

function editSubscription(id) {
  window.location.href = `{{ url('admin/subscriptions') }}/${id}/edit`;
}
</script>
@endsection
