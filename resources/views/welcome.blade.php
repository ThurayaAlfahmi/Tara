<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome to Car Rental')

@section('content')
<div class="text-center">
    <h1>Welcome to Car Rental</h1>
    <form action="{{ route('search.cars') }}" method="GET">
        <label for="pickup_location">Pickup Location:</label>
        <select name="pickup_location" id="pickup_location">
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
            @endforeach
        </select>
    
        <label for="dropoff_location">Dropoff Location:</label>
        <select name="dropoff_location" id="dropoff_location">
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
            @endforeach
        </select>
    
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date">
    
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date">
    
        <button type="submit">Search</button>
    </form>

    <h2> Cars</h2>
    <div class="flex-container">
        @foreach($cars as $car)
            <div class="card">
                <td><img src="{{ asset('storage/' . $car->image_url) }}" alt="Car Image" width="100"></td>
                <h3>{{ $car->model }}</h3>
                <p>{{ $car->make }}</p>
                <p>{{ $car->year }}</p>
                <p>{{ $car->price }}</p>            
            </div>
        @endforeach
</div>
@endsection
