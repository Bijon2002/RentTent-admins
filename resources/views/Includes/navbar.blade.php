<nav class="navbar navbar-expand-lg custom-navbar floating-navbar">
  <div class="container">
    <!-- Logo with Image -->
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="img/logo2.png" alt="RentTent Logo" class="me-2 rounded-circle" style="width: 32px; height: 32px;">
      <span class="logo-text">RentTent</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Items -->
    <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
      <ul class="navbar-nav gap-lg-4">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="bi bi-house-door"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/properties') }}">
            <i class="bi bi-building"></i> Properties
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/foodplans') }}">
            <i class="bi bi-egg-fried"></i> Food Plans
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/about') }}">
            <i class="bi bi-person"></i> About Us
          </a>
        </li>
      </ul>
    </div>

    <!-- Right Buttons -->
    <div class="d-flex gap-2">
      <a href="{{ route('register') }}" class="btn signup-btn">signup</a>
      <a href="{{ route('login') }}" class="btn login-btn">login</a>
    </div>
  </div>
</nav>

<style>
  /* Sticky fixed navbar on top */
  .floating-navbar {
    position: fixed;
    top: 1cm;
    left: 0;
    right: 0;
    width: 100%;
    max-width: 1200px;
    height: 75px;
    border-radius: 12px;
    margin: 0 auto;
    z-index: 1030;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  background: rgba(0, 5, 15, 0.45) !important;
  backdrop-filter: blur(3px);
  -webkit-backdrop-filter: blur(3px);
  }
  
  /* PC Screen Navbar Width Increase */
  @media (min-width: 1367px) {
    .floating-navbar {
      max-width: 1400px;
    }
  }
  
  /* 4K Screen Support */
  @media (min-width: 2560px) {
    .floating-navbar {
      max-width: 1800px;
      height: 90px;
    }
    .logo-text {
      font-size: 1.6rem !important;
    }
    .nav-link {
      font-size: 1.1rem !important;
    }
    .signup-btn, .login-btn {
      font-size: 1.1rem !important;
      padding: 0.6rem 1.5rem !important;
    }
  }
  
  /* Laptop Screen Navbar Position */
  @media (min-width: 1024px) and (max-width: 1366px) {
    .floating-navbar {
      top: 0.5cm;
    }
  }

  .floating-navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
    padding: 0 1rem;
  }

  /* Glowing bottom border */
  .custom-navbar::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 10%;
    right: 10%;
    height: 2px;
    background: linear-gradient(90deg, rgba(77, 166, 255, 0), rgba(77, 166, 255, 0.7), rgba(77, 166, 255, 0));
    box-shadow: 0 0 10px rgba(77, 166, 255, 0.7);
    animation: borderGlow 3s infinite alternate;
    border-radius: 50%;
  }

  @keyframes borderGlow {
    0% {
      opacity: 0.5;
      box-shadow: 0 0 10px rgba(77, 166, 255, 0.5);
    }
    100% {
      opacity: 1;
      box-shadow: 0 0 15px rgba(77, 166, 255, 0.9);
    }
  }

  /* Logo styles */
  .navbar-brand img {
    border: 1px solid rgba(100, 200, 255, 0.3);
    transition: all 0.3s ease;
  }

  .logo-text {
    font-weight: 700;
    font-size: 1.3rem;
    color: white;
    transition: all 0.3s ease;
  }

  .navbar-brand:hover .logo-text {
    color: #4da6ff;
    text-shadow: 0 0 10px rgba(77, 166, 255, 0.8),
                 0 0 20px rgba(77, 166, 255, 0.6);
  }

  .navbar-brand:hover img {
    box-shadow: 0 0 15px rgba(77, 166, 255, 0.5);
    border-color: rgba(77, 166, 255, 0.7);
  }

  /* Nav links */
  .nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.3s ease;
    padding: 0.5rem 0;
  }

  .nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.3s ease;
    padding: 0.5rem 0;
    position: relative;
  }

  .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background: #4da6ff;
    transition: all 0.3s ease;
  }

  .nav-link:hover {
    color: rgba(255, 255, 255, 0.9) !important;
    text-shadow: 0 0 10px rgba(77, 166, 255, 0.8),
                 0 0 20px rgba(77, 166, 255, 0.6);
  }

  .nav-link:hover::after {
    width: 100%;
  }

  .nav-link i {
    transition: all 0.3s ease;
  }

  .nav-link:hover i {
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 0 10px rgba(77, 166, 255, 0.8),
                 0 0 20px rgba(77, 166, 255, 0.6);
  }

  /* Buttons */
  .signup-btn {
    background: transparent;
    border: 1px solid rgba(100, 200, 255, 0.3);
    color: rgba(255, 255, 255, 0.9);
    border-radius: 50px;
    padding: 0.5rem 1.2rem;
    transition: all 0.3s ease;
  }

  .signup-btn:hover {
    background: rgba(77, 166, 255, 0.1);
    border-color: #4da6ff;
    box-shadow: 0 0 15px rgba(77, 166, 255, 0.3);
    color: #4da6ff;
  }

  .login-btn {
    background: rgba(0, 150, 255, 0.2);
    color: white;
    border-radius: 50px;
    padding: 0.5rem 1.2rem;
    border: 1px solid rgba(0, 200, 255, 0.3);
    transition: all 0.3s ease;
  }

  .login-btn:hover {
    background: rgba(77, 166, 255, 0.2);
    box-shadow: 0 0 20px rgba(77, 166, 255, 0.4);
    border-color: #4da6ff;
    color: #4da6ff;
  }

  /* Body padding so content doesn't go under navbar */
  body {
    padding-top: 80px;
  }
</style>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
