@extends('layouts.master')

@section('stats')
@endsection

@section('content')
<div class="user-management-section">
  <div class="section-header">
    <h2>Registered Users</h2>
    <div class="header-actions">
      <button class="btn-create" onclick="openCreateModal('user')">
        <i class="bi bi-plus-circle"></i> Create User
      </button>
      <div class="search-container">
        <input type="text" placeholder="Search users..." class="search-input" id="searchInput">
        <i class="bi bi-search"></i>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      <i class="bi bi-check-circle-fill"></i>
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-error">
      <i class="bi bi-exclamation-circle-fill"></i>
      {{ session('error') }}
    </div>
  @endif

  <div class="table-responsive">
    <table class="user-table" id="userTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>NIC</th>
          <th>Role</th>
          <th>Verification</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user['user_id'] }}</td>
          <td>{{ $user['name'] }}</td>
          <td>{{ $user['email'] }}</td>
          <td>{{ $user['phone'] }}</td>
          <td>{{ $user['nic_number'] }}</td>
          <td><span class="role-badge">{{ ucfirst($user['role']) }}</span></td>
          <td>
            <span class="verification-status {{ $user['verification_status'] == 'Verified' ? 'verified' : 'pending' }}">
              <i class="bi {{ $user['verification_status'] == 'Verified' ? 'bi-shield-check' : 'bi-clock-history' }}"></i>
              {{ $user['verification_status'] }}
            </span>
          </td>
          <td>
            <div class="action-buttons">
              <button type="button" class="btn-edit" onclick="editUser({{ $user['user_id'] }})">
                <i class="bi bi-pencil"></i> Edit
              </button>
              <button type="button" class="btn-verify" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $user['user_id'] }}">
                <i class="bi bi-eye-fill"></i> Verify
              </button>
              <form action="{{ route('admin.users.destroy', $user['user_id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">
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

