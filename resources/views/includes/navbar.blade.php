<div class="header-top">
  <h1>RentTent Admin</h1>
  <nav>
 
   <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Overview</a>
  <a href="{{ route('properties') }}" class="{{ request()->is('properties') ? 'active' : '' }}">Properties</a>
  <a href="{{ route('vendors') }}" class="{{ request()->is('vendors') ? 'active' : '' }}">Vendors</a>
<a href="{{ route('users') }}" class="{{ request()->is('users') ? 'active' : '' }}">Users</a>
  <a href="{{ route('bookings') }}" class="{{ request()->is('bookings') ? 'active' : '' }}">Bookings</a>

  <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
    @csrf
    <button type="submit" class="logout-btn">Logout</button>
  </form>
  </nav>
</div>
