@extends('layouts.admin')

@section('content')
<div class="container car-form">
    <h2 class="mb-4">إضافة سيارة جديدة</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">اسم السيارة</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">الماركة</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الموديل</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">سنة الصنع</label>
            <input type="number" name="year" class="form-control" min="1900" max="{{ date('Y') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">السعر اليومي ($)</label>
            <input type="number" step="0.01" name="daily_rate" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الموقع</label>
            <select name="location_id" class="form-control" required>
                <option value="" disabled selected>اختر الموقع</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">التوفر</label>
            <select name="availability" class="form-control">
                <option value="1">متاح</option>
                <option value="0">غير متاح</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع السيارة</label>
            <select name="car_type" class="form-control" required>
                <option value="" disabled selected>اختر نوع السيارة</option>
                <option value="Family Small">عائلية صغيرة</option>
                <option value="Family Large">عائلية كبيرة</option>
                <option value="Sports">رياضية</option>
                <option value="Luxury">فاخرة</option>
                <option value="Economy">اقتصادية</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">صورة السيارة</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">إضافة السيارة</button>
    </form>
</div>
@endsection
