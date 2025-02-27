@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>جميع المدفوعات</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>رقم المعرف</th>
                <th>رقم الحجز</th>
                <th>المبلغ</th>
                <th>طريقة الدفع</th>
                <th>الحالة</th>
                <th>التاريخ</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->booking_id }}</td>
                <td>${{ $payment->amount }}</td>
                <td>{{ ucfirst($payment->payment_method) }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    @if($payment->status == 'pending')
                    <form action="{{ route('admin.update.payment', $payment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">تأكيد الدفع</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">رجوع</a>
</div>

@endsection
