@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Bookings</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">New Booking</a>
    <table class="table">
        <thead>
            <tr>
                <th>Car</th>
                <th>Pickup Location</th>
                <th>Drop-off Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->car->name }}</td>
                <td>{{ $booking->pickupLocation->name }}</td>
                <td>{{ $booking->dropoffLocation->name }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>
                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-secondary">View More Locations</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
