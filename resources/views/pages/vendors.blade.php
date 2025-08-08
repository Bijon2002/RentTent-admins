@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  <h2>Registered Vendors</h2>
  <table style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr>
        <th style="border-bottom: 1px solid #ccc; padding: 0.5rem;">ID</th>
        <th style="border-bottom: 1px solid #ccc; padding: 0.5rem;">Name</th>
        <th style="border-bottom: 1px solid #ccc; padding: 0.5rem;">Email</th>
        <th style="border-bottom: 1px solid #ccc; padding: 0.5rem;">Status</th>
        <th style="border-bottom: 1px solid #ccc; padding: 0.5rem;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($vendors as $vendor)
        <tr>
          <td style="padding: 0.5rem;">{{ $vendor->id }}</td>
          <td style="padding: 0.5rem;">{{ $vendor->name }}</td>
          <td style="padding: 0.5rem;">{{ $vendor->email }}</td>
          <td style="padding: 0.5rem;">{{ $vendor->status }}</td>
          <td style="padding: 0.5rem;">
            <!-- Add your CRUD buttons here -->
            <button>Edit</button>
            <button>Delete</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
