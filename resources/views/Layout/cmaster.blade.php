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
  <script>
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

  <style>
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

    .animated-gradient-bg {
      background: rgb(16, 22, 58) !important;
    }
  </style>
</body>
</html>
