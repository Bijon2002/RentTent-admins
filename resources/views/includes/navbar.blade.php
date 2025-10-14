<div class="header-top">
  <h1>RentTent Admin</h1>
  <nav>
 
   <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Overview</a>
  <a href="{{ route('admin.properties') }}" class="{{ request()->is('properties') ? 'active' : '' }}">Properties</a>
  <a href="{{ route('admin.vendors') }}" class="{{ request()->is('vendors') ? 'active' : '' }}">Vendors</a>
<a href="{{ route('admin.users.index') }}" class="{{ (request()->is('users') || request()->is('admin/users')) ? 'active users-active' : '' }}" style="cursor:default;">Users</a>
  <a href="{{ route('admin.bookings') }}" class="{{ request()->is('bookings') ? 'active' : '' }}">Bookings</a>

  <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
    <i class="moon-icon">🌙</i>
    <i class="sun-icon">☀️</i>
  </button>

  <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
    @csrf
    <button type="submit" class="logout-btn">Logout</button>
  </form>
  </nav>
</div>
