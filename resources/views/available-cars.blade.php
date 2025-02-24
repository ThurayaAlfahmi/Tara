@extends('layouts.app')

@section('content')

@foreach($availableCars as $car)
    <div>
        <h3>{{ $car->name }}</h3>
        <p>{{ $car->description }}</p>
        <p>Brand: {{ $car->brand }}</p>
        <p>Model: {{ $car->model }}</p>
        <p>Daily Rate: ${{ $car->daily_rate }}</p>
        <a href="{{ route('book.car', $car->id) }}">Book Now</a>
    </div>
@endforeach
@endsection