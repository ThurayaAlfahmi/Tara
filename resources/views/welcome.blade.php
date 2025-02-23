<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome to Car Rental')

@section('content')
<div class="text-center">
    <h1>Welcome to Car Rental</h1>
    <p>Find the perfect car for your journey.</p>
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('register') }}" class="btn btn-success">Register</a>
    @endguest
</div>
@endsection
