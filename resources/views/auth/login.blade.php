@extends('Layout.master')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-body">
          <h2 class="text-center mb-4 text-primary">Login</h2>
          <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <div class="mt-3 text-center">
            <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Sign up</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
