@extends('layouts.admin')

@section('content')


<div class="container">
    <h2>تفاصيل الحجز</h2>

    <div class="mb-3">
        <strong>السيارة:</strong> {{ $booking->car->name }}
    </div>
    
    <div class="mb-3">
        <img src="{{ asset('storage/' . $booking->car->image_url) }}" alt="Car Image" class="img-fluid" width="300">
    </div>
    
    <div class="mb-3">
        <strong>موقع الاستلام:</strong> {{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}
    </div>

    <div class="mb-3">
        <strong>موقع التسليم:</strong> {{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}
    </div>
    
    <div class="mb-3">
        <strong>تاريخ البدء:</strong> {{ $booking->start_date }}
    </div>
    
    <div class="mb-3">
        <strong>تاريخ الانتهاء:</strong> {{ $booking->end_date }}
    </div>
    
    <div class="mb-3">
        <strong>الحالة:</strong> {{ ucfirst($booking->status) }}
    </div>
    
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mb-3">رجوع</a>
</div>
@endsection
