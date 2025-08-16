@extends('layout.master')

@section('title', 'Home')

@section('slideshow')
  @include('includes.sidebar')
@endsection

@section('content')
  <div class="content-wrapper bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4">Welcome to RentTent</h2>
    <p>Your content goes here...</p>
  </div>

  @include('includes.suggestions')
@endsection
