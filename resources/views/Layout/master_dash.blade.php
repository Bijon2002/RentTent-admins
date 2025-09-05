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

    .animated-gradient-bg {
      background: url('{{ asset('img/bacck.jpg') }}') no-repeat center center fixed;
      background-size: cover;
    }

    #chatbot-float-btn {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 9999;
      background: #fff;
      border: none;
      border-radius: 30px;
      width: 60px;
      height: 60px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: transform 0.18s cubic-bezier(0.4,0.2,0.2,1);
    }
    #chatbot-float-btn:hover {
      transform: translateY(-7px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }
  </style>
</head>

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
            <span class="badge bg-primary">{{ session('user.role') ? ucfirst(session('user.role')) : ($user ? ucfirst($user->role) : 'Guest') }}</span>
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

  <!-- Floating Chatbot Button -->
  <button id="chatbot-float-btn" title="Chatbot">
    <img src="{{ asset('img/bott.gif') }}" alt="Chatbot" style="width: 54px; height: 54px;">
  </button>

  <!-- Chat Window with Botpress iframe -->
  <div id="chat-window" style="display:none; position:fixed; bottom:90px; right:24px; width:400px; height:500px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.2); background:#fff; z-index:9999; flex-direction:column;">
    <div id="chat-header" style="padding:10px; background:#0a2540; color:#fff; font-weight:bold; border-top-left-radius:12px; border-top-right-radius:12px;">
      RentTent Chat
      <span id="close-chat" style="float:right; cursor:pointer;">&times;</span>
    </div>
    <iframe
      id="chat-iframe"
      src="https://cdn.botpress.cloud/webchat/v3.3/shareable.html?configUrl=https://files.bpcontent.cloud/2025/09/05/07/20250905073149-I99PXM74.json&clientId=abe605af-5da9-4952-86a9-b31bb360f547"
      style="flex:1; border:none; border-bottom-left-radius:12px; border-bottom-right-radius:12px;">
    </iframe>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sidebar toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener('click', function() {
        sidebar.style.transform = (sidebar.style.transform === 'translateX(0%)') ? 'translateX(-100%)' : 'translateX(0%)';
      });
    }

    // Chatbot toggle
    const chatWindow = document.getElementById('chat-window');
    const chatBtn = document.getElementById('chatbot-float-btn');
    const chatClose = document.getElementById('close-chat');

    chatBtn.addEventListener('click', () => {
      chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
    });

    chatClose.addEventListener('click', () => {
      chatWindow.style.display = 'none';
    });
  </script>
</body>
</html>