<!-- Verification Modals -->
@foreach($users as $user)
<div class="modal fade" id="verifyModal{{ $user['user_id'] }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $user['user_id'] }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable custom-modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <div class="modal-title mb-0 w-100 text-center">
          <div style="font-size:1.3rem; font-weight:700; color:var(--primary-light);">Manual Verification</div>
          <div style="font-size:1.1rem; font-weight:500; color:var(--text); margin-top:0.2rem;">{{ $user['name'] }}</div>
        </div>
        <button type="button" class="close-modal btn btn-light btn-sm" data-bs-dismiss="modal">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <div class="modal-body">
        <div class="verification-content">

          <!-- NIC and Profile Images -->
            <div class="compare-images-section d-flex justify-content-between align-items-start gap-3 flex-wrap">
            <div class="document-section text-center flex-1">
                <h4>NIC Document</h4>
                <div class="document-image">
                <img src="{{ $user['nic_image_url'] ?? 'https://via.placeholder.com/250x200?text=No+NIC+Image' }}" alt="NIC Image" class="zoomable-img">
                </div>
            </div>
            <div class="document-section text-center flex-1">
                <h4>Profile Picture</h4>
                <div class="document-image">
                <img src="{{ $user['profile_pic_url'] ?? 'https://via.placeholder.com/250x200?text=No+Profile' }}" alt="Profile Picture" class="zoomable-img">
                </div>
            </div>
            </div>

          <!-- User Details -->
          <div class="user-details-section">
            <h4>User Details</h4>
            <div class="user-profile">
              <div class="profile-details w-100">
                <div class="detail-row"><span class="detail-label">Name:</span> <span class="detail-value">{{ $user['name'] }}</span></div>
                <div class="detail-row"><span class="detail-label">Email:</span> <span class="detail-value">{{ $user['email'] }}</span></div>
                <div class="detail-row"><span class="detail-label">Phone:</span> <span class="detail-value">{{ $user['phone'] }}</span></div>
                <div class="detail-row"><span class="detail-label">NIC:</span> <span class="detail-value">{{ $user['nic_number'] }}</span></div>
                <div class="detail-row"><span class="detail-label">Location:</span> <span class="detail-value">{{ $user['location'] ?? 'Not provided' }}</span></div>
                <div class="detail-row"><span class="detail-label">Role:</span> <span class="detail-value">{{ ucfirst($user['role']) }}</span></div>
                <div class="detail-row"><span class="detail-label">Status:</span>
                  <form action="{{ route('admin.users.verify', $user['user_id']) }}" method="POST" style="display:inline-flex; align-items:center; gap:0.5rem;">
                    @csrf
                    <select name="verification_status" class="form-select form-select-sm" onchange="this.form.submit()" style="width:auto;">
                      <option value="Pending" {{ $user['verification_status'] == 'Pending' ? 'selected' : '' }}>Pending</option>
                      <option value="Verified" {{ $user['verification_status'] == 'Verified' ? 'selected' : '' }}>Verified</option>
                      <option value="Rejected" {{ $user['verification_status'] == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <form action="{{ route('admin.users.verify', $user['user_id']) }}" method="POST" style="display:inline;">
          @csrf
          <input type="hidden" name="verification_status" value="Verified">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle-fill"></i> Mark as Verified
          </button>
        </form>
        <form action="{{ route('admin.users.verify', $user['user_id']) }}" method="POST" style="display:inline;">
          @csrf
          <input type="hidden" name="verification_status" value="Rejected">
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-x-circle-fill"></i> Verification Rejected
          </button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<style>
.user-management-section { background: var(--card-bg); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border:1px solid rgba(74,107,255,0.1); }
.section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem; }
.header-actions { display:flex; gap:1rem; align-items:center; }
.search-container { position:relative; display:flex; align-items:center; }
.search-input { background:rgba(30,30,30,0.5); border:1px solid var(--border); border-radius:0.5rem; padding:0.75rem 1rem 0.75rem 2.5rem; width:250px; color:var(--text); }
.search-container i { position:absolute; left:1rem; color:var(--text-light); }
.table-responsive { overflow-x:auto; border-radius:0.5rem; }
.user-table { width:100%; border-collapse:collapse; }
.user-table th { background: rgba(74,107,255,0.1); padding:1rem; text-align:left; font-weight:600; color:var(--text); border-bottom:1px solid var(--border); }
.user-table td { padding:1rem; border-bottom:1px solid var(--border); }
.role-badge { background:rgba(74,107,255,0.1); color:var(--primary-light); padding:0.35rem 0.75rem; border-radius:1rem; font-size:0.8rem; font-weight:500; }
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

/* MODAL FIX */
.custom-modal-dialog { max-width:700px; width:90%; margin:0 auto; }
@media (max-width:992px){ .custom-modal-dialog { max-width:95%; } }

.modal-content { background: var(--card-bg); border-radius:0.75rem; border:1px solid var(--primary); box-shadow:0 0 30px rgba(0,242,255,0.3); max-height:90vh; overflow:hidden; }
.modal-body { overflow-y:auto; max-height:70vh; padding-right:1rem; }
.modal-body::-webkit-scrollbar { width:6px; }
.modal-body::-webkit-scrollbar-thumb { background: var(--primary-light); border-radius:6px; }
.modal-body::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }

.document-image img { width:100%; max-width:250px; height:auto; border-radius:12px; border:2px solid var(--primary); transition: transform 0.3s ease; cursor:pointer; }
.document-image img:hover { transform:scale(1.05); }

.detail-row { display:flex; justify-content:space-between; padding:0.5rem 0; border-bottom:1px solid rgba(255,255,255,0.05); }
.detail-label { color:var(--text-light); font-weight:500; }
.detail-value { color:var(--text); }
.modal-footer { border-top:1px solid var(--border); padding:1rem 1.5rem; display:flex; justify-content:flex-end; gap:1rem; }

.compare-images-section {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 1rem;
  flex-wrap: wrap;
}

.document-section {
  flex: 1;
  min-width: 250px; /* ensures they stay side by side on larger screens but wrap on small screens */
  text-align: center;
}

.document-image img {
  width: 100%;
  max-width: 250px;
  height: auto;
  border-radius: 12px;
  border: 2px solid var(--primary);
  transition: transform 0.3s ease;
  cursor: pointer;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Center modal correctly
  document.querySelectorAll('.modal').forEach(function(modal) {
    modal.addEventListener('show.bs.modal', function() {
      const modalDialog = this.querySelector('.modal-dialog');
      modalDialog.style.margin = 'auto';
    });
  });

  // Live search
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('keyup', function() {
    const filter = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');
    rows.forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
  });
});

function openCreateModal(type) {
  if (type === 'user') {
    window.location.href = "{{ route('admin.users.create') }}";
  }
}

function editUser(id) {
  window.location.href = `{{ url('admin/users') }}/${id}/edit`;
}
</script>
@endsection
