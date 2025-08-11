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
  
  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  
  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

  {{-- Navbar --}}
  @include('includes.navbar')

  {{-- Slideshow --}}
  @yield('slideshow')

  {{-- Main Content --}}
  <main class="flex-grow-1 position-relative my-4">
    <div class="container">
      <div class="row justify-content-center">
        {{-- Centered Content --}}
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

</body>
</html>
