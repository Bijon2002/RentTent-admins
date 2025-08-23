@extends('Layout.master')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow-lg">
        <div class="card-body">
          <h2 class="text-center mb-4 text-success">Sign Up</h2>
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required autofocus>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label for="nic_number" class="form-label">National ID Number</label>
              <input type="text" class="form-control" id="nic_number" name="nic_number" required>
            </div>
            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-select" id="role" name="role" required>
                <option value="finder">Finder</option>
                <option value="provider">Provider</option>
                <option value="vendor">Vendor</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="profile_pic" class="form-label">Profile Picture</label>
              <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="location" class="form-label">Location</label>
              <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Sign Up</button>
          </form>
          <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
