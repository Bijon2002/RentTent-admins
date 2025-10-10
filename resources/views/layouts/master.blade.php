<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'RentTent Admin Dashboard')</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
   <style>
    :root {
      --primary: #4a6bff;
      --primary-light: #7aa9ff;
      --primary-lighter: #e0e9ff;
      --neon-blue: #00f2ff;
      --neon-purple: #a100ff;
      --text: #e0e0e0;
      --text-light: #b0b0b0;
      --text-lighter: #808080;
      --bg: #121212;
      --card-bg: #1e1e1e;
      --border: #333;
      --success: #00e676;
    }

    /* Light theme variables */
    [data-theme="light"] {
      --primary: #2563eb;
      --primary-light: #3b82f6;
      --primary-lighter: #dbeafe;
      --neon-blue: #0ea5e9;
      --neon-purple: #8b5cf6;
      --text: #1f2937;
      --text-light: #4b5563;
      --text-lighter: #6b7280;
      --bg: #f8fafc;
      --card-bg: #ffffff;
      --border: #e5e7eb;
      --success: #10b981;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.5;
      padding: 1rem;
      min-height: 100vh;
    }

    .container {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
      max-width: 1920px; /* broadened to fit all charts comfortably */
      margin: 0 auto;
    }

    /* Header */
    header {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid var(--border);
      margin-bottom: 1.5rem;
    }

    .header-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    h1 {
      font-size: 1.75rem;
      font-weight: 700;
      background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: gradientShift 8s ease infinite;
      background-size: 200% 200%;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    nav {
      display: flex;
      gap: 1.5rem;
      align-items: center;
    }

    nav {
      background: #1e3a8a; /* Dark blue background */
      border-radius: 0.5rem;
      padding: 0.75rem 1rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    nav a {
      color: #e0e7ff;
      text-decoration: none;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      transition: all 0.3s;
      position: relative;
      background: transparent;
    }

    nav a.active,
    nav a:hover {
      color: white;
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    nav a.active::after,
    nav a:hover::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, #60a5fa, #a78bfa);
      animation: gradientShift 8s ease infinite;
      background-size: 200% 200%;
    }

    .logout-btn {
      background: linear-gradient(90deg, #ff4a4a, #ff1a1a);
      color: white;
      border: none;
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 0 10px rgba(255, 74, 74, 0.3);
    }

    .logout-btn:hover {
      box-shadow: 0 0 15px rgba(255, 74, 74, 0.5);
      transform: translateY(-2px);
    }

    /* Theme toggle button */
    .theme-toggle {
      background: rgba(74, 107, 255, 0.1);
      border: 1px solid var(--primary);
      border-radius: 50%;
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .theme-toggle:hover {
      background: var(--primary);
      color: white;
      box-shadow: 0 0 15px rgba(74, 107, 255, 0.5);
      transform: translateY(-2px);
    }

    .theme-toggle i {
      font-size: 1.2rem;
      transition: all 0.3s ease;
    }

    .theme-toggle .moon-icon {
      opacity: 1;
      transform: rotate(0deg);
    }

    .theme-toggle .sun-icon {
      opacity: 0;
      transform: rotate(180deg);
      position: absolute;
    }

    [data-theme="light"] .theme-toggle .moon-icon {
      opacity: 0;
      transform: rotate(-180deg);
    }

    [data-theme="light"] .theme-toggle .sun-icon {
      opacity: 1;
      transform: rotate(0deg);
    }

    /* Light theme specific adjustments */
    [data-theme="light"] .slide {
      background: rgba(255, 255, 255, 0.9);
      border: 1px solid rgba(37, 99, 235, 0.3);
    }

    [data-theme="light"] .activity {
      background: rgba(248, 250, 252, 0.8);
      border-left: 3px solid var(--primary);
    }

    [data-theme="light"] .activity:hover {
      background: rgba(37, 99, 235, 0.1);
    }

    [data-theme="light"] .form-group input,
    [data-theme="light"] .form-group select,
    [data-theme="light"] .form-group textarea {
      background: rgba(248, 250, 252, 0.8);
      border: 1px solid var(--border);
    }

    /* Main content grid */
    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
    }

    /* Stats cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .stat-card {
      background: var(--card-bg);
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      transition: all 0.3s;
      border: 1px solid rgba(74, 107, 255, 0.1);
      position: relative;
      overflow: hidden;
      opacity: 0;
      transform: translateY(30px) scale(0.95);
      animation: slideUpFade 0.8s ease forwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }
    .stat-card:nth-child(6) { animation-delay: 0.6s; }

    @keyframes slideUpFade {
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .stat-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 12px 30px rgba(74, 107, 255, 0.4);
      border-color: rgba(74, 107, 255, 0.3);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
      animation: gradientShift 8s ease infinite;
      background-size: 200% 200%;
    }

    .stat-card::after {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, transparent, rgba(74, 107, 255, 0.1), transparent);
      transform: rotate(45deg);
      transition: all 0.5s;
      opacity: 0;
    }

    .stat-card:hover::after {
      animation: shimmer 1.5s ease;
    }

    @keyframes shimmer {
      0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
        opacity: 0;
      }
      50% {
        opacity: 1;
      }
      100% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
        opacity: 0;
      }
    }

    .stat-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1rem;
    }

    .stat-icon {
      font-size: 1.5rem;
      background: rgba(74, 107, 255, 0.1);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pulse 2s infinite, rotateIn 0.8s ease;
    }

    @keyframes rotateIn {
      from {
        transform: rotate(-180deg) scale(0);
        opacity: 0;
      }
      to {
        transform: rotate(0deg) scale(1);
        opacity: 1;
      }
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(74, 107, 255, 0.4);
      }
      50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 10px rgba(74, 107, 255, 0);
      }
    }

    .stat-title {
      font-size: 0.9rem;
      color: var(--text-light);
      font-weight: 500;
    }

    .stat-value {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 0.25rem;
      background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: gradientShift 8s ease infinite;
      background-size: 200% 200%;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s ease forwards, gradientShift 8s ease infinite;
    }

    .stat-value[data-animate="true"] {
      animation-delay: 0.8s;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .stat-change {
      font-size: 0.85rem;
      color: var(--success);
      font-weight: 500;
    }

    /* Slideshow section */
    .slideshow-section {
      background: var(--card-bg);
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(74, 107, 255, 0.1);
      position: relative;
      overflow: hidden;
    }

    .slideshow-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
      animation: gradientShift 8s ease infinite;
      background-size: 200% 200%;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    h2 {
      font-size: 1.25rem;
      color: var(--text);
      font-weight: 600;
    }

    .edit-btn {
      background: rgba(74, 107, 255, 0.1);
      color: var(--primary-light);
      border: 1px solid var(--primary);
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
      font-size: 0.8rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
    }

    .edit-btn:hover {
      background: var(--primary);
      color: white;
      box-shadow: 0 0 10px rgba(74, 107, 255, 0.5);
    }

    /* Slideshow */
    .slideshow {
      position: relative;
      height: 150px; /* compact rectangle as requested */
      overflow: hidden;
      border-radius: 0.5rem;
    }

    .slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: opacity 1s ease;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 1rem;
      background: rgba(30, 30, 30, 0.7);
      border: 1px solid rgba(74, 107, 255, 0.3);
    }

    .slide.active {
      opacity: 1;
    }

    .slide-icon {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .slide-title {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .slide-desc {
      font-size: 0.9rem;
      color: var(--text-light);
    }

    /* Quick Actions */
    .quick-actions {
      background: var(--card-bg);
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(74, 107, 255, 0.1);
      position: relative;
      overflow: hidden;
    }

    .quick-actions::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
      animation: gradientShift 8s ease infinite;
      background-size: 200% 200%;
    }

    .action-buttons {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 1rem;
    }

    .action-btn {
      background: rgba(74, 107, 255, 0.1);
      color: var(--primary-light);
      border: 1px solid var(--primary);
      border-radius: 0.5rem;
      padding: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      text-align: center;
      text-decoration: none;
    }

    .action-btn:hover {
      background: var(--primary);
      color: white;
      box-shadow: 0 0 15px rgba(74, 107, 255, 0.5);
      transform: translateY(-3px);
    }

    .action-btn i {
      font-size: 1.5rem;
    }

    /* Recent Activities */
    .activities-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .activity {
      background: rgba(30, 30, 30, 0.5);
      border-left: 3px solid var(--primary);
      padding: 1rem;
      border-radius: 0 0.5rem 0.5rem 0;
      transition: all 0.3s;
    }

    .activity:hover {
      background: rgba(74, 107, 255, 0.1);
      transform: translateX(5px);
    }

    .activity-content {
      font-size: 0.9rem;
      margin-bottom: 0.25rem;
    }

    .activity-time {
      font-size: 0.75rem;
      color: var(--text-lighter);
    }

    /* Modal for CRUD operations */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: var(--card-bg);
      border-radius: 0.75rem;
      padding: 2rem;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 0 30px rgba(0, 242, 255, 0.3);
      border: 1px solid var(--primary);
      position: relative;
      animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .close-modal {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      color: var(--text-light);
      font-size: 1.5rem;
      cursor: pointer;
    }

    .modal-title {
      margin-bottom: 1.5rem;
      color: var(--primary-light);
      font-size: 1.5rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: var(--text-light);
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem;
      background: rgba(30, 30, 30, 0.5);
      border: 1px solid var(--border);
      border-radius: 0.5rem;
      color: var(--text);
      font-family: inherit;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .btn {
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      border: none;
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background: var(--primary-light);
      box-shadow: 0 0 15px rgba(74, 107, 255, 0.5);
    }

    .btn-secondary {
      background: rgba(74, 107, 255, 0.1);
      color: var(--primary-light);
      border: 1px solid var(--primary);
    }

    .btn-secondary:hover {
      background: rgba(74, 107, 255, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .header-top {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
      }

      nav {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 0.5rem;
      }

      .stats-grid {
        grid-template-columns: 1fr;
      }

      .action-buttons {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 480px) {
      body {
        padding: 0.5rem;
      }

      .action-buttons {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    @include('includes.navbar')

    <header>
      <div class="stats-grid">
        @yield('stats')
      </div>
    </header>

    <div class="dashboard-grid">
      @yield('content')
    </div>
  </div>

 
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Theme toggle functionality
    function toggleTheme() {
      const body = document.body;
      const currentTheme = body.getAttribute('data-theme');
      
      if (currentTheme === 'light') {
        body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
      } else {
        body.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
      }
    }

    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', function() {
      const savedTheme = localStorage.getItem('theme') || 'dark';
      document.body.setAttribute('data-theme', savedTheme);
      
      // Animate stats counters with delay
      setTimeout(() => {
        animateStatsCounters();
      }, 500);
      
      // Add loading effects
      addPageLoadEffects();
    });

    // Animate stats counters
    function animateStatsCounters() {
      document.querySelectorAll('.stat-value').forEach((element, index) => {
        const finalText = element.textContent;
        const hasNumbers = /\d/.test(finalText);
        
        if (hasNumbers) {
          const numbers = finalText.match(/\d+/g);
          if (numbers && numbers.length > 0) {
            const targetNumber = parseInt(numbers[0]);
            element.textContent = finalText.replace(/\d+/g, '0');
            
            setTimeout(() => {
              animateCounter(element, 0, targetNumber, finalText, 1500);
            }, index * 200);
          }
        }
      });
    }

    // Counter animation function
    function animateCounter(element, start, end, template, duration) {
      const range = end - start;
      const increment = range / (duration / 16);
      let current = start;
      
      const timer = setInterval(() => {
        current += increment;
        const currentNum = Math.floor(current);
        element.textContent = template.replace(/\d+/g, currentNum.toLocaleString());
        
        if (current >= end) {
          element.textContent = template.replace(/\d+/g, end.toLocaleString());
          clearInterval(timer);
        }
      }, 16);
    }

    // Page load effects
    function addPageLoadEffects() {
      // Stagger animation for cards
      document.querySelectorAll('.stat-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
      });

      // Add hover sound effect (visual feedback)
      document.querySelectorAll('.stat-card, .action-btn, .btn-create').forEach(element => {
        element.addEventListener('mouseenter', () => {
          element.style.transform = element.style.transform + ' scale(1.02)';
        });
        
        element.addEventListener('mouseleave', () => {
          element.style.transform = element.style.transform.replace(' scale(1.02)', '');
        });
      });

      // Parallax effect for background elements
      window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelectorAll('.stat-card');
        
        parallax.forEach((element, index) => {
          const speed = 0.1 * (index + 1);
          element.style.transform = `translateY(${scrolled * speed}px)`;
        });
      });
    }

    // Add refresh animation for live data
    function refreshLiveData() {
      document.querySelectorAll('.stat-value').forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
          element.style.opacity = '1';
          element.style.transform = 'translateY(0)';
          
          // Re-animate counters
          setTimeout(() => {
            animateStatsCounters();
          }, 300);
        }, index * 100);
      });
    }

    // Auto-refresh data every 30 seconds
    setInterval(() => {
      if (document.visibilityState === 'visible') {
        // You can add AJAX call here to fetch fresh data
        refreshLiveData();
      }
    }, 30000);
  </script>
  
  @stack('scripts')

</body>
</html>
