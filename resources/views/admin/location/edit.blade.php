@extends('layouts.admin')

@section('content')


<div class="container">
    <h1>تعديل الموقع</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.location.update', $locations->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <div class="mb-3">
            <label for="city" class="form-label">المدينة</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $locations->city }}" required>
        </div>

        <div class="mb-3">
            <label for="branch_name" class="form-label">اسم الفرع</label>
            <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{ $locations->branch_name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">تحديث الموقع</button>
        <a href="{{ route('admin.location.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
