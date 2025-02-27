@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>جميع السيارات</h1>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mb-3">إضافة سيارة جديدة</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الصورة</th>
                <th>الاسم</th>
                <th>الماركة</th>
                <th>الموقع</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td><img src="{{ asset('storage/' . $car->image_url) }}" alt="صورة السيارة" width="100"></td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->location->city }}</td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">رجوع</a>
</div>
@endsection
