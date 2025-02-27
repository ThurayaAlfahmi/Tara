@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

                <div class="card-body">
                   

                    <!-- Cars Section -->
                    <h2>السيارات</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>الصورة</th>
                                    <th>الاسم</th>
                                    <th>العلامة التجارية</th>
                                    <th>الموقع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $car)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $car->image_url) }}" alt="صورة السيارة" width="100"></td>
                                    <td>{{ $car->name }}</td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->location->city }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">عرض المزيد من السيارات</a>

                    <!-- Locations Section -->
                    <h2 class="mt-4">المواقع</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>المدينة</th>
                                    <th>اسم الفرع</th>
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
                    <a href="{{ route('admin.location.index') }}" class="btn btn-secondary">عرض المزيد من المواقع</a>

                    <!-- Bookings Section -->
                    <h2 class="mt-4">الحجوزات</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>السيارة</th>
                                    <th>موقع الاستلام</th>
                                    <th>موقع التسليم</th>
                                    <th>تاريخ البدء</th>
                                    <th>تاريخ الانتهاء</th>
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
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">عرض المزيد من الحجوزات</a>

                    <!-- Payments Section -->
                    <h2 class="mt-4">المدفوعات</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>رقم الحجز</th>
                                    <th>المبلغ</th>
                                    <th>طريقة الدفع</th>
                                    <th>الحالة</th>
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
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">عرض المزيد من المدفوعات</a>

                </div>
            </div>
@endsection
