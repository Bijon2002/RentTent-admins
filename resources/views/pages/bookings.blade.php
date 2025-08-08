@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  <h2>Booking Requests</h2>
  <table style="width:100%; border-collapse: collapse;">
    <thead>
      <tr>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">ID</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Property</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">User</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Date</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Status</th>
        <th style="padding:0.5rem; border-bottom:1px solid #ccc;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bookings as $booking)
      <tr>
        <td style="padding:0.5rem;">{{ $booking->id }}</td>
        <td style="padding:0.5rem;">{{ $booking->property }}</td>
        <td style="padding:0.5rem;">{{ $booking->user }}</td>
        <td style="padding:0.5rem;">{{ $booking->date }}</td>
        <td style="padding:0.5rem;">{{ ucfirst($booking->status) }}</td>
        <td style="padding:0.5rem;">
          <button>Edit</button>
          <button>Delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
