@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="user-management-section">
  <div class="section-header">
    <h2>Registered Users</h2>
    <div class="search-container">
      <input type="text" placeholder="Search users..." class="search-input" id="searchInput">
      <i class="bi bi-search"></i>
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
  <div class="modal-dialog modal-dialog-centered" style="max-width:700px; min-height:340px; right:1cm;left:2.5cm; position:relative; top:3cm;">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <div class="modal-title mb-0" style="width:100%; text-align:center;">
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
          <div class="compare-images-section d-flex flex-row justify-content-center align-items-center gap-3">
            <div class="document-section text-center" style="flex:1;">
              <h4>NIC Document</h4>
              <div class="document-image">
                <img src="{{ $user['nic_image_url'] ?? 'https://via.placeholder.com/500x400?text=No+NIC+Image' }}" alt="NIC Image" style="max-width:180px; height:auto;">
              </div>
            </div>
            <div class="document-section text-center" style="flex:1;">
              <h4>Profile Picture</h4>
              <div class="document-image">
                <img src="{{ $user['profile_pic_url'] ?? 'https://via.placeholder.com/500x400?text=No+Profile' }}" alt="Profile Picture" style="max-width:180px; height:auto;">
              </div>
            </div>
          </div>

          <!-- User Details -->
          <div class="user-details-section">
            <h4>User Details</h4>
            <div class="user-profile">
              <div class="profile-details" style="width:100%;">
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
  /* --- Keep all your previous styles intact --- */
  .user-management-section { background: var(--card-bg); border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.3); border:1px solid rgba(74,107,255,0.1); position:relative; }
  .section-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem; }
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
  .action-buttons { display:flex; gap:0.75rem; }
  .btn-verify, .btn-delete { padding:0.5rem 0.75rem; border-radius:0.5rem; font-size:0.8rem; font-weight:500; display:inline-flex; align-items:center; gap:0.35rem; border:none; cursor:pointer; transition:all 0.3s; }
  .btn-verify { background:rgba(74,107,255,0.1); color:var(--primary-light); border:1px solid var(--primary); }
  .btn-verify:hover { background:var(--primary); color:white; box-shadow:0 0 10px rgba(74,107,255,0.5); }
  .btn-delete { background: rgba(244,67,54,0.1); color:#f44336; border:1px solid rgba(244,67,54,0.3); }
  .btn-delete:hover { background:#f44336; color:white; box-shadow:0 0 10px rgba(244,67,54,0.3); }
  .modal-content { background: var(--card-bg); border-radius:0.75rem; border:1px solid var(--primary); box-shadow:0 0 30px rgba(0,242,255,0.3); }
  @media (max-width:968px) { .modal-dialog { max-width:95vw !important; min-height:220px !important; left:0.5cm !important; right:0.5cm !important; top:1.2cm !important; } .modal-content { border-radius:0.5rem; padding:0.5rem; } }
  .modal-header { border-bottom:1px solid var(--border); padding:0.7rem 1.2rem; display:flex; justify-content:space-between; align-items:center; min-height:60px; }
  .modal-title { color:var(--primary-light); font-weight:600; font-size:1.25rem; }
  .close-modal { background:none; border:none; color:var(--text-light); font-size:1.25rem; cursor:pointer; }
  .close-modal:hover { color:white; }
  .modal-body { padding:0.7rem; min-height:220px; }
  .verification-content { display:grid; grid-template-columns:1fr; gap:1.2rem; }
  .compare-images-section { display:flex; justify-content:center; gap:1.5rem; flex-wrap:wrap; }
  .document-image img { width:100%; max-width:300px; height:auto; border-radius:12px; border:2px solid var(--primary); }
  .user-profile { display:flex; gap:1rem; align-items:flex-start; flex-wrap:wrap; }
  .profile-image img { width:80px; height:80px; border-radius:50%; object-fit:cover; border:2px solid var(--primary); }
  .profile-details { flex-grow:1; }
  .detail-row { display:flex; justify-content:space-between; padding:0.5rem 0; border-bottom:1px solid rgba(255,255,255,0.05); }
  .detail-row:last-child { border-bottom:none; }
  .detail-label { color:var(--text-light); font-weight:500; }
  .detail-value { color:var(--text); }
  .modal-footer { border-top:1px solid var(--border); padding:1rem 1.5rem; display:flex; justify-content:flex-end; gap:1rem; }
  @media (max-width:968px) { .verification-content { grid-template-columns:1fr; } .compare-images-section { flex-direction:column; align-items:center; } .user-profile { flex-direction:column; align-items:center; text-align:center; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
</script>
@endsection
