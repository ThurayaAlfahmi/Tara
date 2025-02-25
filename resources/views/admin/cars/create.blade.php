@extends('layouts.admin')



@section('content')
<div class="container">
    <h2 class="mb-4">Add New Car</h2>

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
            <label class="form-label">Car Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" min="1900" max="{{ date('Y') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Daily Rate ($)</label>
            <input type="number" step="0.01" name="daily_rate" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="location_id">{{ __('Location') }}</label>
            <select name="location_id" id="location_id" class="form-control" required>
                <option value="" disabled selected>{{ __('Select Location') }}</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->city }} - {{ $location->branch_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Availability</label>
            <select name="availability" class="form-control">
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Car Type</label>
            <select name="car_type" class="form-control" required>
                <option value="" disabled selected>Select Car Type</option>
                <option value="Family Small">Family Small</option>
                <option value="Family Large">Family Large</option>
                <option value="Sports">Sports</option>
                <option value="Luxury">Luxury</option>
                <option value="Economy">Economy</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Car Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Car</button>
    </form>
</div>
@endsection

