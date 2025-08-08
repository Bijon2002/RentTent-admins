@extends('layouts.master')

@section('stats')
  @include('includes.stats')
@endsection

@section('content')
  <h2>Registered Properties</h2>
  <table>
    <thead>
      <tr><th>ID</th><th>Title</th><th>Status</th></tr>
    </thead>
    <tbody>
      @foreach($properties as $property)
        <tr>
          <td>{{ $property->id }}</td>
          <td>{{ $property->title }}</td>
          <td>{{ $property->status }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
