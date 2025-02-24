@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Booking Details</h2>

    <div class="mb-3">
        <strong>Car:</strong> {{ $booking->car->name }}
    </div>
    <div class="mb-3">
        <strong>Pickup Location:</strong> {{ $booking->pickupLocation->name }}
    </div>
    <div class="mb-3">
        <strong>Drop-off Location:</strong> {{ $booking->dropoffLocation->name }}
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

    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Cancel</button>
    </form>
</div>
@endsection
