@extends('layouts.admin')

@section('content')


<div class="container">
    <h2>Booking Details</h2>

    <div class="mb-3">
        <strong>Car:</strong> {{ $booking->car->name }}
    </div>
    <div class="mb-3">
        <strong>Pickup Location:</strong> {{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}
    </div>

    <div class="mb-3">
        <strong>Drop-off Location:</strong>{{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}
    </div>
    <div class="mb-3">
        <strong>Start Date:</strong> {{ $booking->start_date }}
    </div>
    <div class="mb-3">
        <strong>End Date:</strong> {{ $booking->end_date }}
    </div>
    <div class="mb-3">
        <strong>Status:</strong> {{ ucfirst($booking->status) }}
    </div>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mb-3">Back</a>
</div>
@endsection
