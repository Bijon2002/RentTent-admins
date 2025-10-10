@extends('Layout.master_dash')

@section('title', 'Subscription Success')

@section('content')
<div class="container py-4">
    <h2>Subscription Successful! 🎉</h2>
    <p>You have successfully subscribed to <strong>{{ $menu->name }}</strong> by {{ $menu->user->name }}.</p>
    <p>Amount: Rs. {{ number_format($menu->monthly_fee, 2) }}</p>
    <p>Start Date: {{ $menu->start_date }} | End Date: {{ $menu->end_date }}</p>

    <!-- QR Code Display -->
    <div class="my-4">
        <h5>Scan this QR code: </h5>
        <div>{!! $qr_image !!}</div>
    </div>
</div>

<!-- SweetAlert2 Popup -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Subscription Successful!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endsection
