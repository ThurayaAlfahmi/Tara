@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payment for Booking #{{ $booking->id }}</h2>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" name="amount" value="amount" class="form-control" disabled>
        </div>
    
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash">Cash</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-success">Proceed to Payment</button>
    </form>
    
</div>
@endsection
