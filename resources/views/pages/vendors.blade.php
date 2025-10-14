@extends('layouts.master')

@section('stats')
@endsection

@section('content')
<div class="vendor-management-section">
    <div class="section-header">
        <h2>Registered Food Packages</h2>
        <div class="header-actions">
            <button class="btn-create" onclick="openCreateModal('vendor')">
                <i class="bi bi-plus-circle"></i> Create Package
            </button>
            <div class="search-container">
                <input type="text" placeholder="Search packages..." class="search-input" id="searchInput">
                <i class="bi bi-search"></i>
            </div>
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
        <table class="vendor-table" id="vendorTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Food Type</th>
                    <th>Preference</th>
                    <th>Monthly Fee</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($foodMenus as $menu)
                    <tr>
                        <td>{{ $menu->menu_id }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ ucfirst($menu->food_type) }}</td>
                        <td>{{ ucfirst($menu->preference) }}</td>
                        <td>${{ number_format($menu->monthly_fee, 2) }}</td>
                        <td>{{ $menu->start_date }}</td>
                        <td>{{ $menu->end_date }}</td>
                        <td>
                            @if($menu->image_url)
                                <img src="{{ asset('storage/' . $menu->image_url) }}" alt="Food Image"
                                     style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <span class="verification-status {{ $menu->approved ? 'verified' : 'pending' }}">
                                <i class="bi {{ $menu->approved ? 'bi-check-circle-fill' : 'bi-clock-history' }}"></i>
                                {{ $menu->approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-edit" onclick="editVendor({{ $menu->menu_id }})">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                @if(!$menu->approved)
                                    {{-- Approve Form --}}
                                   <form action="{{ route('admin.vendors.approve', ['id' => $menu->menu_id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-verify">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                @endif

                                {{-- Delete Form --}}
                                <form action="{{ route('admin.vendors.destroy', ['id' => $menu->menu_id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this package?')">
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
.header-actions { display:flex; gap:1rem; align-items:center; }
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
.btn-edit, .btn-verify, .btn-delete { padding:0.5rem 0.75rem; border-radius:0.5rem; font-size:0.8rem; font-weight:500; display:inline-flex; align-items:center; gap:0.35rem; border:none; cursor:pointer; transition:all 0.3s; }
.btn-edit { background: linear-gradient(90deg, #3b82f6, #2563eb); color: white; }
.btn-edit:hover { background: linear-gradient(90deg, #2563eb, #1d4ed8); box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4); transform: translateY(-1px); }
.btn-verify { background:rgba(74,107,255,0.1); color:var(--primary-light); border:1px solid var(--primary); }
.btn-verify:hover { background:var(--primary); color:white; box-shadow:0 0 10px rgba(74,107,255,0.5); }
.btn-delete { background: linear-gradient(90deg, #ef4444, #dc2626); color: white; }
.btn-delete:hover { background: linear-gradient(90deg, #dc2626, #b91c1c); box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4); transform: translateY(-1px); }
</style>

{{-- Search JS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#vendorTable tbody tr');
        rows.forEach(row => row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none');
    });
});

function openCreateModal(type) {
  if (type === 'vendor') {
    window.location.href = "{{ route('admin.vendors.create') }}";
  }
}

function editVendor(id) {
  window.location.href = `{{ url('admin/vendors') }}/${id}/edit`;
}
</script>
@endsection
