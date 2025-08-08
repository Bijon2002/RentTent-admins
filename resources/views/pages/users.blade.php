@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  <h2>Registered Users</h2>
  <table style="width:100%; border-collapse: collapse;">
    <thead>
      <tr>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">ID</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Name</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Email</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Role</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Status</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td style="padding:0.5rem;">{{ $user->id }}</td>
        <td style="padding:0.5rem;">{{ $user->name }}</td>
        <td style="padding:0.5rem;">{{ $user->email }}</td>
        <td style="padding:0.5rem;">{{ $user->role }}</td>
        <td style="padding:0.5rem;">{{ $user->status }}</td>
        <td style="padding:0.5rem;">
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
