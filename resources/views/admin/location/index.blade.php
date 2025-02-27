@extends('layouts.admin')

@section('content')


<div class="container">
    <h1>جميع المواقع</h1>
    <a href="{{ route('admin.location.create') }}" class="btn btn-primary mb-3">إضافة موقع جديد</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>المدينة</th>
                <th>اسم الفرع</th>
                <th>الخيارات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
            <tr>
                <td>{{ $location->city }}</td>
                <td>{{ $location->branch_name }}</td>
                <td>
                    <a href="{{ route('admin.location.edit', $location->id) }}" class="btn btn-warning">تعديل</a>
                    <form action="{{ route('admin.location.destroy', $location->id) }}" method="POST" style="display:inline;">
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
