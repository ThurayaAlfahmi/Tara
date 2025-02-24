@extends('layouts.app')
@section('content')


<form action="{{ route('process.payment', $booking->id) }}" method="POST">
    @csrf
    <label for="payment_method">Payment Method:</label>
    <select name="payment_method" id="payment_method">
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
        <option value="cash">Cash</option>
    </select>

    <button type="submit">Pay Now</button>
</form>

@endsection