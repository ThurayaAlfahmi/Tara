@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payment Details</h2>

    <p><strong>Booking ID:</strong> {{ $payment->booking->id }}</p>
    <p><strong>Amount:</strong> ${{ $payment->amount }}</p>
    <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>

    <a href="{{ route('bookings.index') }}" class="btn btn-primary">Back to Bookings</a>
</div>
@endsection
