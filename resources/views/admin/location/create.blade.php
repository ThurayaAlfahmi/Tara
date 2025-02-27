@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('إضافة موقع جديد') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.location.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="city">{{ __('المدينة') }}</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="branch_name">{{ __('اسم الفرع') }}</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('حفظ الموقع') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
