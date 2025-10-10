@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="booking-management-section">
  <div class="section-header">
    <h2>Bookings</h2>
    <div class="search-container">
      <input type="text" placeholder="Search bookings..." class="search-input" id="searchInput">
      <i class="bi bi-search"></i>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
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
            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash-fill"></i> Delete
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8">No bookings found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<style>
.booking-management-section { padding:1.5rem; background: var(--card-bg); border-radius:.75rem; }
.section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
.search-container { position:relative; }
.search-input { padding:0.5rem 1rem; width:250px; border-radius:.5rem; border:1px solid #ccc; }
.table-responsive { overflow-x:auto; }
.booking-table { width:100%; border-collapse:collapse; }
.booking-table th, .booking-table td { padding:0.75rem; border-bottom:1px solid #ccc; text-align:left; }
.btn-edit { background: #4a6bff; color:white; padding:.35rem .75rem; border-radius:.5rem; text-decoration:none; }
.btn-delete { background: #f44336; color:white; padding:.35rem .75rem; border-radius:.5rem; border:none; cursor:pointer; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('keyup', function() {
    const filter = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('#bookingTable tbody tr');
    rows.forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
  });
});
</script>
@endsection
