<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'User Dashboard')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --sidebar-bg: #0a1929;
      --sidebar-hover: #102a43;
      --primary-accent: #3b82f6;
      --primary-accent-light: #60a5fa;
      --text-primary: #1f2937;
      --text-light: #f8fafc;
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
    }

    body { 
      background-color: #f1f5f9; 
      font-family: 'Inter', sans-serif;
      color: var(--text-primary);
      margin: 0;
      padding: 0;
    }

    /* Fullscreen layout (no sidebar for profile page) */
    .main-content {
      margin: 0;
      width: 100vw;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      padding: 0;
    }

    @media (max-width: 992px) {
      .sidebar { width: 80px; }
      .main-content { margin-left: 80px; width: calc(100% - 80px); }
    }

    @media (max-width: 768px) {
      .sidebar { width: 0; overflow: hidden; }
      .sidebar.active { width: 250px; }
      .main-content { margin-left: 0; width: 100%; }
    }
  </style>
</head>

<body>
<body class="animated-gradient-bg">
  {{-- Navbar --}}
    @include('Includes.navbar')

  <div class="container-fluid p-0" style="min-height:100vh;">
    <div class="row g-0" style="min-height:100vh;">
  <div id="sidebar" class="sidebar d-flex flex-column justify-content-between p-3" style="width:5cm; background:rgba(10,25,41,0.7); min-height:100vh; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); position: fixed; left: 0; top: 0; height: 100vh; z-index: 10; transform: translateX(-100%); transition: transform 0.3s;">
        <!-- Sidebar content -->
        <div>
          <div class="text-center mb-4" style="margin-top:3cm;">
            <img src="{{ session('user.profile_pic') ? asset('storage/' . session('user.profile_pic')) : asset('img/default-user.png') }}" class="rounded-circle mb-2" style="width:80px; height:80px; object-fit:cover;">
            <h5 class="fw-bold text-light">{{ session('user.name') ?? 'User' }}</h5>
            <span class="badge bg-primary">{{ ucfirst(session('user.role') ?? 'Guest') }}</span>
          </div>
          <ul class="nav flex-column gap-2">
            <li class="nav-item">
              <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'fw-bold text-warning' : 'text-light' }}">Profile</a>
            </li>
            <li class="nav-item">
              <a href="#" id="sidebarBoardingList" class="nav-link text-light">Boarding List</a>
            </li>
            <li class="nav-item">
              <a href="#" id="sidebarSubscribedFoods" class="nav-link text-light">Subscribed Foods</a>
            </li>
          </ul>
        </div>
        <div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
          </form>
        </div>
  </div>
  <div class="col-lg-9 col-md-8 main-content d-flex align-items-center justify-content-center p-0" style="background:transparent; min-height:100vh; margin-left:0;">
        @yield('content')
      </div>
    </div>
  </div>

  {{-- Footer --}}
  @include('includes.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    sidebarToggle.addEventListener('click', function() {
      if (sidebar.style.transform === 'translateX(0%)') {
        sidebar.style.transform = 'translateX(-100%)';
      } else {
        sidebar.style.transform = 'translateX(0%)';
      }
    });
  </script>
<button id="chatbot-float-btn" title="Chatbot">
  <img src="{{ asset('img/bot2.gif') }}" alt="Chatbot" style="width: 80px; height: 80px; display: block;">
</button>
<style>
  #chatbot-float-btn {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    background: #fff;
    border: none;
    border-radius: 50%;
    width: 90px;
    height: 90px;
    box-shadow:
      0 4px 16px rgba(0,0,0,0.18),
      0 2px 8px rgba(255,140,0,0.18),
      0 0 0 4px rgba(255,255,255,0.15),
      0 8px 24px 0 rgba(255,140,0,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: box-shadow 0.2s, background 0.2s, transform 0.2s;
    transform: perspective(120px) scale3d(1,1,1) rotateX(8deg) rotateY(-8deg);
  }
  #chatbot-float-btn:hover {
    box-shadow:
      0 8px 32px rgba(255,140,0,0.25),
      0 4px 16px rgba(255,140,0,0.18),
      0 0 0 6px rgba(255,255,255,0.18);
    background: #fffbe6;
    color: #ff9800;
    transform: perspective(120px) scale3d(1.08,1.08,1.08) rotateX(0deg) rotateY(0deg);
  }
  #chatbot-float-btn:hover {
    box-shadow:
      0 8px 32px rgba(255,140,0,0.25),
      0 4px 16px rgba(255,140,0,0.18),
      0 0 0 6px rgba(255,255,255,0.18);
    background: linear-gradient(135deg, #ff9800 60%, #fffbe6 100%);
    transform: perspective(120px) scale3d(1.08,1.08,1.08) rotateX(0deg) rotateY(0deg);
  }
  #chatbot-float-btn:hover {
    box-shadow: 0 8px 24px rgba(255,140,0,0.25);
    background: linear-gradient(135deg, #ff9800 60%, #fffbe6 100%);
  }
</style>
</body>
<style>
  .animated-gradient-bg {
    background: linear-gradient(120deg, #0a2540, #4f8cff, #0a2540);
    background-size: 200% 200%;
    animation: gradientMove 8s ease-in-out infinite;
  }
  @keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
</style>
</html>
