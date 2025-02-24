 @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Summary</h1>

    <!-- Display Car Details -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $booking->car->brand }} {{ $booking->car->model }} ({{ $booking->car->year }})</h5>
            <p class="card-text">{{ $booking->car->description }}</p>
            <ul>
                <li><strong>Daily Rate:</strong> ${{ $booking->car->daily_rate }}</li>
                <li><strong>Location:</strong> {{ $booking->car->location->city }} - {{ $booking->car->location->branch_name }}</li>
            </ul>
        </div>
    </div>

    <!-- Display Booking Details -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Booking Details</h5>
            <ul>
                <li><strong>Start Date:</strong> {{ $booking->start_date }}</li>
                <li><strong>End Date:</strong> {{ $booking->end_date }}</li>
                <li><strong>Total Days:</strong> {{ $booking->total_days }}</li>
                <li><strong>Pickup location:</strong> {{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}</li>
                <li><strong>Dropoff location:</strong> {{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}</li>
                <li><strong>Total Price:</strong> ${{ $booking->total_price }}</li>
                <li><strong>Status:</strong> {{ ucfirst($booking->status) }}</li>
            </ul>
        </div>
    </div>

    <!-- Payment Button -->
    <a href="{{ route('payment.form', $booking->id) }}" class="btn btn-primary">Proceed to Payment</a>
</div>
@endsection