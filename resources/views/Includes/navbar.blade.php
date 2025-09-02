@php
use Illuminate\Support\Facades\Auth;
@endphp

<nav class="navbar navbar-expand-lg custom-navbar floating-navbar">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('img/logo2.png') }}" alt="RentTent Logo" class="me-2 rounded-circle" style="width: 32px; height: 32px;">
      <span class="logo-text">RentTent</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Items -->
    <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
      <ul class="navbar-nav gap-lg-4">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/properties') }}"><i class="bi bi-building"></i> Properties</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/foodplans') }}"><i class="bi bi-egg-fried"></i> Food Plans</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}"><i class="bi bi-person"></i> About Us</a></li>
      </ul>
    </div>

    <!-- Right Buttons / Profile -->
    <div class="d-flex gap-2 align-items-center">
      @if(session('user'))
        <!-- Logged-in user -->
        <div class="dropdown">
          <a class="d-flex align-items-center" href="{{ route('profile') }}" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ session('user.profile_pic') ? asset('storage/' . session('user.profile_pic')) : asset('img/default-user.png') }}" 
                 class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
            @if(session('user.role') === 'provider')
              <li><a class="dropdown-item" href="{{ route('provider.options') }}">Provider Options</a></li>
            @elseif(session('user.role') === 'vendor')
              <li><a class="dropdown-item" href="{{ route('vendor.options') }}">Vendor Options</a></li>
            @endif
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      @else
        <!-- Not logged-in -->
        <a href="{{ route('register') }}" class="btn signup-btn">Signup</a>
        <a href="{{ route('login') }}" class="btn login-btn">Login</a>
      @endif
    </div>
  </div>
</nav>

<!-- Styles -->
<style>
  .floating-navbar {
    position: fixed; top: 1cm; left: 0; right: 0; width: 100%;
    max-width: 1200px; height: 75px; border-radius: 12px; margin: 0 auto;
    z-index: 1030; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    background: rgba(0,5,15,0.45) !important; backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
  }
  @media (min-width: 1367px) { .floating-navbar { max-width: 1400px; } }
  @media (min-width: 2560px) { 
    .floating-navbar { max-width: 1800px; height: 90px; } 
    .logo-text { font-size: 1.6rem !important; } .nav-link { font-size: 1.1rem !important; }
    .signup-btn, .login-btn { font-size:1.1rem !important; padding:0.6rem 1.5rem !important; }
  }
  .floating-navbar .container { display:flex; justify-content:space-between; align-items:center; height:100%; padding:0 1rem; }
  .navbar-brand img { border:1px solid rgba(100,200,255,0.3); transition: all 0.3s ease; }
  .logo-text { font-weight:700; font-size:1.3rem; color:white; transition: all 0.3s ease; }
  .nav-link { color: rgba(255,255,255,0.8)!important; font-weight:500; display:flex; align-items:center; gap:0.4rem; transition:all 0.3s ease; padding:0.5rem 0; position:relative; }
  .nav-link::after { content:''; position:absolute; bottom:0; left:0; width:0; height:1px; background:#4da6ff; transition: all 0.3s ease; }
  .nav-link:hover { color: rgba(255,255,255,0.9)!important; }
  .nav-link:hover::after { width:100%; }
  .signup-btn { background:transparent; border:1px solid rgba(100,200,255,0.3); color:white; border-radius:50px; padding:0.5rem 1.2rem; }
  .signup-btn:hover { background: rgba(77,166,255,0.1); border-color:#4da6ff; color:#4da6ff; }
  .login-btn { background: rgba(0,150,255,0.2); color:white; border-radius:50px; padding:0.5rem 1.2rem; border:1px solid rgba(0,200,255,0.3); }
  .login-btn:hover { background: rgba(77,166,255,0.2); border-color:#4da6ff; color:#4da6ff; }
  .dropdown-menu {
    min-width: 150px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.25);
    background: rgba(0, 5, 15, 0.45) !important;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    border: 1px solid rgba(100,200,255,0.15);
    transition: background 0.3s cubic-bezier(.4,0,.2,1);
  }
  .dropdown-item {
    transition: background 0.3s ease, color 0.3s ease;
    color: rgba(255,255,255,0.85);
  }
  .dropdown-item:hover {
    background: rgba(77,166,255,0.15);
    color: #4da6ff;
  }
</style>
