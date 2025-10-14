<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login | RentTent</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* Fullscreen slideshow container */
    body, html {
      margin: 0; padding: 0; height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow: hidden;
    }
    .slideshow {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      z-index: -1;
      overflow: hidden;
    }
    .slide {
      position: absolute;
      width: 100%; height: 100%;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1.5s ease-in-out;
    }
    .slide.active {
      opacity: 1;
      z-index: 1;
    }

    /* Center form container */
    .login-container {
      position: relative;
      background: rgba(13, 27, 42, 1);
      border-radius: 1rem;
      padding: 1.8rem 2rem; /* reduced vertical padding */
      max-width: 320px;
      width: 100%;
      box-shadow:
        0 0 15px 2px #2a5fff88,
        0 0 40px 5px #0a2ff9cc;
      border: 1.5px solid #2a5fffaa;
      animation: fadeInSlide 0.8s ease forwards;
      color: #e0e7ff;
      user-select: none;
    }

    @keyframes fadeInSlide {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Logo image */
    .logo {
      display: block;
      margin: 0 auto 1.8rem;
      width: 80px;
      height: auto;
      filter:
        drop-shadow(0 0 6px #2a5fffaa)
        drop-shadow(0 0 12px #2a5fffcc);
      animation: logoPulse 2s infinite ease-in-out;
    }

    @keyframes logoPulse {
      0%, 100% {
        filter:
          drop-shadow(0 0 6px #2a5fffaa)
          drop-shadow(0 0 12px #2a5fffcc);
      }
      50% {
        filter:
          drop-shadow(0 0 10px #3f62ffdd)
          drop-shadow(0 0 20px #3f62ffee);
      }
    }

    /* Heading */
    h3 {
      text-align: center;
      margin-bottom: 1.6rem; /* reduced margin */
      font-weight: 700;
      font-size: 1.7rem;
      color: #9bb8ff;
      letter-spacing: 0.08rem;
      text-shadow: 0 0 6px #2a5fffaa;
    }

    /* Input fields */
    .form-control {
      background: transparent;
      border: 2px solid #2a5fffaa;
      border-radius: 0.7rem;
      padding: 0.65rem 1rem;
      font-size: 1rem;
      color: #cbd5e1;
      box-shadow: inset 0 0 6px #2a5fff44;
      transition: all 0.3s ease;
    }
    .form-control::placeholder {
      color: #8394bbaa;
      font-style: italic;
    }
    .form-control:focus {
      border-color: #4c7dff;
      box-shadow: 0 0 12px #4c7dffaa;
      background: rgba(58, 95, 255, 0.1);
      color: #e0e7ff;
      outline: none;
    }

    /* Checkbox */
    .form-check-label {
      color: #aabbffcc;
      user-select: none;
    }
    .form-check-input {
      border: 2px solid #2a5fffaa;
      background: transparent;
      transition: box-shadow 0.3s ease;
      cursor: pointer;
    }
    .form-check-input:checked {
      background-color: #2a5fffcc;
      border-color: #4c7dff;
      box-shadow: 0 0 12px #4c7dffaa;
    }

    /* Button */
    .btn-login {
      background: linear-gradient(45deg, #2a5fff, #4c7dff);
      border: none;
      border-radius: 0.8rem;
      font-weight: 700;
      font-size: 1.15rem;
      padding: 0.75rem 1rem;
      color: #e0e7ff;
      width: 100%;
      cursor: pointer;
      box-shadow: 0 6px 18px #2a5fffaa;
      transition: all 0.3s ease;
    }
    .btn-login:hover,
    .btn-login:focus {
      background: linear-gradient(45deg, #4c7dff, #2a5fff);
      box-shadow: 0 10px 25px #4c7dffcc;
      transform: translateY(-3px);
      outline: none;
    }

    /* Errors */
    .error-text {
      color: #ff6b6b;
      font-size: 0.9rem;
      margin-top: 0.2rem;
    }
    .alert-danger {
      background-color: #381212aa;
      color: #ff6b6b;
      border-radius: 0.5rem;
      padding: 0.8rem 1rem;
      margin-bottom: 1rem;
      font-weight: 600;
      text-align: center;
      text-shadow: 0 0 4px #ff4f4fcc;
    }
  </style>
</head>
<body>

  <!-- Slideshow Background -->
  <div class="slideshow">
    <div class="slide active" style="background-image: url('/images/2.jpg');"></div>
   
  </div>
<br>
  <!-- Center the login container -->
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container">
      <!-- Your logo image -->
      <img src="{{ asset('images/logo2.png') }}" alt="RentTent Logo" class="logo" />

      <h3>Admin Login</h3>

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="form-label">Email address</label>
        <input
          type="email"
          class="form-control @error('email') is-invalid @enderror"
          id="email"
          name="email"
          placeholder="name@example.com"
          value="{{ old('email') }}"
          required
          autofocus
        />
        @error('email')
          <div class="error-text">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          class="form-control @error('password') is-invalid @enderror"
          id="password"
          name="password"
          placeholder="Your password"
          required
        />
        @error('password')
          <div class="error-text">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4 form-check">
        <input
          type="checkbox"
          class="form-check-input"
          id="remember"
          name="remember"
        />
        <label class="form-check-label" for="remember">Remember Me</label>
      </div>

      @if ($errors->has('email'))
        <div class="alert alert-danger">
          {{ $errors->first('email') }}
        </div>
      @endif

      <button type="submit" class="btn btn-login">
        Login
      </button>
    </form>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
