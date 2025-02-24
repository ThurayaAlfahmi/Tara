@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book Car: {{ $car->name }}</h1>

    <!-- Display Car Details -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</h5>
            <p class="card-text">{{ $car->description }}</p>
            <ul>
                <li><strong>Daily Rate:</strong> ${{ $car->daily_rate }}</li>
                <li><strong>Location:</strong> {{ $car->location->city }} - {{ $car->location->branch_name }}</li>
                <li><strong>Availability:</strong> {{ $car->availability ? 'Available' : 'Not Available' }}</li>
            </ul>
        </div>
    </div>

    <!-- Booking Form -->
    <form action="{{ route('confirm.booking', $car->id) }}" method="POST">
        @csrf
        <input type="hidden" name="car_id" value="{{ $car->id }}">

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </form>
</div>
@endsection