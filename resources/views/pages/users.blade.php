@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
<div class="user-management-section">
  <div class="section-header">
    <h2>Registered Users</h2>
    <div class="search-container">
      <input type="text" placeholder="Search users..." class="search-input">
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
    <table class="user-table">
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
  <div class="modal-dialog modal-dialog-centered d-flex justify-content-center align-items-center" style="min-height:100vh;">
  <div class="modal-content" style="margin:auto; max-width:700px; max-height:80vh; overflow-y:auto; border-radius:16px; box-shadow:0 8px 32px rgba(0,0,0,0.25);">
      <div class="modal-header d-flex justify-content-between align-items-center" style="padding: 1.5rem 2rem; border-bottom: 1px solid #eee;">
        <h3 class="modal-title mb-0" style="font-size:2rem; font-weight:600;">Manual Verification - {{ $user['name'] }}</h3>
        <button type="button" class="close-modal btn btn-light btn-sm" data-bs-dismiss="modal" aria-label="Close" style="border-radius:50%;">
          <i class="bi bi-x-lg" style="font-size:1.5rem;"></i>
        </button>
      </div>
      <div class="modal-body" style="padding:2rem;">
        <div class="verification-content text-center">
          <div class="compare-images-section d-flex justify-content-center align-items-center gap-5 mb-4">
            <div>
              <h4>NIC Document</h4>
              <img src="{{ $user['nic_image_url'] ?? 'https://via.placeholder.com/500x400?text=No+NIC+Image' }}" alt="NIC Image" style="width:500px; height:400px; object-fit:cover; border:2px solid #007bff; border-radius:12px;">
            </div>
            <div>
              <h4>Profile Picture</h4>
              <img src="{{ $user['profile_pic_url'] ?? 'https://via.placeholder.com/500x400?text=No+Profile' }}" alt="Profile Picture" style="width:500px; height:400px; object-fit:cover; border:2px solid #007bff; border-radius:12px;">
            </div>
          </div>
          <div style="margin-top:3cm;">
            <div class="user-details-section">
              <h4>User Details</h4>
              <div class="user-profile">
                <div class="profile-details">
                  <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $user['name'] }}</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $user['email'] }}</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $user['phone'] }}</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">NIC:</span>
                    <span class="detail-value">{{ $user['nic_number'] }}</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">Location:</span>
                    <span class="detail-value">{{ $user['location'] ?? 'Not provided' }}</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">Role:</span>
                    <span class="detail-value">{{ ucfirst($user['role']) }}</span>
                  </div>
                  <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="verification-status {{ $user['verification_status'] == 'Verified' ? 'verified' : 'pending' }}">
                      {{ $user['verification_status'] }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <form action="{{ route('admin.users.update', $user['user_id']) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="verification_status" value="Verified">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle-fill"></i> Mark as Verified
          </button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<style>
  .user-management-section {
    background: var(--card-bg);
    border-radius: 0.75rem;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(74, 107, 255, 0.1);
    position: relative;
    overflow: hidden;
  }

  .user-management-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
    animation: gradientShift 8s ease infinite;
    background-size: 200% 200%;
  }

  .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .search-container {
    position: relative;
    display: flex;
    align-items: center;
  }

  .search-input {
    background: rgba(30, 30, 30, 0.5);
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    color: var(--text);
    width: 250px;
    transition: all 0.3s;
  }

  .search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(74, 107, 255, 0.2);
  }

  .search-container i {
    position: absolute;
    left: 1rem;
    color: var(--text-light);
  }

  .alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .alert-success {
    background: rgba(0, 230, 118, 0.1);
    border: 1px solid rgba(0, 230, 118, 0.3);
    color: #00e676;
  }

  .alert-error {
    background: rgba(244, 67, 54, 0.1);
    border: 1px solid rgba(244, 67, 54, 0.3);
    color: #f44336;
  }

  .table-responsive {
    overflow-x: auto;
    border-radius: 0.5rem;
  }

  .user-table {
    width: 100%;
    border-collapse: collapse;
  }

  .user-table th {
    background: rgba(74, 107, 255, 0.1);
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--text);
    border-bottom: 1px solid var(--border);
  }

  .user-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
  }

  .user-table tbody tr {
    transition: all 0.3s;
  }

  .user-table tbody tr:hover {
    background: rgba(74, 107, 255, 0.05);
  }

  .role-badge {
    background: rgba(74, 107, 255, 0.1);
    color: var(--primary-light);
    padding: 0.35rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
  }

  .verification-status {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
  }

  .verification-status.verified {
    background: rgba(0, 230, 118, 0.1);
    color: #00e676;
  }

  .verification-status.pending {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
  }

  .action-buttons {
    display: flex;
    gap: 0.75rem;
  }

  .btn-verify, .btn-delete {
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
  }

  .btn-verify {
    background: rgba(74, 107, 255, 0.1);
    color: var(--primary-light);
    border: 1px solid var(--primary);
  }

  .btn-verify:hover {
    background: var(--primary);
    color: white;
    box-shadow: 0 0 10px rgba(74, 107, 255, 0.5);
  }

  .btn-delete {
    background: rgba(244, 67, 54, 0.1);
    color: #f44336;
    border: 1px solid rgba(244, 67, 54, 0.3);
  }

  .btn-delete:hover {
    background: #f44336;
    color: white;
    box-shadow: 0 0 10px rgba(244, 67, 54, 0.3);
  }

  /* Modal Styles */
  .modal-content {
    background: var(--card-bg);
    border-radius: 0.75rem;
    border: 1px solid var(--primary);
    box-shadow: 0 0 30px rgba(0, 242, 255, 0.3);
  }

  .modal-header {
    border-bottom: 1px solid var(--border);
    padding: 1.5rem;
  }

  .modal-title {
    color: var(--primary-light);
    font-size: 1.25rem;
    font-weight: 600;
  }

  .close-modal {
    background: none;
    border: none;
    color: var(--text-light);
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.3s;
  }

  .close-modal:hover {
    color: white;
  }

  .modal-body {
    padding: 1.5rem;
  }

  .verification-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
  }

  .document-section h4, .user-details-section h4 {
    margin-bottom: 1rem;
    color: var(--text);
    font-weight: 600;
  }

  .document-image {
    border: 1px solid var(--border);
    border-radius: 0.5rem;
    overflow: hidden;
  }

  .document-image img {
    width: 100%;
    height: auto;
    display: block;
  }

  .user-profile {
    display: flex;
    gap: 1rem;
  }

  .profile-image {
    flex-shrink: 0;
  }

  .profile-image img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--primary);
  }

  .profile-details {
    flex-grow: 1;
  }

  .detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  }

  .detail-row:last-child {
    border-bottom: none;
  }

  .detail-label {
    color: var(--text-light);
    font-weight: 500;
  }

  .detail-value {
    color: var(--text);
  }

  .modal-footer {
    border-top: 1px solid var(--border);
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
  }

  @media (max-width: 968px) {
    .verification-content {
      grid-template-columns: 1fr;
    }
    
    .section-header {
      flex-direction: column;
      align-items: flex-start;
    }
    
    .search-input {
      width: 100%;
    }
  }

  @media (max-width: 576px) {
    .action-buttons {
      flex-direction: column;
      gap: 0.5rem;
    }
    
    .user-profile {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    
    .detail-row {
      flex-direction: column;
      gap: 0.25rem;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Center modals when they are shown
    document.querySelectorAll('.modal').forEach(function(modal) {
      modal.addEventListener('show.bs.modal', function() {
        const modalDialog = this.querySelector('.modal-dialog');
        modalDialog.style.margin = 'auto';
      });
    });
  });
</script>
@endsection

