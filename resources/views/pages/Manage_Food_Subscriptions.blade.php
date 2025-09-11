@extends('Layout.master_dash')

@section('title', 'Manage Food Subscriptions')

@section('content')
<div class="glass-card w-100 p-4 position-relative">

    <button id="sidebarToggle" class="btn position-absolute" style="top:1rem; right:1rem; z-index:3000; background:transparent; border:none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>

    <h2 class="mb-4">Your Food Packages</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFoodModal">
        <i class="bi bi-plus-circle"></i> Add New Package
    </button>

    @if($foods->isEmpty())
        <p class="text-muted">No packages yet. Start by adding one!</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Preference</th>
                        <th>Monthly Fee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food)
                        <tr>
                            <td>
                                @if($food->image_url)
                                    <img src="{{ asset('storage/' . $food->image_url) }}" class="rounded food-img">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $food->name }}</td>
                            <td>{{ ucfirst($food->food_type) }}</td>
                            <td>{{ ucfirst($food->preference) }}</td>
                            <td>Rs. {{ number_format($food->monthly_fee, 2) }}</td>
                            <td>
                                @if($food->approved)
                                    <span class="text-success fw-bold">✅ Approved</span>
                                @else
                                    <span class="text-warning fw-bold">⏳ Pending</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFoodModal{{ $food->menu_id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('vendor.foods.destroy', $food->menu_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this package?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Add Package Modal -->
<div class="modal fade" id="addFoodModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('vendor.foods.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Food Package</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Package Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Food Type</label>
              <select name="food_type" class="form-select" required>
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
              </select>
            </div>
            <div class="col-md-6"><label class="form-label">Preference</label>
              <select name="preference" class="form-select" required>
                <option value="veg">Veg</option>
                <option value="non_veg">Non-Veg</option>
                <option value="both">Both</option>
              </select>
            </div>
            <div class="col-md-6"><label class="form-label">Monthly Fee</label><input type="number" step="0.01" name="monthly_fee" class="form-control" required></div>
            <div class="col-md-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
            <div class="col-md-6"><label class="form-label">Start Date</label><input type="date" name="start_date" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">End Date</label><input type="date" name="end_date" class="form-control" required></div>
            <div class="col-md-12"><label class="form-label">Image</label><input type="file" name="image" class="form-control"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Package</button>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
.food-img { width:100px; height:100px; object-fit:cover; border-radius:8px; transition: transform .2s;}
.food-img:hover { transform:scale(1.1); box-shadow:0 0 10px rgba(0,0,0,0.3);}
.modal { z-index:2000 !important; }
.modal-backdrop { z-index:1900 !important; }
</style>
@endsection
