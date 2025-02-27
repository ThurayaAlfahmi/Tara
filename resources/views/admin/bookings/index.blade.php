@extends('layouts.admin')

@section('content')


<div class="container">
    <h2>حجوزاتي</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>السيارة</th>
                <th>موقع الاستلام</th>
                <th>موقع التسليم</th>
                <th>تاريخ البدء</th>
                <th>تاريخ الانتهاء</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr class="clickable-row" data-href="{{ route('bookings.show', $booking->id) }}" style="cursor: pointer;">
                <td>{{ $booking->car->name }}</td>
                <td>{{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}</td>
                <td>{{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}</td>  
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td>{{ ucfirst($booking->status) }}</td>  
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">رجوع</a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".clickable-row").forEach(row => {
            row.addEventListener("click", function() {
                window.location.href = this.dataset.href;
            });
        });
    });
</script>
@endsection
