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
      max-width: 1600px;
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
    
    nav a {
      color: var(--text-light);
      text-decoration: none;
      font-weight: 500;
      padding-bottom: 0.5rem;
      transition: all 0.3s;
      position: relative;
    }
    
    nav a.active,
    nav a:hover {
      color: white;
    }
    
    nav a.active::after,
    nav a:hover::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
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
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(74, 107, 255, 0.4);
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
      height: 200px;
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

  <!-- Floating Chatbot Button -->
<button id="chatbot-float-btn" title="Chatbot" style="position:fixed; bottom:24px; right:24px; z-index:9999; background:#fff; border:none; border-radius:30px; width:60px; height:60px; box-shadow:0 2px 8px rgba(0,0,0,0.12); display:flex; align-items:center; justify-content:center; cursor:pointer;">
  <img src="{{ asset('img/bott.gif') }}" alt="Chatbot" style="width:54px; height:54px;">
</button>
<!-- Chat Window (hidden by default) -->
<div id="chat-window" style="display:none; position:fixed; bottom:90px; right:24px; width:400px; height:500px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.2); background:#fff; z-index:9999; flex-direction:column;">
  <div style="padding:10px; background:#0a2540; color:#fff; font-weight:bold; border-top-left-radius:12px; border-top-right-radius:12px;">
    RentTent Chat
    <span id="close-chat" style="float:right; cursor:pointer;">&times;</span>
  </div>
  <iframe src="https://cdn.botpress.cloud/webchat/v3.3/shareable.html?configUrl=https://files.bpcontent.cloud/2025/09/05/07/20250905073149-I99PXM74.json&clientId=abe605af-5da9-4952-86a9-b31bb360f547" style="flex:1; border:none; border-bottom-left-radius:12px; border-bottom-right-radius:12px;"></iframe>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
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
</body>
</html>
