@extends('layouts.master')

@section('stats')
    @include('includes.stats')
@endsection

@section('content')
<div class="vendor-management-section">
    <div class="section-header">
        <h2>Registered Boarding Properties</h2>
        <div class="search-container">
            <input type="text" placeholder="Search properties..." class="search-input" id="searchInput">
            <i class="bi bi-search"></i>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="vendor-table" id="propertyTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Monthly Rent</th>
                    <th>Room Type</th>
                    <th>Food Included</th>
                    <th>Police Rating</th>
                    <th>Posted Date</th>
                    <th>Photos</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td>{{ $property->boarding_id }}</td>
                        <td>{{ $property->title }}</td>
                        <td>{{ Str::limit($property->description, 50) }}</td>
                        <td>{{ $property->location }}</td>
                        <td>{{ number_format($property->monthly_rent, 2) }}</td>
                        <td>{{ ucfirst($property->room_type) }}</td>
                        <td>{{ $property->is_food_included ? 'Yes' : 'No' }}</td>
                        <td>{{ $property->police_zone_rating }}/5</td>
                        <td>{{ $property->posted_date }}</td>
                        <td>
                            @foreach($property->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->image_url) }}" alt="Room Photo"
                                     style="width:60px; height:60px; object-fit:cover; border-radius:6px; margin-right:4px;">
                            @endforeach
                        </td>
                        <td>
                            <span class="verification-status {{ $property->is_approved ? 'verified' : 'pending' }}">
                                <i class="bi {{ $property->is_approved ? 'bi-check-circle-fill' : 'bi-clock-history' }}"></i>
                                {{ $property->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                @if(!$property->is_approved)
                                    <form action="{{ route('admin.properties.approve', $property->boarding_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-verify">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.properties.destroy', $property->boarding_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this property?')">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Styles --}}
<style>
.vendor-management-section { background: var(--card-bg); border-radius:0.75rem; padding:1.5rem; box-shadow:0 4px 20px rgba(0,0,0,0.1); border:1px solid rgba(74,107,255,0.1); }
.section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem; }
.search-container { position:relative; display:flex; align-items:center; }
.search-input { background:rgba(30,30,30,0.05); border:1px solid var(--border); border-radius:0.5rem; padding:0.75rem 1rem 0.75rem 2.5rem; width:250px; color:var(--text); }
.search-container i { position:absolute; left:1rem; color:var(--text-light); }
.table-responsive { overflow-x:auto; border-radius:0.5rem; }
.vendor-table { width:100%; border-collapse:collapse; }
.vendor-table th { background: rgba(74,107,255,0.05); padding:1rem; text-align:left; font-weight:600; color:var(--text); border-bottom:1px solid var(--border); }
.vendor-table td { padding:1rem; border-bottom:1px solid var(--border); vertical-align:middle; }
.verification-status { display:inline-flex; align-items:center; gap:0.5rem; padding:0.35rem 0.75rem; border-radius:1rem; font-size:0.8rem; font-weight:500; }
.verification-status.verified { background: rgba(0,230,118,0.1); color:#00e676; }
.verification-status.pending { background: rgba(255,193,7,0.1); color:#ffc107; }
.action-buttons { display:flex; gap:0.5rem; flex-wrap:wrap; }
.btn-verify, .btn-delete { padding:0.5rem 0.75rem; border-radius:0.5rem; font-size:0.8rem; font-weight:500; display:inline-flex; align-items:center; gap:0.35rem; border:none; cursor:pointer; transition:all 0.3s; }
.btn-verify { background:rgba(74,107,255,0.1); color:var(--primary-light); border:1px solid var(--primary); }
.btn-verify:hover { background:var(--primary); color:white; box-shadow:0 0 10px rgba(74,107,255,0.5); }
.btn-delete { background: rgba(244,67,54,0.1); color:#f44336; border:1px solid rgba(244,67,54,0.3); }
.btn-delete:hover { background:#f44336; color:white; box-shadow:0 0 10px rgba(244,67,54,0.3); }
</style>

{{-- Search JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#propertyTable tbody tr');
        rows.forEach(row => row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none');
    });
});
</script>
@endsection
