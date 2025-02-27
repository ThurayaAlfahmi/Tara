@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">تعديل السيارة</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">اسم السيارة</label>
            <input type="text" name="name" class="form-control" value="{{ $car->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control">{{ $car->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">الماركة</label>
            <input type="text" name="brand" class="form-control" value="{{ $car->brand }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الموديل</label>
            <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">السنة</label>
            <input type="number" name="year" class="form-control" min="1900" max="{{ date('Y') }}" value="{{ $car->year }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">السعر اليومي ($)</label>
            <input type="number" step="0.01" name="daily_rate" class="form-control" value="{{ $car->daily_rate }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="location_id">{{ __('الموقع') }}</label>
            <select name="location_id" id="location_id" class="form-control" required>
                <option value="" disabled>{{ __('اختر الموقع') }}</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ $car->location_id == $location->id ? 'selected' : '' }}>
                        {{ $location->city }} - {{ $location->branch_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">التوافر</label>
            <select name="availability" class="form-control">
                <option value="1" {{ $car->availability ? 'selected' : '' }}>متاح</option>
                <option value="0" {{ !$car->availability ? 'selected' : '' }}>غير متاح</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع السيارة</label>
            <select name="car_type" class="form-control">
                    <option value="Family Small"{{ $car->car_type == 'Family Small' ? 'selected' : '' }}>عائلة صغيرة</option>
                    <option value="Family Large"{{ $car->car_type == 'Family Large' ? 'selected' : '' }}>عائلة كبيرة</option>
                    <option value="Sports"{{ $car->car_type == 'Sports' ? 'selected' : '' }}>رياضية</option>
                    <option value="Luxury"{{ $car->car_type == 'Luxury' ? 'selected' : '' }}>فاخرة</option>
                    <option value="Economy"{{ $car->car_type == 'Economy' ? 'selected' : '' }}>اقتصادية</option>
                </select>
        </div>

        <div class="mb-3">
            <label class="form-label">صورة السيارة</label>
            <input type="file" name="image" class="form-control">
            @if ($car->image_url)
                <img src="{{ asset('storage/' . $car->image_url) }}" alt="صورة السيارة" class="mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">تحديث السيارة</button>
    </form>
</div>
@endsection
