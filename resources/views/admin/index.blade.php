@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

                <div class="card-body">
                   

                    <!-- Cars Section -->
                    <h2>Cars</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $car)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $car->image_url) }}" alt="Car Image" width="100"></td>
                                    <td>{{ $car->name }}</td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->location->city }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">View More Cars</a>

                    <!-- Locations Section -->
                    <h2 class="mt-4">Locations</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>Branch Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $location)
                                <tr>
                                    <td>{{ $location->city }}</td>
                                    <td>{{ $location->branch_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('admin.location.index') }}" class="btn btn-secondary">View More Locations</a>

                    <!-- Bookings Section -->
                    <h2 class="mt-4">Bookings</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Car</th>
                                    <th>Pickup Location</th>
                                    <th>Drop-off Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->car->name }}</td>
                                    <td>{{ $booking->pickupLocation->city }} - {{ $booking->pickupLocation->branch_name }}</td>
                                    <td>{{ $booking->dropoffLocation->city }} - {{ $booking->dropoffLocation->branch_name }}</td>
                                    <td>{{ $booking->start_date}}</td>
                                    <td>{{ $booking->end_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">View More Bookings</a>

                    <!-- Payments Section -->
                    <h2 class="mt-4">Payments</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->booking_id }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">View More Payments</a>

                </div>
            </div>
@endsection
