<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'RentTent')</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  
  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100 animated-gradient-bg">

  {{-- Navbar --}}
  @include('includes.navbar')

  {{-- Slideshow --}}
  @yield('slideshow')

  {{-- Main Content --}}
  <main class="flex-grow-1 position-relative my-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          @yield('content')
        </div>
      </div>
    </div>
  </main>

  {{-- Footer --}}
  @include('includes.footer')

  {{-- Scripts --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')

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
