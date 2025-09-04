@extends('Layout.master')

@section('content')
<div class="signup-page d-flex align-items-center justify-content-center" style="min-height:100vh; background: transparent;">
<style>
@media (min-width: 1200px) {
  .signup-page {
    margin-top: 1cm !important;
  }
}
</style>
  
  <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 1200px; width:100%;">
    <div class="row g-0">
      <!-- Left Section (Form) -->
      <div class="col-md-6 p-5 bg-transparent" style="height: 600px; overflow-y: auto; background: transparent;">
        <div class="text-center mb-4">
          <h2 class="fw-bold">Begin Your Adventure</h2>
          <p class="text-muted">Sign up for your account</p>
        </div>

        <div class="d-flex justify-content-center gap-3 mb-4">
          <a href="#" class="btn btn-outline-dark rounded-circle"><i class="fa-brands fa-apple"></i></a>
          <a href="#" class="btn btn-outline-danger rounded-circle"><i class="fa-brands fa-google"></i></a>
          <a href="#" class="btn btn-outline-dark rounded-circle"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
        <p class="text-center text-muted mb-3">or</p>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="name" placeholder="eli_trekker" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="elitrekker@gmail.com" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="phone" required>
          </div>

          <div class="mb-3">
            <label class="form-label">National ID</label>
            <input type="text" class="form-control" name="nic_number" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Upload NIC Image</label>
            <input type="file" class="form-control" name="nic_image" accept="image/*" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role" required>
              <option value="finder">Finder</option>
              <option value="provider">Provider</option>
              <option value="vendor">Vendor</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" class="form-control" name="profile_pic" accept="image/*">
          </div>

          <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" name="location" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember">
            <label for="remember" class="form-check-label">Remember me</label>
          </div>

          <button type="submit" class="btn btn-dark w-100">Let's Start</button>
        </form>

        <div class="text-center mt-3">
          <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Log in</a>
        </div>
      </div>

      <!-- Right Section (Slideshow) -->
      <div class="col-md-6 d-none d-md-block position-relative">
        <div id="signupCarousel" class="carousel slide h-100" data-bs-ride="carousel">
          <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
              <img src="{{ asset('assets/images/slide01.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 1">
            </div>
            <div class="carousel-item h-100">
              <img src="{{ asset('assets/images/food.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
            </div>
            <div class="carousel-item h-100">
              <img src="{{ asset('assets/images/park.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
            </div>
            <div class="carousel-item h-100">
              <img src="{{ asset('assets/images/yog.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 4">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#signupCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#signupCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="position-absolute top-0 start-0 p-4 text-white">
          <h5 class="fw-bold">Travel the World, Your Way!</h5>
          <p style="max-width: 250px;">Explore destinations at your pace with personalized journeys & unforgettable experiences.</p>
        </div>
        <div class="position-absolute bottom-0 start-0 p-4 text-white">
          <h5 class="fw-bold">Explore the World, Beyond Boundaries!</h5>
          <button class="btn btn-light btn-sm mt-2">Start your adventure today!</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
