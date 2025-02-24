@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Booking</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="car_id" class="form-label">Select Car</label>
            <select name="car_id" id="car_id" class="form-control" required>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}" {{ $car->id == $booking->car_id ? 'selected' : '' }}>
                        {{ $car->name }} - ${{ $car->rate_per_day }}/day
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pickup_location_id" class="form-label">Pickup Location</label>
            <select name="pickup_location_id" id="pickup_location_id" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $booking->pickup_location_id ? 'selected' : '' }}>
                        {{ $location->city }} - {{ $location->branch_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="dropoff_location_id" class="form-label">Drop-off Location</label>
            <select name="dropoff_location_id" id="dropoff_location_id" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $booking->dropoff_location_id ? 'selected' : '' }}>
                        {{ $location->city }} - {{ $location->branch_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $booking->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $booking->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
</div>
@endsection
